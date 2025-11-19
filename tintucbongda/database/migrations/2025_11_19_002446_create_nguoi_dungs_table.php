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
        Schema::create('nguoi_dungs', function (Blueprint $table) {
            $table->id();
            $table->string('ho_ten', 100);
            $table->string('email', 100)->unique();
            $table->string('mat_khau', 255);
            $table->string('anh_dai_dien', 255)->nullable();
            $table->string('vai_tro', 50);
            $table->string('trang_thai', 20);
            $table->dateTime('ngay_tao')->nullable();
            $table->dateTime('ngay_cap_nhat')->nullable();
            $table->timestamps();

        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('nguoi_dungs');
    }
};
