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
        Schema::create('doi_bongs', function (Blueprint $table) {
            $table->id();
            $table->string('ten');
            $table->unsignedBigInteger('giai_dau_id');
            $table->string('logo_url')->nullable();
            $table->dateTime('ngay_tao')->nullable();
            $table->dateTime('ngay_cap_nhat')->nullable();

            $table->foreign('giai_dau_id')->references('id')->on('giai_daus')->onDelete('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('doi_bongs');
    }
};
