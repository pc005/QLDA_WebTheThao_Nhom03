<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\Auth\LoginController;





Route::get('/', [HomeController::class, 'home'])->name('home');
Route::get('/video', [HomeController::class, 'video'])->name('video');





//Login
Route::get('/login', [LoginController::class, 'showFormLogin'])->name('login.show');
Route::post('/login', [LoginController::class, 'login'])->name('login.post');
Route::post('/logout', [LoginController::class, 'logout'])->name('logout');
Route::get('/register', [LoginController::class, 'showFormRegister'])->name('register.show');
Route::post('/register', [LoginController::class, 'register'])->name('register.post');

