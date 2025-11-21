<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class VideoSeeder extends Seeder

{



    public function run(): void
    {
        DB::table('videos')->insert([
            [
                'tieu_de' => 'Video Bóng Đá Hay Nhất',
                'url' => '<iframe width="560" height="315" src="https://www.youtube.com/embed/JsYkWfqQhwM?si=TnvM_50_KinOXUoL" title="YouTube video player" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share" referrerpolicy="strict-origin-when-cross-origin" allowfullscreen></iframe>',
                'bai_viet_id' => 1,
                'nguoi_dung_id' => 1,
                'trang_thai' => 'active',
                'ngay_tao' => Carbon::now(),
                'ngay_cap_nhat' => Carbon::now(),
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'tieu_de' => 'Highlights Giải Ngoại Hạng Anh',
                'url' => '<iframe width="560" height="315" src="https://www.youtube.com/embed/PzNZgR1J3fA?si=ltlx-UTMjNGZY6rO" title="YouTube video player" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share" referrerpolicy="strict-origin-when-cross-origin" allowfullscreen></iframe>',
                'bai_viet_id' => 2,
                'nguoi_dung_id' => 2,
                'trang_thai' => 'active',
                'ngay_tao' => Carbon::now(),
                'ngay_cap_nhat' => Carbon::now(),
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'tieu_de' => 'Kỹ Thuật Thủ Môn Siêu Đỉnh',
                'url' => '<iframe width="560" height="315" src="https://www.youtube.com/embed/aqSUtgpimO0?si=G46_q3hXqOMX623H" title="YouTube video player" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share" referrerpolicy="strict-origin-when-cross-origin" allowfullscreen></iframe>',
                'bai_viet_id' => 3,
                'nguoi_dung_id' => 1,
                'trang_thai' => 'active',
                'ngay_tao' => Carbon::now(),
                'ngay_cap_nhat' => Carbon::now(),
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
        ]);
    }
}
