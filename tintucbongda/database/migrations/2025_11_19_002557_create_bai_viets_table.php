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
        Schema::create('bai_viets', function (Blueprint $table) {
            $table->id();
            $table->string('tieu_de', 255);
            $table->string('slug', 255);
            $table->text('tom_tat')->nullable();
            $table->text('noi_dung')->nullable();
            $table->string('anh_dai_dien', 255)->nullable();
            $table->string('video_url', 255)->nullable();
            $table->unsignedBigInteger('nguoi_dung_id');
            $table->unsignedBigInteger('danh_muc_id');
            $table->string('trang_thai', 20);
            $table->boolean('noi_bat')->default(false);
            $table->dateTime('ngay_tao')->nullable();
            $table->dateTime('ngay_cap_nhat')->nullable();

            $table->foreign('nguoi_dung_id')->references('id')->on('nguoi_dungs')->onDelete('cascade');
            $table->foreign('danh_muc_id')->references('id')->on('danh_mucs')->onDelete('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('bai_viets');
    }
};
