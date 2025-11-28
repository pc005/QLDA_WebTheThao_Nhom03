<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
// THÊM DÒNG NÀY: Import model NguoiDung của bạn
use App\Models\NguoiDung;

class BinhLuan extends Model
{
    use HasFactory;

    protected $fillable = [
        'bai_viet_id',
        'nguoi_dung_id',
        'noi_dung',
        'trang_thai',
        'ngay_tao',
        'ngay_cap_nhat'
    ];

    // SỬA LẠI ĐOẠN NÀY
    public function nguoiDung()
    {
        // Thay User::class thành NguoiDung::class
        return $this->belongsTo(NguoiDung::class, 'nguoi_dung_id');
    }

    public function baiViet()
    {
        return $this->belongsTo(BaiViet::class, 'bai_viet_id');
    }
}
