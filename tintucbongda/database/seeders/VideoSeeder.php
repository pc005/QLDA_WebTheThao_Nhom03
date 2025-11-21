<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class VideoSeeder extends Seeder
{
    public function run()
    {
        DB::table('videos')->insert([
            [
                'tieu_de' => 'Hướng dẫn sử dụng dịch vụ',
                'url' => '<iframe width="560" height="315" src="https://www.youtube.com/embed/86X3OenaQsU?si=sgHudzzqK7T3oEr4" title="YouTube video player" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share" referrerpolicy="strict-origin-when-cross-origin" allowfullscreen></iframe>',
                'bai_viet_id' => 2,
                'nguoi_dung_id' => 2,
                'trang_thai' => 'Chờ duyệt',
                'ngay_tao' => '2025-11-03 09:30:00',
                'ngay_cap_nhat' => '2025-11-04 15:00:00',
                'created_at' => Carbon::create(2025, 11, 20, 13, 4, 1),
                'updated_at' => Carbon::create(2025, 11, 20, 13, 4, 1),
            ],
            [
                'tieu_de' => 'Quảng cáo sự kiện đặc biệt',
                'url' => '<iframe width="560" height="315" src="https://www.youtube.com/embed/86X3OenaQsU?si=sgHudzzqK7T3oEr4" title="YouTube video player" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share" referrerpolicy="strict-origin-when-cross-origin" allowfullscreen></iframe>',
                'bai_viet_id' => 3,
                'nguoi_dung_id' => 2,
                'trang_thai' => 'Đã duyệt',
                'ngay_tao' => '2025-11-05 14:00:00',
                'ngay_cap_nhat' => '2025-11-06 16:30:00',
                'created_at' => Carbon::create(2025, 11, 20, 13, 4, 1),
                'updated_at' => Carbon::create(2025, 11, 20, 13, 4, 1),
            ],
        ]);
    }
}
