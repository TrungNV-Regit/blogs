<?php

use App\Http\Controllers\auth\SignInController;
use App\Http\Controllers\auth\SignUpController;
use App\Http\Controllers\auth\VerificationController;
use App\Http\Controllers\User\BlogController as UserBlogController;
use App\Http\Controllers\Admin\BlogController as AdminBlogController;
use App\Http\Controllers\Admin\CategoryController;
use App\Http\Controllers\Admin\ManagerUserController;
use App\Http\Controllers\Common\BlogController as CommonBlogController;
use App\Http\Controllers\Common\CommentController;
use App\Http\Controllers\Common\LikeController;
use App\Http\Controllers\User\UserController;
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

      Route::group(['prefix' => 'blog', 'as' => 'blog.'], function () {
         Route::get('/', [AdminBlogController::class, 'index'])->name('index');
         Route::put('/change-status/{id}', [AdminBlogController::class, 'changeStatus'])->name('change-status');
         Route::get('/show/{id}', [AdminBlogController::class, 'show'])->name('show');
         Route::get('/edit/{id}', [CommonBlogController::class, 'edit'])->name('edit');
         Route::put('/update/{id}', [AdminBlogController::class, 'update'])->name('update');
         Route::delete('/destroy/{id}', [AdminBlogController::class, 'destroy'])->name('destroy');
      });

      Route::group(['prefix' => 'user', 'as' => 'user.'], function () {
         Route::get('/', [ManagerUserController::class, 'index'])->name('index');
         Route::put('/change-status', [ManagerUserController::class, 'changeStatus'])->name('change-status');
      });

      Route::group(['prefix' => 'category', 'as' => 'category.'], function () {
         Route::get('/', [CategoryController::class, 'index'])->name('index');
         Route::post('/store', [CategoryController::class, 'store'])->name('store');
         Route::get('/edit', [CategoryController::class, 'edit'])->name('edit');
         Route::put('/update', [CategoryController::class, 'update'])->name('update');
         Route::delete('/destroy', [CategoryController::class, 'destroy'])->name('destroy');
      });

      Route::get('/change-password', [UserController::class, 'showChangePasswordForm'])->name('change-password');
      Route::post('/change-password', [UserController::class, 'changePassword'])->name('verify');
   });
});

Route::middleware(['auth', 'user'])->group(function () {
   Route::group(['prefix' => 'user', 'as' => 'user.'], function () {
      Route::prefix('blog')->name('blog.')->group(function () {
         Route::get('/create', [UserBlogController::class, 'create'])->name('create');
         Route::post('/create', [UserBlogController::class, 'store'])->name('create');
         Route::get('/show/{id}', [UserBlogController::class, 'show'])->name('show');
         Route::get('/edit/{id}', [CommonBlogController::class, 'edit'])->name('edit');
         Route::put('/update/{id}', [UserBlogController::class, 'update'])->name('update');
         Route::delete('/destroy/{id}', [UserBlogController::class, 'destroy'])->name('destroy');
         Route::get('/my-blogs', [UserBlogController::class, 'myBlogs'])->name('my-blogs');
      });
      Route::get('/change-password', [UserController::class, 'showChangePasswordForm'])->name('change-password');
      Route::post('/change-password', [UserController::class, 'changePassword'])->name('verify');

      Route::group(['prefix' => 'profile', 'as' => 'profile.'], function () {
         Route::get('/show', [UserController::class, 'show'])->name('show');
         Route::put('/update', [UserController::class, 'update'])->name('update');
      });
   });
});

Route::group(['prefix' => 'blog', 'as' => 'blog.'], function () {
   Route::get('/show/{id}', [CommonBlogController::class, 'show'])->name('show');
});

Route::group(['prefix' => 'api', 'as' => 'api.'], function () {
   Route::middleware(['auth'])->post('/like', [LikeController::class, 'like'])->name('like');

   Route::group(['prefix' => 'comment', 'as' => 'comment.'], function () {
      Route::get('/', [CommentController::class, 'index'])->name('index');
      Route::middleware(['auth'])->group(function () {
         Route::post('/store', [CommentController::class, 'store'])->name('store');
         Route::put('/update', [CommentController::class, 'update'])->name('update');
         Route::delete('/destroy', [CommentController::class, 'destroy'])->name('destroy');
      });
   });
});

Route::get('/index', [CommonBlogController::class, 'index'])->name('/index');
