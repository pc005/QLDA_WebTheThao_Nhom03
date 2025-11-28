<?php

namespace App\Http\Controllers;

use App\Models\Video;
use Illuminate\Http\Request;

class VideoController extends Controller
{
    // Lấy danh sách video có phân trang



public function index()
    {
        // Lấy dữ liệu từ DB
        $videos = Video::paginate(9);

        // Trả về view
        return view('user.DanhSachVideo', compact('videos'));
    }
        public function show($id)
    {
        $video = Video::findOrFail($id);
        return view('user.video', compact('video'));
    }


    // Tạo video mới
    public function store(Request $request)
    {
        $validated = $request->validate([
            'tieu_de' => 'required|string|max:255',
            'url' => 'required|string|max:999',
            'bai_viet_id' => 'required|integer',
            'nguoi_dung_id' => 'required|integer',
            'trang_thai' => 'nullable|string|max:255',
            'thumbnail' => 'nullable|string',
            'ngay_tao' => 'nullable|date',
            'ngay_cap_nhat' => 'nullable|date',


        ]);

        $video = Video::create($validated);

        return response()->json(['message' => 'Video đã được tạo', 'video' => $video], 201);
    }

    // Cập nhật video
    public function update(Request $request, $id)
    {
        $video = Video::findOrFail($id);

        $validated = $request->validate([
            'tieu_de' => 'sometimes|string|max:255',
            'url' => 'sometimes|string|max:999',
            'bai_viet_id' => 'sometimes|integer',
            'nguoi_dung_id' => 'sometimes|integer',
            'trang_thai' => 'nullable|string|max:255',
            'thumbnail' => 'nullable|string',
            'ngay_tao' => 'nullable|date',
            'ngay_cap_nhat' => 'nullable|date',
        ]);

        $video->update($validated);

        return response()->json(['message' => 'Video đã được cập nhật', 'video' => $video]);
    }

    // Xóa video
    public function destroy($id)
    {
        $video = Video::findOrFail($id);
        $video->delete();

        return response()->json(['message' => 'Video đã được xóa']);
    }


public function like(Request $request, Video $video)
{
    if (!auth()->check()) {
        return response()->json(['status' => 'not_logged_in', 'message' => 'Vui lòng đăng nhập để thích video này.']);
    }

    // Phần còn lại của mã xử lý lưu thích
    $like = Like::where('user_id', auth()->id())->where('video_id', $video->id)->first();

    if ($like) {
        $like->delete();
        return response()->json(['status' => 'unliked']);
    } else {
        Like::create([
            'user_id' => auth()->id(),
            'video_id' => $video->id
        ]);
        return response()->json(['status' => 'liked']);
    }
}
}
