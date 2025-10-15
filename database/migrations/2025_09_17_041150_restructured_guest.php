<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::table('guest', function (Blueprint $table) {
            $table->string('no_hp', 20)->nullable()->after('nip');
        });

        DB::table('guest')
            ->whereNull('no_hp')
            ->orWhere('no_hp', '')
            ->update(['no_hp' => DB::raw("CONCAT('temp-', id, '-', UNIX_TIMESTAMP())")]);

        Schema::table('guest', function (Blueprint $table) {
            $table->string('no_hp', 20)->unique()->change();
        });

    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('guest', function (Blueprint $table) {
            $table->dropUnique(['no_hp']);

            // Hapus kolom
            $table->dropColumn('no_hp');
        });
    }
};
