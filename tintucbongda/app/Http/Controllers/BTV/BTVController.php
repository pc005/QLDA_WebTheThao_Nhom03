<?php

namespace App\Http\Controllers\BTV;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use App\Models\BaiViet;

class BTVController extends Controller
{
    // Dashboard cho BTV
    public function dashboard()
    {
        $userId = Auth::id();

        // Tổng số bài viết của BTV
        $totalPosts = BaiViet::where('nguoi_dung_id', $userId)->count();

        // Thống kê theo trạng thái (group by trang_thai)
        $statusCounts = BaiViet::where('nguoi_dung_id', $userId)
            ->select('trang_thai', DB::raw('count(*) as cnt'))
            ->groupBy('trang_thai')
            ->pluck('cnt', 'trang_thai')
            ->toArray();

        // Thử lấy các trạng thái phổ biến (nếu có)
        $approved = 0;
        $pending = 0;
        $possibleApproved = ['Đã duyệt', 'Duyệt', 'Hoạt động', 'Approved'];
        $possiblePending = ['Chờ duyệt', 'Pending', 'Cho duyệt'];

        foreach ($possibleApproved as $s) {
            if (isset($statusCounts[$s])) { $approved = $statusCounts[$s]; break; }
        }
        foreach ($possiblePending as $s) {
            if (isset($statusCounts[$s])) { $pending = $statusCounts[$s]; break; }
        }

        return view('btv.dashboard', compact('totalPosts', 'approved', 'pending'));
    }

    // Hiển thị form tạo bài viết
    public function createPost()
    {
        return view('btv.posts.create');
    }

    // Danh sách bài viết đã tạo
    public function listPosts()
    {
        // Lấy danh sách bài viết của BTV hiện tại
        // $posts = BaiViet::where('nguoi_tao_id', auth()->id())->get();
        // return view('btv.posts.index', compact('posts'));
        return view('btv.posts.index'); // demo
    }

    // Danh sách video của BTV
    public function listVideos()
    {
        // $videos = Video::where('nguoi_tao_id', auth()->id())->get();
        // return view('btv.videos.index', compact('videos'));
        return view('btv.videos.index'); // demo
    }
}
