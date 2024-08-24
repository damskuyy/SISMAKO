<?php

namespace App\Models\keasramaan;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class tahfidz extends Model
{
    use HasFactory;
    protected $table = 'tahfidz';
    protected $fillable = [
        'tanggal',
        'kelas',
        'nama',
        'nisn',
        'surat',
        'ayat',
        'predikat',
        'pengajar',
    ];
}
