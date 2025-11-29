<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use HasFactory, Notifiable;

    /**
     * 1. CẤU HÌNH TÊN BẢNG
     * Mặc định là 'users', phải đổi thành 'nguoi_dungs' để khớp DB của bạn
     */
    protected $table = 'nguoi_dungs';

    /**
     * 2. CẤU HÌNH CÁC CỘT DỮ LIỆU
     * Đổi 'name' thành 'ho_ten', 'password' thành 'mat_khau'
     */
    protected $fillable = [
        'ho_ten',
        'email',
        'mat_khau',
        'anh_dai_dien',
        'vai_tro',
        'trang_thai',
    ];

    /**
     * 3. ẨN MẬT KHẨU
     */
    protected $hidden = [
        'mat_khau', // Sửa password thành mat_khau
        'remember_token',
    ];

    /**
     * 4. CẤU HÌNH QUAN TRỌNG NHẤT
     * Hàm này báo cho Laravel biết cột chứa mật khẩu tên là 'mat_khau'
     * Nếu không có hàm này, chức năng Đăng nhập sẽ luôn báo sai mật khẩu.
     */
    public function getAuthPassword()
    {
        return $this->mat_khau;
    }

    /**
     * Hàm ép kiểu dữ liệu (Giữ nguyên hoặc tùy chỉnh)
     */
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'mat_khau' => 'hashed', // Sửa password thành mat_khau
        ];
    }
}