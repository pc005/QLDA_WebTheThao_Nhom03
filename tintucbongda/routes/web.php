<?php

use Illuminate\Support\Facades\Route;

// Import Controllers
use App\Http\Controllers\HomeController;
// SỬA DÒNG NÀY: Dùng LoginController thay vì AuthController
use App\Http\Controllers\Auth\LoginController; 
use App\Http\Controllers\VideoController;
use App\Http\Controllers\BaiVietController;
use App\Http\Controllers\DanhMucController;
use App\Http\Controllers\Admin\AdminController; // Chú ý namespace Admin
use App\Http\Controllers\BTV\BTVController;     // Chú ý namespace BTV
use App\Http\Controllers\BtvPostController;
use App\Http\Controllers\BtvVideoController;

/*
|--------------------------------------------------------------------------
| 1. FRONTEND ROUTES (Khách xem)
|--------------------------------------------------------------------------
*/
Route::get('/', [HomeController::class, 'index'])->name('home');
Route::get('/home', [HomeController::class, 'index']);
Route::get('/bai-viet/{id}', [HomeController::class, 'show'])->name('bai-viet.show');
Route::get('/videos', [VideoController::class, 'index'])->name('video.index');
Route::get('/video/{id}', [VideoController::class, 'show'])->name('video.show');
Route::post('/like/{type}/{id}', [HomeController::class, 'like'])->name('like.store')->middleware('auth');

/*
|--------------------------------------------------------------------------
| 2. AUTHENTICATION ROUTES (Sửa lại dùng LoginController)
|--------------------------------------------------------------------------
*/
Route::middleware('guest')->group(function () {
    // Đăng nhập
    Route::get('/login', [LoginController::class, 'showFormLogin'])->name('login.show');
    Route::post('/login', [LoginController::class, 'login'])->name('login.post'); // <--- Quan trọng

    // Đăng ký
    Route::get('/register', [LoginController::class, 'showFormRegister'])->name('register.show');
    Route::post('/register', [LoginController::class, 'register'])->name('register.post');

    // Quên mật khẩu
    Route::get('/forgot-password', [LoginController::class, 'showForgotForm'])->name('password.request');
    Route::post('/forgot-password', [LoginController::class, 'sendResetLink'])->name('password.email');
    Route::get('/reset-password/{token}', [LoginController::class, 'showResetForm'])->name('password.reset');
    Route::post('/reset-password', [LoginController::class, 'resetPassword'])->name('password.update');
});

// Đăng xuất
Route::post('/logout', [LoginController::class, 'logout'])->name('logout')->middleware('auth');

/*
|--------------------------------------------------------------------------
| 3. ADMIN ROUTES
|--------------------------------------------------------------------------
*/
Route::group(['prefix' => 'admin', 'as' => 'admin.', 'middleware' => ['auth', 'checkadmin']], function () {
    Route::get('/', [AdminController::class, 'dashboard'])->name('dashboard');
    Route::resource('danhmucs', DanhMucController::class);
    Route::resource('baiviets', BaiVietController::class);
    // Các route admin khác...
});

/*
|--------------------------------------------------------------------------
| 4. BTV ROUTES
|--------------------------------------------------------------------------
*/
Route::group(['prefix' => 'btv', 'as' => 'btv.', 'middleware' => ['auth', 'checkbtv']], function () {
    Route::get('/', [BTVController::class, 'dashboard'])->name('dashboard');
    Route::resource('posts', BtvPostController::class);
    Route::resource('videos', BtvVideoController::class);
});