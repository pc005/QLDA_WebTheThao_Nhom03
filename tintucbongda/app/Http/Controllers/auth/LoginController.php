<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User; // Dùng Model User chuẩn
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;

class LoginController extends Controller
{
    // 1. Hiển thị form login
    public function showFormLogin()
    {
        if (Auth::check()) {
            return $this->redirectUser(Auth::user());
        }
        return view('auth.login');
    }

    // 2. Xử lý đăng nhập (Chuẩn Laravel)
    public function login(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);

        // Thử đăng nhập (Laravel tự check hash và cột mat_khau nếu đã config Model)
        if (Auth::attempt(['email' => $request->email, 'password' => $request->password])) {
            
            $request->session()->regenerate();
            $user = Auth::user();

            if ($user->trang_thai !== 'Hoạt động') {
                Auth::logout();
                return back()->with('error', 'Tài khoản đã bị khóa.');
            }

            return $this->redirectUser($user)->with('success', 'Đăng nhập thành công!');
        }

        return back()->with('error', 'Email hoặc mật khẩu không chính xác.');
    }

    // Hàm phụ trợ chuyển hướng theo quyền
    private function redirectUser($user)
    {
        if ($user->vai_tro === 'Admin') return redirect()->route('admin.dashboard');
        if ($user->vai_tro === 'BTV') return redirect()->route('btv.dashboard');
        return redirect()->route('home');
    }

    // 3. Đăng ký
    public function showFormRegister()
    {
        return view('auth.register');
    }

    public function register(Request $request)
    {
        $request->validate([
            'ho_ten' => 'required|string|max:100',
            'email' => 'required|email|unique:nguoi_dungs,email',
            'password' => [
                'required', 'min:6', 'confirmed',
                'regex:/[a-z]/', 'regex:/[A-Z]/', 'regex:/[0-9]/', 'regex:/[@$!%*?&]/'
            ],
        ], [
            'password.regex' => 'Mật khẩu yếu (cần chữ hoa, thường, số, ký tự đặc biệt).',
            'email.unique' => 'Email đã tồn tại.',
        ]);

        User::create([
            'ho_ten' => $request->ho_ten,
            'email' => $request->email,
            'mat_khau' => Hash::make($request->password), // QUAN TRỌNG: Phải mã hóa!
            'vai_tro' => 'Người dùng',
            'trang_thai' => 'Hoạt động',
        ]);

        return redirect()->route('login.show')->with('success', 'Đăng ký thành công! Hãy đăng nhập.');
    }

    // 4. Đăng xuất
    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
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

        $user = User::where('email', $request->email)->first();

        if (!$user) {
            return back()->with('error', 'Email không tồn tại.');
        }

        $token = Str::random(60);

        DB::table('password_resets')->updateOrInsert(
            ['email' => $request->email],
            ['token' => $token, 'created_at' => now()]
        );

        // Gửi mail (Đảm bảo .env đã cấu hình SMTP Gmail)
        try {
            Mail::raw(
                "Link reset mật khẩu (có hạn 60p): " . route('password.reset', $token),
                function ($message) use ($request) {
                    $message->to($request->email)->subject("Yêu cầu đặt lại mật khẩu");
                }
            );
            return back()->with('success', 'Link reset đã được gửi vào email!');
        } catch (\Exception $e) {
            return back()->with('error', 'Lỗi gửi mail: ' . $e->getMessage());
        }
    }

    public function showResetForm($token)
    {
        $reset = DB::table('password_resets')->where('token', $token)->first();
        
        if (!$reset || now()->diffInMinutes($reset->created_at) > 60) {
            return redirect()->route('login.show')->with('error', 'Link hết hạn!');
        }

        return view('auth.reset', compact('token'));
    }

    public function resetPassword(Request $request)
    {
        $request->validate([
            'password' => 'required|min:6|confirmed'
        ]);

        $reset = DB::table('password_resets')->where('token', $request->token)->first();

        if (!$reset) {
            return back()->with('error', 'Token không hợp lệ.');
        }

        $user = User::where('email', $reset->email)->first();

        // Cập nhật mật khẩu mới (MÃ HÓA)
        $user->update([
            'mat_khau' => Hash::make($request->password) // QUAN TRỌNG: Phải mã hóa!
        ]);

        // Xóa token
        DB::table('password_resets')->where('email', $reset->email)->delete();

        return redirect()->route('login.show')->with('success', 'Đổi mật khẩu thành công!');
    }
}