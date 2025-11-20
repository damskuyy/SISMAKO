<?php

namespace App\Models\Finance;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Pemasukan extends Model
{
    use HasFactory;

    protected $table = 'pemasukans';
    protected $fillable = [
        'tanggal_pemasukan', 'jenis', 'nama', 'asal', 'nominal', 'keterangan'
    ];
    protected $casts = [
        'tanggal_pemasukan' => 'date',
    ];
}
