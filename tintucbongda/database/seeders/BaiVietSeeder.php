<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use Carbon\Carbon;

class BaiVietSeeder extends Seeder
{
    public function run(): void
    {
        $data = [
            [
                'tieu_de' => 'Bài Viết 1',
                'noi_dung' => 'Nội dung bài viết 1',
            ],
            [
                'tieu_de' => 'Bài Viết 2',
                'noi_dung' => 'Nội dung bài viết 2',
            ],
            [
                'tieu_de' => 'Bài Viết 3',
                'noi_dung' => 'Nội dung bài viết 3',
            ],
        ];

        foreach ($data as $item) {
            DB::table('bai_viets')->insert([
                'tieu_de'       => $item['tieu_de'],
                'slug'          => Str::slug($item['tieu_de']),
                'tom_tat'       => null,
                'noi_dung'      => $item['noi_dung'],
                'anh_dai_dien'  => null,
                'video_url'     => null,
                'nguoi_dung_id' => 1,      // tồn tại
                'danh_muc_id'   => 1,      // BẮT BUỘC → phải có bản ghi danh_mucs id = 1
                'trang_thai'    => 'active',
                'noi_bat'       => false,
                'ngay_tao'      => Carbon::now(),
                'ngay_cap_nhat' => Carbon::now(),
                'created_at'    => Carbon::now(),
                'updated_at'    => Carbon::now(),
            ]);
        }
    }
}
