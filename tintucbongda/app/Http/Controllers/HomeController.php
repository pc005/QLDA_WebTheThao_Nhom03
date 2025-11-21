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
    $articles = BaiViet::limit(3)->get(); // Lấy 3 bài viết đầu tiên
    return view('home', compact('articles'));
}
    public function login()
    {
        return view('login.login'); // Laravel tự hiểu 'views/' và '.blade.php'
    }

}
