<?php

namespace App\Models\penilaian;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class pas extends Model
{
    use HasFactory;
    protected $table = 'admin';
    protected $fillable = [
        'tahun_ajaran',
        'kelas',
        'mapel',
        'kisi_kisi',
        'soal',
        'jawaban',
        'proker',
        'kehadiran',
        'ba',
        'sk_panitia',
        'tatib_pengawas',
        'tatib_peserta',
        'keterangan',
        'surat_pemberitahuan_guru',
        'surat_pemberitahuan_ortu',
        'jadwal',
        'daftar_nilai',
        'tanda_terima_dan_penerimaan_soal',
        'denah_ruangan',
        'denah_duduk',
        'type',
        'kehadiran_panitia',
    ];
}
