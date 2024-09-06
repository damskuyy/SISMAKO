<?php

namespace Database\Seeders;

use App\Models\Password;
use Illuminate\Database\Seeder;

class PasswordSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Password::create([
            'password' => bcrypt('12345'), // Menggunakan bcrypt untuk enkripsi password
        ]);
    }
}
