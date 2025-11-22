<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\BaiViet; // Đảm bảo bạn đã tạo model cho bảng bai_viets

class BaiVietController extends Controller

{
    public function home()
    {
        $articles = BaiViet::all(); // Lấy tất cả bài viết
        return view('home', compact('articles')); // Trả về view home với biến articles
    }



    public function show($id)
    {
        // Lấy bài viết theo ID
        $baiViet = BaiViet::findOrFail($id);
        $articles = BaiViet::inRandomOrder()->limit(5)->get();
        // Trả về view với dữ liệu
        return view('bai_viet.show', compact('baiViet', 'articles'));
    }
}


