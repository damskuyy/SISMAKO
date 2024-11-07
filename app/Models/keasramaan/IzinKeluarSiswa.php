<?php

namespace App\Models\keasramaan;

use App\Models\database\Guru;
use App\Models\database\Siswa;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class IzinKeluarSiswa extends Model
{
    use HasFactory;

    protected $table = 'izin_keluar_siswa';

    protected $fillable = [
        'guru_id',
        'siswa_id',
        'alasan',
        'tanggal_keluar',
        'tanggal_kembali',
    ];

    public function guru()
    {
        return $this->belongsTo(Guru::class, 'guru_id');
    }


    public function siswa()
    {
        return $this->belongsTo(Siswa::class, 'siswa_id');
    }
}
