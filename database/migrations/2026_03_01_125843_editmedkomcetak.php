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
        Schema::table('permohonan_det_med_kom_cetaks', function (Blueprint $table) {
            $table->date('tgl_mulai_publikasi')->nullable();
             $table->date('tgl_selesai_publikasi')->nullable();
            $table->integer('durasi_hari')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('permohonan_det_med_kom_cetaks', function (Blueprint $table) {
            $table->dropColumn('tgl_mulai_publikasi');
            $table->dropColumn('tgl_selesai_publikasi');
            $table->dropColumn('durasi_hari');
        });
    }
};
