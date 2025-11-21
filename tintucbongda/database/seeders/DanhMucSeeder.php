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
                'created_at' => now(),
                'updated_at' => now(),
            ]
        ]);
    }
}
