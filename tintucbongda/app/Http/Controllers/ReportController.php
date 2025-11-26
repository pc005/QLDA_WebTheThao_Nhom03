<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
// use App\Models\Report; // Kích hoạt dòng này khi bạn có model Report

class ReportController extends Controller
{
    /**
     * Xử lý và lưu báo cáo bài viết vào cơ sở dữ liệu.
     */
    public function store(Request $request, $articleId)
    {
        // 1. Xác thực dữ liệu
        $request->validate([
            'reason' => 'required|string|in:spam,hate_speech,misinformation,pornography,other',
            'description' => 'nullable|string|max:1000',
        ]);

        // 2. Logic lưu báo cáo vào DB (Giả định bạn có bảng/model Report)

        /*
        // Ví dụ về việc lưu dữ liệu:
        Report::create([
            'article_id' => $articleId,
            'user_id' => auth()->check() ? auth()->id() : null, // Ghi lại ID người dùng nếu đã đăng nhập
            'reason' => $request->reason,
            'description' => $request->description,
            'ip_address' => $request->ip(),
        ]);
        */

        // 3. Trả về phản hồi cho người dùng
        return back()->with('success', 'Cảm ơn bạn! Báo cáo của bạn đã được ghi nhận và sẽ được xem xét sớm.');
    }
}
