<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('pkgs', function (Blueprint $table) {
            $table->id();

            // Identitas guru yang dinilai
            $table->unsignedBigInteger('id_guru')->nullable();
            $table->unsignedBigInteger('id_tendik')->nullable();
            $table->string('nama');
            $table->string('nip')->nullable();
            $table->string('mapel')->nullable();
            $table->string('jabatan')->nullable();
            $table->string('periode_penilaian')->nullable();

            // Identitas penilai
            $table->unsignedBigInteger('penilai_id_guru')->nullable();
            $table->unsignedBigInteger('penilai_id_tendik')->nullable();
            $table->string('penilai_nama')->nullable();
            $table->string('penilai_nip')->nullable();
            $table->string('penilai_jabatan')->nullable();

            // Kompetensi utama
            $table->tinyInteger('kompetensi_pedagogik')->nullable();
            $table->tinyInteger('kompetensi_kepribadian')->nullable();
            $table->tinyInteger('kompetensi_profesional')->nullable();
            $table->tinyInteger('kompetensi_sosial')->nullable();
            $table->text('kompetensi_keterangan')->nullable();

            // Pelaksanaan praktik
            $table->string('praktik_kinerja')->nullable();
            $table->text('praktik_keterangan')->nullable();
            $table->string('perilaku_kerja')->nullable();
            $table->text('perilaku_keterangan')->nullable();
            $table->string('predikat_kinerja')->nullable();
            $table->text('predikat_keterangan')->nullable();

            // Kesimpulan & rekomendasi
            $table->text('kekuatan_guru')->nullable();
            $table->text('area_peningkatan')->nullable();
            $table->text('rekomendasi_tingkat_lanjut')->nullable();
            $table->string('foto_dokumentasi_kegiatan')->nullable();

            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('pkgs');
    }
};
