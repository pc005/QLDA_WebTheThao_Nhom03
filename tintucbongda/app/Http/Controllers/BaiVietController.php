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

    // public function hienThiBaiVietMoiNhat()
    // {
    //     // 1. Lấy 3 bài viết mới nhất, sắp xếp theo ngày tạo giảm dần (hoặc ngày đăng).
    //     // Sử dụng 'latest()' là cách viết tắt cho orderBy('created_at', 'desc').
    //     $baiViets = BaiViet::latest()
    //                         ->take(3) // Giới hạn lấy 3 bài
    //                         ->get(); // Thực thi truy vấn

    //     // 2. Phân chia bài viết thành bài nổi bật (đầu tiên) và 2 bài còn lại
    //     $baiVietNoiBat = $baiViets->shift(); // Lấy bài đầu tiên và xóa khỏi collection $baiViets
    //     $haiBaiConLai = $baiViets; // 2 bài còn lại

    //     // 3. Truyền dữ liệu sang view.
    //     return view('ten_view_cua_ban', compact('baiVietNoiBat', 'haiBaiConLai'));
    // }
}


