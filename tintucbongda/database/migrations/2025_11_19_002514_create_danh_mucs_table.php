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
        Schema::create('danh_mucs', function (Blueprint $table) {
            $table->id();
            $table->string('ten_danh_muc', 100);
            $table->string('slug', 255);
            $table->string('mo_ta', 255)->nullable();
            $table->unsignedBigInteger('danh_muc_cha_id')->nullable();
            $table->string('trang_thai', 20)->default('active'); // ← SỬA Ở ĐÂY
            $table->dateTime('ngay_tao')->nullable();
            $table->dateTime('ngay_cap_nhat')->nullable();

            $table->foreign('danh_muc_cha_id')
                ->references('id')
                ->on('danh_mucs')
                ->onDelete('set null');

            $table->timestamps();
        });

    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('danh_mucs');
    }
};
