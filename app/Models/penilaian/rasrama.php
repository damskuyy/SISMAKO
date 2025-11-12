<?php

namespace App\Models\penilaian;

use App\Models\database\DataKelas;
use App\Models\database\Siswa;
use App\Models\keasramaan\JamaahSiswa;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class rasrama extends Model
{
    use HasFactory;

    protected $table = 'rasrama';

    protected $fillable = [
        'tahun_ajaran',
        'kelas',
        'nama',
        'semester',
        'released',
        'wname',
        'nik',
        'keterangan',
        'tahfidz',
        'tahsin',
        'amaliyyah',
        'ubudiyyah',
        'mapel',
        'data_siswa',
        'pengembangan_diri',
        'sertifikat',
        'start_date',
        'end_date',
    ];
    protected $casts = [
        'tahfidz' => 'array',
        'tahsin' => 'array',
        'amaliyyah' => 'array',
        'ubudiyyah' => 'array',
        'mapel' => 'array',
        'data_siswa' => 'array',
        'pengembangan_diri' => 'array',
        'sertifikat' => 'array',
    ];

    // // Relasi ke model Siswa
    public function siswa()
    {
        return $this->belongsTo(Siswa::class, 'siswa_id');
    }

    // // Relasi ke model Jamaah untuk ubudiyyah
    // public function ubudiyyah()
    // {
    //     return $this->belongsTo(JamaahSiswa::class, 'ubudiyyah_id');
    // }
}
