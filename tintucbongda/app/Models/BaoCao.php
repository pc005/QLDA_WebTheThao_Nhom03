<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class BaoCao extends Model
{
    use HasFactory;

    protected $table = 'bao_caos';

    protected $fillable = [
        'nguoi_dung_id',
        'doi_tuong',
        'doi_tuong_id',
        'ly_do',
        'mo_ta',
        'trang_thai',
        'ngay_tao',
    ];

    public function user(): BelongsTo
    {
        return $this->belongsTo(NguoiDung::class, 'nguoi_dung_id');
    }

    public function baiViet(): BelongsTo
    {
        return $this->belongsTo(BaiViet::class, 'doi_tuong_id');
    }
}
