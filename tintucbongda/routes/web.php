<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\VideoController;
use App\Http\Controllers\DanhMucController;
use App\Http\Controllers\BaiVietController;
use App\Http\Controllers\Admin\AdminController;



// Route::get('/', [HomeController::class, 'home'])->name('home');
// Route::get('/home', [HomeController::class, 'home'])->name('home');
Route::get('/video', [HomeController::class, 'video'])->name('video');
Route::get('/', [HomeController::class, 'home'])->name('home');
Route::get('/home', [HomeController::class, 'home'])->name('home');


Route::resource('DanhMuc', DanhMucController::class);
Route::get('danhmucs/{id}/edit', [DanhMucController::class, 'edit'])->name('danhmucs.edit');
Route::put('danhmucs/{id}', [DanhMucController::class, 'update'])->name('danhmucs.update');

Route::resource('danhmucs', DanhMucController::class);
Route::post('/categories', [DanhMucController::class, 'store'])->name('categories.store');

Route::resource('videos', VideoController::class);
Route::get('/video/{id}', [VideoController::class, 'show'])->name('video.show');
Route::get('/video/{id}/like', [VideoController::class, 'like'])->name('video.like');


Route::get('/bai-viet/{id}', [BaiVietController::class, 'show'])->name('bai-viet.show');





//Login
Route::get('/login', [LoginController::class, 'showFormLogin'])->name('login.show');
Route::post('/login', [LoginController::class, 'login'])->name('login.post');
Route::post('/logout', [LoginController::class, 'logout'])->name('logout');
Route::get('/register', [LoginController::class, 'showFormRegister'])->name('register.show');
Route::post('/register', [LoginController::class, 'register'])->name('register.post');
Route::get('/forgot-password', [LoginController::class, 'showForgotForm'])->name('password.forgot');
Route::post('/forgot-password', [LoginController::class, 'sendResetLink'])->name('password.email');
Route::get('/reset-password/{token}', [LoginController::class, 'showResetForm'])->name('password.reset');
Route::post('/reset-password', [LoginController::class, 'resetPassword'])->name('password.update');

//AdminController
Route::prefix('admin')
    ->name('admin.')
    ->middleware(['auth', 'checkadmin'])
    ->group(function () {

        Route::get('/', [AdminController::class, 'dashboard'])->name('dashboard');

        Route::get('/posts', [AdminController::class, 'posts'])->name('posts.index');
        Route::get('/videos', [AdminController::class, 'videos'])->name('videos.index');
        Route::get('/users', [AdminController::class, 'users'])->name('users.index');
        Route::get('/categories', [AdminController::class, 'categories'])->name('categories.index');
        Route::get('/ads', [AdminController::class, 'ads'])->name('ads.index');
        Route::get('/settings', [AdminController::class, 'settings'])->name('settings.index');

});




