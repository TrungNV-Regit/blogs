<?php

use App\Http\Controllers\auth\SignInController;
use App\Http\Controllers\auth\SignUpController;
use App\Http\Controllers\auth\VerificationController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::group(['prefix' => 'auth', 'as' => 'auth.'], function () {
   Route::get('/sign-up', [SignUpController::class, 'signUpForm'])->name('sign-up');
   Route::post('/sign-up', [SignUpController::class, 'signUp'])->name('sign-up');
   Route::get('/sign-in', [SignInController::class, 'signInForm'])->name('sign-in');
   Route::post('/sign-in', [SignInController::class, 'signIn'])->name('sign-in');
   Route::get('/verify-email',[VerificationController::class,'verifyEmail'])->name('verify-email');
   Route::get('/forgot-password',[VerificationController::class,'forgotPasswordForm'])->name('forgot-password');
   Route::post('/forgot-password',[VerificationController::class,'forgotPassword'])->name('forgot-password');
});


Route::get('/home', function () {
   return view('welcome');
})->name('/home');

