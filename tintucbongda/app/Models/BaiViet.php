<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class BaiViet extends Model
{
    protected $table = 'bai_viets';

    protected $fillable = [
        'tieu_de',
        'slug',
        'tom_tat',
        'noi_dung',
        'anh_dai_dien',
        'video_url',
        'nguoi_dung_id',
        'danh_muc_id',
        'trang_thai',
        'noi_bat',
        'ngay_tao',
        'ngay_cap_nhat',
    ];

    public $timestamps = true;

    protected $dates = ['created_at', 'updated_at', 'ngay_tao', 'ngay_cap_nhat'];

    // Relationship với NguoiDung (tác giả)
    public function user(): BelongsTo
    {
        return $this->belongsTo(NguoiDung::class, 'nguoi_dung_id', 'id');
    }

    // Relationship với DanhMuc (danh mục)
    public function danhMuc(): BelongsTo
    {
        return $this->belongsTo(DanhMuc::class, 'danh_muc_id', 'id');
    }
}
