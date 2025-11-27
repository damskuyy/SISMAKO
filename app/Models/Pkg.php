<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pkg extends Model
{
    use HasFactory;

    protected $table = 'pkgs';

    protected $fillable = [
        'id_guru','id_tendik','nama','nip','mapel','jabatan','periode_penilaian',
        'penilai_id_guru','penilai_id_tendik','penilai_nama','penilai_nip','penilai_jabatan',
        'kompetensi_pedagogik','kompetensi_kepribadian','kompetensi_profesional','kompetensi_sosial','kompetensi_keterangan',
        'praktik_kinerja','praktik_keterangan','perilaku_kerja','perilaku_keterangan','predikat_kinerja','predikat_keterangan',
        'kekuatan_guru','area_peningkatan','rekomendasi_tingkat_lanjut','foto_dokumentasi_kegiatan','status_pengiriman'
    ];

    protected $casts = [
        'kompetensi_pedagogik' => 'integer',
        'kompetensi_kepribadian' => 'integer',
        'kompetensi_profesional' => 'integer',
        'kompetensi_sosial' => 'integer',
    ];
}
