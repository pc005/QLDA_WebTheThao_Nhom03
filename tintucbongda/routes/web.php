<?php

use Illuminate\Support\Facades\Route;



use App\Http\Controllers\HomeController;
Route::get('/', [HomeController::class, 'home'])->name('home');
Route::get('/login', [HomeController::class, 'login'])->name('login');

Route::get('/video', [HomeController::class, 'video'])->name('video');
use App\Http\Controllers\DanhMucController;

Route::resource('DanhMuc', DanhMucController::class);
Route::get('danhmucs/{id}/edit', [DanhMucController::class, 'edit'])->name('danhmucs.edit');
Route::put('danhmucs/{id}', [DanhMucController::class, 'update'])->name('danhmucs.update');

Route::resource('danhmucs', DanhMucController::class);
Route::post('/categories', [DanhMucController::class, 'store'])->name('categories.store');


use App\Http\Controllers\VideoController;

Route::resource('videos', VideoController::class);

Route::get('/video/{id}', [VideoController::class, 'show'])->name('video.show');


