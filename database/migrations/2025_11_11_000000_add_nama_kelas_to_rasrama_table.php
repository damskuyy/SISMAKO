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
        Schema::table('rasrama', function (Blueprint $table) {
            // Add nama and kelas columns if they don't exist yet
            if (!Schema::hasColumn('rasrama', 'nama')) {
                $table->string('nama')->nullable()->after('semester');
            }
            if (!Schema::hasColumn('rasrama', 'kelas')) {
                $table->string('kelas')->nullable()->after('tahun_ajaran');
            }
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('rasrama', function (Blueprint $table) {
            if (Schema::hasColumn('rasrama', 'nama')) {
                $table->dropColumn('nama');
            }
            if (Schema::hasColumn('rasrama', 'kelas')) {
                $table->dropColumn('kelas');
            }
        });
    }
};
