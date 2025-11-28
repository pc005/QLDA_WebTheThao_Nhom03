<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DanhMuc extends Model
{
    use HasFactory;

    protected $table = 'danh_mucs'; // Chỉ định tên bảng nếu khác với quy ước
    protected $fillable = ['ten_danh_muc', 'mo_ta', 'danh_muc_cha_id', 'trang_thai','slug']; // Các trường hợp gán


    public function parent()
    {
        return $this->belongsTo(DanhMuc::class, 'danh_muc_cha_id');
    }

    /**
     * Quan hệ: Danh mục con
     */
    public function children()
    {
        return $this->hasMany(DanhMuc::class, 'danh_muc_cha_id');
    }

}
