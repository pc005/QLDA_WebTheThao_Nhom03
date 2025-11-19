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
        Schema::create('su_kien_tran_daus', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('tran_dau_id');
            $table->integer('phut');
            $table->unsignedBigInteger('cau_thu_id');
            $table->string('loai_su_kien');
            $table->dateTime('ngay_tao')->nullable();

            $table->foreign('tran_dau_id')->references('id')->on('tran_daus')->onDelete('cascade');
            $table->foreign('cau_thu_id')->references('id')->on('cau_thus')->onDelete('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('su_kien_tran_daus');
    }
};
