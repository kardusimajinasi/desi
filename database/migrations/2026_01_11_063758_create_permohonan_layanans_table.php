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
        Schema::create('permohonan_layanans', function (Blueprint $table) {
            $table->char('id', 36)->primary();
            $table->string('kegiatan_id');
            $table->string('permohonan_id');
            $table->timestamps();

            $table->foreign('kegiatan_id')->references('id')->on('kegiatans');
            $table->foreign('permohonan_id')->references('id')->on('permohonans');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('permohonan_layanans');
    }
};
