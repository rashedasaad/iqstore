<?php

namespace App\Http\Controllers;

use App\Mail\message as MailMessage;
use App\Mail\Refound as MailRefound;
use App\Mail\Manage as MailManage;
use App\Models\message;
use App\Models\order;
use App\Models\product;
use App\Models\section;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Storage;
use Mockery\Expectation;

class AdminpageController extends Controller
{
    public function __construct()
    {
      if(!isset($_COOKIE["dsfsde3wrfds"])){
        return abort(404);
    }
    if ($_COOKIE["dsfsde3wrfds"] == null) {
        return abort(404);
    }
        if ($_COOKIE["dsfsde3wrfds"] != "sdirfyw8493509234irjefdns98230wjsdkbro8pse9upidji") {
          return abort(404);
        }
    }




    public function users()
    {
        $users = User::all();
        return view("admin/admins", compact("users"));
    }
    public function login()
    {
        return view("admin/login");
    }
    public function loginstore(Request $request)
    {
        $form = $request->validate([
            "username" =>   "required",
            "password" => "required"
        ]);



        $check_customer = User::where('username', $form["username"])->get();


        if (sizeof($check_customer) != 0) {
            if (Hash::check($form["password"], $check_customer[0]["password"])) {
                $request->session()->put("admin", [
                    "username" => $check_customer[0]["username"],
                ]);
                return redirect("/admin/users");
            } else {
                return redirect("/admin/login")->with(['statusbad' => "Check the password or the username", "bool" => false]);
            }
        } else {
            return redirect("/admin/login");
        }
    }
    public function createuser(Request $request)
    {
        $form = $request->validate([
            "username" =>   "required",
            "password" => "required",
            "re_password" => "required"
        ]);

        $username = $form["username"];
        $password = $form["password"];
        $re_password = $form["re_password"];
        $userinfor = User::where("username", $username)->get();

        if (sizeof($userinfor) != 0) {
            return redirect("admin/users")->with(['statusbad' => "There are a user with the same username", "bool" => false]);
        }
        if ($password != $re_password) {
            return redirect("admin/users")->with(['statusbad' => "The password and re password is not the same", "bool" => false]);
        }

        User::create([
            "username" => $username,
            "password" => Hash::make($password, ['rounds' => 12,])
        ]);

        return redirect("admin/users");
    }
    public function deleteuser(Request $request)
    {
        $form = $request->validate([
            "id" => "required",
        ]);

        $id = $form["id"];

        User::find($id)->delete();



        return redirect("admin/users")->with(['statusbad' => "User is deleted sucssful", "bool" => true]);
    }
    public function updateuser(Request $request)
    {
        $form = $request->validate([
            "id" => "required",
            "username" => "required",
            "password" => "required",
            "re_password" => "required",
        ]);

        if ($form["password"] != $form["re_password"]) {
            return redirect("admin/users")->with(['statusbad' => "The password and the re password is not the same.", "bool" => false]);
        }
        User::where("id", $form["id"])->update(["username" => $form["username"], "password" =>  Hash::make($form["password"], ['rounds' => 12,])]);

        return redirect("admin/users")->with(['status' => "The user is updated sucsesfull", "bool" => true]);;
    }
    public function feedback()
    {
        $messges = message::orderBy("id","desc")->paginate(10);
        return view("admin/messages", compact("messges"));
    }
    public function deletefeedback(Request $request)
    {
        $form = $request->validate([
            "id" => "required",
        ]);

        $id = $form["id"];

        message::find($id)->delete();

        return back()->with(['status' => "The message was deleted succsessfuly", "bool" => true]);
    }
    public function feedbacksendmail(Request $request)
    {
        $form = $request->validate([
            "email" => "required",
            "title" => "required",
            "massage" => "required",

        ]);
        $email_file =  $request->file('email_file');
        if (isset($email_file) == true) {
            $filenameWithExt = $request->file('email_file')->getClientOriginalName();

            $filename = pathinfo($filenameWithExt, PATHINFO_FILENAME);

            $extension = $request->file('email_file')->getClientOriginalExtension();

            $fileNameToStore = $filename . '_' . time() . '.' . $extension;

            $path = $request->file('email_file')->storeAs('public/file', $fileNameToStore);

            $request->session()->put("filepath", [
                "path" => env("STORE_PATH") . "/" . $path
            ]);

            $info = $request->session()->get("filepath");



            $data = [
                "title" => $form["title"],
                "massage" => $form["massage"],
                "path" =>  $info["path"],
                "filename" => $filename,
                "extension" => $extension
            ];
            try {
                Mail::to($form["email"])->send(new MailManage($data));
            } catch (\Throwable $th) {
                return back()->with(['statusbad' => "The email coudn't be sent", "bool" => false]);
            }
            unlink($info["path"]);
            $request->session()->forget("filepath");
        } else {
            $data = [
                "title" => $form["title"],
                "message" => $form["massage"],
            ];
            try {
                Mail::to($form["email"])->send(new MailRefound($data));
            } catch (\Throwable $th) {
                return back()->with(['statusbad' => "The email coudn't be sent", "bool" => false]);
            }
        }

        return Redirect("admin/feedback")->with(['status' => "The email hase been sent", "bool" => true]);;
    }
    public function orders()
    {
        $orders = order::orderBy("id","desc")->paginate(10);

      


        return view("admin/orders", compact("orders"));
    }
    public function deleteorder(Request $request)
    {
        $form = $request->validate([
            "id" => "required",
        ]);

        order::find($form["id"])->delete();
        return back()->with(['status' => "The order has been deleted", "bool" => true]);
    }
    public function refound(Request $request)
    {
        $form = $request->validate([
            "id" => "required",
        ]);




        $stripe = new \Stripe\StripeClient(
            env("stripe_key"),
        );

        try {
            $order = order::where("id", $form["id"])->first();

            $stripe->refunds->create([
                'charge' =>  (string)$order->refund,
            ]);

            $data = [
                "title" => "Refound",
                "message" => "Your Refound was sucssful",
            ];

            Mail::to($order->email)->send(new MailRefound($data));
            order::find($form["id"])->delete();
        } catch (Expectation $error) {
            return back()->with(['statusbad' => $error, "bool" => false]);
        }
        return back()->with(['status' => "The refound has been succsesful", "bool" => true]);
    }
    public function ordersendmail(Request $request)
    {
        $form = $request->validate([
            "id" => "required",
            "email" => "email",
            "title" => "required",
            "massage" => "required",


        ]);

        $email_file =  $request->file('email_file');
        if (isset($email_file) == true) {
            $filenameWithExt = $request->file('email_file')->getClientOriginalName();

            $filename = pathinfo($filenameWithExt, PATHINFO_FILENAME);

            $extension = $request->file('email_file')->getClientOriginalExtension();

            $fileNameToStore = $filename . '_' . time() . '.' . $extension;

            $path = $request->file('email_file')->storeAs('public/file', $fileNameToStore);

            $request->session()->put("filepath", [
                "path" => env("STORE_PATH") . "/" . $path
            ]);

            $info = $request->session()->get("filepath");



            $data = [
                "title" => $form["title"],
                "massage" => $form["massage"],
                "path" =>  $info["path"],
                "filename" => $filename,
                "extension" => $extension
            ];
            try {
                Mail::to($form["email"])->send(new MailManage($data));
            } catch (\Throwable $th) {
                return back()->with(['statusbad' => "The email coudn't be sent", "bool" => false]);
            }
            unlink($info["path"]);
            $request->session()->forget("filepath");
        } else {
            $data = [
                "title" => $form["title"],
                "message" => $form["massage"],
            ];
            try {
                Mail::to($form["email"])->send(new MailRefound($data));
            } catch (\Throwable $th) {
                return back()->with(['statusbad' => "The email coudn't be sent", "bool" => false]);
            }
        }






        return back()->with(['status' => "The email has been sent", "bool" => true]);
    }
    public function products()
    {
        $secions = section::all();
        $products = product::paginate(9);
        return view("admin/products", compact("secions", "products"));
    }
    public function create_type(Request $request)
    {
        $form = $request->validate([
            "arabic_type" => "required",
            "english_type" => "required"
        ]);

        $arabic_type = $form["arabic_type"];
        $english_type = $form["english_type"];

        $d =  section::where("en", $english_type)->orWhere("ar", $arabic_type)->first();

        if (strtolower($arabic_type)== "الكل" || strtolower($english_type) == "all") {
        
            return redirect("admin/products")->with(['status' => "There is a section with that name", "bool" => false]);
        }
        if ($d) {
            return back()->with(['statusbad' => "There is a section with that name", "bool" => false]);
        }
        section::create([
            "ar" =>   $arabic_type,
            "en" =>   $english_type
        ]);

        return back()->with(['status' => "The type has been created", "bool" => true]);;
    }
    public function delete_type(Request $request)
    {
        $form = $request->validate([
            "target" => "required",
        ]);

        section::where("en",  $form["target"])->delete();

        return back()->with(['status' => "The type is deleted", "bool" => true]);;
    }
    public function update_type(Request $request)
    {
        $form = $request->validate([
            "target" => "required",
            "arabic_type" => "required",
            "english_type" => "required",
        ]);

        $arabic_type = $form["arabic_type"];
        $english_type = $form["english_type"];

        $d =  section::where("en", $english_type)->orWhere("ar", $arabic_type)->first();

        if ($arabic_type == "الكل" || $english_type == "all" || $english_type == "ALL") {
            return back()->with(['statusbad' => "There is a section with that name", "bool" => false]);
        }
        if ($d) {
            return back()->with(['statusbad' => "There is a section with that name", "bool" => false]);
        }

        section::where("en",  $form["target"])->update(["en" => $form["english_type"], "ar" => $form["arabic_type"]]);
        return back()->with(['status' => "The type is updated", "bool" => true]);
    }
    public function createproduct(Request $request)
    {
        $form = $request->validate([
            "product_name" => "required",
            "product_price" => "required",
            "type" => "required",
            "image" => "required",
        ]);

        $type = section::where("en",  $form["type"])->first();

        if (!$type) {
            return back()->with(['statusbad' => "There are no section with that name", "bool" => false]);
        }

        $filenameWithExt = $request->file('image')->getClientOriginalName();
        $filename = pathinfo($filenameWithExt, PATHINFO_FILENAME);
        $extension = $request->file('image')->getClientOriginalExtension();
        $fileNameToStore = $filename . '_' . time() . '.' . $extension;
        $path = $request->file('image')->move(public_path('images'), $fileNameToStore);



        product::create(["section" => $form["type"], "name" => $form["product_name"], "price" => $form["product_price"], "img" => $fileNameToStore, "subs" => 0]);

        return back()->with(['status' => "The product has been created", "bool" => true]);
    }
    public function updateproduct(Request $request)
    {
        $form = $request->validate([
            "id" => "required",
            "product_name" => "required",
            "product_price" => "required",
            "type" => "required",
        ]);



        $type = section::where("en",  $form["type"])->first();


        if (!$type) {
            return back()->with(['statusbad' => "There are no section with that name", "bool" => false]);
        }

        if (!$request->file('image')) {
            product::where("id", $form["id"])->update([
                "section" => $form["type"],
                "name" => $form["product_name"],
                "price" => $form["product_price"],
                "subs" => 0
            ]);

            return back()->with(['status' => "The product has been updated", "bool" => true]);
        } else {
            $img = product::where("id", $form["id"])->first();

            unlink(public_path('images') . "/" .$img->img);

            $filenameWithExt = $request->file('image')->getClientOriginalName();
            //Get just filename
            $filename = pathinfo($filenameWithExt, PATHINFO_FILENAME);
            // Get just ext
            $extension = $request->file('image')->getClientOriginalExtension();
            // Filename to store
            $fileNameToStore = $filename . '_' . time() . '.' . $extension;
            // Upload Image
            $path = $request->file('image')->move(public_path('images'), $fileNameToStore);

            product::where("id", $form["id"])->update([
                "section" => $form["type"],
                "name" => $form["product_name"],
                "price" => $form["product_price"],
                "img" => $fileNameToStore,
                "subs" => 0
            ]);

            return back()->with(['status' => "The product has been updated", "bool" => true]);
        }
    }
    public function deleteproduct(Request $request)
    {
        $form = $request->validate([
            "id" => "required",
        ]);

        $product  = product::where("id",  $form["id"])->first();

        unlink(public_path('images') . "/" . $product->img);

        $product->delete();


        return back()->with(['status' => "The product has been deleted", "bool" => true]);;
    }
    public function logout(Request $request)
    {

        $request->session()->forget("admin");
       return redirect("/");
    }
}
