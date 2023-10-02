<?php

namespace App\Http\Controllers;

use App\Models\message;
use App\Models\product;
use App\Models\section;
use Illuminate\Http\Request;

class MainpageController extends Controller
{

 
    public function index()
    {


       $products = product::paginate(9);
       $sections = section::with("products");
       $sections = section::all();
      $lang_arrays = []; 
       for ($i=0; $i < count($sections); $i++) { 
          array_push($lang_arrays, ["en" => $sections[$i]->en, "ar" =>  $sections[$i]->ar]);
       }
 
     

      return view("home",compact("products","lang_arrays",));
    }

    public function index_ar()
    {


       $products = product::paginate(9);
       $sections = section::all();
      $lang_arrays = []; 
       for ($i=0; $i < count($sections); $i++) { 
          array_push($lang_arrays, ["en" => $sections[$i]->en, "ar" =>  $sections[$i]->ar]);
       }

     

      return view("home_ar",compact("products","lang_arrays"));
    }


    public function basket()
    {
      return view("cart");
    }
    public function basket_ar()
    {
      return view("cart_ar");
    }
    public function formcontact(Request $request)
    {
      $form = $request->validate([
        "email" => "email",
        "message" => "required"
      ]);

     $email = $form["email"];
     $number =$request->input("number");
     $message = $form["message"];
  
    if(FuncController::emailfilter($email) == "fail"){

      return back()->with(['statusbad' => "Please check you email", "bool" => false]);;

    }
    if(FuncController::phonenummber($number) == "fail"){

      return back()->with(['statusbad' => "Please check your phone nummber", "bool" => false]);;

    }
    if(FuncController::message($message) == "fail"){

      return back()->with(['statusbad' => "Please check your the syntaxs", "bool" => false]);;
    }
    $message =  FuncController::xssfilter($message);
    $number =  FuncController::xssfilter($number);

    if (strlen($message) > 90) {
      return back()->with(['statusbad' => "The message was long,it must be between 70", "bool" => false]);
    }


    message::create([
      "email" => $email,
      "phone_number" => $number,
      "message" => $message
    ]);



      return back()->with(['status' => "The message was send succsesfuly", "bool" => true]);;
    }
}
