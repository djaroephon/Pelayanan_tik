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
        Schema::create('teknisi_wilayah', function (Blueprint $table) {
            $table->id();
            $table->foreignId('teknisi_id')->constrained('teknisi')->onDelete('cascade');
            $table->foreignId('wilayah_teknisi_id')->constrained('wilayah_teknisi')->onDelete('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('teknisi_wilayah');
    }
};
