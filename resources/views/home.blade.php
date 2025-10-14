@extends('layouts.app')

@section('content')
    <livewire:layout.header />
    <div class="card" style="margin-bottom: 48px;"> <!-- Tambahkan margin-bottom di sini -->
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

                        .footer-creators {
                            background: #fff;
                            color: #222;
                            padding: 40px 0 16px 0;
                            border-top: 1px solid #eee;
                        }

                        .footer-creators .footer-flex {
                            gap: 32px;
                        }

                        .footer-desc-card {
                            background: #f7f7f7;
                            border-radius: 16px;
                            box-shadow: 0 2px 12px rgba(0, 0, 0, 0.07);
                            padding: 32px 24px;
                            max-width: 370px;
                            min-width: 260px;
                            flex: 1 1 320px;
                            display: flex;
                            flex-direction: column;
                            justify-content: center;
                            margin-bottom: 18px;
                        }

                        .footer-creators-list {
                            flex: 2 1 520px;
                            min-width: 280px;
                        }

                        .footer-creators-list h5 {
                            font-weight: bold;
                            margin-bottom: 18px;
                            font-size: 1.18rem;
                            color: #222;
                        }

                        .footer-creators .creator-list {
                            display: flex;
                            flex-wrap: wrap;
                            justify-content: center;
                            gap: 18px;
                            margin-bottom: 0;
                        }

                        .footer-creators .creator-card {
                            background: #f7f7f7;
                            border-radius: 12px;
                            box-shadow: 0 2px 8px rgba(0, 0, 0, 0.07);
                            padding: 16px 12px 12px 12px;
                            width: 150px;
                            text-align: center;
                            transition:
                                transform 0.3s,
                                box-shadow 0.3s;
                            position: relative;
                            overflow: hidden;
                            flex: 0 1 150px;
                        }

                        .footer-creators .creator-card:hover {
                            transform: translateY(-8px) scale(1.05);
                            box-shadow: 0 8px 24px rgba(0, 0, 0, 0.13);
                            background: #eaeaea;
                        }

                        .footer-creators .creator-img {
                            width: 60px;
                            height: 60px;
                            object-fit: cover;
                            border-radius: 50%;
                            margin-bottom: 8px;
                            border: 2px solid #222;
                            transition: border-color 0.3s;
                        }

                        .footer-creators .creator-card:hover .creator-img {
                            border-color: #007bff;
                        }

                        .footer-creators .creator-name {
                            font-weight: 600;
                            font-size: 1.05rem;
                            margin-bottom: 4px;
                            color: #222;
                        }

                        .footer-creators .creator-role {
                            font-size: 0.92rem;
                            color: #444;
                            margin-bottom: 0;
                        }

                        @media (max-width: 900px) {
                            .footer-creators .footer-flex {
                                flex-direction: column;
                                align-items: center;
                                gap: 24px;
                            }

                            .footer-desc-card {
                                max-width: 100%;
                                min-width: 0;
                            }

                            .footer-creators-list {
                                max-width: 100%;
                                min-width: 0;
                            }
                        }

                        @media (max-width: 600px) {
                            .footer-creators .creator-card {
                                width: 90vw;
                                min-width: 100px;
                                flex: 0 1 90vw;
                            }

                            .footer-desc-card {
                                padding: 18px 8px;
                            }
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

                    {{-- <div class="col-12 col-sm-6 col-md-4 text-center">
                        <a href="{{ route('created-by') }}" class="text-decoration-none">
                            <div class="card shadow-sm mb-4 hover-shadow" style="background-color: rgba(0, 128, 0, 0.25);">
                                <div class="card-body d-flex align-items-center justify-content-center">
                                    <img src="https://firebasestorage.googleapis.com/v0/b/explorefireb4se.appspot.com/o/Icons%2Fmanagement-consulting.gif?alt=media&token=db2d8a1b-46ff-4e95-b8ff-478beddbfeba"
                                        alt="" class="img-fluid img-custom">
                                    <h2 class="card-title">Created By</h2>
                                </div>
                            </div>
                        </a>
                    </div> --}}
                </div>
            </div>
        </div>
    </div>

    <!-- Footer SISMAKO -->
    <footer class="footer-creators">
        <div class="container">
            <div class="footer-flex"
                style="display: flex; flex-wrap: wrap; justify-content: center; align-items: flex-start; gap: 32px; max-width: 1200px; margin: 0 auto;">
                <!-- Card Deskripsi SISMAKO -->
                <div class="footer-desc-card"
                    style="background: #f7f7f7; border-radius: 16px; box-shadow: 0 2px 12px rgba(0,0,0,0.07); padding: 32px 24px; max-width: 370px; min-width: 260px; flex: 1 1 320px; display: flex; flex-direction: column; justify-content: center;">
                    <div style="display: flex; align-items: center; gap: 12px; margin-bottom: 12px;">
                        <img src="https://firebasestorage.googleapis.com/v0/b/explorefireb4se.appspot.com/o/Icons%2Fmanagement-consulting.gif?alt=media&token=db2d8a1b-46ff-4e95-b8ff-478beddbfeba"
                            alt="SISMAKO" style="width:48px;height:48px;border-radius:12px;">
                        <h2 style="font-weight: bold; color: #007bff; margin:0;">SISMAKO</h2>
                    </div>
                    <div style="font-size:1.08rem;color:#222;line-height:1.6;">
                        <b>SISMAKO</b> adalah platform integrasi data dan administrasi sekolah yang dibuat
                        untuk memudahkan pengelolaan, monitoring, dan otomasi proses administrasi di lingkungan SMK TI
                        BAZMA.<br><br>
                        <span style="color:#007bff;font-weight:500;">Tujuan:</span> Meningkatkan efisiensi,
                        transparansi, dan akurasi dalam pengelolaan data sekolah serta mendukung digitalisasi pendidikan.
                    </div>
                </div>
                <!-- Card Creator -->
                <div class="footer-creators-list" style="flex: 2 1 520px;">
                    <h5
                        style="font-weight: bold; margin-bottom: 18px; font-size: 1.18rem; color: #222;">
                        Created By:</h5>
                    <div class="creator-list"
                        style="display: flex; flex-wrap: wrap; justify-content: center; gap: 18px;">
                        @php
                            $creators = [
                                ['name' => 'Ahmad Dahlan, S.Ag', 'role' => 'Kepala SMK TI BAZMA (Inisiator & Pembuat Skema Alur Kerja)', 'img' => 'https://firebasestorage.googleapis.com/v0/b/explorefireb4se.appspot.com/o/created-by%2Fdragon_1.png?alt=media&token=d4e30b62-b0fd-4925-9372-d501a3b80968'],
                                ['name' => 'I Gde Bayu Priyambada M. S.Kom', 'role' => 'Guru IT Th. ', 'img' => 'https://firebasestorage.googleapis.com/v0/b/explorefireb4se.appspot.com/o/created-by%2Fdragon_2.png?alt=media&token=caf4ccc0-205b-490e-95b0-ca6c0c182845'],
                                ['name' => 'Fadhil Rabbani', 'role' => 'Angkatan II SMK TI BAZMA', 'img' => 'https://firebasestorage.googleapis.com/v0/b/explorefireb4se.appspot.com/o/created-by%2Fdragon_3.png?alt=media&token=99493e4a-07c6-49f8-a061-e2125f2a1d49'],
                                ['name' => 'Mufiz Ihsanulhaq', 'role' => 'Angkatan II SMK TI BAZMA', 'img' => 'https://firebasestorage.googleapis.com/v0/b/explorefireb4se.appspot.com/o/created-by%2Fdragon_4.png?alt=media&token=7b2bf226-27e7-4962-b994-5812a48f1674'],
                                ['name' => 'Attar Rifai', 'role' => 'Angkatan II SMK TI BAZMA', 'img' => 'https://firebasestorage.googleapis.com/v0/b/explorefireb4se.appspot.com/o/created-by%2Fdragon_5.png?alt=media&token=a8029e9c-1729-4a65-8990-1be31fbff31b'],
                                ['name' => 'Muhammad Abdullah Al-Aziz', 'role' => 'Angkatan II SMK TI BAZMA', 'img' => 'https://firebasestorage.googleapis.com/v0/b/explorefireb4se.appspot.com/o/created-by%2Fdragon_6.png?alt=media&token=e12f3018-830a-4193-b8d5-bcb467b75fc4'],
                                ['name' => 'Muhammad Saeful Romadhon', 'role' => 'Angkatan II SMK TI BAZMA', 'img' => 'https://firebasestorage.googleapis.com/v0/b/explorefireb4se.appspot.com/o/created-by%2Fdragon_7.png?alt=media&token=0868aa03-c2c6-4dc2-a555-b577f7df9ef1'],
                                ['name' => 'Gemi Widodo', 'role' => 'Angkatan II SMK TI BAZMA', 'img' => 'https://firebasestorage.googleapis.com/v0/b/explorefireb4se.appspot.com/o/created-by%2Fdragon_8.png?alt=media&token=328ee27e-392a-4d42-8cfa-2fd5c1a4d798'],
                                ['name' => 'Hafith Muhammad Fauzan', 'role' => 'Angkatan II SMK TI BAZMA', 'img' => 'https://firebasestorage.googleapis.com/v0/b/explorefireb4se.appspot.com/o/created-by%2Fdragon_9.png?alt=media&token=4962f725-90f8-4efa-84bd-07793e40b929'],
                                ['name' => 'Syahban Syahputra', 'role' => 'Angkatan II SMK TI BAZMA', 'img' => 'https://firebasestorage.googleapis.com/v0/b/explorefireb4se.appspot.com/o/created-by%2Fdragon_10.png?alt=media&token=fc01610c-e9ac-4141-9c31-712ece4452ed'],
                                ['name' => 'Hanif Gibran Syidiq', 'role' => 'Angkatan II SMK TI BAZMA', 'img' => 'https://firebasestorage.googleapis.com/v0/b/explorefireb4se.appspot.com/o/created-by%2Fdragon_11.png?alt=media&token=28c529fc-f416-458d-9315-cfedd2059f8c'],
                                ['name' => 'Damar Nugroho Utomo', 'role' => 'Angkatan XXIV SMKN 1 Cibinong', 'img' => 'https://wallpapercave.com/uwp/uwp4887476.jpeg'],
                                ['name' => 'Rizki Zikrillah', 'role' => 'Angkatan XXIV SMKN 1 Cibinong', 'img' => 'https://wallpapercave.com/uwp/uwp4887508.jpeg'],
                            ];
                            // Tampilkan semua card tanpa batasan
                        @endphp
                        @foreach ($creators as $creator)
                            <div class="creator-card">
                                <img src="{{ $creator['img'] }}" alt="{{ $creator['name'] }}" class="creator-img"
                                    loading="lazy">
                                <div class="creator-name">{{ $creator['name'] }}</div>
                                <div class="creator-role">{{ $creator['role'] }}</div>
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>
            <div style="margin-top: 24px; text-align:center; font-size: 0.95rem; color:#222;">
                <b>SISMAKO</b> &copy; {{ date('Y') }} - Sistem Manajemen Sekolah
            </div>
        </div>
    </footer>
@endsection
