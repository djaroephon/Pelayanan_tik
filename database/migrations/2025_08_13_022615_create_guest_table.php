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
        Schema::create('guest', function (Blueprint $table) {
            $table->id();
            $table->string('nama_pelapor');
            $table->string('nik')->unique();
            $table->string('nip')->unique();
            $table->string('instansi');
            $table->string('surat_pernyataan_pengelola'); // Ubah dari file ke string
            $table->string('ktp'); // Ubah dari file ke string
            $table->string('password');
            $table->string('status')->default('pending');
            $table->rememberToken();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('guest');
    }
};
