<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class BaiViet extends Model
{
    protected $table = 'bai_viets';

    protected $fillable = [
        'tieu_de',
        'noi_dung',
        'hinh_anh',
        'nguoi_dung_id',
        'trang_thai',
        'ngay_tao',
        'ngay_cap_nhat',
    ];

    public $timestamps = true; // dùng created_at và updated_at
}
