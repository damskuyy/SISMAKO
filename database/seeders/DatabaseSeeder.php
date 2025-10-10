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
            ['url' => '/administrasi', 'password' => '140721'],
            ['url' => '/penilaian', 'password' => '140721'],
            ['url' => '/penilaian/rapor', 'password' => '140721'],
            ['url' => '/penilaian/rpts', 'password' => '140721'],
            ['url' => '/penilaian/rasrama', 'password' => '140721'],
            ['url' => '/penilaian/pts', 'password' => '140721'],
            ['url' => '/penilaian/pat', 'password' => '140721'],
            ['url' => '/penilaian/pas', 'password' => '140721'],
            ['url' => '/penilaian/panitia', 'password' => '140721'],
            ['url' => '/sarpras', 'password' => '140721'],
            ['url' => '/finance', 'password' => '140721'],
            ['url' => '/pkg', 'password' => '140721'],
            ['url' => '/sekolah-keasramaan', 'password' => '140721'],
            ['url' => '/jamaah', 'password' => '140721'],
            ['url' => '/patroli/asrama', 'password' => '140721'],
            ['url' => '/sekolah-keasramaan/akses-lab', 'password' => '140721'],
            // ['url' => '/sekolah-keasramaan/kunjungan/alumniOrtuTamu/edit/', 'password' => '140721'],
        ];

        foreach ($cards as $card) {
            Password::create([
                'url' => $card['url'],
                'password' => Hash::make($card['password']),
            ]);
        }
    }
}
