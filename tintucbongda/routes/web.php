<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\VideoController;
use App\Http\Controllers\DanhMucController;

Route::get('/', [HomeController::class, 'home'])->name('home');
Route::get('/video', [HomeController::class, 'video'])->name('video');

Route::resource('DanhMuc', DanhMucController::class);
Route::get('danhmucs/{id}/edit', [DanhMucController::class, 'edit'])->name('danhmucs.edit');
Route::put('danhmucs/{id}', [DanhMucController::class, 'update'])->name('danhmucs.update');

Route::resource('danhmucs', DanhMucController::class);
Route::post('/categories', [DanhMucController::class, 'store'])->name('categories.store');

Route::resource('videos', VideoController::class);
Route::get('/video/{id}', [VideoController::class, 'show'])->name('video.show');

//Login
Route::get('/login', [LoginController::class, 'showFormLogin'])->name('login.show');
Route::post('/login', [LoginController::class, 'login'])->name('login.post');
Route::post('/logout', [LoginController::class, 'logout'])->name('logout');
Route::get('/register', [LoginController::class, 'showFormRegister'])->name('register.show');
Route::post('/register', [LoginController::class, 'register'])->name('register.post');
