<?php

namespace App\Models\schoolwebsite;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SaranMasukan extends Model
{
    use HasFactory;
    protected $table = 'saran_masukan';
    protected $fillable = ['nama', 'email', 'status', 'pesan'];
}
