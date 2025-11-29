<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\BaiViet;
use App\Models\DanhMuc;
class HomeController extends Controller
{
    public function video()
{
    return view('video'); // Trả về view video.blade.php
}



// public function home()
// {
//     // 3 bài viết nổi bật đã được admin duyệt
//     $featuredArticles = BaiViet::where('trang_thai', 'Đã duyệt')->where('noi_bat', 1)->orderBy('created_at', 'desc')->take(3)->get();
//     $articles = BaiViet::limit(3)->get(); // Lấy 3 bài viết đầu tiên
//     $latestArticles = BaiViet::orderBy('created_at', 'desc')->take(6)->get(); // Lấy 6 bài viết mới nhất
//      // 1. Lấy 3 bài viết mới nhất, sắp xếp theo ngày tạo giảm dần (hoặc ngày đăng).
//         // Sử dụng 'latest()' là cách viết tắt cho orderBy('created_at', 'desc').
//         $baiViets = BaiViet::latest()
//                             ->take(3) // Giới hạn lấy 3 bài
//                             ->get(); // Thực thi truy vấn

//         // 2. Phân chia bài viết thành bài nổi bật (đầu tiên) và 2 bài còn lại
//         $baiVietNoiBat = $baiViets->shift(); // Lấy bài đầu tiên và xóa khỏi collection $baiViets
//         $haiBaiConLai = $baiViets; // 2 bài còn lại

//         // 3. Truyền dữ liệu sang view.
//         // 4. Lấy 3 bài viết theo danh mục Entertainment (nếu có)
//         $entertainmentCategory = DanhMuc::where('slug', 'entertainment')
//             ->orWhere('ten_danh_muc', 'Entertainment')
//             ->orWhere('ten_danh_muc', 'Giải trí')
//             ->first();

//         if ($entertainmentCategory) {
//             $entertainmentArticles = BaiViet::where('danh_muc_id', $entertainmentCategory->id)
//                 ->where('trang_thai', 'Đã duyệt')
//                 ->orderBy('created_at', 'desc')
//                 ->take(3)
//                 ->get();
//         } else {
//             // No entertainment category found, create an empty collection
//             $entertainmentArticles = collect();
//         }

//     return view('home', compact('articles', 'latestArticles', 'featuredArticles','baiVietNoiBat', 'haiBaiConLai', 'entertainmentArticles', 'entertainmentCategory'));
// }

    public function home()
    {
        // Lấy các bài viết nổi bật (ví dụ admin duyệt)
        $featuredArticles = BaiViet::where('trang_thai', 'Đã duyệt')
            ->where('noi_bat', 1)
            ->orderBy('created_at', 'desc')
            ->take(3)
            ->get();

        // Lấy 6 bài mới nhất
        $latestArticles = BaiViet::orderBy('created_at', 'desc')
            ->take(6)
            ->get();

        // Hiển thị bài nổi bật nhất + 2 bài còn lại (ví dụ demo layout)
        $baiViets = BaiViet::latest()->take(3)->get();
        $baiVietNoiBat = $baiViets->shift();
        $haiBaiConLai = $baiViets;

        // Lấy danh mục "entertainment" (ví dụ để vẫn giữ lại khối kiến trúc cũ)
        $entertainmentCategory = DanhMuc::where('slug', 'entertainment')
            ->orWhere('ten_danh_muc', 'Entertainment')
            ->orWhere('ten_danh_muc', 'Giải trí')
            ->first();

        if ($entertainmentCategory) {
            $entertainmentArticles = BaiViet::where('danh_muc_id', $entertainmentCategory->id)
                ->where('trang_thai', 'Đã duyệt')
                ->orderBy('created_at', 'desc')
                ->take(3)
                ->get();
        } else {
            $entertainmentArticles = collect();
        }

        // Lấy tất cả danh mục (hiển thị động)
        $danhMucList = DanhMuc::all();

        // Với mỗi danh mục, lấy 3 bài viết mới nhất (đã duyệt)
        $baiVietTheoDanhMuc = [];
        foreach ($danhMucList as $danhMuc) {
            $baiVietTheoDanhMuc[$danhMuc->id] = BaiViet::where('danh_muc_id', $danhMuc->id)
                ->where('trang_thai', 'Đã duyệt')
                ->orderBy('created_at', 'desc')
                ->take(3)
                ->get();
        }

        return view('home', compact(
            'latestArticles',
            'featuredArticles',
            'baiVietNoiBat',
            'haiBaiConLai',
            'entertainmentArticles',
            'entertainmentCategory',
            'danhMucList',
            'baiVietTheoDanhMuc'
        ));
    }
    public function login()
    {
        return view('login.login'); // Laravel tự hiểu 'views/' và '.blade.php'
    }

}
