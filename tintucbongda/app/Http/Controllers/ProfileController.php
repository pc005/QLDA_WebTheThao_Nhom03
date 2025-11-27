<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\File; // Sử dụng facade File
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rule;

class ProfileController extends Controller
{
    public function index()
    {
        // Lấy thông tin người dùng hiện tại
        $user = Auth::user();

        return view('profile.index', compact('user'));
    }

    /**
     * Xử lý upload và thay đổi ảnh đại diện.
     */
    public function updateAvatar(Request $request)
    {
        // 1. Xác thực (Validation)
        $request->validate([
            'avatar' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048', // 2MB Max
        ], [
            'avatar.required' => 'Vui lòng chọn ảnh đại diện.',
            'avatar.image' => 'File tải lên phải là hình ảnh.',
            'avatar.mimes' => 'Định dạng ảnh không hợp lệ. Chỉ chấp nhận: jpeg, png, jpg, gif.',
            'avatar.max' => 'Kích thước ảnh không được vượt quá 2MB.',
        ]);

        $user = Auth::user();

        // 2. Lưu trữ ảnh mới
        if ($request->hasFile('avatar')) {
            $image = $request->file('avatar');
            $filename = time() . '.' . $image->getClientOriginalExtension();

            // Lưu file vào thư mục 'public/avatars' (storage/app/public/avatars)
            $path = $image->storeAs('avatars', $filename, 'public');

            // 3. Xóa ảnh cũ (nếu có)
            if ($user->anh_dai_dien) {
                // Kiểm tra và xóa file ảnh đại diện cũ
                Storage::disk('public')->delete($user->anh_dai_dien);
            }

            // 4. Cập nhật đường dẫn ảnh mới vào database
            $user->anh_dai_dien = $path;
            $user->save();

            return redirect()->route('profile.index')->with('success', 'Ảnh đại diện đã được cập nhật thành công!');
        }

        return redirect()->back()->with('error', 'Có lỗi xảy ra khi upload ảnh.');
    }

    /**
     * Xử lý thay đổi Họ và tên.
     */
    public function updateName(Request $request)
    {
        // 1. Validate dữ liệu
        $request->validate([
            'ho_ten' => 'required|string|max:255|min:2',
        ], [
            'ho_ten.required' => 'Vui lòng nhập họ tên.',
            'ho_ten.min' => 'Họ tên phải có ít nhất 2 ký tự.',
        ]);

        // 2. Cập nhật user hiện tại
        $user = $request->user();
        $user->ho_ten = $request->input('ho_ten');
        $user->save();

        // 3. Quay lại trang cũ với thông báo thành công
        return back()->with('success', 'Đã cập nhật họ tên thành công!');
    }

    // Xử lý đổi Email
    public function updateEmail(Request $request)
    {
        $request->validate([
            // Rule 'current_password' kiểm tra pass cũ có đúng không
            'current_password' => ['required', 'current_password'],
            'email' => ['required', 'email', Rule::unique('users')->ignore(Auth::user()->id)],
        ], [
            'current_password.current_password' => 'Mật khẩu hiện tại không chính xác.',
            'email.unique' => 'Email này đã được sử dụng.'
        ]);
        try {
            $user = Auth::user();

            $user->email = $request->email;
            $user->save();

            return back()->with('success', 'Cập nhật email thành công!');
        } catch (\Throwable $e) {
            return back()->with('error', 'Không thể cập nhật email lúc này.');
        }
    }

    // Xử lý đổi Mật khẩu
    public function updatePassword(Request $request)
    {
        $request->validate([
            'current_password' => ['required', 'current_password'],
            'password' => ['required', 'confirmed', 'min:8'],
        ], [
            'current_password.current_password' => 'Mật khẩu hiện tại không chính xác.',
            'password.confirmed' => 'Mật khẩu mới không khớp.',
        ]);
        try {
            $user = Auth::user();
            // Gán mật khẩu thô để Model tự mã hóa (như bạn chọn giữ setMatKhauAttribute)
            $user->mat_khau = $request->password;

            $user->save();
            // THÀNH CÔNG: Gửi session 'success'
            return back()->with('success', 'Đổi mật khẩu thành công!');
        } catch (\Throwable $e) {
            // THẤT BẠI (Lỗi server, database...): Gửi session 'error'
            // Log::error($e->getMessage()); // Ghi log nếu cần
            return back()->with('error', 'Đã có lỗi xảy ra, vui lòng thử lại sau!');
        }
    }
}
