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
        Schema::create('tran_daus', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('giai_dau_id');
            $table->unsignedBigInteger('doi_nha_id');
            $table->unsignedBigInteger('doi_khach_id');
            $table->dateTime('thoi_gian')->nullable();
            $table->integer('ti_so_nha')->nullable();
            $table->integer('ti_so_khach')->nullable();
            $table->string('trang_thai')->nullable();
            $table->dateTime('ngay_tao')->nullable();
            $table->dateTime('ngay_cap_nhat')->nullable();

            $table->foreign('giai_dau_id')->references('id')->on('giai_daus')->onDelete('cascade');
            $table->foreign('doi_nha_id')->references('id')->on('doi_bongs')->onDelete('cascade');
            $table->foreign('doi_khach_id')->references('id')->on('doi_bongs')->onDelete('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tran_daus');
    }
};
