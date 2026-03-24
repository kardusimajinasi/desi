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
        Schema::create('permohonan_det_med_kom_cetaks', function (Blueprint $table) {
            $table->char('id', 36)->primary();
            $table->string('permohonan_id');
            $table->string('anggaran_id')->nullable(); 
            $table->string('kegiatan_id')->nullable();   
            $table->string('titik_baliho_id')->nullable();
            $table->string('isi_konten');
            $table->string('keterangan')->nullable();

            $table->decimal('panjang', 10, 2)->nullable();
            $table->decimal('lebar', 10, 2)->nullable();
            $table->integer('jumlah')->nullable()->default(1);
            $table->decimal('volume_hitung', 15, 2)->default(1); // Simpan hasil P x L x Jml
            $table->timestamps();

            $table->foreign('permohonan_id')->references('id')->on('permohonans')->onDelete('cascade');
            $table->foreign('titik_baliho_id')->references('id')->on('titik_balihos')->onDelete('set null');
            $table->foreign('anggaran_id')->references('id')->on('anggaran_belanjas')->onDelete('set null'); 
            $table->foreign('kegiatan_id')->references('id')->on('kegiatans')->onDelete('set null');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('permohonan_det_med_kom_cetaks');
    }
};
