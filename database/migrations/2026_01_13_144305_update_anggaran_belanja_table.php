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
        Schema::table('anggaran_belanjas', function (Blueprint $table) {
            $table->string('tahun_anggaran_id')->after('id')->nullable();
            $table->renameColumn('layanan_id', 'kegiatan_id');
            $table->foreign('tahun_anggaran_id')->references('id')->on('tahun_anggarans');
            $table->foreign('kegiatan_id')->references('id')->on('kegiatans');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('anggaran_belanjas', function (Blueprint $table) {
            $table->dropForeign(['tahun_anggaran_id']);
            $table->dropForeign(['kegiatan_id']);
            $table->dropColumn('tahun_anggaran_id');
            $table->renameColumn('kegiatan_id', 'layanan_id');
        });
    }
};
