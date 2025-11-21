<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\VideoController;
use App\Http\Controllers\DanhMucController;

Route::get('/', [HomeController::class, 'home'])->name('home');
Route::get('/home', [HomeController::class, 'home'])->name('home');
Route::get('/video', [HomeController::class, 'video'])->name('video');

Route::resource('DanhMuc', DanhMucController::class);
Route::get('danhmucs/{id}/edit', [DanhMucController::class, 'edit'])->name('danhmucs.edit');
Route::put('danhmucs/{id}', [DanhMucController::class, 'update'])->name('danhmucs.update');

Route::resource('danhmucs', DanhMucController::class);
Route::post('/categories', [DanhMucController::class, 'store'])->name('categories.store');

Route::resource('videos', VideoController::class);
Route::get('/video/{id}', [VideoController::class, 'show'])->name('video.show');
Route::get('/video/{id}/like', [VideoController::class, 'like'])->name('video.like');

//Login
Route::get('/login', [LoginController::class, 'showFormLogin'])->name('login.show');
Route::post('/login', [LoginController::class, 'login'])->name('login.post');
Route::post('/logout', [LoginController::class, 'logout'])->name('logout');
Route::get('/register', [LoginController::class, 'showFormRegister'])->name('register.show');
Route::post('/register', [LoginController::class, 'register'])->name('register.post');
<<<<<<< HEAD
=======
// Hiển thị form quên mật khẩu

Route::get('/forgot-password', [LoginController::class, 'showForgotForm'])->name('password.forgot');

// Gửi email đặt lại mật khẩu
Route::post('/forgot-password', [LoginController::class, 'sendResetLink'])->name('password.email');

// Form đặt lại mật khẩu
Route::get('/reset-password/{token}', [LoginController::class, 'showResetForm'])->name('password.reset');

// Xử lý đặt lại mật khẩu
Route::post('/reset-password', [LoginController::class, 'resetPassword'])->name('password.update');



>>>>>>> d7f1c1e6014c7e011900987b1042fc1f23e1c043
