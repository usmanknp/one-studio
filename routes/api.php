<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\ClassController;
use App\Http\Controllers\CouponController;
use App\Http\Controllers\OrderController;


/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::group(['prefix' => 'class','middleware' => ['auth:sanctum']], function()
{

    Route::get("list",[ClassController:: class,'api_class_list']);
    Route::post("offer",[ClassController::class,'api_class_offer']);
    Route::post("book-offer",[ClassController::class,'api_book_offer']);
    
    // Route::("offer",[ClassController::class,'api_class_offer']);
    // Route::post("search_stamp",[StampsController::class,'search_stamp']);
    // Route::post("report-stamp",[StampsController::class,'report_stamp']);
    // Route::post("logout",[AuthController::class,'logout']);
});

Route::group(['middleware' => ['auth:sanctum']], function()
{
    Route::post("user-logout",[AuthController::class,'api_user_logout']);
    Route::post("user-profile",[AuthController::class,'api_user_profile']);
    Route::get("user-info",[AuthController::class,'api_user_info']);

    Route::post("coupon-redeem",[CouponController::class,'api_coupon_redeem']);
    Route::post("create-order",[OrderController::class,'api_create_order']);
});


Route::post("api-handshake",[AuthController::class,'api_handshake']);
Route::post("create-account",[AuthController::class,'create_account']);
