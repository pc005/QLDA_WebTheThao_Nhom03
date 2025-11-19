<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\NguoiDung;
use Illuminate\Http\Request;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Barryvdh\DomPDF\Facade\Pdf;

class LoginController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function login(Request $request)
    {
        $request->validate([
            'email' => 'required|string|email|max:255',
            'password' => 'required|string|min:6',
        ], [
            'email.required' => 'Email là bắt buộc.',
            'email.email' => 'Email không hợp lệ.',
            'password.required' => 'Mật khẩu là bắt buộc.',
            'password.min' => 'Mật khẩu phải ít nhất 6 ký tự.',
        ]);

        // Tìm người dùng
        $user = NguoiDung::where('email', $request->email)->first();

        if (!$user) {
            toastr()->error('Email không tồn tại.');
            return back();
        }

        // Check mật khẩu
        if (!Hash::check($request->password, $user->mat_khau)) {
            toastr()->error('Mật khẩu không chính xác.');
            return back();
        }

        // Check trạng thái
        if ($user->trang_thai !== 'Hoạt động') {
            toastr()->warning('Tài khoản đã bị khóa hoặc không hoạt động.');
            return back();
        }

        // Đăng nhập
        Auth::login($user);
        $request->session()->regenerate();

        // Điều hướng theo vai trò
        if ($user->vai_tro === 'Admin') {
            toastr()->success('Đăng nhập thành công (Admin).');
            return redirect()->route('admin.dashboard');
        }

        if ($user->vai_tro === 'BTV') {
            toastr()->success('Đăng nhập thành công (Biên tập viên).');
            return redirect()->route('btv.dashboard');
        }

        // Người dùng thường không được vào admin
        toastr()->error('Bạn không có quyền truy cập vào hệ thống quản trị.');
        Auth::logout();
        return back();
    }

    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        toastr()->success('Đăng xuất thành công.');
        return redirect()->route('admin.login.show');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(NguoiDung $nguoiDung)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(NguoiDung $nguoiDung)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, NguoiDung $nguoiDung)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(NguoiDung $nguoiDung)
    {
        //
    }
}
