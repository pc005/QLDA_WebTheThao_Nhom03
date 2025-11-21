<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\NguoiDung;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;


class LoginController extends Controller
{
    // Hiển thị form login
    public function showFormLogin()
    {
        return view('auth.login'); // resources/views/auth/login.blade.php
    }
    // Xử lý đăng nhập
    public function login(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'email' => 'required|string|email|max:255',
            'password' => 'required|string|min:6',
        ]);

        if ($validator->fails()) {
            toastr()->error($validator->errors()->first());
            return back()->withInput();
        }

        $user = NguoiDung::where('email', $request->email)->first();

        if (!$user) {
            toastr()->error('Email không tồn tại.');
            return back();
        }

        if (!Hash::check($request->password, $user->mat_khau)) {
            toastr()->error('Mật khẩu không chính xác.');
            return back();
        }

        if ($user->trang_thai !== 'Hoạt động') {
            toastr()->warning('Tài khoản đã bị khóa hoặc không hoạt động.');
            return back();
        }

        Auth::login($user);
        $request->session()->regenerate();

        toastr()->success('Đăng nhập thành công!');

        if ($user->vai_tro === 'Admin') return redirect()->route('admin.dashboard');
        if ($user->vai_tro === 'BTV') return redirect()->route('btv.dashboard');

        return redirect()->route('home');
    }
    //Hiển thị form đăng ký
    public function showFormRegister(){
        return view('auth.register'); // resources/views/auth/login.blade.php
    }
    //Xử lý đăng ký
    public function register(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'ho_ten' => 'required|string|max:100',
            'email' => 'required|email|unique:nguoi_dungs,email',
            'password' => [
                'required',
                'min:6',
                'confirmed',
                'regex:/[a-z]/',
                'regex:/[A-Z]/',
                'regex:/[0-9]/',
                'regex:/[@$!%*?&]/'
            ],
        ], [
            'password.regex' => 'Mật khẩu phải có chữ hoa, chữ thường, số và ký tự đặc biệt.',
            'password.min' => 'Mật khẩu tối thiểu 6 ký tự.',
            'password.confirmed' => 'Mật khẩu nhập lại không khớp.',
            'email.unique' => 'Email đã tồn tại trong hệ thống.',
        ]);

        if ($validator->fails()) {
            // Lấy lỗi đầu tiên và hiển thị toastr
            toastr()->error($validator->errors()->first());
            return back()->withInput();
        }

        // Tạo người dùng mới
        NguoiDung::create([
            'ho_ten' => $request->ho_ten,
            'email' => $request->email,
            'mat_khau' => $request->password, // bỏ Hash::make
            'vai_tro' => 'Người dùng',
            'trang_thai' => 'Hoạt động',
        ]);


        toastr()->success('Tạo tài khoản thành công! Hãy đăng nhập.');

        return redirect()->route('login.show');
    }
    // =============================
    // QUÊN MẬT KHẨU
    // =============================

    public function showForgotForm()
    {
        return view('auth.forgot');
    }
    public function sendResetLink(Request $request)
    {
        $request->validate(['email' => 'required|email']);

        $user = NguoiDung::where('email', $request->email)->first();

        if (!$user) {
            toastr()->error("Email không tồn tại trong hệ thống.");
            return back();
        }

        // Tạo token reset
        $token = Str::random(60);

        // Lưu vào bảng password_resets
        DB::table('password_resets')->updateOrInsert(
            ['email' => $request->email],
            [
                'token' => $token,
                'created_at' => now()
            ]
        );

        // Gửi email
        Mail::raw(
            "Nhấn vào link đặt lại mật khẩu (hết hạn sau 60 phút): " . route('password.reset', $token),
            function ($message) use ($request) {
                $message->to($request->email)->subject("Đặt lại mật khẩu");
            }
        );

        toastr()->success("Đã gửi link đặt lại mật khẩu tới email của bạn!");
        return back();
    }
    public function showResetForm($token)
    {
        // Kiểm tra token tồn tại và chưa hết hạn
        $reset = DB::table('password_resets')->where('token', $token)->first();
        if (!$reset || now()->diffInMinutes($reset->created_at) > 60) {
            toastr()->error("Link đặt lại mật khẩu không hợp lệ hoặc đã hết hạn!");
            return redirect()->route('login.show');
        }

        return view('auth.reset', compact('token'));
    }
    public function resetPassword(Request $request)
    {
        // Validate password
        $request->validate([
            'password' => [
                'required',
                'min:6',
                'confirmed',
                'regex:/[a-z]/',
                'regex:/[A-Z]/',
                'regex:/[0-9]/',
                'regex:/[@$!%*?&]/'
            ],
        ], [
            'password.regex' => 'Mật khẩu phải có chữ hoa, chữ thường, số và ký tự đặc biệt.',
            'password.min' => 'Mật khẩu tối thiểu 6 ký tự.',
            'password.confirmed' => 'Mật khẩu nhập lại không khớp.',
        ]);

        $reset = DB::table('password_resets')->where('token', $request->token)->first();

        if (!$reset) {
            toastr()->error("Link đặt lại mật khẩu không hợp lệ hoặc đã dùng!");
            return back();
        }

        // Kiểm tra token hết hạn
        if (now()->diffInMinutes($reset->created_at) > 60) {
            DB::table('password_resets')->where('token', $request->token)->delete();
            toastr()->error("Link đặt lại mật khẩu đã hết hạn!");
            return redirect()->route('login.show');
        }

        $user = NguoiDung::where('email', $reset->email)->first();

        // Kiểm tra mật khẩu mới khác mật khẩu cũ
        if (Hash::check($request->password, $user->mat_khau)) {
            toastr()->error("Mật khẩu mới không được trùng mật khẩu cũ!");
            return back();
        }
        //cập nhật không cần dùng make vì trong kia đã đó sử dụng để ãm hóa ròi
        $user->update([ 'mat_khau' => $request->password  ]);

        // Xóa token sau khi dùng
        DB::table('password_resets')->where('email', $reset->email)->delete();

        toastr()->success("Đặt lại mật khẩu thành công! Hãy đăng nhập.");
        return redirect()->route('login.show');
    }

    //Log out
    // LoginController.php
    public function logout()
    {
        Auth::logout();
        return redirect()->route('login.show');
    }


}
