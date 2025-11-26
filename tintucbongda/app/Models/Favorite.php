<?php

namespace App\Models;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\MorphTo;

class Favorite extends Model
{
    // Tên bảng trung gian
    protected $table = 'favorites';

    // Khai báo các cột có thể gán giá trị
    protected $fillable = [
        'nguoi_dung_id',
        'favoritable_id',
        'favoritable_type'
    ];

    /**
     * Xác định đối tượng (BaiViet/Video/...) được yêu thích.
     * Đây là quan hệ MorphTo.
     */
    public function favoritable(): MorphTo
    {
        return $this->morphTo();
    }

    /**
     * Mối quan hệ trỏ về người dùng đã thực hiện thao tác thích.
     */
    public function nguoiDung()
    {
        return $this->belongsTo(NguoiDung::class, 'nguoi_dung_id');
    }
}
