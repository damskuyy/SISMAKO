<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Password extends Model
{
    use HasFactory;
    protected $table = 'password';
    protected $fillable = ['password'];
    protected static function boot()
    {
        parent::boot();

        static::creating(function ($password) {
            if (empty($password->password)) {
                $password->password = bcrypt('12345'); // Default password
            }
        });
    }
}
