<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('favorites', function (Blueprint $table) {
            $table->id();

            // 1. Khóa ngoại liên kết với bảng 'nguoi_dungs'
            $table->foreignId('nguoi_dung_id')
                ->constrained('nguoi_dungs')
                ->onDelete('cascade');

            // 2. Hai cột đa hình: favoritable_id và favoritable_type
            $table->morphs('favoritable'); // Tạo ra favoritable_id và favoritable_type

            $table->timestamps();

            // Đảm bảo mỗi người dùng chỉ thích một đối tượng (bài viết/video) một lần.
            $table->unique(['nguoi_dung_id', 'favoritable_id', 'favoritable_type'], 'user_favoritable_unique');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('favorites');
    }
};
