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
        Schema::create('luot_thich_videos', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('video_id');
            $table->unsignedBigInteger('nguoi_dung_id');
            $table->dateTime('ngay_tao')->nullable();

            $table->foreign('video_id')->references('id')->on('videos')->onDelete('cascade');
            $table->foreign('nguoi_dung_id')->references('id')->on('nguoi_dungs')->onDelete('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('luot_thich_videos');
    }
};
