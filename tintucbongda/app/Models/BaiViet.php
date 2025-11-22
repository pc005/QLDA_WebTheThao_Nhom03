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

    ];
    public $timestamps = true;

    protected $dates = ['created_at', 'updated_at', 'ngay_tao', 'ngay_cap_nhat'];


}
