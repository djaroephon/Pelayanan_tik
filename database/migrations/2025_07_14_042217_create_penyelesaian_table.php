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
        Schema::create('penyelesaian', function (Blueprint $table) {
            $table->id();
            $table->foreignId('laporan_id')->constrained('laporan')->onDelete('cascade');
            $table->foreignId('penjab_layanan_id')->constrained('penjab_layanan')->onDelete('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('penyelesaian');
    }
};
