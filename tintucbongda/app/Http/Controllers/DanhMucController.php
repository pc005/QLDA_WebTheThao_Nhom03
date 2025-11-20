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
            // Lấy tất cả danh mục để hiển thị dropdown
    $categories = DanhMuc::all();

    // Trả về view và truyền biến $categories
    return view('Admin.DanhMuc.ThemDanhMuc', compact('categories'));
    }

    public function store(Request $request)
{
    $request->validate([
        'ten_danh_muc' => 'required|string|max:255',
        'mo_ta' => 'nullable|string',
        'danh_muc_cha_id' => 'nullable|exists:danh_mucs,id',
        'trang_thai' => 'required|boolean',
    ]);

    DanhMuc::create($request->only(['ten_danh_muc','mo_ta','danh_muc_cha_id','trang_thai']));

    return redirect()->route('danhmucs.index')
                     ->with('success', 'Thêm danh mục thành công!');
}
}
