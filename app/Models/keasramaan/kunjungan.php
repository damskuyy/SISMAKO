<?php

namespace App\Models\keasramaan;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Kunjungan extends Model
{
    use HasFactory;
    protected $table = 'visiting';
    protected $fillable = [
        'nama',
        'asal',
        'tujuan',
        'keterangan',
        'no_hp',
        'nama_instansi',
        'jabatan',
        'start',
        'end',
        'status_kunjungan',
    ];
    protected $casts = [
        'status_kunjungan' => 'string',
    ];
}
