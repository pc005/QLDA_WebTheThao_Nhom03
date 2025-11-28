<?php

namespace App\Http\Controllers;

use App\Models\BinhLuan;
use App\Models\BaiViet;
use App\Models\NguoiDung;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;

class BinhLuanController extends Controller
{
    // Lấy danh sách bình luận (API)
    public function index($baiVietId)
    {
        $binhLuans = BinhLuan::with('nguoiDung')
            ->where('bai_viet_id', $baiVietId)
            ->where('trang_thai', 'hien_thi')
            ->orderBy('created_at', 'desc')
            ->get();

        $data = $binhLuans->map(function ($bl) {
            // --- XỬ LÝ AVATAR (ĐÃ SỬA LỖI THIẾU STORAGE) ---
            $avatarUrl = null;
            if ($bl->nguoiDung && $bl->nguoiDung->anh_dai_dien) {
                $path = $bl->nguoiDung->anh_dai_dien;

                // 1. Nếu là URL online (http/https)
                if (filter_var($path, FILTER_VALIDATE_URL)) {
                    $avatarUrl = $path;
                } else {
                    // Xử lý làm sạch đường dẫn
                    $cleanPath = str_ireplace(public_path(), '', $path);
                    $cleanPath = str_replace('\\', '/', $cleanPath);
                    $cleanPath = ltrim($cleanPath, '/');

                    // Fix lỗi dư chữ 'public/' đầu chuỗi
                    if (Str::startsWith($cleanPath, 'public/')) {
                        $cleanPath = substr($cleanPath, 7);
                    }

                    // [QUAN TRỌNG] TỰ ĐỘNG THÊM 'storage/' NẾU THIẾU
                    // Nếu đường dẫn bắt đầu bằng 'avatars/' (như trong DB của bạn)
                    // thì phải thêm 'storage/' vào trước.
                    if (!Str::startsWith($cleanPath, 'storage/') && !empty($cleanPath)) {
                        $cleanPath = 'storage/' . $cleanPath;
                    }

                    if (!empty($cleanPath)) {
                        $avatarUrl = asset($cleanPath);
                    }
                }
            }
            // -----------------------------------------------

            // Xử lý thời gian tiếng Việt
            $timeAgo = $bl->created_at ? $bl->created_at->locale('vi')->diffForHumans() : '';
            if (str_contains($timeAgo, '1 giây')) {
                $timeAgo = 'Vừa xong';
            }

            return [
                'id' => $bl->id,
                'noi_dung' => $bl->noi_dung,
                'ngay_tao' => $timeAgo,
                'user_id' => $bl->nguoi_dung_id,
                'ho_ten' => $bl->nguoiDung ? $bl->nguoiDung->ho_ten : 'Người dùng ẩn danh',
                'anh_dai_dien' => $avatarUrl,
                'can_edit' => Auth::id() === $bl->nguoi_dung_id,
            ];
        });

        return response()->json($data);
    }

    // Lưu bình luận
    public function store(Request $request)
    {
        $request->validate([
            'bai_viet_id' => 'required|exists:bai_viets,id',
            'noi_dung' => 'required|string|max:1000',
        ]);

        $binhLuan = BinhLuan::create([
            'bai_viet_id' => $request->bai_viet_id,
            'nguoi_dung_id' => Auth::id(),
            'noi_dung' => $request->noi_dung,
            'trang_thai' => 'hien_thi',
        ]);

        return response()->json([
            'message' => 'Đăng bình luận thành công',
            'binh_luan' => $binhLuan
        ]);
    }

    // Cập nhật
    public function update(Request $request, $id)
    {
        $binhLuan = BinhLuan::findOrFail($id);
        if (Auth::id() !== $binhLuan->nguoi_dung_id) {
            return response()->json(['message' => 'Không có quyền thực hiện'], 403);
        }
        $request->validate(['noi_dung' => 'required|string|max:1000']);
        $binhLuan->update(['noi_dung' => $request->noi_dung]);
        return response()->json(['message' => 'Cập nhật thành công']);
    }

    // Xóa
    public function destroy($id)
    {
        $binhLuan = BinhLuan::findOrFail($id);
        if (Auth::id() !== $binhLuan->nguoi_dung_id) {
            return response()->json(['message' => 'Không có quyền thực hiện'], 403);
        }
        $binhLuan->delete();
        return response()->json(['message' => 'Xóa thành công']);
    }
}
