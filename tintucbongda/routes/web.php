<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\VideoController;
use App\Http\Controllers\DanhMucController;
use App\Http\Controllers\BaiVietController;
use App\Http\Controllers\Admin\AdminController;
use App\Http\Controllers\BTV\BTVController;



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
use App\Http\Controllers\LuotThichController;

Route::post('/like/{baiViet}', [LuotThichController::class, 'store'])->name('like.store');


Route::get('/bai-viet/{id}', [BaiVietController::class, 'show'])->name('bai-viet.show');

//report
use App\Http\Controllers\ReportController;
Route::post('/bai-viet/{id}/report', [ReportController::class, 'store'])
    ->middleware('auth')
    ->name('bai-viet.report');









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
        Route::get('/posts/featured', [AdminController::class, 'featuredPosts'])->name('posts.featured');
        Route::get('/posts/reported', [AdminController::class, 'reportedPosts'])->name('posts.reported');
        Route::post('/reports/{id}/resolve', [AdminController::class, 'resolveReport'])->name('reports.resolve');
        Route::get('/posts/create', [AdminController::class, 'createPost'])->name('posts.create');
        Route::post('/posts', [AdminController::class, 'store'])->name('posts.store');
        Route::get('/posts/{id}', [AdminController::class, 'show'])->name('posts.show');
        Route::get('/posts/{id}/edit', [AdminController::class, 'editPost'])->name('posts.edit');
        Route::put('/posts/{id}', [AdminController::class, 'update'])->name('posts.update');
        Route::delete('/posts/{id}', [AdminController::class, 'destroy'])->name('posts.destroy');
        Route::post('/posts/{id}/approve', [AdminController::class, 'approvePost'])->name('posts.approve');
        Route::post('/posts/{id}/reject', [AdminController::class, 'rejectPost'])->name('posts.reject');
        Route::post('/posts/{id}/toggle-featured', [AdminController::class, 'toggleFeatured'])->name('posts.toggle-featured');
        //Route::get('/videos', [AdminController::class, 'videos'])->name('videos.index');
        // Route::get('/videos', [AdminController::class, 'videos'])->name('videos.index');
        Route::get('/videos', [VideoController::class, 'quanlyvideo'])->name('admin.videos.danhsachvideoadmin');
        Route::get('/videos/{video}/editvideo', [VideoController::class, 'editVideo'])->name('videos.editvideo');
        Route::get('/users', [AdminController::class, 'users'])->name('users.index');
        Route::get('/categories', [AdminController::class, 'categories'])->name('categories.index');
        Route::get('/ads', [AdminController::class, 'ads'])->name('ads.index');
        Route::get('/settings', [AdminController::class, 'settings'])->name('settings.index');

});

//BTV (Biên tập viên)
Route::prefix('btv')
    ->name('btv.')
    ->middleware(['auth', 'checkbtv'])
    ->group(function () {
        Route::get('/', [BTVController::class, 'dashboard'])->name('dashboard');
        Route::get('/posts/create', [BTVController::class, 'createPost'])->name('posts.create');
        Route::post('/posts', [BTVController::class, 'store'])->name('posts.store');
        Route::get('/posts', [BTVController::class, 'listPosts'])->name('posts.index');
        Route::get('/posts/{id}/edit', [BTVController::class, 'editPost'])->name('posts.edit');
        Route::put('/posts/{id}', [BTVController::class, 'update'])->name('posts.update');
        Route::delete('/posts/{id}', [BTVController::class, 'deletePost'])->name('posts.delete');

    });
