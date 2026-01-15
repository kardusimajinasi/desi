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
        Schema::create('permohonans', function (Blueprint $table) {
            $table->char('id', 36)->primary();
            $table->string('instansi_id');
            $table->string('perihal');
            $table->text('isi_ringkas');
            $table->char('dengan_surat', 1); // 'Y' atau 'N'
            $table->string('no_surat')->nullable();
            $table->date('tanggal_surat')->nullable();
            $table->string('file_surat')->nullable();
            $table->string('nama_narahubung');
            $table->string('kontak_narahubung');
            $table->timestamps();

            $table->foreign('instansi_id')->references('id')->on('tbl_instansi');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('permohonans');
    }
};
