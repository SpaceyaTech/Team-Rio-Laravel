<?php

use App\Http\Controllers\Api\AccountController;
use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\Api\EmailVerificationController;
use App\Http\Controllers\Api\PasswordController;
use App\Http\Controllers\Api\RoleController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use PhpParser\Node\Stmt\Return_;

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




Route::middleware(['auth:api','active_user','verified'])->group( function () {
    // our routes that are protected

    //user protected routes


});

Route::post('register',[AuthController::class,'register'])->name('register');
Route::post('login',[AuthController::class,'login'])->name('login');

Route::middleware(['auth:api'])->group(function () {
    Route::get('email/verify/{id}', [EmailVerificationController::class, "verify"])->name('verification.verify');
    Route::get('email/resend', [EmailVerificationController::class, "resend"])->name('verification.resend');


     Route::middleware(['verified'])->group(function () {
        Route::get('profile',[AuthController::class,'profile'])->name('profile');
        Route::get('users',[AuthController::class,'all_users'])->name('users');
        Route::get('logout',[AuthController::class,'logout'])->name('logout');

        Route::post("forgot-password", [PasswordController::class, "forgotpassword"]);
        Route::post("reset-password", [PasswordController::class, "reset"])->name('password.reset');


        //resouse routes
        Route::apiResources(
            [
                "account" => AccountController::class,
                "role" => RoleController::class,


            ]
        );
    });
});
