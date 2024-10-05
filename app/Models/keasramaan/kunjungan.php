<?php

namespace App\Models\keasramaan;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Kunjungan extends Model
{
    use HasFactory;
    protected $table = 'kunjungan';
    protected $fillable = [
        'nama',
        'asal',
        'tujuan',
        'keterangan',
        'no_hp',
        'nama_instansi',
        'jabatan',
        'status_kunjungan',
    ];
    protected $casts = [
        'status_kunjungan' => 'string',
    ];
}
