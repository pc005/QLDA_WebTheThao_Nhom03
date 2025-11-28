<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\BaoCao;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;

class ReportController extends Controller
{
    public function store(Request $request, $id)
    {
        // Xác thực dữ liệu
        $request->validate([
            'ly_do' => 'required|string|max:255',
            'mo_ta' => 'nullable|string|max:1000',
        ]);

        // Lưu báo cáo
        BaoCao::create([
            'nguoi_dung_id' => Auth::check() ? Auth::id() : null,
            'doi_tuong' => 'bai_viet',
            'doi_tuong_id' => $id,
            'ly_do' => $request->ly_do,
            'mo_ta' => $request->mo_ta,
            'trang_thai' => 'đang xử lý',
            'ngay_tao' => Carbon::now(),
        ]);

        return back()->with('success', 'Báo cáo của bạn đã được ghi nhận.');
    }
}
