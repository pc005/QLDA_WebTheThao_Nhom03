<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\BaiViet;
class HomeController extends Controller
{
    public function video()
{
    return view('video'); // Trả về view video.blade.php
}
//     public function home()
// {
//     return view('home'); // Trả về view video.blade.php
// }
public function home()
{
    // 3 bài viết nổi bật đã được admin duyệt
    $featuredArticles = BaiViet::where('trang_thai', 'Đã duyệt')->orderBy('created_at', 'desc')->take(3)->get();
    $articles = BaiViet::limit(3)->get(); // Lấy 3 bài viết đầu tiên
    $latestArticles = BaiViet::orderBy('created_at', 'desc')->take(6)->get(); // Lấy 6 bài viết mới nhất
    return view('home', compact('articles', 'latestArticles', 'featuredArticles'));
}
    public function login()
    {
        return view('login.login'); // Laravel tự hiểu 'views/' và '.blade.php'
    }

}
