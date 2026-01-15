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
        Schema::create('kegiatans', function (Blueprint $table) {
            $table->char('id', 36)->primary();
            $table->string('nama');
            $table->string('layanan_id');
            $table->char('dengan_anggaran', 1);
            $table->char('aktif', 1);
            $table->timestamps();

            $table->foreign('layanan_id')->references('id')->on('tbl_layanan');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('kegiatans');
    }
};
