@extends('layouts.app')

@section('content')
    @include('database.inc.form')
    <div class="py-6">
        <div class="container ">
            <div class="row d-flex justify-content-center">
                <style>
                    .hover-shadow:hover {
                        box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2);
                    }

                    .card-body img {
                        max-width: 40%;
                        height: auto;
                    }

                    .card-title {
                        font-size: 1.25rem;
                        font-family: 'Poppins', sans-serif;
                        font-weight: bold;
                        color: white;
                    }

                    .img-custom {
                        max-width: 40%;
                        height: auto;
                        margin-right: 12px;
                    }

                    .card-custom {
                        background-color: rgba(0, 123, 255, 0.25);
                    }

                    .card-custom-red {
                        background-color: rgba(255, 0, 0, 0.25);
                    }

                    .card-custom-green {
                        background-color: rgba(0, 128, 0, 0.25);
                    }
                </style>

                @php
                    $cards = [
                        [
                            'url' => '/jamaah',
                            'img' =>
                                'https://firebasestorage.googleapis.com/v0/b/explorefireb4se.appspot.com/o/Icons%2Fwindows.gif?alt=media&token=059162c4-00d0-43b1-912d-f896a92b4b1e',
                            'title' => 'Jamaaah',
                            'color' => 'card-custom',
                        ],
                        [
                            'url' => '/patroli/asrama',
                            'img' =>
                                'https://firebasestorage.googleapis.com/v0/b/explorefireb4se.appspot.com/o/Icons%2Fsearch.gif?alt=media&token=35e8b631-1ac7-46e5-b69c-9f5f82de4e04',
                            'title' => 'Patroli',
                            'color' => 'card-custom',
                        ],
                        [
                            'url' => '/sekolah-keasramaan/akses-lab',
                            'img' =>
                                'https://firebasestorage.googleapis.com/v0/b/explorefireb4se.appspot.com/o/Icons%2Fcomputer.gif?alt=media&token=8ea22d50-e985-422d-b0ab-3898b6a368ed',
                            'title' => 'Akses Lab',
                            'color' => 'card-custom-red',
                        ],
                        [
                            'url' => '/sekolah-keasramaan/akademik',
                            'img' =>
                                'https://firebasestorage.googleapis.com/v0/b/explorefireb4se.appspot.com/o/Icons%2Feducation.gif?alt=media&token=3a16b136-b068-479d-bfbb-ee4cbe544e50',
                            'title' => 'Akademik',
                            'color' => 'card-custom',
                        ],
                        [
                            'url' => '/sekolah-keasramaan/al-quran',
                            'img' =>
                                'https://firebasestorage.googleapis.com/v0/b/explorefireb4se.appspot.com/o/Icons%2Fal-quran.gif?alt=media&token=23b495d0-92a3-4ade-95d8-34434a8578aa',
                            'title' => 'Al-Quran',
                            'color' => 'card-custom-red',
                        ],
                        [
                            'url' => '/sekolah-keasramaan/jurnal-asrama',
                            'img' =>
                                'https://firebasestorage.googleapis.com/v0/b/explorefireb4se.appspot.com/o/Icons%2Fjournal.gif?alt=media&token=bb438613-fe4c-4ecb-add1-8d59e5d13420',
                            'title' => 'Jurnal',
                            'color' => 'card-custom-green',
                        ],
                        [
                            'url' => '/sekolah-keasramaan/kunjungan',
                            'img' =>
                                'https://firebasestorage.googleapis.com/v0/b/sismako.appspot.com/o/Kunjungan%2Fkunjungan.gif?alt=media&token=0720e2eb-1d81-4f22-8953-0173e678d3dc',
                            'title' => 'Kunjungan',
                            'color' => 'card-custom-green',
                        ],
                        [
                            'url' => '/sekolah-keasramaan/catatan-grooming',
                            'img' =>
                                'https://firebasestorage.googleapis.com/v0/b/explorefireb4se.appspot.com/o/Icons%2Ftuxedo-unscreen.gif?alt=media&token=f32f023e-6822-4f68-afa2-1e7e3ab6198e',
                            'title' => 'Catatan Grooming',
                            'color' => 'card-custom-green',
                        ],
                        [
                            'url' => '/sekolah-keasramaan/uks',
                            'img' =>
                                'https://firebasestorage.googleapis.com/v0/b/explorefireb4se.appspot.com/o/Icons%2Fmedicine-unscreen.gif?alt=media&token=3db3f147-5617-4553-9b34-75a86cbba87c',
                            'title' => 'Unit Kesehatan Sekolah',
                            'color' => 'card-custom-green',
                        ],
                    ];
                @endphp

                @foreach ($cards as $card)
                    <div class="col-12 col-sm-6 col-md-4 text-center">
                        @php
                            $requiresPin = ['Jamaaah', 'Patroli', 'Akses Lab'];
                        @endphp

                        @if (in_array($card['title'], $requiresPin))
                            <a href="{{ route('pin', ['redirect_url' => $card['url']]) }}" class="text-decoration-none">
                            @else
                                <a href="{{ url($card['url']) }}" class="text-decoration-none">
                        @endif

                        <div class="card shadow-sm mb-4 hover-shadow {{ $card['color'] }}">
                            <div class="card-body d-flex align-items-center justify-content-center">
                                <img src="{{ asset($card['img']) }}" alt="" class="img-fluid img-custom">
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
