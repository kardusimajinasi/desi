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
        Schema::create('permohonan_det_spanduks', function (Blueprint $table) {
            $table->char('id', 36)->primary();
            $table->string('permohonan_id');
            $table->string('anggaran_id'); // Relasi ke anggaran_belanja
            $table->string('jenis_spanduk_id');
            $table->string('isi_konten');
            $table->string('keterangan')->nullable();

            $table->decimal('panjang', 10, 2);
            $table->decimal('lebar', 10, 2);
            $table->integer('jumlah');
            $table->decimal('volume_hitung', 15, 2); // Simpan hasil P x L x Jml
            $table->timestamps();

            $table->foreign('jenis_spanduk_id')->references('id')->on('jenis_spanduks');
            $table->foreign('permohonan_id')->references('id')->on('permohonans')->onDelete('cascade');
            $table->foreign('anggaran_id')->references('id')->on('anggaran_belanjas');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('permohonan_det_spanduks');
    }
};
