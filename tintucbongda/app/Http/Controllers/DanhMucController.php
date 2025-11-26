<?php
namespace App\Http\Controllers;

use App\Models\DanhMuc;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class DanhMucController extends Controller
{
//     protected function isUniqueTenDanhMuc($tenDanhMuc, $currentId = null)
// {
//     $query = \App\Models\DanhMuc::where('ten_danh_muc', $tenDanhMuc);

//     if ($currentId) {
//         $query->where('id', '!=', $currentId); // loại trừ chính nó khi update
//     }

//     return !$query->exists(); // true nếu không trùng
// }


    // Hàm kiểm tra danh_muc_cha_id hợp lệ
    protected function isValidDanhMucChaId($id, $danh_muc_cha_id = null)
    {
        if (empty($id)) {
            return true; // không có cha thì hợp lệ
        }

        // Không cho phép chính nó làm cha
        if ($danh_muc_cha_id && $id == $danh_muc_cha_id) {
            return false;
        }

        // Kiểm tra xem danh mục cha có tồn tại không
        return DanhMuc::where('id', $id)->exists();
    }

    public function index()
    {
        $danhMucs = DanhMuc::all();
        return view('Admin.DanhMuc.Danhmuc', compact('danhMucs'));
    }

    public function create()
    {
        $categories = DanhMuc::all();
        return view('Admin.DanhMuc.ThemDanhMuc', compact('categories'));
    }

    // public function store(Request $request)
    // {
    //     $request->validate([
    //         'ten_danh_muc' => 'required|string|max:255',
    //         'mo_ta' => 'nullable|string',
    //         'danh_muc_cha_id' => 'nullable|integer',
    //         'trang_thai' => 'required|string|in:Hoạt động,K không hoạt động',
    //     ]);

    //     if (!$this->isValidDanhMucChaId($request->danh_muc_cha_id)) {
    //         return back()->withErrors(['danh_muc_cha_id' => 'Danh mục cha không hợp lệ']);
    //     }

    //     $data = $request->all();
    //     $data['slug'] = Str::slug($request->ten_danh_muc);

    //     DanhMuc::create($data);

    //     return redirect()->route('danhmucs.index')->with('success', 'Danh mục đã được thêm thành công!');
    // }
public function store(Request $request)
{
    $request->validate([
        'ten_danh_muc' => 'required|string|max:255|unique:danh_mucs,ten_danh_muc',

        'mo_ta' => 'nullable|string',
        'danh_muc_cha_id' => 'nullable|integer|exists:danh_mucs,id',
        'trang_thai' => 'required|string|in:Hoạt động,Không hoạt động',

    ], [
        'ten_danh_muc.unique' => 'Tên danh mục đã tồn tại',
    ]);

    $data = $request->all();
    $data['slug'] = \Illuminate\Support\Str::slug($request->ten_danh_muc);

    \App\Models\DanhMuc::create($data);

    return redirect()->route('danhmucs.index')->with('success', 'Danh mục đã được thêm thành công!');
}


    public function edit($id)
    {
        $danhMuc = DanhMuc::findOrFail($id);
        $categories = DanhMuc::all();
        return view('Admin.DanhMuc.SuaDanhMuc', compact('danhMuc', 'categories'));
    }

    // public function update(Request $request, $id)
    // {
    //     $request->validate([
    //         'ten_danh_muc' => 'required|string|max:255',
    //         'mo_ta' => 'nullable|string',
    //         'danh_muc_cha_id' => 'nullable|integer',
    //         'trang_thai' => 'required|string|in:Hoạt động,K không hoạt động',
    //     ]);

    //     if (!$this->isValidDanhMucChaId($request->danh_muc_cha_id, $id)) {
    //         return back()->withErrors(['danh_muc_cha_id' => 'Danh mục cha không hợp lệ']);
    //     }

    //     $danhMuc = DanhMuc::findOrFail($id);
    //     $danhMuc->update($request->all());

    //     return redirect()->route('danhmucs.index')->with('success', 'Cập nhật danh mục thành công!');
    // }
//     public function update(Request $request, $id)
// {
//     $request->validate([
//         'ten_danh_muc' => 'required|string|max:255',
//         'mo_ta' => 'nullable|string',
//         'danh_muc_cha_id' => 'nullable|integer|exists:danh_mucs,id',
//         'trang_thai' => 'required|string|in:Hoạt động,K không hoạt động',
//     ]);

//     if (!$this->isUniqueTenDanhMuc($request->ten_danh_muc, $id)) {
//         return back()->withErrors(['ten_danh_muc' => 'Tên danh mục đã tồn tại']);
//     }

//     $danhMuc = \App\Models\DanhMuc::findOrFail($id);
//     $danhMuc->update($request->all());

//     return redirect()->route('danhmucs.index')->with('success', 'Cập nhật danh mục thành công!');
// }
public function update(Request $request, $id)
{
    $request->validate([
        'ten_danh_muc' => 'required|string|max:255|unique:danh_mucs,ten_danh_muc,' . $id,
        'mo_ta' => 'nullable|string',
        'danh_muc_cha_id' => 'nullable|integer|exists:danh_mucs,id',
        'trang_thai' => 'required|string|in:Hoạt động,K không hoạt động',
    ], [
        'ten_danh_muc.unique' => 'Tên danh mục đã tồn tại',
    ]);


    $danhMuc = \App\Models\DanhMuc::findOrFail($id);
    $danhMuc->update($request->all());
    $request->validate([
    'ten_danh_muc' => 'required|string|max:255|unique:danh_mucs,ten_danh_muc,' . $id,
],
//  [
//     'ten_danh_muc.unique' => 'Tên danh mục đã tồn tại',
// ]
);


    return redirect()->route('danhmucs.index')->with('success', 'Cập nhật danh mục thành công!');
}



    public function destroy($id)
    {
        $danhMuc = DanhMuc::findOrFail($id);
        $danhMuc->delete();
        return redirect()->route('danhmucs.index')->with('success', 'Xóa danh mục thành công!');
    }
}

