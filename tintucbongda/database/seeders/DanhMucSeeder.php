<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class DanhMucSeeder extends Seeder
{
    public function run(): void
    {
        DB::table('danh_mucs')->insert([
            [
                'ten_danh_muc' => 'Tin tức thể thao',
                'slug' => 'tin-tuc-the-thao',
                'mo_ta' => 'Các tin tức mới nhất về thể thao',
                'danh_muc_cha_id' => null,
                'trang_thai' => 'Hoạt động',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'ten_danh_muc' => 'Công nghệ',
                'slug' => 'cong-nghe',
                'mo_ta' => 'Tin tức và bài viết về công nghệ',
                'danh_muc_cha_id' => null,
                'trang_thai' => 'Hoạt động',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'ten_danh_muc' => 'Du lịch',
                'slug' => 'du-lich',
                'mo_ta' => 'Kinh nghiệm và hướng dẫn du lịch',
                'danh_muc_cha_id' => null,
                'trang_thai' => 'Hoạt động',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'ten_danh_muc' => 'Bóng đá',
                'slug' => 'bong-da',
                'mo_ta' => 'Tin tức bóng đá trong và ngoài nước',
                'danh_muc_cha_id' => 1, // thuộc "Tin tức thể thao"
                'trang_thai' => 'Hoạt động',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'ten_danh_muc' => 'Review sản phẩm',
                'slug' => 'review-san-pham',
                'mo_ta' => 'Đánh giá các sản phẩm công nghệ',
                'danh_muc_cha_id' => 2, // thuộc "Công nghệ"
                'trang_thai' => 'Hoạt động',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'ten_danh_muc' => 'Ẩm thực',
                'slug' => 'am-thuc',
                'mo_ta' => 'Khám phá món ăn ngon',
                'danh_muc_cha_id' => 3, // thuộc "Du lịch"
                'trang_thai' => 'Hoạt động',
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }
}
