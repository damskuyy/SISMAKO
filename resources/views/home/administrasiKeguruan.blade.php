@extends('layouts.app')


@section('content')
@include('database.inc.form')
<style>
    .bg-red {
        background-color: rgba(255, 0, 0, 0.5);
    }

    .bg-blue {
        background-color: rgba(0, 0, 255, 0.5);
    }

    .bg-green {
        background-color: rgba(0, 255, 0, 0.5);
    }

    .card-body img {
        width: 50%;
        height: auto;
        margin-right: 16px;
    }

    .card-title {
        font-size: 1.5rem;
        font-family: 'Poppins', sans-serif;
        font-weight: bold;
        color: white;
    }
</style>


<div class="py-5">
    <div class="container">
        <div class="row">
            @php
            $cards = [
            ['url' => 'administrasi-keguruan/mapel', 'img' =>
            'https://firebasestorage.googleapis.com/v0/b/explorefireb4se.appspot.com/o/Icons%2Fmapel-unscreen.gif?alt=media&token=831eb11d-d89d-466e-b9f5-35b08709873f',
            'title' => 'Mata Pelajaran', 'bg' => 'bg-red'],
            ['url' => '#', 'img' =>
            'https://firebasestorage.googleapis.com/v0/b/explorefireb4se.appspot.com/o/Icons%2Fbk-unscreen.gif?alt=media&token=b7d6c604-0985-4d4d-b15a-20b0458690e8',
            'title' => 'Bimbingan Konseling', 'bg' => 'bg-red'],
            ['url' => 'administrasi-keguruan/kepalaLabKom', 'img' =>
            'https://firebasestorage.googleapis.com/v0/b/explorefireb4se.appspot.com/o/Icons%2Flab-unscreen.gif?alt=media&token=b223b2dd-428c-406d-afce-7105228e35ab',
            'title' => 'Kepala LABKOM', 'bg' => 'bg-red'],
            ['url' => 'administrasi-keguruan/osis', 'img' =>
            'https://firebasestorage.googleapis.com/v0/b/explorefireb4se.appspot.com/o/Icons%2Fstudent-unscreen.gif?alt=media&token=e3239e62-4101-43f0-81bf-0711ae9dd0c2',
            'title' => 'OSIS SMK', 'bg' => 'bg-blue'],
            ['url' => 'administrasi-keguruan/perpustakaan', 'img' =>
            'https://firebasestorage.googleapis.com/v0/b/explorefireb4se.appspot.com/o/Icons%2Fshelves-unscreen.gif?alt=media&token=bc6d23b4-812f-4a50-bca2-6c3527f47acf',
            'title' => 'Library', 'bg' => 'bg-blue'],
            ['url' => 'administrasi-keguruan/walas', 'img' =>
            'https://firebasestorage.googleapis.com/v0/b/explorefireb4se.appspot.com/o/Icons%2Fprofessor-unscreen.gif?alt=media&token=ee7e231f-3d2f-418b-be3f-97609ff7df36',
            'title' => 'Wali Kelas', 'bg' => 'bg-blue'],
            ['url' => 'administrasi-keguruan/kepsek', 'img' =>
            'https://firebasestorage.googleapis.com/v0/b/explorefireb4se.appspot.com/o/Icons%2Fheadmaster-unscreen.gif?alt=media&token=23a9fee2-ad6d-4529-8854-17078cf454ad',
            'title' => 'Kepala Sekolah', 'bg' => 'bg-blue'],
            ['url' => 'administrasi-keguruan/waka-kurikulum', 'img' =>
            'https://firebasestorage.googleapis.com/v0/b/explorefireb4se.appspot.com/o/Icons%2Fapproved-unscreen.gif?alt=media&token=b5c2c790-d4d2-44fb-a5c8-b34a15ddd0b6',
            'title' => 'Waka Kurikulum', 'bg' => 'bg-green'],
            ['url' => 'administrasi-keguruan/waka-kesiswaan', 'img' =>
            'https://firebasestorage.googleapis.com/v0/b/explorefireb4se.appspot.com/o/Icons%2Fkesiswaan-unscreen.gif?alt=media&token=5fe91c55-21ed-4feb-b6a1-dc90d0db825b',
            'title' => 'Waka Kesiswaan', 'bg' => 'bg-green'],
            ['url' => 'administrasi-keguruan/supervisi', 'img' =>
            'https://firebasestorage.googleapis.com/v0/b/explorefireb4se.appspot.com/o/Icons%2Fsupervisi-unscreen.gif?alt=media&token=e22ca8a1-679d-4ed3-9a99-148e3069e9cd',
            'title' => 'Supervisi', 'bg' => 'bg-green'],
            ];
            @endphp


            @foreach ($cards as $card)
            <div class="col-md-{{ in_array($loop->iteration, [4,5,6,7]) ? 3 : 4 }}">
                <a href="{{ $card['url'] }}" class="text-decoration-none">
                    <div class="card {{ $card['bg'] }} shadow-sm mb-4 hover-shadow">
                        <div class="card-body d-flex align-items-center">
                            <img src="{{ $card['img'] }}" alt="">
                            <h2 class="card-title">{{ $card['title'] }}</h2>
                        </div>
                    </div>
                </a>
            </div>
            @endforeach
        </div>
    </div>
</div>
@endsection
