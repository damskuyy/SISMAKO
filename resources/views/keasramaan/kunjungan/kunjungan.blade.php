@extends('layouts.app')

@section('content')
@include('database.inc.form')
<div class="py-6">
    <div class="container ">
        <div class="mb-4">
            <a href="/sekolah-keasramaan" class="btn btn-secondary">
                Back
            </a>
            <a href="{{ route('kunjungan.export')}}" class="btn btn-success">Rekap Data</a>
        </div>
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
            'title' => 'Dinas',
            'img' =>
            'https://firebasestorage.googleapis.com/v0/b/sismako.appspot.com/o/Kunjungan%2Fgoverment.gif?alt=media&token=d9bd0ffc-b75c-473b-9319-d8630413bdb0',
            'color' => 'card-custom',
            ],
            [
            'url' => '/sekolah-keasramaan/kunjungan/industri',
            'img' =>
            'https://firebasestorage.googleapis.com/v0/b/sismako.appspot.com/o/Kunjungan%2FInstansi.gif?alt=media&token=cb90abc3-7631-42f4-918a-56882790cf87',
            'title' => 'Industri',
            'color' => 'card-custom',
            ],
            [
            'url' => '/sekolah-keasramaan/kunjungan/ortu',
            'img' =>
            'https://firebasestorage.googleapis.com/v0/b/sismako.appspot.com/o/Kunjungan%2Ffamily.gif?alt=media&token=5cf80da6-5db2-4f39-95b7-4f32b4a7f2d0',
            'title' => 'Orangtua/Wali',
            'color' => 'card-custom-red',
            ],
            [
            'url' => '/sekolah-keasramaan/kunjungan/alumni',
            'img' =>
            'https://firebasestorage.googleapis.com/v0/b/sismako.appspot.com/o/Kunjungan%2Falumni.gif?alt=media&token=6d6b196d-316a-4ade-85f8-d05cb462c3aa',
            'title' => 'Alumni',
            'color' => 'card-custom',
            ],
            [
            'url' => '/sekolah-keasramaan/kunjungan/tamu',
            'img' =>
            'https://firebasestorage.googleapis.com/v0/b/sismako.appspot.com/o/Kunjungan%2Fguest.gif?alt=media&token=5b6d13b1-a8da-4394-9542-f8a1a74458aa',
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
