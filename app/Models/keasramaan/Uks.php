<?php

namespace App\Models;

use App\Models\database\Guru;
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
    ];

    /**
     * Relasi dengan model Guru.
     * Menghubungkan 'guru_id' dengan id di tabel guru.
     */
    public function guru()
    {
        return $this->belongsTo(Guru::class);
    }
}
