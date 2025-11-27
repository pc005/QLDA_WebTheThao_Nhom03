<?php

namespace App\Http\Controllers;

use App\Models\BaiViet;
use App\Models\Video;
use App\Models\Favorite;
use Illuminate\Http\Request;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str; // CẦN THÊM: Import lớp Str

class FavoriteController extends Controller
{
    /**
     * Thêm hoặc xóa một mục khỏi danh sách yêu thích.
     */
    public function toggleFavorite(Request $request)
    {
        $request->validate([
            'model_id' => 'required|integer',
            'model_type' => 'required|string', // Ví dụ: 'BaiViet' hoặc 'Video' (tên ngắn)
        ]);

        // 1. Lấy tên Model đầy đủ cho việc tìm kiếm
        $fullModelType = 'App\\Models\\' . $request->model_type;

        if (!class_exists($fullModelType) || !(new $fullModelType instanceof Model)) {
            return response()->json(['error' => 'Loại nội dung không hợp lệ.'], 400);
        }

        // 2. Lấy đối tượng (Bài viết/Video)
        $item = $fullModelType::findOrFail($request->model_id);

        // 3. LẤY TÊN LỚP CƠ SỞ (Ví dụ: 'BaiViet') để lưu vào DB
        // SỬ DỤNG $request->model_type (vì nó đã là tên lớp cơ sở) HOẶC Str::studly(class_basename($item))
        $baseModelType = $request->model_type;

        // Kiểm tra xem đã có trong yêu thích chưa (Sử dụng tên lớp cơ sở để kiểm tra)
        $existingFavorite = Favorite::where('nguoi_dung_id', auth()->id())
            ->where('favoritable_id', $item->id)
            ->where('favoritable_type', $baseModelType) // KIỂM TRA BẰNG TÊN NGẮN
            ->first();

        if ($existingFavorite) {
            // Đã thích -> Xóa
            $existingFavorite->delete();
            $message = "Đã xóa khỏi mục yêu thích.";
            $isFavorited = false;
        } else {
            // Chưa thích -> Thêm
            Favorite::create([
                'nguoi_dung_id' => auth()->id(),
                'favoritable_id' => $item->id,
                'favoritable_type' => $baseModelType, // LƯU BẰNG TÊN NGẮN
            ]);
            $message = "Đã thêm vào mục yêu thích.";
            $isFavorited = true;
        }

        return response()->json([
            'message' => $message,
            'is_favorited' => $isFavorited,
        ]);
    }

    /**
     * Hiển thị danh sách tất cả các mục yêu thích của người dùng.
     */
    public function index()
    {
        // Sử dụng eager loading 'favoritable' để lấy Bài viết hoặc Video liên quan
        $favorites = Favorite::with('favoritable')
            ->where('nguoi_dung_id', auth()->id())
            ->latest()
            ->paginate(15);

        return view('favorites.index', compact('favorites'));
    }
}
