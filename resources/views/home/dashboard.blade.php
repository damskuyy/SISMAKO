@extends('layouts.app')


@section('content')
    @include('database.inc.form')


    <head>
        <style>
            /* Styling for images */
            .img-icons {
                width: 70px;
                height: auto;
                background: transparent;
                display: block;
            }

            .row.g-3 { 
                align-items: stretch; 
            }
            .row.g-3 .col-lg-3 { 
                display: flex; 
            }

            .card.card-bordered {
                flex: 1 1 auto;
                display: flex;
                flex-direction: column;
                justify-content: center;
                padding: 18px;
                border-radius: 12px;
                box-shadow: 0 6px 18px rgba(0,0,0,0.06);
                color: #fff;
                min-height: 170px;
            }

            .card.card-bordered .card-body {
                display: flex;
                align-items: center;
                gap: 18px;
                width: 100%;
                flex: 1 1 auto;
            }

            .card .content-body-1 h2,
            .card .content-body-2-1 h1,
            .card .content-body-2-2 h1 {
                margin: 0;
            }

            .card .content-body-2 { 
                display:flex; align-items:center; width:100%; 
            }


            /* Styling for cards */
            .card {
                transition: transform 0.3s ease, box-shadow 0.3s ease;
                border-radius: 10px;
                padding: 15px;
                color: #fff;
            }


            .card:hover {
                transform: translateY(-10px);
                box-shadow: 0 4px 20px rgba(0, 0, 0, 0.2);
            }


            /* Styling for card body */
            .card-body {
                display: flex;
                align-items: center;
                gap: 10px;
            }


            .content-body-1 img {
                transition: transform 0.5s ease-in-out;
            }


            .content-body-2-1 img {
                transition: transform 0.5s ease-in-out;
            }


            .content-body-2-1:hover img {
                transform: scale(1.5);
            }


            .content-body-1:hover img {
                transform: scale(1.5);
            }


            .btn-group a {
                margin-right: 10px;
            }


            /* Card Colors */
            .card-guru {
                background-image: linear-gradient(to top, #f77062 0%, #fe5196 100%);
            }


            .card-siswa {
                background-image: linear-gradient(to top, #00c6fb 0%, #005bea 100%);
            }


            .card-mutasi {
                background-image: linear-gradient(-60deg, #ff5858 0%, #f09819 100%);
            }


            .card-award {
                background-image: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            }


            .card-tendik {
                background-image: linear-gradient(to top, #4da0ff 0%, #005bea 100%);
            }


            .card-kelas {
                background-image: linear-gradient(120deg, #6dd5fa 0%, #2980b9 100%);
            }


            .card-kelulusan {
                background-image: linear-gradient(120deg, #ffb347 0%, #ffcc33 100%);
            }


            .card-pkl {
                background-image: linear-gradient(120deg, #7ee8fa 0%, #4ac29a 100%);
            }
        </style>
    </head>
    <script>
        async function toHref(url) {
            window.location.href = url;
        }
    </script>
    <div class="py-12 container mt-4">
        <div class="row g-3">
            <div class="col-lg-3">
                <div class="card card-bordered card-guru" style="cursor: pointer" onclick="toHref('/guru')">
                    <div class="card-body d-flex" style="gap: 25px">
                        <div class="content-body-1" style="width: 35%">
                            <img src="https://firebasestorage.googleapis.com/v0/b/explorefireb4se.appspot.com/o/Icons%2Ftraining-unscreen.gif?alt=media&token=dd862696-345f-49af-bc58-112a58b02026" alt="" class="img-icons">
                            <h2>Tendik</h2>
                        </div>
                        <div class="content-body-2 d-flex justify-content-center align-items-center"
                            style="gap: 20px; width: 100%">
                            <div class="content-body-2-1">
                                <div class="content-body-2-3">
                                    <h2 class="text-center">Data Tenaga Pendidik SMK TI Bazma</h2>
                                </div>
                            </div>
                        </div>
                        {{-- <div class="content-body-2 d-flex justify-content-center align-items-center"
                            style="gap: 20px; width: 100%">
                            <div class="content-body-2-1">
                                <h3 class="text-center">Tendik Aktif :</h3>
                                <h2 class="text-center"> {{ $totalGuruAktif }} Tendik</h2>
                            </div>
                        </div> --}}
                        {{-- <div class="content-body-2 d-flex" style="gap: 20px; width: 100%">
                            <div class="content-body-2-1" style="width: 50%">
                                <h3 class="text-center">Active</h3>
                                <h1 class="text-center">{{ $totalGuruAktif }}</h1>
                            </div>
                            <div class="content-body-2-2" style="width: 50%">
                                <h3 class="text-center">Off</h3>
                                <h1 class="text-center">{{ $totalGuruTidakAktif }}</h1>
                            </div>
                        </div> --}}
                    </div>
                </div>
            </div>
            <div class="col-lg-3">
                <div class="card card-bordered card-siswa" style="cursor: pointer" onclick="toHref('/siswa')">
                    <div class="card-body d-flex" style="gap: 25px">
                        <div class="content-body-1" style="width: 35%">
                            <img src="https://firebasestorage.googleapis.com/v0/b/explorefireb4se.appspot.com/o/Icons%2Fstudent.gif?alt=media&token=c79b09d9-bc3e-4a2f-853e-0c8e8efdd32f" alt="" class="img-icons">
                            <h2>Siswa</h2>
                        </div>
                        <div class="content-body-2 d-flex justify-content-center align-items-center"
                            style="gap: 20px; width: 100%">
                            <div class="content-body-2-1">
                                <div class="content-body-2-3">
                                    <h2 class="text-center">Data Siswa SMK TI Bazma</h2>
                                </div>
                            </div>
                        </div>
                        {{-- <div class="content-body-2 d-flex justify-content-center align-items-center"
                            style="gap: 20px; width: 100%">
                            <div class="content-body-2-1">
                                <h3 class="text-center">Siswa Aktif :</h2>
                                <h2 class="text-center"> {{ $totalSiswaAktif }} Siswa</h2>
                            </div>
                        </div> --}}
                        {{-- <div class="content-body-2 d-flex" style="gap: 20px; width: 100%">
                            <div class="content-body-2-1" style="width: 50%">
                                <h3 class="text-center">Active</h3>
                                <h1 class="text-center">{{ $totalSiswaAktif }}</h1>
                            </div>
                            <div class="content-body-2-2" style="width: 50%">
                                <h3 class="text-center">Off</h3>
                                <h1 class="text-center">{{ $totalSiswaTidakAktif }}</h1>
                            </div>
                        </div> --}}
                    </div>
                </div>
            </div>
            <div class="col-lg-3">
                <div class="card card-bordered card-mutasi" style="cursor: pointer" onclick="toHref('/data-mutasi')">
                    <div class="card-body d-flex" style="gap: 25px">
                        <div class="content-body-1" style="width: 35%">
                            <img src="https://res.cloudinary.com/dqzc35nrh/image/upload/v1760928566/notebook-unscreen_jhjz8d.gif" alt="" class="img-icons">
                            <h2>Mutasi</h2>
                        </div>
                        <div class="content-body-2 d-flex justify-content-center align-items-center"
                            style="gap: 20px; width: 100%">
                            <div class="content-body-2-1">
                                <div class="content-body-2-3">
                                    <h2 class="text-center">Data Mutasi Siswa dan Guru</h2>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-3">
                <div class="card card-bordered card-award" style="cursor: pointer">
                    <div class="card-body d-flex" style="gap: 25px">
                        <div class="content-body-1" style="width: 35% display: grid; justify-items: center" onclick="toHref('/data-prestasi')">
                            <img src="https://firebasestorage.googleapis.com/v0/b/explorefireb4se.appspot.com/o/Icons%2Ftrophy-unscreen.gif?alt=media&token=006d9110-a018-4cc1-a730-785acfa81bc7" alt="" class="img-icons">
                            <h2>Award</h2>
                        </div>
                        <div style="gap: 20px; width: 100%;" onclick="toHref('/punishment')">
                            <div class="content-body-2-1" style="display: grid; justify-items: center">
                                <img src="https://firebasestorage.googleapis.com/v0/b/explorefireb4se.appspot.com/o/Icons%2Faxe-unscreen.gif?alt=media&token=ef928527-08e3-4c76-b8f0-1873fbdbdd20" alt="" class="img-icons"
                                    style="width: 60px;">
                                <h3 style="font-size: 19px">Punishment</h3>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-3">
                <div class="card card-bordered card-tendik" style="cursor: pointer" onclick="toHref('/tendik')">
                    <div class="card-body d-flex" style="gap: 25px">
                        <div class="content-body-1">
                            <img src="https://firebasestorage.googleapis.com/v0/b/explorefireb4se.appspot.com/o/Icons%2Fprofessor.gif?alt=media&token=7fe89df6-94d3-4db7-86a5-c865cf2fb1ac" alt="" class="img-icons">
                            <h2 class="">Staff</h2>
                        </div>
                        <div class="content-body-2 d-flex justify-content-center align-items-center"
                            style="gap: 20px; width: 100%">
                            <div class="content-body-2-1">
                                <div class="content-body-2-3">
                                    <h2 class="text-center">Data Staff SMK TI Bazma</h2>
                                </div>
                            </div>
                        </div>
                        {{-- <div class="content-body-2 d-flex justify-content-center align-items-center"
                            style="gap: 20px; width: 100%">
                            <div class="content-body-2-1">
                                <h2 class="text-center">Staff Aktif :</h2>
                                <h2 class="text-center"> {{ $totalTendikAktif }} Staff</h2>
                            </div>
                        </div> --}}
                        {{-- <div class="content-body-2 d-flex justify-content-center align-items-center"
                            style="gap: 20px; width: 100%">
                            <div class="content-body-2 d-flex" style="gap: 20px; width: 100%">
                                <div class="content-body-2-1" style="width: 50%">
                                    <h3 class="text-center ">Active</h3>
                                    <h1 class="text-center ">{{ $totalTendikAktif }}</h1>
                                </div>
                                <div class="content-body-2-2" style="width: 50%">
                                    <h3 class="text-center ">Off</h3>
                                    <h1 class="text-center ">{{ $totalTendikTidakAktif }}</h1>
                                </div>
                            </div>
                        </div> --}}
                    </div>
                </div>
            </div>
            <div class="col-lg-3">
                <div class="card card-bordered card-kelas" style="cursor: pointer" onclick="toHref('/kelas')">
                    <div class="card-body d-flex" style="gap: 25px">
                        <div class="content-body-1" style="width: 35%">
                            <img src="https://firebasestorage.googleapis.com/v0/b/explorefireb4se.appspot.com/o/Icons%2Fsearch-book-unscreen.gif?alt=media&token=72708d0c-ac38-4eea-98e3-94d05d263010" alt=""
                                class="img-icons">
                            <h2>Kelas</h2>
                        </div>
                        <div class="content-body-2 d-flex justify-content-center align-items-center"
                            style="gap: 20px; width: 100%">
                            <div class="content-body-2-1">
                                <h2 class="text-center">Data Peserta Didik Perkelas</h2>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-3">
                <div class="card card-bordered card-kelulusan" style="cursor: pointer" onclick="toHref('/kelulusan')">
                    <div class="card-body d-flex" style="gap: 25px">
                        <div class="content-body-1" style="width: 35%">
                            <img src="https://firebasestorage.googleapis.com/v0/b/explorefireb4se.appspot.com/o/Icons%2Feducation.gif?alt=media&token=3a16b136-b068-479d-bfbb-ee4cbe544e50" alt="" class="img-icons">
                            <h3>Lulusan</h3>
                        </div>
                        <div class="content-body-2 d-flex justify-content-center align-items-center"
                            style="gap: 20px; width: 100%">
                            <div class="content-body-2-1">
                                <div class="content-body-2-3">
                                    <h2 class="text-center">Data Kelulusan Siswa SMK TI Bazma</h2>
                                </div>
                            </div>
                        </div>
                        {{-- <div class="content-body-2 d-flex justify-content-center align-items-center"
                            style="gap: 20px; width: 100%">
                            <div class="content-body-2-1">
                                <h2 class="text-center">Data Kelulusan {{ $totalKelulusanSiswa }}</h2>
                            </div>
                        </div> --}}
                    </div>
                </div>
            </div>
            <div class="col-lg-3">
                <div class="card card-bordered card-pkl" style="cursor: pointer" onclick="toHref('/pkl')">
                    <div class="card-body d-flex" style="gap: 25px">
                        <div class="content-body-1" style="width: 35%">
                            <img src="https://firebasestorage.googleapis.com/v0/b/explorefireb4se.appspot.com/o/Icons%2Fdigital-nomad-unscreen.gif?alt=media&token=08c6f4c5-beb7-4dae-9b5c-1e4f0542d1a7" alt=""
                                class="img-icons">
                            <h2>PKL</h2>
                        </div>
                        <div class="content-body-2 d-flex justify-content-center align-items-center"
                            style="gap: 20px; width: 100%">
                            <div class="content-body-2-1">
                                <div class="content-body-2-3">
                                    <h2 class="text-center">Data Siswa Praktek Kerja Lapangan</h2>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
