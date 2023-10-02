<?php

namespace App\Http\Controllers;
use App\Mail\invoice as MailInvoice;
use App\Models\order;
use Illuminate\Http\Request;
use App\Models\Product;
use Illuminate\Support\Facades\Mail;
use Mockery\Expectation;
use Stripe;



class SubscriptionController extends Controller
{

    
   
    public function card(Request $request){
      if ($request->query("lang") == "ar") {
        $lang = "ar";
        return view("stripe_ar",compact("lang"));
      }else{
        $lang = "en";
        return view("stripe",compact("lang"));
      }
       
    }

    public function buy(Request $request){

      $form = $request->validate([
        "stripeToken" => "required",
        "email" => "email",
        "lang" => "required",
      ]);
     
      
      
         $stripe = new \Stripe\StripeClient(
            env("stripe_key"),
          );


         $productsData = $request->input("prodcuts");
         $products = [];
        $productsDatas = json_decode($productsData,false);
      if ($form["lang"] == "en") {
        if($productsDatas == null){
          return redirect("/")->with(['status' => "you must buy a product", "bool" => false]);
        }
        $phone_number =$request->input("number");
        if(FuncController::emailfilter($form["email"]) == "fail"){
          return back()->with(['statusbad' => "Please check you email", "bool" => false]);;
        }
        if ($phone_number != null) {
          if(is_numeric($phone_number) == false){
          return redirect("/card")->with(['statusbad' => "you must type a number", "bool" => false]);
          }
        }
       
      }elseif($form["lang"] == "ar"){
        if($productsDatas == null){
          return redirect("/ar")->with(['statusbad' => "لازم تشرتي منتج", "bool" => false]);
        }
        $phone_number = $request->input("number");
        if(FuncController::emailfilter($form["email"]) == "fail"){
          return redirect("/card/ar")->with(['statusbad' => "تاكد من ايمالك", "bool" => false]);;
        }
        if ($phone_number != null) {
          if(is_numeric($phone_number) == false){
          return redirect("/card/ar")->with(['statusbad' => "اكتب رقم صحيح", "bool" => false]);
          }
        }
       
      }else{
        if($productsDatas == null){
          return redirect("/")->with(['status' => "you must buy a product", "bool" => false]);
        }
        $phone_number =$request->input("number");
        if(FuncController::emailfilter($form["email"]) == "fail"){
          return back()->with(['statusbad' => "Please check you email", "bool" => false]);;
        }
        if ($phone_number != null) {
          if(is_numeric($phone_number) == false){
          return redirect("/cart/en")->with(['statusbad' => "you must type a number", "bool" => false]);
          }
        }
      }
     

        try{
          $customer_id =  $stripe->customers->create([
            'email' => $form["email"],
            "source" => $form["stripeToken"],
          ]);
        }catch(Expectation $e){
           return redirect("/")->with(['statusbad' => "sorry there was an error we coudn't complete the process", "bool" => false]);;
        }

        
       

     
          for ($i=0; $i <  count($productsDatas); $i++) { 
            array_push($products, [$productsDatas[$i]->product_id]);            
          }

    $Product =  Product::whereIn('id', $products)->get();
          $allprice = 0;
          $allproduct = array();
          for ($i=0; $i < count($Product); $i++) { 
            for ($a=0; $a < count($productsDatas); $a++) {  

              if ($productsDatas[$a]->product_id == $Product[$i]->id) {
                array_push($allproduct,[(string)"id" => (string)$Product[$i]->id,(string)"name" => (string)$Product[$i]->name , (string)"price" => (int)$Product[$i]->price*$productsDatas[$a]->product_qtn , "qtn" => $productsDatas[$a]->product_qtn]);    
              }
      
          
            }
         
          }

          for ($i=0; $i < count($allproduct); $i++) { 
          $allprice += (int)$allproduct[$i]["price"];
          }





        
          try{
           $d = $stripe->charges->create([
              'amount' => (int)$allprice,
              'currency' => 'USD',
              'customer' => $customer_id,
            ]);
  
    
              if($d->status == "succeeded"){
               $ds=  order::create([
                  "email" => $form["email"],
                  "number" => $request->input("number") != null ?  $request->input("number") : "nothing",
                  "paid_price" => (int)$allprice,
                  "refund" => $d->id,
                  "products" => json_encode($allproduct)
                ]);

           
                $data = [
                  "telefone" =>  $ds->number,
                  "email" => $ds->email,
                  "refund" => substr($ds->refund,3,26),
                  "title" => "invoice",
                  "order" => $allproduct,
                  "message" => "thank you for buying from us, we will contact you as soon as possible"
                  
                ];
  
                Mail::to($form["email"])->send(new MailInvoice($data)); 
              }
             if ( $form["lang"] == "en") {
              return redirect("/")->with(['status' => "Thank you for buying from our store,check your email address, spam,all,not importent", "bool" => true]);
             }elseif($form["lang"] == "ar"){
              return redirect("/ar")->with(['status' => "شكرا لشراك منا تاكد من ايمالك و المهملات او السبام", "bool" => true]);
             }else{
              return redirect("/")->with(['status' => "Thank you for buying from our store,check your email address, spam,all,not importent", "bool" => true]);
             }


  
          }catch(Expectation $error){
            if ( $form["lang"] == "en") {
              return redirect("/")->with(['statusbad' => "sorry there was an error we coudn't complete the process", "bool" => false]);
             }elseif($form["lang"] == "ar"){
              return redirect("/ar")->with(['statusbad' => "هناكا مشكله", "bool" => false]);
             }else{
              return redirect("/")->with(['statusbad' => "sorry there was an error we coudn't complete the process", "bool" => false]);
             }
          
          }
    }
}
