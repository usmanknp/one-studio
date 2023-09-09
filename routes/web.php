<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\ClassController;
use App\Http\Controllers\InstructorController;
use App\Http\Controllers\OfferController;
use App\Http\Controllers\CouponController;
// use App\Http\Controllers\TestController;
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

// Route::get('/', function () {
//     return view('dashboard');
// });
// Route::get('test',[Testcontroller::class,'index']);
Route::get('/',[Authcontroller::class,'login_view'])->name('user-login');
Route::post('user-handshake',[Authcontroller::class,'user_handshake'])->name('user-handshake');
Route::get('logout',[Authcontroller::class,'user_logout'])->name('user-logout');

Route::group(['middleware' => ['auth','role:admin|editor']], function()
{
    Route::get('dashboard',[DashboardController::class,'dashboard']);


    Route::get('class-create',[ClassController::class,'class_create']);
    Route::post('class-create',[ClassController::class,'class_save']);
    Route::get('class-list',[ClassController::class,'class_list']);
    Route::get('class-edit/{id}',[ClassController::class,'class_edit']);
    Route::post('class-edit',[ClassController::class,'class_update']);
    Route::delete('class-delete/{id}', [ClassController::class, 'destroy']);


    Route::get('instructor-create',[InstructorController::class,'instructor_create']);
    Route::post('instructor-create',[InstructorController::class,'instructor_save']);
    Route::get('instructor-list',[InstructorController::class,'instructor_list']);
    Route::get('instructor-edit/{id}',[InstructorController::class,'instructor_edit']);
    Route::post('instructor-edit',[InstructorController::class,'instructor_update']);
    Route::delete('instructor-delete/{id}', [InstructorController::class, 'destroy']);

    Route::get('offer-create',[OfferController::class,'offer_create']);
    Route::post('offer-create',[OfferController::class,'offer_save']);
    Route::get('offer-list',[OfferController::class,'offer_list']);
    Route::get('offer-edit/{id}',[OfferController::class,'offer_edit']);
    Route::post('offer-edit',[OfferController::class,'offer_update']);

    Route::get('user-create',[Authcontroller::class,'user_create']);
    Route::post('user-create',[Authcontroller::class,'user_save']);
    Route::get('user-list',[Authcontroller::class,'user_list']);
    Route::get('user-edit/{id}',[AuthController::class,'user_edit']);
    Route::post('user-edit',[AuthController::class,'user_update']);

    Route::get('coupon-create',[CouponController::class,'coupon_create']);
    Route::post('coupon-create',[CouponController::class,'coupon_save']);
    Route::get('coupon-list',[CouponController::class,'coupon_list']);
    Route::get('coupon-edit/{id}',[CouponController::class,'coupon_edit']);
    Route::post('coupon-edit',[CouponController::class,'coupon_update']);
});


Route::middleware('auth')->group(function () {
    // Your protected routes here
 
});
