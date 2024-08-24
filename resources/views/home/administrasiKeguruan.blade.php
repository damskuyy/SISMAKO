@extends('layouts.app')

@section('content')
    <style>
        .bg-red {
            background-color: rgba(255, 0, 0, 0.5);
        }
    </style>
    <div>
        <div class="py-12"">
            <div class="container">
                <div class="row">
                    <div class="col-md-4">
                        <a href="administrasi-keguruan/mapel" class="text-decoration-none">
                            <div class="card bg-red shadow-sm mb-4 hover-shadow">
                                <div class="card-body d-flex align-items-center">
                                    <img src="{{ asset('dist/img/gif/mapel-unscreen.gif') }}" alt=""
                                        style="width: 50%; height: auto; margin-right: 16px;">
                                    <h2 class="card-title text-xl font-semibold mb-0"
                                        style="font-size: 1.5rem; font-family: 'Poppins', sans-serif; font-weight: bold; color: white">
                                        Mata Pelajaran
                                    </h2>
                                </div>
                            </div>
                        </a>
                    </div>
                    <div class="col-md-4">
                        <a href="#" class="text-decoration-none">
                            <div class="card bg-red shadow-sm mb-4 hover-shadow">
                                <div class="card-body d-flex align-items-center">
                                    <img src="{{ asset('dist/img/gif/bk-unscreen.gif') }}" alt=""
                                        style="width: 50%; height: auto; margin-right: 16px;">
                                    <h2 class="card-title text-xl font-semibold mb-0"
                                        style="font-size: 1.5rem; font-family: 'Poppins', sans-serif; font-weight: bold; color: white">
                                        Bimbingan Konseling
                                    </h2>
                                </div>
                            </div>
                        </a>
                    </div>
                    <div class="col-md-4">
                        <a href="administrasi-keguruan/kepalaLabKom" class="text-decoration-none">
                            <div class="card bg-red shadow-sm mb-4 hover-shadow">
                                <div class="card-body d-flex align-items-center">
                                    <img src="{{ asset('dist/img/gif/lab-unscreen.gif') }}" alt=""
                                        style="width: 50%; height: auto; margin-right: 16px;">
                                    <h2 class="card-title text-xl font-semibold mb-0"
                                        style="font-size: 1.5rem; font-family: 'Poppins', sans-serif; font-weight: bold; color: white">
                                        Kepala LABKOM
                                    </h2>
                                </div>
                            </div>
                        </a>
                    </div>
                    <div class="col-md-3">
                        <a href="administrasi-keguruan/osis" class="text-decoration-none">
                            <div class="card bg-blue shadow-sm mb-4 hover-shadow">
                                <div class="card-body d-flex align-items-center">
                                    <img src="{{ asset('dist/img/gif/student-unscreen.gif') }}" alt=""
                                        style="width: 50%; height: auto; margin-right: 16px;">
                                    <h2 class="card-title text-xl font-semibold mb-0"
                                        style="font-size: 1.5rem; font-family: 'Poppins', sans-serif; font-weight: bold; color: white">
                                        OSIS SMK</h2>
                                </div>
                            </div>
                        </a>
                    </div>
                    <div class="col-md-3">
                        <a href="administrasi-keguruan/perpustakaan" class="text-decoration-none">
                            <div class="card bg-blue shadow-sm mb-4 hover-shadow">
                                <div class="card-body d-flex align-items-center">
                                    <img src="{{ asset('dist/img/gif/shelves-unscreen.gif') }}" alt=""
                                        style="width: 50%; height: auto; margin-right: 16px;">
                                    <h2 class="card-title text-xl font-semibold mb-0"
                                        style="font-size: 1.5rem; font-family: 'Poppins', sans-serif; font-weight: bold; color: white">
                                        Library</h2>
                                </div>
                            </div>
                        </a>
                    </div>
                    <div class="col-md-3">
                        <a href="administrasi-keguruan/walas" class="text-decoration-none">
                            <div class="card bg-blue shadow-sm mb-4 hover-shadow">
                                <div class="card-body d-flex align-items-center">
                                    <img src="{{ asset('dist/img/gif/professor-unscreen.gif') }}" alt=""
                                        style="width: 50%; height: auto; margin-right: 16px;">
                                    <h2 class="card-title text-xl font-semibold mb-0"
                                        style="font-size: 1.5rem; font-family: 'Poppins', sans-serif; font-weight: bold; color: white">
                                        Wali Kelas</h2>
                                </div>
                            </div>
                        </a>
                    </div>
                    <div class="col-md-3">
                        <a href="administrasi-keguruan/kepsek" class="text-decoration-none">
                            <div class="card bg-blue shadow-sm mb-4 hover-shadow">
                                <div class="card-body d-flex align-items-center">
                                    <img src="{{ asset('dist/img/gif/headmaster-unscreen.gif') }}" alt=""
                                        style="width: 50%; height: auto; margin-right: 16px;">
                                    <h2 class="card-title text-xl font-semibold mb-0"
                                        style="font-size: 1.5rem; font-family: 'Poppins', sans-serif; font-weight: bold; color: white">
                                        Kepala Sekolah</h2>
                                </div>
                            </div>
                        </a>
                    </div>
                    <div class="col-md-4">
                        <a href="administrasi-keguruan/waka-kurikulum" class="text-decoration-none">
                            <div class="card bg-green shadow-sm mb-4 hover-shadow">
                                <div class="card-body d-flex align-items-center">
                                    <img src="{{ asset('dist/img/gif/approved-unscreen.gif') }}" alt=""
                                        style="width: 50%; height: auto; margin-right: 16px;">
                                    <h2 class="card-title text-xl font-semibold mb-0"
                                        style="font-size: 1.5rem; font-family: 'Poppins', sans-serif; font-weight: bold; color: white">
                                        Waka Kurikulum</h2>
                                </div>
                            </div>
                        </a>
                    </div>
                    <div class="col-md-4">
                        <a href="administrasi-keguruan/waka-kesiswaan" class="text-decoration-none">
                            <div class="card bg-green shadow-sm mb-4 hover-shadow">
                                <div class="card-body d-flex align-items-center">
                                    <img src="{{ asset('dist/img/gif/kesiswaan-unscreen.gif') }}" alt=""
                                        style="width: 50%; height: auto; margin-right: 16px;">
                                    <h2 class="card-title text-xl font-semibold mb-0"
                                        style="font-size: 1.5rem; font-family: 'Poppins', sans-serif; font-weight: bold; color: white">
                                        Waka Kesiswaan</h2>
                                </div>
                            </div>
                        </a>
                    </div>

                    <div class="col-md-4">
                        <a href="administrasi-keguruan/supervisi" class="text-decoration-none">
                            <div class="card bg-green shadow-sm mb-4 hover-shadow">
                                <div class="card-body d-flex align-items-center">
                                    <img src="{{ asset('dist/img/gif/supervisi-unscreen.gif') }}" alt=""
                                        style="width: 50%; height: auto; margin-right: 16px;">
                                    <h2 class="card-title text-xl font-semibold mb-0"
                                        style="font-size: 1.5rem; font-family: 'Poppins', sans-serif; font-weight: bold; color: white">
                                        Supervisi</h2>
                                </div>
                            </div>
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
