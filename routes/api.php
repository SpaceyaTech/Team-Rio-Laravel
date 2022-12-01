<?php

use App\Http\Controllers\API\AuthController;
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

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

Route::post('register',[AuthController::class,'register'])->name('register');
Route::post('login',[AuthController::class,'login'])->name('login');

Route::middleware(['auth:api','active_user','verified'])->group( function () {
    // our routes that are protected

    //user protected routes 
    Route::get('profile',[AuthController::class,'profile']);
    Route::get('logout',[AuthController::class,'logout'])->name('logout');
 
});