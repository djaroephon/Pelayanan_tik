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
        Schema::create('wilayah_teknisi', function (Blueprint $table) {
            $table->id();
            $table->string('nama_wilayah'); // Nama instansi dari API
            $table->string('nama_pic');   // Nama guest yang register
            $table->text('ip_address')->nullable(); // Bisa multiple IP, dipisah dengan koma
            $table->foreignId('guest_id')->constrained('guest')->onDelete('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('wilayah_teknisi');
    }
};
