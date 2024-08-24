<?php

namespace App\Models\penilaian;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class pat extends Model
{
    use HasFactory;
    protected $table = 'admpat';
    protected $fillable = ['tahun_ajaran', 'kelas', 'mapel', 'kisi_kisi', 'soal', 'jawaban', 'proker', 'kehadiran', 'ba', 'sk_panitia', 'tatib', 'surat_pemberitahuan', 'jadwal', 'daftar_nilai', 'tanda_terima_dan_penerimaan_soal', 'kehadiran_panitia'];

}
