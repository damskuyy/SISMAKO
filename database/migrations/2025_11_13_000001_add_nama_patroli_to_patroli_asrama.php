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
        Schema::table('patroli_asrama', function (Blueprint $table) {
            if (!Schema::hasColumn('patroli_asrama', 'nama_patroli')) {
                $table->string('nama_patroli', 100)->nullable()->after('status_patroli');
            }
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('patroli_asrama', function (Blueprint $table) {
            if (Schema::hasColumn('patroli_asrama', 'nama_patroli')) {
                $table->dropColumn('nama_patroli');
            }
        });
    }
};
