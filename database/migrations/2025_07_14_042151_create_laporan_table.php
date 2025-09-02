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
        Schema::create('laporan', function (Blueprint $table) {
            $table->id();
            $table->string('nama_pelapor', 100);
            $table->string('no_hp_pelapor', 15);
            $table->string('email_pelapor', 100);
            $table->string('instansi', 100);
            $table->string('bidang');
            $table->text('laporan_permasalahan');
            $table->foreignId('kategori_id')->constrained('kategori');
            $table->string('ip_jaringan', 40)->nullable();
            $table->string('ip_server', 40)->nullable();
            $table->timestamp('waktu_permasalahan');
            $table->enum('status', ['pending', 'on progress', 'complete'])->default('pending');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('laporan');
    }
};
