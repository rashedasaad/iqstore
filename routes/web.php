<?php

use App\Http\Controllers\AdminpageController;
use App\Http\Controllers\MainpageController;
use App\Http\Controllers\SubscriptionController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get("/",[MainpageController::class, "index"]);
Route::get("/ar",[MainpageController::class, "index_ar"]);


Route::get("cart/en",[MainpageController::class, "basket"]);
Route::get("cart/ar",[MainpageController::class, "basket_ar"]);
Route::post("formcontact",[MainpageController::class, 'formcontact'])->name("formcontact");
Route::get("card",[SubscriptionController::class, 'card'])->name("card");
Route::post("buy",[SubscriptionController::class, 'buy'])->name("buy");
Route::get("invoice", function ()
{
return view("invoice");
});


Route::group(['prefix' => 'admin'], function () {

    Route::get("login",[AdminpageController::class, 'login']);
    Route::post("/loginstore",[AdminpageController::class, 'loginstore'])->name("loginstore");

    Route::middleware(["admin"])->group(function () {

        Route::get("users",[AdminpageController::class, 'users']);
        Route::post("createuser",[AdminpageController::class, 'createuser'])->name("createuser");
        Route::post("updateuser",[AdminpageController::class, 'updateuser'])->name("updateuser");
        Route::post("deleteuser",[AdminpageController::class, 'deleteuser'])->name("deleteuser");

        Route::get("feedback",[AdminpageController::class, 'feedback']);
        Route::post("deletefeedback",[AdminpageController::class, 'deletefeedback'])->name("deletefeedback");
        Route::post("feedbacksendmail",[AdminpageController::class, 'feedbacksendmail'])->name("feedbacksendmail");

        Route::get("orders",[AdminpageController::class, 'orders']);
        Route::post("deleteorder",[AdminpageController::class, 'deleteorder'])->name("deleteorder");
        Route::post("ordersendmail",[AdminpageController::class, 'ordersendmail'])->name("ordersendmail");
        Route::post("refound",[AdminpageController::class, 'refound'])->name("refound");

     
        Route::post("create_type",[AdminpageController::class, 'create_type'])->name("create_type");
        Route::post("update_type",[AdminpageController::class, 'update_type'])->name("update_type");
        Route::post("delete_type",[AdminpageController::class, 'delete_type'])->name("delete_type");
        Route::get("products",[AdminpageController::class, 'products']);
        Route::post("updateproduct",[AdminpageController::class, 'updateproduct'])->name("updateproduct");
        Route::post("deleteproduct",[AdminpageController::class, 'deleteproduct'])->name("deleteproduct");
        Route::post("createproduct",[AdminpageController::class, 'createproduct'])->name("createproduct");
        Route::get("logout",[AdminpageController::class, 'logout'])->name("logout");


    });

});


?>


