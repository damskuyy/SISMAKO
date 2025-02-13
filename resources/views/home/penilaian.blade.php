@extends('layouts.app')

@section('content')
    <div class="py-6">
        <div class="container">
            <div class="row d-flex justify-content-center">
                <style>
                    .hover-shadow:hover {
                        box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2);
                    }

                    .card-title {
                        font-size: 1.25rem;
                        font-family: 'Poppins', sans-serif;
                        font-weight: bold;
                    }

                    .img-custom {
                        max-width: 40%;
                        height: auto;
                        margin-right: 12px;
                    }

                </style>

                @php
                    $cards = [
                        [
                            'title' => 'Administrasi Ujian',
                            'text' => 'Kelola ujian dan file-file terkait.',
                            'links' => [
                                ['url' => '/penilaian/pts', 'label' => 'Pergi ke PTS'],
                                ['url' => '/penilaian/pas', 'label' => 'Pergi ke PAS'],
                                ['url' => '/penilaian/pat', 'label' => 'Pergi ke PAT'],
                                ['url' => '/penilaian/panitia', 'label' => 'Pergi ke Panitia'],
                            ],
                            'color' => 'card-custom'
                        ],
                        [
                            'title' => 'Rapor',
                            'text' => 'Melihat dan mengelola rapor siswa.',
                            'links' => [
                                ['url' => '/penilaian/rapor', 'label' => 'Pergi ke Rapor'],
                                ['url' => '/penilaian/rpts', 'label' => 'Pergi ke Rapor PTS'],
                                ['url' => '/penilaian/rasrama', 'label' => 'Pergi ke Rapor Asrama'],
                            ],
                            'color' => 'card-custom'
                        ]
                    ];
                @endphp

                @foreach ($cards as $card)
                    <div class="col-12 col-md-6 mb-4">
                        <div class="card shadow-sm hover-shadow {{ $card['color'] }} h-100">
                            <div class="card-body">
                                <h2 class="card-title">{{ $card['title'] }}</h2>
                                <p class="card-text">{{ $card['text'] }}</p>
                                @foreach($card['links'] as $link)
                                    <a href="{{ route('pin', ['redirect_url' => $link['url']]) }}" class="btn btn-primary me-2 mb-2">
                                        {{ $link['label'] }}
                                    </a>
                                @endforeach
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </div>
@endsection
