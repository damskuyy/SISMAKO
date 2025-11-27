@extends('layouts.app')

@section('content')
<link rel="stylesheet" href="{{ asset('dist/css/style.css') }}">

<div class="createdby-page">
    <header class="createdby-header">
        <div class="createdby-header-content">
            <h1 class="createdby-title animate-fade-in">SISMAKO</h1>
            <div class="createdby-subtitle-wrapper animate-slide-up">
                <h2 class="createdby-subtitle"><b>Sistem Manajemen Sekolah</b></h2>
                <p class="createdby-desc">Sistem integrasi data dan administrasi sekolah otomatis.</p>
            </div>
        </div>
    </header>
    
    <div class="createdby-content">
        @php
            $data = [
                ['name' => 'Ahmad Dahlan, S.Ag', 'role' => 'Kepala SMK TI BAZMA (Inisiator & Pembuat Skema Alur Kerja)', 'img' => 'https://wallpapercave.com/uwpt/uwp4911571.jpeg'],
                ['name' => 'I Gde Bayu Priyambada M. S.Kom', 'role' => 'Guru IT 2023-2024', 'img' => 'https://wallpapercave.com/uwpt/uwp4911572.jpeg'],
                ['name' => 'Fadhil Rabbani', 'role' => 'Angkatan II SMK TI BAZMA', 'img' => 'https://wallpapercave.com/uwpt/uwp4911563.jpeg'],
                ['name' => 'Mufiz Ihsanulhaq', 'role' => 'Angkatan II SMK TI BAZMA', 'img' => 'https://wallpapercave.com/uwpt/uwp4911568.jpeg'],
                ['name' => 'Attar Rifai', 'role' => 'Angkatan II SMK TI BAZMA', 'img' => 'https://wallpapercave.com/uwpt/uwp4911561.jpeg'],
                ['name' => 'Muhammad Abdullah Al-Aziz', 'role' => 'Angkatan II SMK TI BAZMA', 'img' => 'https://wallpapercave.com/uwpt/uwp4911562.jpeg'],
                ['name' => 'Muhammad Saeful Romadhon', 'role' => 'Angkatan II SMK TI BAZMA', 'img' => 'https://wallpapercave.com/uwpt/uwp4911569.jpeg'],
                ['name' => 'Gemi Widodo', 'role' => 'Angkatan II SMK TI BAZMA', 'img' => 'https://wallpapercave.com/uwpt/uwp4911560.jpeg'],
                ['name' => 'Hafith Muhammad Fauzan', 'role' => 'Angkatan II SMK TI BAZMA', 'img' => 'https://wallpapercave.com/uwpt/uwp4911565.jpeg'],
                ['name' => 'Syahban Syahputra', 'role' => 'Angkatan II SMK TI BAZMA', 'img' => 'https://wallpapercave.com/uwp/uwp4911573.jpeg'],
                ['name' => 'Hanif Gibran Syidiq', 'role' => 'Angkatan II SMK TI BAZMA', 'img' => 'https://wallpapercave.com/uwpt/uwp4911564.jpeg'],
                ['name' => 'Damar Nugroho Utomo', 'role' => 'Angkatan XXIV SMKN 1 Cibinong', 'img' => 'https://wallpapercave.com/uwpt/uwp4913182.jpeg'],
                ['name' => 'Rizki Zikrillah', 'role' => 'Angkatan XXIV SMKN 1 Cibinon', 'img' => 'https://wallpapercave.com/uwpt/uwp4930345.jpeg'],
            ];
        @endphp
        
        <div class="createdby-grid-container">
            @foreach ($data as $index => $person)
                @php
                    // entrance delay (staggered), and float-variation variables per card
                    $delay = ($index % 3) * 0.15 + floor($index / 3) * 0.1;
                    $floatDuration = 3 + ($index % 4) * 0.5; // 3s - 4.5s
                    $floatDistance = 6 + ($index % 3) * 2; // 6px - 10px
                    $floatX = ($index % 5 - 2) * 2; // -4px .. 4px
                    $floatRotate = ($index % 3 - 1); // -1 .. 1 deg
                @endphp
                <div class="createdby-card" style="animation-delay: {{ $delay }}s; --float-duration: {{ $floatDuration }}s; --float-distance: {{ $floatDistance }}px; --float-x: {{ $floatX }}px; --float-rotate: {{ $floatRotate }}deg;">
                    <div class="createdby-card-inner">
                        <div class="createdby-image-wrapper">
                            <img src="{{ $person['img'] }}" alt="{{ $person['name'] }}" class="createdby-img">
                        </div>
                        <div class="createdby-info">
                            <h3 class="createdby-name">{{ $person['name'] }}</h3>
                            <p class="createdby-role">{{ $person['role'] }}</p>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
</div>

@endsection
