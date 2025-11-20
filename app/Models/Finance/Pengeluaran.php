<?php

namespace App\Models\Finance;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Pengeluaran extends Model
{
    use HasFactory;

    protected $table = 'pengeluarans';
    protected $fillable = [
        'tanggal_pengeluaran', 'jenis', 'nama', 'nominal', 'keterangan', 'sarpras_id', 'sarpras_type'
    ];
    protected $casts = [
        'tanggal_pengeluaran' => 'date',
    ];
}
