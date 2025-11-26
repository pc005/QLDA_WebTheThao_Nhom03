<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Database\Eloquent\Relations\Relation; // Import lớp Relation

use Illuminate\Pagination\Paginator;



class AppServiceProvider extends ServiceProvider
{
    public function boot()
{
    Paginator::useBootstrapFive();
}

    /**
     * Register any application services.
     */
    public function register(): void
    {
        // === KHẮC PHỤC LỖI MORPH MAP (Dành cho chức năng yêu thích Đa hình) ===
        // Chúng ta ánh xạ tên ngắn (BaiViet, Video) thành tên Model đầy đủ.

        Relation::enforceMorphMap([
            'BaiViet' => \App\Models\BaiViet::class,
            'Video' => \App\Models\Video::class,
            'NguoiDung' => \App\Models\NguoiDung::class, // Thêm luôn User để đồng bộ
        ]);

        // Nếu bạn muốn hiển thị phân trang bằng Bootstrap:
        \Illuminate\Pagination\Paginator::useBootstrapFive();
    }

    /**
     * Bootstrap any application services.
     */

}
