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
                ['name' => 'Damar Nugroho Utomo', 'role' => 'Backend Developer', 'img' => 'https://wallpapercave.com/uwp/uwp4887476.jpeg'],
                ['name' => 'Rizki Zikrillah', 'role' => 'Frontend Developer', 'img' => 'https://wallpapercave.com/uwp/uwp4887508.jpeg'],
            ];
        @endphp
        
        <div class="createdby-grid-container">
            @foreach ($data as $index => $person)
                <div class="createdby-card" style="animation-delay: {{ $index * 0.1 }}s">
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
