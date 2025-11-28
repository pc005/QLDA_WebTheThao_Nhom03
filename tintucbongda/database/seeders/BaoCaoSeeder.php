<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class BaoCaoSeeder extends Seeder
{
    public function run(): void
    {
        DB::table('bao_caos')->insert([
            [
                'nguoi_dung_id' => 1,
                'doi_tuong' => 'bai_viet',
                'doi_tuong_id' => 1,
                'ly_do' => 'Nội dung phản cảm',
                'mo_ta' => 'Bài viết chứa hình ảnh không phù hợp với cộng đồng.',
                'trang_thai' => 'đang xử lý',
                'ngay_tao' => Carbon::now(),
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'nguoi_dung_id' => 2,
                'doi_tuong' => 'bai_viet',
                'doi_tuong_id' => 2,
                'ly_do' => 'Spam',
                'mo_ta' => 'Bình luận lặp lại nhiều lần, gây phiền toái.',
                'trang_thai' => 'đã xử lý',
                'ngay_tao' => Carbon::now()->subDay(),
                'created_at' => Carbon::now()->subDay(),
                'updated_at' => Carbon::now()->subDay(),
            ],
        ]);
    }
}
