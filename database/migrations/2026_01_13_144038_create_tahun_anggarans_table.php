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
        Schema::create('tahun_anggarans', function (Blueprint $table) {
            $table->char('id', 36)->primary();
            $table->string('nama'); // Contoh: "Tahun Anggaran 2024"
            $table->date('mulai');
            $table->date('selesai');
            $table->boolean('aktif')->default(true);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tahun_anggarans');
    }
};
