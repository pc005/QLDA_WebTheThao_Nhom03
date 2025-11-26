<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\MorphToMany;

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

    /**
     * Lấy danh sách Người dùng đã yêu thích Bài viết này.
     */
    public function favoritedBy(): MorphToMany
    {
        // 'NguoiDung' là Model User của bạn
        // 'favoritable' là tên tiền tố của cột đa hình trong bảng 'favorites'
        // 'favorites' là tên bảng pivot
        // 'favoritable_id' là khóa ngoại của Bài viết trong bảng pivot (mặc định của morphToMany)
        // 'nguoi_dung_id' là khóa ngoại của Người dùng trong bảng pivot
        return $this->morphToMany(NguoiDung::class, 'favoritable', 'favorites', 'favoritable_id', 'nguoi_dung_id');
    }
}
