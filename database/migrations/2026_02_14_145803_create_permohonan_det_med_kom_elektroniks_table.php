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
        Schema::create('permohonan_det_med_kom_elektroniks', function (Blueprint $table) {
            $table->char('id', 36)->primary();
            $table->string('permohonan_id');
            
            // Kolom Spesifik Running Text
            $table->text('isi_konten'); // Pesan yang akan ditampilkan
            $table->date('tgl_mulai_publikasi');
            $table->date('tgl_selesai_publikasi');
            $table->integer('durasi_hari'); // Selisih tgl_mulai & tgl_selesai
            $table->decimal('volume_hitung', 15, 2)->default(1); // Simpan hasil P x L x Jml

            $table->string('anggaran_id')->nullable(); // Tambahkan nullable
            $table->string('kegiatan_id')->nullable();  // Tambahkan nullable

            // Kalkulasi Volume
            $table->timestamps();

            // Foreign Key
            
            $table->foreign('permohonan_id')->references('id')->on('permohonans')->onDelete('cascade');
            $table->foreign('anggaran_id')->references('id')->on('anggaran_belanjas')->onDelete('set null'); 
            $table->foreign('kegiatan_id')->references('id')->on('kegiatans')->onDelete('set null');
        
            });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('permohonan_det_med_kom_elektroniks');
    }
};
