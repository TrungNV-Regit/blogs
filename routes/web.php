<?php

use App\Http\Controllers\auth\SignInController;
use App\Http\Controllers\auth\SignUpController;
use App\Http\Controllers\auth\VerificationController;
use App\Http\Controllers\User\HomeController as UserHomeController;
use App\Http\Controllers\User\BlogController as UserBlogController;
use App\Http\Controllers\Admin\HomeController as AdminHomeController;
use App\Http\Controllers\Admin\BlogController as AdminBlogController;
use App\Http\Controllers\Common\BlogController as CommonBlogController;
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
   Route::get('/sign-up', [SignUpController::class, 'create'])->name('sign-up');
   Route::post('/sign-up', [SignUpController::class, 'signUp'])->name('sign-up');
   Route::get('/sign-in', [SignInController::class, 'index'])->name('sign-in');
   Route::post('/sign-in', [SignInController::class, 'signIn'])->name('sign-in');
   Route::post('/logout', [SignInController::class, 'logout'])->name('logout');
   Route::get('/verify-email', [VerificationController::class, 'verifyEmail'])->name('verify-email');
   Route::get('/resend-token', [VerificationController::class, 'resendToken'])->name('resend-token');
   Route::get('/forgot-password', [VerificationController::class, 'forgotPasswordForm'])->name('forgot-password');
   Route::post('/forgot-password', [VerificationController::class, 'forgotPassword'])->name('forgot-password');
});

Route::middleware(['auth', 'admin'])->group(function () {
   Route::group(['prefix' => 'admin', 'as' => 'admin.'], function () {
      Route::get('/home', [AdminHomeController::class, 'home'])->name('home');
   });
});

Route::group(['prefix' => 'blog', 'as' => 'blog.'], function () {
   Route::middleware(['auth', 'user'])->group(function () {
      Route::get('/create', [UserBlogController::class, 'create'])->name('create');
      Route::post('/create', [UserBlogController::class, 'store'])->name('create');
      Route::get('/my-blogs', [UserBlogController::class, 'myBlogs'])->name('my-blogs');
      Route::get('/my-blogs', [UserBlogController::class, 'myBlogs'])->name('my-blogs');
   });

   Route::middleware(['auth'])->group(function () {
      Route::get('/edit/{id}', [CommonBlogController::class, 'edit'])->name('edit');
      Route::post('/update/{id}', [CommonBlogController::class, 'update'])->name('update');
   });

   Route::middleware(['auth'])->group(function () {
      Route::get('/edit/{id}', [CommonBlogController::class, 'edit'])->name('edit');
      Route::post('/update/{id}', [CommonBlogController::class, 'update'])->name('update');
   });

   Route::middleware(['auth', 'admin'])->group(function () {
      Route::get('/index/{status}', [AdminBlogController::class, 'index'])->name('index');
      Route::post('/change-status/{id}', [AdminBlogController::class, 'changeStatus'])->name('change-status');
   });

   Route::get('/show/{id}', [UserBlogController::class, 'show'])->name('show');
});

Route::get('/', [UserHomeController::class, 'home'])->name('/');
