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
        Schema::create('laporan_teknisi', function (Blueprint $table) {
            $table->id();
            $table->foreignId('laporan_id')->constrained('laporan')->onDelete('cascade');
            $table->foreignId('teknisi_id')->constrained('teknisi')->onDelete('cascade');
            $table->text('deskripsi_masalah')->nullable();
            $table->text('deskripsi_penyelesaian')->nullable();
            $table->timestamp('selesai_pada')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('laporan_teknisi');
    }
};
