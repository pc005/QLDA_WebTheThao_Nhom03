<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class NguoiDungSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('nguoi_dungs')->insert([
            [
                'ho_ten' => 'Admin Hệ Thống',
                'email' => 'admin@example.com',
                'mat_khau' => Hash::make('123456'),
                'anh_dai_dien' => null,
                'vai_tro' => 'Admin',
                'trang_thai' => 'Hoạt động',
                'ngay_tao' => now(),
                'ngay_cap_nhat' => now(),
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'ho_ten' => 'Biên Tập Viên',
                'email' => 'btv@example.com',
                'mat_khau' => Hash::make('123456'),
                'anh_dai_dien' => null,
                'vai_tro' => 'BTV',
                'trang_thai' => 'Hoạt động',
                'ngay_tao' => now(),    
                'ngay_cap_nhat' => now(),
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'ho_ten' => 'Người Dùng Test',
                'email' => 'user@example.com',
                'mat_khau' => Hash::make('123456'),
                'anh_dai_dien' => null,
                'vai_tro' => 'Người dùng',
                'trang_thai' => 'Hoạt động',
                'ngay_tao' => now(),
                'ngay_cap_nhat' => now(),
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }
}
