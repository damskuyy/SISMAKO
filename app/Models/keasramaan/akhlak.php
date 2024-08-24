<?php

namespace App\Models\keasramaan;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class akhlak extends Model
{
    use HasFactory;
    protected $table = 'akhlak';
    protected $fillable = [
        'tanggal',
        'kelas',
        'materi',
        'type',
        'nisn',
    ];
}
