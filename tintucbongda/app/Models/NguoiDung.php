<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Auth\User as Authenticatable; // nếu dùng Auth
use Illuminate\Notifications\Notifiable;
use App\Models\Favorite;
use Illuminate\Database\Eloquent\Relations\MorphMany;
use Illuminate\Support\Str; // CẦN THÊM: Import lớp Str

class NguoiDung extends Authenticatable
{
    use Notifiable;
    // ... (các thuộc tính khác giữ nguyên) ...

    public function setMatKhauAttribute($value)
    {
        $this->attributes['mat_khau'] = bcrypt($value);
    }
    public function getAuthPassword()
    {
        return $this->mat_khau;
    }

    // --- MỐI QUAN HỆ YÊU THÍCH ---

    public function favorites(): MorphMany
    {
        return $this->morphMany(Favorite::class, 'favoritable');
    }

    /**
     * Phương thức tiện ích để kiểm tra xem người dùng đã thích một đối tượng cụ thể chưa.
     * KIỂM TRA BẰNG TÊN LỚP CƠ SỞ (Base Class Name).
     */
    public function hasFavorited(Model $model): bool
    {
        // Lấy tên lớp cơ sở (ví dụ: 'BaiViet')
        $baseModelName = class_basename($model);

        // Kiểm tra trong bảng favorites
        return \App\Models\Favorite::where('nguoi_dung_id', $this->id)
            ->where('favoritable_id', $model->id)
            ->where('favoritable_type', $baseModelName) // KIỂM TRA BẰNG TÊN NGẮN
            ->exists();
    }
}
