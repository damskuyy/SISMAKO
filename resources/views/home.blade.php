@extends('layouts.app')

@section('content')
<livewire:layout.header />
<div class="card">
    <div class="py-6"
        style="background-image: url(https://firebasestorage.googleapis.com/v0/b/explorefireb4se.appspot.com/o/Icons%2Fbg.png?alt=media&token=9e12403b-e795-4db3-b936-a127271e3bb9); background-size: cover; min-height: 92vh;">
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
                'id' => 'database',
                'url' => '/database',
                'img' =>
                'https://firebasestorage.googleapis.com/v0/b/explorefireb4se.appspot.com/o/Icons%2Fprotection.gif?alt=media&token=f150a7b5-d7f3-4fdf-bbdb-5df887635dd4',
                'title' => 'Database',
                'color' => 'card-custom',
                ],
                [
                'id' => 'korespondensi',
                'url' => '/korespondensi',
                'img' =>
                'https://firebasestorage.googleapis.com/v0/b/explorefireb4se.appspot.com/o/Icons%2Fpassport.gif?alt=media&token=b2331b75-36b2-440f-9e17-e405d5c4c596',
                'title' => 'Korespondensi',
                'color' => 'card-custom',
                ],
                [
                'id' => 'administrasi',
                'url' => '/administrasi',
                'img' =>
                'https://firebasestorage.googleapis.com/v0/b/explorefireb4se.appspot.com/o/Icons%2Ffiles.gif?alt=media&token=322cb890-2c30-455d-bd28-34f8ac0a7066',
                'title' => 'Administrasi',
                'color' => 'card-custom-red',
                ],
                [
                'id' => 'penilaian',
                'url' => '/penilaian',
                'img' =>
                'https://firebasestorage.googleapis.com/v0/b/explorefireb4se.appspot.com/o/Icons%2Fpassed.gif?alt=media&token=5c0140cc-50a9-44df-a3c1-58e5eb0ceda3',
                'title' => 'Penilaian',
                'color' => 'card-custom',
                ],
                [
                'id' => 'sarpras',
                'url' => '/sarpras',
                'img' =>
                'https://firebasestorage.googleapis.com/v0/b/explorefireb4se.appspot.com/o/Icons%2Fschool.gif?alt=media&token=df4d9eee-ff3c-4aa9-892d-f94ca0a3e060',
                'title' => 'Sarpras',
                'color' => 'card-custom-red',
                ],
                [
                'id' => 'finance',
                'url' => '/finance',
                'img' =>
                'https://firebasestorage.googleapis.com/v0/b/explorefireb4se.appspot.com/o/Icons%2Fdollar.gif?alt=media&token=b996e252-0ec3-48c4-ac6b-c53228ba5105',
                'title' => 'Keuangan',
                'color' => 'card-custom-green',
                ],
                [
                'id' => 'pkg',
                'url' => '/pkg',
                'img' =>
                'https://firebasestorage.googleapis.com/v0/b/explorefireb4se.appspot.com/o/Icons%2F360-feedback.gif?alt=media&token=63220144-e26a-4e26-a32d-49434ed8380d',
                'title' => 'Penilaian Kinerja Guru (PKG)',
                'color' => 'card-custom-red',
                ],
                [
                'id' => 'keasramaan',
                'url' => '/sekolah-keasramaan',
                'img' =>
                'https://firebasestorage.googleapis.com/v0/b/explorefireb4se.appspot.com/o/Icons%2Fquran.gif?alt=media&token=c69149c5-73e5-4a8e-929f-e51a1b1b38d3',
                'title' => 'Sekolah dan Keasramaan',
                'color' => 'card-custom-green',
                ],
                ];
                @endphp

                @foreach ($cards as $card)
                <div class="col-12 col-sm-6 col-md-4 text-center">
                    <a href="{{ route('pin', ['redirect_url' => $card['url']]) }}" class="text-decoration-none">
                        <div class="card shadow-sm mb-4 hover-shadow {{ $card['color'] }}">
                            <div class="card-body d-flex align-items-center justify-content-center">
                                <img src="{{ asset($card['img']) }}" alt="" class="img-fluid img-custom">
                                <h2 class="card-title">{{ $card['title'] }}</h2>
                            </div>
                        </div>
                    </a>
                </div>
                @endforeach

                <div class="col-12 col-sm-6 col-md-4 text-center">
                    <a href="{{ route('created-by') }}" class="text-decoration-none">
                        <div class="card shadow-sm mb-4 hover-shadow" style="background-color: rgba(0, 128, 0, 0.25);">
                            <div class="card-body d-flex align-items-center justify-content-center">
                                <img src="https://firebasestorage.googleapis.com/v0/b/explorefireb4se.appspot.com/o/Icons%2Fmanagement-consulting.gif?alt=media&token=db2d8a1b-46ff-4e95-b8ff-478beddbfeba"
                                    alt="" class="img-fluid img-custom">
                                <h2 class="card-title">Created By</h2>
                            </div>
                        </div>
                    </a>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
