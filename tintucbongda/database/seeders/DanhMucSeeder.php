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
                'ten_danh_muc' => 'Tin nóng bóng đá',
                'slug' => 'tin-nong-bong-da',
                'mo_ta' => 'Các tin tức nóng hổi và cập nhật mới nhất về bóng đá',
                'danh_muc_cha_id' => null,
                'trang_thai' => 'Hoạt động',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'ten_danh_muc' => 'Bóng đá Việt Nam',
                'slug' => 'bong-da-viet-nam',
                'mo_ta' => 'Tin tức và diễn biến các giải đấu trong nước',
                'danh_muc_cha_id' => null,
                'trang_thai' => 'Hoạt động',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'ten_danh_muc' => 'Bóng đá Quốc tế',
                'slug' => 'bong-da-quoc-te',
                'mo_ta' => 'Tin tức bóng đá trên toàn thế giới',
                'danh_muc_cha_id' => null,
                'trang_thai' => 'Hoạt động',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'ten_danh_muc' => 'Ngoại hạng Anh',
                'slug' => 'ngoai-hang-anh',
                'mo_ta' => 'Tin tức về giải Premier League',
                'danh_muc_cha_id' => null,
                'trang_thai' => 'Hoạt động',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'ten_danh_muc' => 'Champions League',
                'slug' => 'champions-league',
                'mo_ta' => 'Tin tức giải C1 châu Âu',
                'danh_muc_cha_id' => null,
                'trang_thai' => 'Hoạt động',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'ten_danh_muc' => 'Chuyển nhượng',
                'slug' => 'chuyen-nhuong',
                'mo_ta' => 'Tin tức chuyển nhượng cầu thủ và đội bóng',
                'danh_muc_cha_id' => null,
                'trang_thai' => 'Hoạt động',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'ten_danh_muc' => 'Phỏng vấn - Hậu trường',
                'slug' => 'phong-van-hau-truong',
                'mo_ta' => 'Hậu trường sân cỏ, phát biểu sau trận đấu',
                'danh_muc_cha_id' => null,
                'trang_thai' => 'Hoạt động',
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }
}
