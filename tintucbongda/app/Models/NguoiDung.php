<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Auth\User as Authenticatable; // nếu dùng Auth
use Illuminate\Notifications\Notifiable;

class NguoiDung extends Authenticatable
{
    use Notifiable;

    // Tên bảng trong database
    protected $table = 'nguoi_dungs';

    // Khóa chính (mặc định là 'id', nếu khác thì khai báo)
    protected $primaryKey = 'id';

    // Các cột có thể gán giá trị hàng loạt
    protected $fillable = [
        'ho_ten',
        'email',
        'mat_khau',
        'anh_dai_dien',
        'vai_tro',
        'trang_thai',
        'ngay_tao',
        'ngay_cap_nhat',
    ];

    // Ẩn các cột khi serialize (ví dụ: trả về JSON)
    protected $hidden = [
        'mat_khau',
    ];

    // Nếu muốn tự động quản lý created_at / updated_at
    public $timestamps = true;

    // Nếu bạn muốn đổi tên cột created_at / updated_at mặc định
    const CREATED_AT = 'ngay_tao';
    const UPDATED_AT = 'ngay_cap_nhat';

    // Nếu muốn hash mật khẩu tự động khi gán
    public function setMatKhauAttribute($value)
    {
        $this->attributes['mat_khau'] = bcrypt($value);
    }
    public function getAuthPassword()
    {
        return $this->mat_khau;
    }
}
