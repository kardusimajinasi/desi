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
        Schema::create('titik_balihos', function (Blueprint $table) {
            $table->char('id', 36)->primary();
            $table->string('nama');
            $table->string('alamat');
            $table->string('titik_lokasi');
            $table->string('foto_baliho')->nullable();
            $table->string('ukuran_baliho_id');
            $table->timestamps();

            $table->foreign('ukuran_baliho_id')->references('id')->on('ukuran_balihos');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('titik_balihos');
    }
};
