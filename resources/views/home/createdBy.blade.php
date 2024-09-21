@extends('layouts.app')

@section('content')
<style></style>
<link rel="stylesheet" href="{{ asset('dist/css/style.css') }}">
    <div class="banner">
        <div class="slider" style="--quantity: 11">
            @php
                $data = [
                    ['name' => 'Ahmad Dahlan, S.Ag', 'role' => 'Kepala SMK TI BAZMA (Inisiator & Pembuat Skema Alur Kerja)', 'img' => 'https://firebasestorage.googleapis.com/v0/b/explorefireb4se.appspot.com/o/created-by%2Fdragon_1.png?alt=media&token=d4e30b62-b0fd-4925-9372-d501a3b80968'],
                    ['name' => 'I Gde Bayu Priyambada M. S.Kom', 'role' => 'Kepala LABKOM & Guru IT', 'img' => 'https://firebasestorage.googleapis.com/v0/b/explorefireb4se.appspot.com/o/created-by%2Fdragon_2.png?alt=media&token=caf4ccc0-205b-490e-95b0-ca6c0c182845'],
                    ['name' => 'Fadhil Rabbani XII', 'role' => 'Project Database', 'img' => 'https://firebasestorage.googleapis.com/v0/b/explorefireb4se.appspot.com/o/created-by%2Fdragon_3.png?alt=media&token=99493e4a-07c6-49f8-a061-e2125f2a1d49'],
                    ['name' => 'Mufiz Ihsanulhaq XII', 'role' => 'Project Penilaian', 'img' => 'https://firebasestorage.googleapis.com/v0/b/explorefireb4se.appspot.com/o/created-by%2Fdragon_4.png?alt=media&token=7b2bf226-27e7-4962-b994-5812a48f1674'],
                    ['name' => 'Attar Rifai XII', 'role' => 'Project Sarpras', 'img' => 'https://firebasestorage.googleapis.com/v0/b/explorefireb4se.appspot.com/o/created-by%2Fdragon_5.png?alt=media&token=a8029e9c-1729-4a65-8990-1be31fbff31b'],
                    ['name' => 'Muhammad Abdullah Al-Aziz XII', 'role' => 'Project Korespondensi', 'img' => 'https://firebasestorage.googleapis.com/v0/b/explorefireb4se.appspot.com/o/created-by%2Fdragon_6.png?alt=media&token=e12f3018-830a-4193-b8d5-bcb467b75fc4'],
                    ['name' => 'Muhammad Saeful Romadhon XII', 'role' => 'Project Administrasi Keguruan', 'img' => 'https://firebasestorage.googleapis.com/v0/b/explorefireb4se.appspot.com/o/created-by%2Fdragon_7.png?alt=media&token=0868aa03-c2c6-4dc2-a555-b577f7df9ef1'],
                    ['name' => 'Gemi Widodo XII', 'role' => 'Project PKG', 'img' => 'https://firebasestorage.googleapis.com/v0/b/explorefireb4se.appspot.com/o/created-by%2Fdragon_8.png?alt=media&token=328ee27e-392a-4d42-8cfa-2fd5c1a4d798'],
                    ['name' => 'Hafith Muhammad Fauzan XII', 'role' => 'Project PKG', 'img' => 'https://firebasestorage.googleapis.com/v0/b/explorefireb4se.appspot.com/o/created-by%2Fdragon_9.png?alt=media&token=4962f725-90f8-4efa-84bd-07793e40b929'],
                    ['name' => 'Syahban Syahputra XII', 'role' => 'Project Keuangan', 'img' => 'https://firebasestorage.googleapis.com/v0/b/explorefireb4se.appspot.com/o/created-by%2Fdragon_10.png?alt=media&token=fc01610c-e9ac-4141-9c31-712ece4452ed'],
                    ['name' => 'Hanif Gibran Syidiq XII', 'role' => 'Project Keuangan', 'img' => 'https://firebasestorage.googleapis.com/v0/b/explorefireb4se.appspot.com/o/created-by%2Fdragon_11.png?alt=media&token=28c529fc-f416-458d-9315-cfedd2059f8c'],
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
