@extends('layouts.app')


@section('content')
    @include('database.inc.form')


    <head>
        <style>
            /* Styling for images */
            .img-icons {
                width: 75px;
                background: transparent;
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
                background-image: linear-gradient(to top, #cfd9df 0%, #e2ebf0 100%);
            }


            .card-kelas {
                background-image: linear-gradient(120deg, #a1c4fd 0%, #c2e9fb 100%);
            }


            .card-kelulusan {
                background-image: linear-gradient(120deg, #f6d365 0%, #fda085 100%);
            }


            .card-pkl {
                background-image: linear-gradient(120deg, #84fab0 0%, #8fd3f4 100%);
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
                            <h2>Guru</h2>
                        </div>
                        <div class="content-body-2 d-flex" style="gap: 20px; width: 100%">
                            <div class="content-body-2-1" style="width: 50%">
                                <h3 class="text-center">Active</h3>
                                <h1 class="text-center">{{ $totalGuruAktif }}</h1>
                            </div>
                            <div class="content-body-2-2" style="width: 50%">
                                <h3 class="text-center">Off</h3>
                                <h1 class="text-center">{{ $totalGuruTidakAktif }}</h1>
                            </div>
                        </div>
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
                        <div class="content-body-2 d-flex" style="gap: 20px; width: 100%">
                            <div class="content-body-2-1" style="width: 50%">
                                <h3 class="text-center">Active</h3>
                                <h1 class="text-center">{{ $totalSiswaAktif }}</h1>
                            </div>
                            <div class="content-body-2-2" style="width: 50%">
                                <h3 class="text-center">Off</h3>
                                <h1 class="text-center">{{ $totalSiswaTidakAktif }}</h1>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-3">
                <div class="card card-bordered card-mutasi" style="cursor: pointer" onclick="toHref('/data-mutasi')">
                    <div class="card-body d-flex" style="gap: 25px">
                        <div class="content-body-1" style="width: 35%">
                            <img src="https://firebasestorage.googleapis.com/v0/b/explorefireb4se.appspot.com/o/Icons%2Fexit-unscreen.gif?alt=media&token=3564a9ba-6be5-4635-8917-653e104136ac" alt="" class="img-icons">
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
                        <div class="content-body-1" style="width: 35%" onclick="toHref('/data-prestasi')">
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
                            <h2 class="text-black">Tendik</h2>
                        </div>
                        <div class="content-body-2 d-flex justify-content-center align-items-center"
                            style="gap: 20px; width: 100%">
                            <div class="content-body-2 d-flex" style="gap: 20px; width: 100%">
                                <div class="content-body-2-1" style="width: 50%">
                                    <h3 class="text-center text-black">Active</h3>
                                    <h1 class="text-center text-black">{{ $totalTendikAktif }}</h1>
                                </div>
                                <div class="content-body-2-2" style="width: 50%">
                                    <h3 class="text-center text-black">Off</h3>
                                    <h1 class="text-center text-black">{{ $totalTendikTidakAktif }}</h1>
                                </div>
                            </div>
                        </div>
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
                            <h2 style="margin: 0">Lulusan</h2>
                        </div>
                        <div class="content-body-2 d-flex justify-content-center align-items-center"
                            style="gap: 20px; width: 100%">
                            <div class="content-body-2-1">
                                <h2 class="text-center">Data Kelulusan {{ $totalKelulusanSiswa }} Orang</h2>
                            </div>
                        </div>
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
                                <h2 class="text-center">Data PKL</h2>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
