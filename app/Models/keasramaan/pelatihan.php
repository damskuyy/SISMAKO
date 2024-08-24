<?php

namespace App\Models\keasramaan;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class pelatihan extends Model
{
    use HasFactory;

    protected $table = 'pelatihan';

    protected $fillable = [
        'tanggal',
        'siswa_id',
        'kegiatan',
        'keterangan',
        'undangan',
        'dokumentasi',
        'type',
    ];

    public function siswa()
    {
        // return $this->belongsTo(Siswa::class);
    }
}
