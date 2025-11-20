<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Video extends Model
{
    protected $table = 'videos';

    protected $fillable = [
        'tieu_de',
        'url',
        'bai_viet_id',
        'nguoi_dung_id',
        'trang_thai',
        'ngay_tao',
        'ngay_cap_nhat',
    ];

    public $timestamps = true; // dùng created_at, updated_at
}
