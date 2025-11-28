<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\BaiViet;

class TimKiemController extends Controller
{
    public function index(Request $request)
    {
        $keyword = $request->input('q');

        // Bắt đầu query
        $articles = BaiViet::query();

        if ($keyword) {
            // Gom nhóm điều kiện tìm kiếm (quan trọng)
            $articles->where(function ($query) use ($keyword) {
                $query->where('tieu_de', 'LIKE', "%{$keyword}%")
                    ->orWhere('noi_dung', 'LIKE', "%{$keyword}%");
            });
        }

        // TẠM THỜI BỎ DÒNG NÀY ĐỂ TEST XEM CÓ PHẢI DO TRẠNG THÁI KHÔNG
        // $articles->where('trang_thai', 'hien_thi'); 

        // Sắp xếp và phân trang
        $result = $articles->orderBy('ngay_tao', 'desc')
            ->paginate(10);

        return view('tim_kiem.index', compact('result', 'keyword'));
    }
}
