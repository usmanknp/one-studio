<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\ClassController;
use App\Http\Controllers\InstructorController;
use App\Http\Controllers\OfferController;
use App\Http\Controllers\CouponController;
use App\Http\Controllers\Technician\TasksController;

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
Route::get('signaturepad', [Authcontroller::class, 'index']);
Route::post('signaturepad', [Authcontroller::class, 'upload'])->name('signaturepad.upload');
Route::get('/pdf',[Authcontroller::class,'generatePdf']);

Route::group(['middleware' => ['auth']], function()
{
    Route::get('dashboard',[DashboardController::class,'dashboard']);
});

Route::group(['middleware' => ['auth','role:admin']], function()
{
    Route::group(['prefix' => 'backend/tasks'], function () {
        Route::get('/get-tasks',[App\Http\Controllers\Admin\TasksController::class,'get_tasks']);
        Route::get('/create-task',[App\Http\Controllers\Admin\TasksController::class,'task_view']);
        Route::post('/create-task',[App\Http\Controllers\Admin\TasksController::class,'create_task']);
        Route::get('/task-edit/{id}',[App\Http\Controllers\Admin\TasksController::class,'task_edit']);
        Route::post('task-edit',[App\Http\Controllers\Admin\TasksController::class,'task_update']);

    });
    // Route::group(['prefix' => 'backend/users'], function () {
    //     Route::get('user-create',[App\Http\Controllers\Admin\UsersController::class,'user_create']);
    //     Route::post('user-create',[App\Http\Controllers\Admin\UsersController::class,'user_save']);
    //     Route::get('user-list',[App\Http\Controllers\Admin\UsersController::class,'user_list']);
    //     Route::get('user-edit/{id}',[App\Http\Controllers\Admin\UsersController::class,'user_edit']);
    //     Route::post('user-edit',[App\Http\Controllers\Admin\UsersController::class,'user_update']);
    // });

    Route::group(['prefix' => 'backend/supervisor'], function () {
        Route::get('user-create',[App\Http\Controllers\Admin\SupervisorController::class,'user_create']);
        Route::post('user-create',[App\Http\Controllers\Admin\SupervisorController::class,'user_save']);
        Route::get('user-list',[App\Http\Controllers\Admin\SupervisorController::class,'user_list']);
        Route::get('user-edit/{id}',[App\Http\Controllers\Admin\SupervisorController::class,'user_edit']);
        Route::post('user-edit',[App\Http\Controllers\Admin\SupervisorController::class,'user_update']);
    });

    Route::group(['prefix' => 'backend/technician'], function () {
        Route::get('user-create',[App\Http\Controllers\Admin\TechnicianController::class,'user_create']);
        Route::post('user-create',[App\Http\Controllers\Admin\TechnicianController::class,'user_save']);
        Route::get('user-list',[App\Http\Controllers\Admin\TechnicianController::class,'user_list']);
        Route::get('user-edit/{id}',[App\Http\Controllers\Admin\TechnicianController::class,'user_edit']);
        Route::post('user-edit',[App\Http\Controllers\Admin\TechnicianController::class,'user_update']);
    });

});


Route::group(['middleware' => ['auth','technician_role:technician']],function(){

    Route::group(['prefix' => 'technician/tasks'], function () {
        Route::get('/get-tasks',[App\Http\Controllers\Technician\TasksController::class,'get_tasks']);
        Route::get('/create-task',[App\Http\Controllers\Technician\TasksController::class,'task_view']);
        Route::post('/create-task',[App\Http\Controllers\Technician\TasksController::class,'create_task']);
        Route::get('/task-edit/{id}',[App\Http\Controllers\Technician\TasksController::class,'task_edit']);
        Route::post('task-edit',[App\Http\Controllers\Technician\TasksController::class,'task_update']);
    });

});

Route::middleware('auth')->group(function () {
    // Your protected routes here
 
});
