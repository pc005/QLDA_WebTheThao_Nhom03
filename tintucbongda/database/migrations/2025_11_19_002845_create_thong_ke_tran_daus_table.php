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
        Schema::create('thong_ke_tran_daus', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('tran_dau_id');
            $table->string('loai_thong_ke');
            $table->unsignedBigInteger('doi_bong_id');
            $table->integer('gia_tri');

            $table->foreign('tran_dau_id')->references('id')->on('tran_daus')->onDelete('cascade');
            $table->foreign('doi_bong_id')->references('id')->on('doi_bongs')->onDelete('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('thong_ke_tran_daus');
    }
};
