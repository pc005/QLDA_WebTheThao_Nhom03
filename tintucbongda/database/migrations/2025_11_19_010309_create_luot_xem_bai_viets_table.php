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
        Schema::create('luot_xem_bai_viets', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('bai_viet_id');
            $table->unsignedBigInteger('nguoi_dung_id')->nullable();
            $table->string('ip')->nullable();
            $table->dateTime('ngay_tao')->nullable();

            $table->foreign('bai_viet_id')->references('id')->on('bai_viets')->onDelete('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('luot_xem_bai_viets');
    }
};
