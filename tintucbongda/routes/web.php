<?php

use Illuminate\Support\Facades\Route;



use App\Http\Controllers\HomeController;
Route::get('/', [HomeController::class, 'home'])->name('home');
Route::get('/login', [HomeController::class, 'login'])->name('login');

Route::get('/video', [HomeController::class, 'video'])->name('video');
