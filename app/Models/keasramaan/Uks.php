<?php

namespace App\Models\keasramaan;

use App\Models\database\Guru;
use App\Models\database\Siswa;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Uks extends Model
{
    use HasFactory;

    // Nama tabel yang terkait dengan model ini
    protected $table = 'uks';

    // Kolom yang dapat diisi secara massal
    protected $fillable = [
        'tanggal',
        'nama',
        'status',
        'keluhan',
        'penanganan',
        'guru_id',
        'siswa_id'
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
