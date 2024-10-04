@extends('layouts.app')

@section('content')
@include('database.inc.form')

{{-- <div class="py-5">
    <div class="container">
        <div class="row">
            <!-- Card 1 -->
            <div class="col-md-4 modals">
                <a href="{{ route('pin', ['redirect_url' => '/jamaah']) }}" class="text-decoration-none">
                    <div class="card shadow-sm mb-4 hover-shadow" style="background-color:  rgba(0, 128, 0, 0.25);">
                        <div class="card-body d-flex align-items-center">
                            <img src="https://firebasestorage.googleapis.com/v0/b/explorefireb4se.appspot.com/o/Icons%2Fwindows.gif?alt=media&token=059162c4-00d0-43b1-912d-f896a92b4b1e"
                                alt="" style="width: 50%; height: auto; margin-right: 16px;">
                            <h2 class="card-title text-xl font-semibold mb-0"
                                style="font-size: 1.5rem; font-family: 'Poppins', sans-serif; font-weight: bold; color: white;">
                                Sholat Berjamaah
                            </h2>
                        </div>
                    </div>
                </a>
            </div>
            <div class="col-md-4 modals">
                <a href="{{ route('pin', ['redirect_url' => '/patroli/asrama']) }}" class="text-decoration-none">
                    <div class="card shadow-sm mb-4 hover-shadow" style="background-color:rgba(0, 123, 255, 0.25);">
                        <div class="card-body d-flex align-items-center">
                            <img src="https://firebasestorage.googleapis.com/v0/b/explorefireb4se.appspot.com/o/Icons%2Fsearch.gif?alt=media&token=35e8b631-1ac7-46e5-b69c-9f5f82de4e04"
                                alt="" style="width: 50%; height: auto; margin-right: 16px;">
                            <h2 class="card-title text-xl font-semibold mb-0"
                                style="font-size: 1.5rem; font-family: 'Poppins', sans-serif; font-weight: bold; color: white;">
                                Patroli
                            </h2>
                        </div>
                    </div>
                </a>
            </div>
            <div class="col-md-4 modals">
                <a href="{{ route('pin', ['redirect_url' => '/sekolah-keasramaan/akses-lab']) }}"
                    class="text-decoration-none">
                    <div class="card shadow-sm mb-4 hover-shadow" style="background-color:rgba(255, 0, 0, 0.25);">
                        <div class="card-body d-flex align-items-center">
                            <img src="https://firebasestorage.googleapis.com/v0/b/explorefireb4se.appspot.com/o/Icons%2Fcomputer.gif?alt=media&token=8ea22d50-e985-422d-b0ab-3898b6a368ed"
                                alt="" style="width: 50%; height: auto; margin-right: 16px;">
                            <h2 class="card-title text-xl font-semibold mb-0"
                                style="font-size: 1.5rem; font-family: 'Poppins', sans-serif; font-weight: bold; color: white;">
                                Akses Lab
                            </h2>
                        </div>
                    </div>
                </a>
            </div>
            <div class="col-md-4">
                <a href="sekolah-keasramaan/akademik" class="text-decoration-none">
                    <div class="card shadow-sm mb-4 hover-shadow" style="background-color: rgba(0, 128, 0, 0.25);">
                        <div class="card-body d-flex align-items-center">
                            <img src="https://firebasestorage.googleapis.com/v0/b/explorefireb4se.appspot.com/o/Icons%2Feducation.gif?alt=media&token=3a16b136-b068-479d-bfbb-ee4cbe544e50"
                                alt="" style="width: 50%; height: auto; margin-right: 16px;">
                            <h2 class="card-title text-xl font-semibold mb-0"
                                style="font-size: 1.5rem; font-family: 'Poppins', sans-serif; font-weight: bold; color: white;">
                                Akademik
                            </h2>
                        </div>
                    </div>
                </a>
            </div>
            <div class="col-md-4">
                <a href="sekolah-keasramaan/al-quran" class="text-decoration-none">
                    <div class="card shadow-sm mb-4 hover-shadow" style="background-color:  rgba(0, 123, 255, 0.25);">
                        <div class="card-body d-flex align-items-center">
                            <img src="https://firebasestorage.googleapis.com/v0/b/explorefireb4se.appspot.com/o/Icons%2Fal-quran.gif?alt=media&token=23b495d0-92a3-4ade-95d8-34434a8578aa"
                                alt="" style="width: 50%; height: auto; margin-right: 16px;">
                            <h2 class="card-title text-xl font-semibold mb-0"
                                style="font-size: 1.5rem; font-family: 'Poppins', sans-serif; font-weight: bold; color: white;">
                                Al-Qur'an
                            </h2>
                        </div>
                    </div>
                </a>
            </div>
            <div class="col-md-4">
                <a href="sekolah-keasramaan/jurnal-asrama" class="text-decoration-none">
                    <div class="card shadow-sm mb-4 hover-shadow" style="background-color:rgba(255, 0, 0, 0.25);">
                        <div class="card-body d-flex align-items-center">
                            <img src="https://firebasestorage.googleapis.com/v0/b/explorefireb4se.appspot.com/o/Icons%2Fjournal.gif?alt=media&token=bb438613-fe4c-4ecb-add1-8d59e5d13420"
                                alt="" style="width: 50%; height: auto; margin-right: 16px;">
                            <h2 class="card-title text-xl font-semibold mb-0"
                                style="font-size: 1.5rem; font-family: 'Poppins', sans-serif; font-weight: bold; color: white;">
                                Jurnal Asrama
                            </h2>
                        </div>
                    </div>
                </a>
            </div>
        </div>
    </div>
</div> --}}
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
            'url' => '/sekolah-keasramaan/kunjungan/dinas',
            'img' =>
            'https://firebasestorage.googleapis.com/v0/b/explorefireb4se.appspot.com/o/Icons%2Fwindows.gif?alt=media&token=059162c4-00d0-43b1-912d-f896a92b4b1e',
            'title' => 'DInas',
            'color' => 'card-custom',
            ],
            [
            'url' => '/sekolah-keasramaan/kunjungan/industri',
            'img' =>
            'https://firebasestorage.googleapis.com/v0/b/explorefireb4se.appspot.com/o/Icons%2Fsearch.gif?alt=media&token=35e8b631-1ac7-46e5-b69c-9f5f82de4e04',
            'title' => 'Industri',
            'color' => 'card-custom',
            ],
            [
            'url' => '/sekolah-keasramaan/kunjungan/ortu',
            'img' =>
            'https://firebasestorage.googleapis.com/v0/b/explorefireb4se.appspot.com/o/Icons%2Fcomputer.gif?alt=media&token=8ea22d50-e985-422d-b0ab-3898b6a368ed',
            'title' => 'Orangtua/Wali',
            'color' => 'card-custom-red',
            ],
            [
            'url' => '/sekolah-keasramaan/kunjungan/alumni',
            'img' =>
            'https://firebasestorage.googleapis.com/v0/b/explorefireb4se.appspot.com/o/Icons%2Feducation.gif?alt=media&token=3a16b136-b068-479d-bfbb-ee4cbe544e50',
            'title' => 'Alumni',
            'color' => 'card-custom',
            ],
            [
            'url' => '/sekolah-keasramaan/kunjungan/tamu',
            'img' =>
            'https://firebasestorage.googleapis.com/v0/b/explorefireb4se.appspot.com/o/Icons%2Fal-quran.gif?alt=media&token=23b495d0-92a3-4ade-95d8-34434a8578aa',
            'title' => 'Tamu',
            'color' => 'card-custom-red',
            ],
            ];
            @endphp

            @foreach ($cards as $card)
            <div class="col-12 col-sm-6 col-md-4 text-center">
                <a href="{{ url($card['url']) }}" class="text-decoration-none">
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
