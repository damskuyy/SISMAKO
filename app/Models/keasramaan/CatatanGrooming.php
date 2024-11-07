<?php

namespace App\Models\keasramaan;

use App\Models\database\Guru;
use App\Models\database\Siswa;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CatatanGrooming extends Model
{
    use HasFactory;

    // Nama tabel yang terkait dengan model ini
    protected $table = 'catatan_grooming';

    // Kolom yang dapat diisi secara massal
    protected $fillable = [
        'tanggal',
        'date',
        'guru_piket_id',
        'siswa_id',
        'catatan',
    ];

    /**
     * Relasi dengan model Guru.
     * Menghubungkan 'guru_piket_id' dengan id di tabel guru.
     */
    public function guruPiket()
    {
        return $this->belongsTo(Guru::class, 'guru_piket_id');
    }

    /**
     * Relasi dengan model Siswa.
     * Menghubungkan 'siswa_id' dengan id di tabel siswa.
     */
    public function siswa()
    {
        return $this->belongsTo(Siswa::class, 'siswa_id');
    }
}
