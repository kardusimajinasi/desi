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
        Schema::table('tbl_layanan', function (Blueprint $table) {
            $table->renameColumn('layanan', 'nama')->change();
            $table->char('aktif');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('tbl_layanan', function (Blueprint $table) {
            $table->renameColumn('nama', 'layanan')->change();
            $table->dropColumn('aktif');
        });
    }
};
