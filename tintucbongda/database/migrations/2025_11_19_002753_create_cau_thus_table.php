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
        Schema::create('cau_thus', function (Blueprint $table) {
            $table->id();
            $table->string('ten');
            $table->unsignedBigInteger('doi_bong_id');
            $table->string('vi_tri');
            $table->integer('ao_so');
            $table->string('anh_url')->nullable();
            $table->date('ngay_sinh')->nullable();
            $table->string('quoc_tich')->nullable();
            $table->dateTime('ngay_tao')->nullable();
            $table->dateTime('ngay_cap_nhat')->nullable();

            $table->foreign('doi_bong_id')->references('id')->on('doi_bongs')->onDelete('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('cau_thus');
    }
};
