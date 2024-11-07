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
        Schema::create('catatan_grooming', function (Blueprint $table) {
            $table->id();
            $table->date('tanggal');
            $table->unsignedBigInteger (column: 'guru_piket_id');
            $table->unsignedBigInteger ('siswa_id');
            $table->foreign(columns: 'guru_piket_id')->references('id')->on('guru')->cascadeOnDelete();
            $table->foreign('siswa_id')->references('id')->on('siswa')->cascadeOnDelete();
            $table->text('catatan');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('catatan_grooming');
    }
};
