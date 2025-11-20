<?php

namespace App\Models\Finance;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Pengajuan extends Model
{
    use HasFactory;

    protected $table = 'pengajuans';
    protected $fillable = [
        'surat_id', 'guru_id', 'foto_lpj', 'tanggal_pengajuan', 'deskripsi', 'nominal', 'keterangan'
    ];
    protected $casts = [
        'tanggal_pengajuan' => 'date',
    ];

    public function guru()
    {
        return $this->belongsTo(\App\Models\database\Guru::class, 'guru_id');
    }
}
