<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\BaiViet;
use App\Models\BaoCao;
use App\Models\DanhMuc;
use App\Models\NguoiDung;
use App\Models\Video;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;
class AdminController extends Controller
{
    public function dashboard()
    {
        $tongBaiViet = BaiViet::count();
        $tongVideo = Video::count();
        $tongNguoiDung = NguoiDung::count();
        $tongDanhMuc = DanhMuc::count();

        return view('admin.dashboard', compact('tongBaiViet', 'tongVideo', 'tongNguoiDung', 'tongDanhMuc'));
    }

    public function posts()
    {
        $posts = BaiViet::with(['user' => function ($q) {
            $q->select('id', 'ho_ten', 'vai_tro', 'email');
        }, 'danhMuc' => function ($q) {
            $q->select('id', 'ten_danh_muc');
        }])->orderBy('created_at', 'desc')->paginate(15);

        return view('admin.posts.index', compact('posts'));
    }

    // Danh sách bài viết nổi bật
    public function featuredPosts()
    {
        $posts = BaiViet::where('noi_bat', 1)->with(['user' => function ($q) {
            $q->select('id', 'ho_ten', 'vai_tro', 'email');
        }, 'danhMuc' => function ($q) {
            $q->select('id', 'ten_danh_muc');
        }])->orderBy('created_at', 'desc')->paginate(15);

        return view('admin.posts.featured', compact('posts'));
    }

    // Danh sách bài viết bị tố cáo
    public function reportedPosts()
    {
        $reports = BaoCao::where('doi_tuong', 'BaiViet')->with(['user' => function ($q) {
            $q->select('id', 'ho_ten');
        }, 'baiViet' => function ($q) {
            $q->select('id', 'tieu_de', 'trang_thai');
        }])->orderBy('created_at', 'desc')->paginate(15);

        return view('admin.posts.reported', compact('reports'));
    }

    // Đánh dấu báo cáo đã xử lý
    public function resolveReport($id)
    {
        $report = BaoCao::find($id);

        if (!$report) {
            toastr()->error('Báo cáo không tồn tại!');
            return back();
        }

        $report->update(['trang_thai' => 'Đã xử lý']);
        toastr()->success('Báo cáo đã được đánh dấu là đã xử lý!');

        return back();
    }

    // Hiển thị form tạo bài viết cho Admin
    public function createPost()
    {
        toastr()->info('Tạo bài viết mới (Admin)');
        return view('admin.posts.create');
    }

    // Lưu bài viết do Admin tạo (tự động duyệt)
    public function store(Request $request)
    {
        $request->validate([
            'tieu_de' => 'required|string|max:255',
            'noi_dung' => 'required|string',
            'danh_muc_id' => 'required|integer|exists:danh_mucs,id',
            'anh_dai_dien' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
            'tom_tat' => 'nullable|string',
        ]);

        $data = $request->all();
        $data['nguoi_dung_id'] = Auth::id();
        $data['slug'] = Str::slug($request->tieu_de);
        $data['ngay_tao'] = now();
        $data['ngay_cap_nhat'] = now();
        $data['noi_bat'] = $request->has('noi_bat') ? 1 : 0;

        if ($request->hasFile('anh_dai_dien')) {
            $uploadPath = public_path('uploads/posts');
            if (!File::exists($uploadPath)) {
                File::makeDirectory($uploadPath, 0755, true);
            }
            $file = $request->file('anh_dai_dien');
            $filename = time() . '_' . $file->getClientOriginalName();
            $file->move($uploadPath, $filename);
            $data['anh_dai_dien'] = 'uploads/posts/' . $filename;
        }

        // Admin tạo bài => tự động duyệt
        $data['trang_thai'] = 'Đã duyệt';

        BaiViet::create($data);

        toastr()->success('Bài viết đã được tạo và duyệt thành công!');
        return redirect()->route('admin.posts.index');
    }

    // public function videos()
    // {
    //     // return view('admin.videos.index');
    //      return view('admin.videos.danhsachvideoadmin');
    // }

    public function users()
    {
        return view('admin.users.index');
    }

    public function categories()
    {
        return view('admin.categories.index');
    }

    public function ads()
    {
        return view('admin.ads.index');
    }

    public function settings()
    {
        return view('admin.settings.index');
    }

