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
        Schema::create('visiting', function (Blueprint $table) {
            $table->id();
            $table->string('nama', 100);
            $table->string('asal')->nullable();
            $table->string('tujuan')->nullable();
            $table->text('keterangan');
            $table->string('no_hp', 50);
            $table->string('nama_instansi', 100)->nullable();
            $table->string('jabatan', 100)->nullable();
            $table->time('start')->nullable();
            $table->time('end')->nullable();
            $table->enum('status_kunjungan', ['Dinas', 'Tamu', 'Ortu', 'Alumni', 'Industri']);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('visiting');
    }
};
