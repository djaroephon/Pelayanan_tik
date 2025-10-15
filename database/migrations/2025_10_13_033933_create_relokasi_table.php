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
        Schema::create('relokasi', function (Blueprint $table) {
            $table->id();
            $table->foreignId('guest_id')->constrained('guest')->onDelete('cascade');
            $table->string('nama_pemohon');
            $table->string('nip');
            $table->string('instansi');
            $table->enum('jenis_relokasi', ['jaringan', 'lainnya']);
            $table->string('nama_alat_jaringan')->nullable();
            $table->text('keterangan')->nullable();
            $table->string('ip_address')->nullable();
            $table->string('instansi_awal');
            $table->string('koordinat_awal');
            $table->string('instansi_tujuan');
            $table->string('koordinat_tujuan');
            $table->string('surat_bukti_izin_relokasi'); // path file
            $table->enum('status', ['pending', 'on progress', 'complete'])->default('pending');
            $table->text('keterangan_admin')->nullable();
            $table->foreignId('teknisi_id')->nullable()->constrained('teknisi')->onDelete('set null');
            $table->foreignId('penjab_id')->nullable()->constrained('penjab_layanan')->onDelete('set null');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('relokasi');
    }
};
