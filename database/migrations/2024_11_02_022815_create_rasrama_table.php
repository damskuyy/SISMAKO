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
        Schema::create('rasrama', function (Blueprint $table) {
            $table->id();
            $table->string('tahun_ajaran', 9);

            // Kolom yang berelasi ke tabel siswa
            // $table->string('siswa_id');
            $table->unsignedBigInteger('siswa_id',);
            $table->foreign('siswa_id')->references('id')->on('siswa')->cascadeOnDelete();
            // $table->string('kelas');


            $table->string('semester');

            // Kolom yang berelasi ke tabel jamaah untuk ubudiyyah
            $table->json('ubudiyyah')->nullable();
            // $table->foreign('ubudiyyah_id')->references('id')->on('jamaah_siswa')->cascadeOnDelete();

            // Signature
            $table->string('released')->nullable();
            $table->string('wname', 100)->nullable();
            $table->string('nik', 50)->nullable();
            $table->string('keterangan', 20)->nullable();

            $table->json('tahfidz')->nullable();
            $table->json('tahsin')->nullable();
            $table->json('amaliyyah')->nullable();
            $table->json('mapel')->nullable();
            $table->json('data_siswa')->nullable();
            $table->json('pengembangan_diri')->nullable();
            $table->json('sertifikat')->nullable();

            // Date
            $table->date('start_date')->nullable();
            $table->date('end_date')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('rasrama');
    }
};
