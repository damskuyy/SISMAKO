<?php

namespace App\Models\keasramaan;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class sertifikat extends Model
{
    use HasFactory;
    protected $table = 'sertifikat';
    protected $fillable = [
        'tanggal',
        'kelas',
        'nama',
        'nisn',
        'juz_30',
        'juz_29',
        'juz_28',
        'juz_umum',
    ];
}
