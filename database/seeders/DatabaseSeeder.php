<?php

namespace Database\Seeders;

use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use App\Models\Password;
class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $cards = [
            ['url' => '/database', 'password' => '140721'],
            ['url' => '/korespondensi', 'password' => '140721'],
            ['url' => '/administrasi', 'password' => 'bazma1992'],
            ['url' => '/penilaian', 'password' => 'bazma1992'],
            ['url' => '/sarpras', 'password' => 'bazma1992'],
            ['url' => '/finance', 'password' => 'bazma1992'],
            ['url' => '/pkg', 'password' => '190924'],
            ['url' => '/jamaah', 'password' => '170845'],
            ['url' => '/patroli/asrama', 'password' => '170845'],
            ['url' => '/sekolah-keasramaan/akses-lab', 'password' => '170845'],
        ];

        foreach ($cards as $card) {
            Password::create([
                'url' => $card['url'],
                'password' => Hash::make($card['password']),
            ]);
        }
    }
}
