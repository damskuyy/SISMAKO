@extends('layouts.app')

@section('content')
<style></style>
<link rel="stylesheet" href="{{ asset('dist/css/style.css') }}">
    <div class="banner">
        <div class="slider" style="--quantity: 13">
            @php
                $data = [
                    ['name' => 'Ahmad Dahlan, S.Ag', 'role' => 'Kepala SMK TI BAZMA (Inisiator & Pembuat Skema Alur Kerja)', 'img' => 'https://res.cloudinary.com/dqzc35nrh/image/upload/v1761118350/pak-dahlan_wmnx6h.png'],
                    ['name' => 'I Gde Bayu Priyambada M. S.Kom', 'role' => 'Guru IT 2023-2024', 'img' => 'https://res.cloudinary.com/dqzc35nrh/image/upload/v1761117746/pak-bayu_szfupy.png'],
                    ['name' => 'Fadhil Rabbani', 'role' => 'Angkatan II SMK TI BAZMA', 'img' => 'https://res.cloudinary.com/dqzc35nrh/image/upload/v1761118340/fadhil_kwutun.png'],
                    ['name' => 'Mufiz Ihsanulhaq', 'role' => 'Angkatan II SMK TI BAZMA', 'img' => 'https://res.cloudinary.com/dqzc35nrh/image/upload/v1761118344/mufiz_g9iec2.png'],
                    ['name' => 'Attar Rifai', 'role' => 'Angkatan II SMK TI BAZMA', 'img' => 'https://res.cloudinary.com/dqzc35nrh/image/upload/v1761118317/attar_mpfg3n.png'],
                    ['name' => 'Muhammad Abdullah Al-Aziz', 'role' => 'Angkatan II SMK TI BAZMA', 'img' => 'https://res.cloudinary.com/dqzc35nrh/image/upload/v1761118321/aziz_vnchtr.png'],
                    ['name' => 'Muhammad Saeful Romadhon', 'role' => 'Angkatan II SMK TI BAZMA', 'img' => 'https://res.cloudinary.com/dqzc35nrh/image/upload/v1761118354/saeful_m34pos.png'],
                    ['name' => 'Gemi Widodo', 'role' => 'Angkatan II SMK TI BAZMA', 'img' => 'https://res.cloudinary.com/dqzc35nrh/image/upload/v1761117743/gemi_awcf58.png'],
                    ['name' => 'Hafith Muhammad Fauzan', 'role' => 'Angkatan II SMK TI BAZMA', 'img' => 'https://res.cloudinary.com/dqzc35nrh/image/upload/v1761118338/hafith_drb8q8.png'],
                    ['name' => 'Syahban Syahputra', 'role' => 'Angkatan II SMK TI BAZMA', 'img' => 'https://res.cloudinary.com/dqzc35nrh/image/upload/v1761118361/syahban_iedbpa.png'],
                    ['name' => 'Hanif Gibran Syidiq', 'role' => 'Angkatan II SMK TI BAZMA', 'img' => 'https://res.cloudinary.com/dqzc35nrh/image/upload/v1761118352/hanif_g6znj3.png'],
                    ['name' => 'Damar Nugroho Utomo', 'role' => 'Backend Developer', 'img' => 'https://wallpapercave.com/uwp/uwp4887476.jpeg'],
                    ['name' => 'Rizki Zikrillah', 'role' => 'Frontend Developer', 'img' => 'https://wallpapercave.com/uwp/uwp4887508.jpeg'],
                ];
            @endphp

            @foreach ($data as $index => $person)
                <div class="item" style="--position: {{ $index + 1 }}">
                    <img src={{$person['img']}} alt="">
                    <div class="overlay">
                        <h3>{{ $person['name'] }}</h3>
                        <p>{{ $person['role'] }}</p>
                    </div>
                </div>
            @endforeach
        </div>

        <div class="content">
            <div class="author">
                <h2>SISMAKO</h2>
                <p><b>Sistem Manajemen Sekolah</b></p>
                <p>
                    Sistem integrasi data dan administrasi sekolah otomatis.
                </p>
            </div>
        </div>
    </div>

@endsection
