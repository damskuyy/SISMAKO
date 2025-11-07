<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMapelsTable extends Migration
{
    public function up()
    {
        Schema::create('mapels', function (Blueprint $table) {
            $table->id();
            $table->string('tahun_ajaran');
            $table->string('kelas');
            $table->string('mapel');
            $table->string('kategori_kurikulum');
            $table->string('capaian_pembelajaran')->nullable();
            $table->string('tp_atp')->nullable();
            $table->string('kktp')->nullable();
            $table->string('kode_etik')->nullable();
            $table->string('ikrar_guru')->nullable();
            $table->string('tatib_guru')->nullable();
            $table->string('pembiasaan_guru')->nullable();
            $table->string('kaldik_sekolah')->nullable();
            $table->string('alokasi_waktu')->nullable();
            $table->string('program_tahunan')->nullable();
            $table->string('program_semester')->nullable();
            $table->string('jurnal_guru')->nullable();
            $table->string('daftar_hadir_siswa')->nullable();
            $table->string('daftar_nilai_siswa')->nullable();
            $table->string('penilaian_sikap')->nullable();
            $table->string('analisis_hasil_penilaian')->nullable();
            $table->string('program_remedial')->nullable();
            $table->string('jadwal_pelajaran')->nullable();
            $table->string('tugas_terstruktur')->nullable();
            $table->string('tugas_tidak_terstruktur')->nullable();
            $table->string('dedkg')->nullable();
            $table->string('ptlkg')->nullable();
            $table->string('rpp_1')->nullable();
            $table->string('pendukung_rpp_1')->nullable();
            $table->string('rpp_2')->nullable();
            $table->string('pendukung_rpp_2')->nullable();
            $table->string('rpp_3')->nullable();
            $table->string('pendukung_rpp_3')->nullable();
            $table->string('rpp_4')->nullable();
            $table->string('pendukung_rpp_4')->nullable();
            $table->string('rpp_5')->nullable();
            $table->string('pendukung_rpp_5')->nullable();
            $table->string('rpp_6')->nullable();
            $table->string('pendukung_rpp_6')->nullable();
            $table->string('rpp_7')->nullable();
            $table->string('pendukung_rpp_7')->nullable();
            $table->string('rpp_8')->nullable();
            $table->string('pendukung_rpp_8')->nullable();
            $table->string('rpp_9')->nullable();
            $table->string('pendukung_rpp_9')->nullable();
            $table->string('rpp_10')->nullable();
            $table->string('pendukung_rpp_10')->nullable();
            $table->string('rpp_11')->nullable();
            $table->string('pendukung_rpp_11')->nullable();
            $table->string('rpp_12')->nullable();
            $table->string('pendukung_rpp_12')->nullable();
            $table->string('rpp_13')->nullable();
            $table->string('pendukung_rpp_13')->nullable();
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('mapels');
    }
}
