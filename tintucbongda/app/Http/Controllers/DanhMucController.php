<?php
namespace App\Http\Controllers;

use App\Models\DanhMuc; // Thay 'Category' bằng 'DanhMuc'
use Illuminate\Http\Request;

class DanhMucController extends Controller
{
 public function index()
    {
        $danhMucs = DanhMuc::all(); // Lấy tất cả danh mục
        return view('Admin.DanhMuc.Danhmuc', compact('danhMucs')); // Truyền biến vào view
    }
   public function edit($id)
    {
         $danhMuc = DanhMuc::findOrFail($id);
    $categories = DanhMuc::all();

    // Trả về view và truyền cả $danhMuc và $categories
    return view('Admin.DanhMuc.SuaDanhMuc', compact('danhMuc', 'categories'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'ten_danh_muc' => 'required|string|max:255',
            'mo_ta' => 'nullable|string',
        ]);

        $danhMuc = DanhMuc::findOrFail($id);
        $danhMuc->update($request->all());

        return redirect()->route('danhmucs.index')
                         ->with('success', 'Cập nhật danh mục thành công!');
    }
     public function destroy($id)
    {
        $danhMuc = DanhMuc::findOrFail($id);
        $danhMuc->delete();

        return redirect()->route('danhmucs.index')
                         ->with('success', 'Xóa danh mục thành công!');
    }
    public function create()
    {

    $categories = DanhMuc::all();

    return view('Admin.DanhMuc.ThemDanhMuc', compact('categories'));
    }

 public function store(Request $request)
    {
        // Xác thực dữ liệu nếu cần
        $request->validate([
            'ten_danh_muc' => 'required|string|max:255',
            'mo_ta' => 'nullable|string',
            'danh_muc_cha_id' => 'nullable|integer|exists:danh_mucs,id',
            'trang_thai' => 'required|string|in:Hoạt động,K không hoạt động',
        ]);

        // Tạo mới danh mục
        DanhMuc ::create($request->all());

        // Chuyển hướng về trang danh sách hoặc thông báo thành công
        return redirect()->route('danhmucs.index')->with('success', 'Danh mục đã được thêm thành công!');
    }
}
