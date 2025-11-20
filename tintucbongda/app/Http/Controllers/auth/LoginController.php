<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\NguoiDung;
use Illuminate\Http\Request;

use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;


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
    public function showFormRegister(){
        return view('auth.register'); // resources/views/auth/login.blade.php
    }


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








}
