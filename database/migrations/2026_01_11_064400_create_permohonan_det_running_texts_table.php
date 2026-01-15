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
        Schema::create('permohonan_det_running_texts', function (Blueprint $table) {
            $table->char('id', 36)->primary();
            $table->string('permohonan_id');
            
            // Kolom Spesifik Running Text
            $table->text('isi_konten'); // Pesan yang akan ditampilkan
            $table->date('tgl_mulai_publikasi');
            $table->date('tgl_selesai_publikasi');
            $table->integer('durasi_hari'); // Selisih tgl_mulai & tgl_selesai
            
            // Kalkulasi Volume
            $table->timestamps();

            // Foreign Key
            $table->foreign('permohonan_id')->references('id')->on('permohonans')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('permohonan_det_running_texts');
    }
};
