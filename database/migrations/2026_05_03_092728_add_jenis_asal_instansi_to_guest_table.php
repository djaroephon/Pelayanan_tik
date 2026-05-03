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
        Schema::table('guest', function (Blueprint $table) {
            $table->string('jenis_instansi')->nullable()->after('instansi');
            $table->string('asal_instansi')->nullable()->after('jenis_instansi');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('guest', function (Blueprint $table) {
            $table->dropColumn(['jenis_instansi', 'asal_instansi']);
        });
    }
};
