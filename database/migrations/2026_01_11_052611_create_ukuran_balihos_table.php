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
        Schema::create('ukuran_balihos', function (Blueprint $table) {
            $table->char('id', 36)->primary();
            $table->float('ukuran_panjang');
            $table->float('ukuran_lebar');
            $table->enum('layout', ['horizontal', 'vertical']);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('ukuran_balihos');
    }
};
