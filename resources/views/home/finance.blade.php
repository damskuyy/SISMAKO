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
                        background-color: rgba(0, 123, 255, 0.597);
                    }

                    .card-custom-red {
                        background-color: rgba(255, 0, 0, 0.649);
                    }

                    .card-custom-green {
                        background-color: rgba(0, 128, 0, 0.561);
                    }
                </style>

                @php
                    $cards = [
                        [
                            'url' => route('finance.pengajuan.index'),
                            'img' => 'https://res.cloudinary.com/dqzc35nrh/image/upload/v1763607524/scroll-with-quill-unscreen_ln6mcq.gif',
                            'title' => 'Pengajuan',
                            'color' => 'card-custom',
                        ],
                        [
                            'url' => route('finance.pemasukan.index'),
                            'img' => 'https://res.cloudinary.com/dqzc35nrh/image/upload/v1763607522/income-unscreen_shbd3n.gif',
                            'title' => 'Pemasukan',
                            'color' => 'card-custom-green',
                        ],
                        [
                            'url' => route('finance.pengeluaran.index'),
                            'img' => 'https://res.cloudinary.com/dqzc35nrh/image/upload/v1763607523/expense-unscreen_vi7bwd.gif',
                            'title' => 'Pengeluaran',
                            'color' => 'card-custom-red',
                        ],
                    ];
                @endphp

                <div class="row d-flex justify-content-center">
                    @foreach ($cards as $card)
                        <div class="col-12 col-sm-6 col-md-4 text-center">
                            <a href="{{ $card['url'] }}" class="text-decoration-none">
                                <div class="card shadow-sm mb-4 hover-shadow {{ $card['color'] }}">
                                    <div class="card-body d-flex align-items-center justify-content-center">
                                        <img src="{{ $card['img'] }}" alt="" class="img-fluid img-custom">
                                        <h2 class="card-title">{{ $card['title'] }}</h2>
                                    </div>
                                </div>
                            </a>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
    </div>

@endsection
