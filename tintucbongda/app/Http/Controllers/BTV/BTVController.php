<?php

namespace App\Http\Controllers\BTV;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;
use App\Models\BaiViet;
use App\Models\DanhMuc;

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
        $categories = DanhMuc::all();
        toastr()->info('Tạo bài viết mới');
        return view('btv.posts.create', compact('categories'));
    }

    // Danh sách bài viết đã tạo
    public function listPosts()
    {
        $userId = Auth::id();
        $posts = BaiViet::where('nguoi_dung_id', $userId)
            ->with('danhMuc')
            ->orderBy('created_at', 'desc')
            ->paginate(10);

        return view('btv.posts.index', compact('posts'));
    }

    // Danh sách video của BTV
    public function listVideos()
    {
        // $videos = Video::where('nguoi_tao_id', auth()->id())->get();
        // return view('btv.videos.index', compact('videos'));
        return view('btv.videos.index'); // demo
    }

    // Lưu bài viết mới
    public function store(Request $request)
    {
        $request->validate([
            'tieu_de' => 'required|string|max:255',
            'noi_dung' => 'required|string',
            'danh_muc_id' => 'required|integer|exists:danh_mucs,id',
            'anh_dai_dien' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
            'tom_tat' => 'nullable|string',
            'trang_thai' => 'required|in:Chờ duyệt,Nháp',
        ]);

        $data = $request->all();
        $data['nguoi_dung_id'] = Auth::id();
        $data['slug'] = Str::slug($request->tieu_de);
        $data['ngay_tao'] = now();
        $data['ngay_cap_nhat'] = now();
        $data['noi_bat'] = $request->has('noi_bat') ? 1 : 0;

        // Xử lý upload hình ảnh
        if ($request->hasFile('anh_dai_dien')) {
            $file = $request->file('anh_dai_dien');
            $filename = time() . '_' . $file->getClientOriginalName();
            $file->move(public_path('uploads/posts'), $filename);
            $data['anh_dai_dien'] = 'uploads/posts/' . $filename;
        } else {
            // Nếu không upload file mới, giữ nguyên đường dẫn cũ hoặc normalize nếu cần
            if (isset($data['anh_dai_dien']) && str_starts_with($data['anh_dai_dien'], public_path())) {
                $data['anh_dai_dien'] = str_replace(public_path(), '', $data['anh_dai_dien']);
                $data['anh_dai_dien'] = str_replace('\\', '/', $data['anh_dai_dien']);
                $data['anh_dai_dien'] = ltrim($data['anh_dai_dien'], '/');
            }
        }

        BaiViet::create($data);

        toastr()->success('Bài viết được tạo thành công và chờ duyệt!');
        return redirect()->route('btv.posts.index');
    }

    // Hiển thị form sửa bài viết
    public function editPost($id)
    {
        $post = BaiViet::find($id);

        if (!$post || $post->nguoi_dung_id !== Auth::id()) {
            toastr()->error('Bạn không có quyền sửa bài viết này.');
            abort(403, 'Bạn không có quyền sửa bài viết này.');
        }

        $categories = DanhMuc::all();
        toastr()->info('Chỉnh sửa bài viết');
        return view('btv.posts.edit', compact('post', 'categories'));
    }

    // Cập nhật bài viết (BTV)
    public function update(Request $request, $id)
    {
        $post = BaiViet::find($id);

        if (!$post || $post->nguoi_dung_id !== Auth::id()) {
            toastr()->error('Bạn không có quyền sửa bài viết này.');
            abort(403, 'Bạn không có quyền sửa bài viết này.');
        }

        $request->validate([
            'tieu_de' => 'required|string|max:255',
            'noi_dung' => 'required|string',
            'danh_muc_id' => 'required|integer|exists:danh_mucs,id',
            'anh_dai_dien' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
            'tom_tat' => 'nullable|string',
        ]);

        $data = $request->all();
        $data['slug'] = Str::slug($request->tieu_de);
        $data['ngay_cap_nhat'] = now();
        $data['noi_bat'] = $request->has('noi_bat') ? 1 : 0;

        // Xử lý upload hình ảnh mới, xóa hình cũ nếu có
        if ($request->hasFile('anh_dai_dien')) {
            if ($post->anh_dai_dien && file_exists(public_path($post->anh_dai_dien))) {
                @unlink(public_path($post->anh_dai_dien));
            }
            $file = $request->file('anh_dai_dien');
            $filename = time() . '_' . $file->getClientOriginalName();
            $file->move(public_path('uploads/posts'), $filename);
            $data['anh_dai_dien'] = 'uploads/posts/' . $filename;
        }

        // Sau khi BTV chỉnh sửa, đưa về trạng thái chờ duyệt
        $data['trang_thai'] = 'Chờ duyệt';

        $post->update($data);

        toastr()->success('Bài viết đã được cập nhật và gửi lại để duyệt!');
        return redirect()->route('btv.posts.index');
    }

    // Xóa bài viết
    public function deletePost($id)
    {
        $post = BaiViet::find($id);

        if (!$post || $post->nguoi_dung_id !== Auth::id()) {
            abort(403, 'Bạn không có quyền xóa bài viết này.');
        }

        // Xóa hình ảnh nếu tồn tại
        if ($post->anh_dai_dien && file_exists(public_path($post->anh_dai_dien))) {
            unlink(public_path($post->anh_dai_dien));
        }

        $post->delete();

        toastr()->success('Bài viết được xóa thành công!');
        return redirect()->route('btv.posts.index');
    }
}
