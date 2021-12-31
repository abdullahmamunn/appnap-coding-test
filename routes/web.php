<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\AuthController;
use App\Http\Controllers\HomeController;

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

Route::get('/', function () {
    return view('welcome');
});
Route::get('login',[AuthController::class, 'login'])->name('login');
Route::get('register',[AuthController::class, 'register'])->name('register');
Route::post('login/submit',[AuthController::class, 'submitLogin'])->name('submit.login');
Route::post('register/submit',[AuthController::class, 'submitRegister'])->name('submit.register');
Route::get('varify/email/{token}',[AuthController::class,'emailVarify'])->name('email.verify');

Route::get('home',[HomeController::class, 'home'])->name('home');
Route::get('password-reset',[AuthController::class, 'forgotPassword'])->name('password.request');
Route::post('password-reset',[AuthController::class, 'passwordReset'])->name('password.reset');
Route::get('password-confirm',[AuthController::class, 'passwordConfirm'])->name('confirm.password');
Route::post('password-confirm',[AuthController::class, 'passwordSubmit'])->name('password.confirm');
