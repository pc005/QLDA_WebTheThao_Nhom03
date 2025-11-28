<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Video extends Model
{
    protected $table = 'videos';

    // Các cột có thể fill
    protected $fillable = [
        'tieu_de',
        'url',
        'bai_viet_id',
        'nguoi_dung_id',
        'trang_thai',
        'ngay_tao',
        'ngay_cap_nhat',
    ];

    // Dùng created_at, updated_at
    public $timestamps = true;

    // Khai báo kiểu ngày cho Carbon
    protected $dates = [
        'ngay_tao',
        'ngay_cap_nhat',
        'created_at',
        'updated_at',
    ];

    // Quan hệ: Video thuộc về 1 bài viết
    public function baiViet()
    {
        return $this->belongsTo(BaiViet::class, 'bai_viet_id');
    }

    // Quan hệ: Video thuộc về 1 người dùng
    public function nguoiDung()
    {
        return $this->belongsTo(NguoiDung::class, 'nguoi_dung_id');
    }
}