    // Duyệt bài viết
    public function approvePost($id)
    {
        $post = BaiViet::find($id);

        if (!$post) {
            toastr()->error('Bài viết không tồn tại!');
            return back();
        }

        $post->update(['trang_thai' => 'Đã duyệt']);
        toastr()->success('Bài viết đã được duyệt thành công!');

        return back();
    }

    // Từ chối bài viết
    public function rejectPost(Request $request, $id)
    {
        $request->validate([
            'ly_do_tu_choi' => 'required|string|max:1000',
        ]);

        $post = BaiViet::find($id);

        if (!$post) {
            toastr()->error('Bài viết không tồn tại!');
            return back();
        }

        $post->update([
            'trang_thai' => 'Bị từ chối',
            'ly_do_tu_choi' => $request->ly_do_tu_choi,
        ]);

        // Gửi thông báo cho biên tập viên (tạm thời dùng toastr, sau này email)
        toastr()->warning('Bài viết đã bị từ chối và thông báo đã gửi cho biên tập viên!');

        return back();
    }

    // Hiển thị bài viết (Admin xem chi tiết)
    public function show($id)
    {
        $post = BaiViet::with(['user', 'danhMuc'])->find($id);

        if (!$post) {
            toastr()->error('Bài viết không tồn tại!');
            return redirect()->route('admin.posts.index');
        }

        return view('admin.posts.show', compact('post'));
    }

    // Hiển thị form chỉnh sửa bài viết cho Admin
    public function editPost($id)
    {
        $post = BaiViet::find($id);

        if (!$post) {
            toastr()->error('Bài viết không tồn tại!');
            return redirect()->route('admin.posts.index');
        }

        $categories = DanhMuc::all();
        toastr()->info('Chỉnh sửa bài viết (Admin)');
        return view('admin.posts.edit', compact('post', 'categories'));
    }

    // Cập nhật bài viết (Admin)
    public function update(Request $request, $id)
    {
        $post = BaiViet::find($id);

        if (!$post) {
            toastr()->error('Bài viết không tồn tại!');
            return redirect()->route('admin.posts.index');
        }

        $request->validate([
            'tieu_de' => 'required|string|max:255',
            'noi_dung' => 'required|string',
            'danh_muc_id' => 'required|integer|exists:danh_mucs,id',
            'anh_dai_dien' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
            'tom_tat' => 'nullable|string',
            'trang_thai' => 'required|in:Chờ duyệt,Đã duyệt,Từ chối,Nháp',
        ]);

        $data = $request->all();
        $data['slug'] = Str::slug($request->tieu_de);
        $data['ngay_cap_nhat'] = now();
        $data['noi_bat'] = $request->has('noi_bat') ? 1 : 0;

        if ($request->hasFile('anh_dai_dien')) {
            if ($post->anh_dai_dien && file_exists(public_path($post->anh_dai_dien))) {
                @unlink(public_path($post->anh_dai_dien));
            }
            $uploadPath = public_path('uploads/posts');
            if (!File::exists($uploadPath)) {
                File::makeDirectory($uploadPath, 0755, true);
            }
            $file = $request->file('anh_dai_dien');
            $filename = time() . '_' . $file->getClientOriginalName();
            $file->move($uploadPath, $filename);
            $data['anh_dai_dien'] = 'uploads/posts/' . $filename;
        }

        $post->update($data);

        toastr()->success('Bài viết đã được cập nhật thành công!');
        return redirect()->route('admin.posts.index');
    }

    // Xóa bài viết (Admin)
    public function destroy($id)
    {
        $post = BaiViet::find($id);

        if (!$post) {
            toastr()->error('Bài viết không tồn tại!');
            return redirect()->route('admin.posts.index');
        }

        if ($post->anh_dai_dien && file_exists(public_path($post->anh_dai_dien))) {
            @unlink(public_path($post->anh_dai_dien));
        }

        $post->delete();

        toastr()->success('Bài viết đã được xóa thành công!');
        return redirect()->route('admin.posts.index');
    }

    // Toggle featured status
    public function toggleFeatured(Request $request, $id)
    {
        $post = BaiViet::find($id);

        if (!$post) {
            toastr()->error('Bài viết không tồn tại!');
            return back();
        }

        $featured = $request->input('featured', 0);
        $post->update(['noi_bat' => $featured]);

        $message = $featured ? 'Bài viết đã được đánh dấu nổi bật!' : 'Bài viết đã được bỏ khỏi danh sách nổi bật!';
        toastr()->success($message);

        return back();
    }
}
