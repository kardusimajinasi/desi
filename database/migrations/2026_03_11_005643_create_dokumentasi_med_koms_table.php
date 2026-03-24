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
        Schema::create('documentations', function (Blueprint $table) {
            $table->char('id', 36)->primary();
            $table->uuidMorphs('dokumentasiable'); // Polymorphic relation
            
            $table->string('nama')->nullable(); // Nama dokumentasi
            $table->date('tanggal_dokumentasi'); // Tanggal
            $table->string('lokasi_file'); // Path file/gambar
            
            $table->enum('jenis', ['Desain', 'Publikasi', 'Pelepasan']);
            $table->timestamps();
    });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('documentations');
    }
};
