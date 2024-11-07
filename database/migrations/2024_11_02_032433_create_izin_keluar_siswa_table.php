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
        Schema::create('izin_keluar_siswa', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger ('guru_id');
            $table->unsignedBigInteger ('siswa_id');
            $table->text('alasan');
            $table->timestamp(column: 'tanggal_keluar');
            $table->timestamp(column: 'tanggal_kembali');
            $table->foreign(columns: 'guru_id')->references('id')->on('guru')->cascadeOnDelete();
            $table->foreign('siswa_id')->references('id')->on('siswa')->cascadeOnDelete();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('izin_keluar_siswa');
    }
};
