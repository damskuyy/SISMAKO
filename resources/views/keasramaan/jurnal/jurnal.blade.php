@extends('layouts.app')


@section('content')
    @include('database.inc.form')
    <div class="py-5">
        <div class="container">
            <div class="row">
                <div class="col-12 row">
                    <div class="mb-4">
                        <a href="/sekolah-keasramaan" class="btn btn-secondary">
                            Back
                        </a>
                    </div>
                    <!-- Card 1 -->
                    <div class="col-md-3">
                        <a href="/sekolah-keasramaan/jurnal-asrama/akhlak" class="text-decoration-none">
                            <div class="card shadow-sm mb-4 hover-shadow" style="background-color:  rgba(255, 0, 0, 0.25);">
                                <div class="card-body d-flex align-items-center">
                                    <img src="https://firebasestorage.googleapis.com/v0/b/explorefireb4se.appspot.com/o/Icons%2FEq.gif?alt=media&token=35534cdf-18be-4573-8ad8-e8dca9f5eef1" alt=""
                                        style="width: 50%; height: auto; margin-right: 16px;">
                                    <h2 class="card-title text-xl font-semibold mb-0"
                                        style="font-size: 1.5rem; font-family: 'Poppins', sans-serif; font-weight: bold; color: white;">
                                        Akhlak
                                    </h2>
                                </div>
                            </div>
                        </a>
                    </div>
                    <div class="col-md-3">
                        <a href="/sekolah-keasramaan/jurnal-asrama/fiqih" class="text-decoration-none">
                            <div class="card shadow-sm mb-4 hover-shadow"
                                style="background-color:  rgba(0, 123, 255, 0.25);">
                                <div class="card-body d-flex align-items-center">
                                    <img src="https://firebasestorage.googleapis.com/v0/b/explorefireb4se.appspot.com/o/Icons%2FAllah.gif?alt=media&token=07f48cb0-ecd0-43fe-ad7c-12377c06bd52" alt=""
                                        style="width: 50%; height: auto; margin-right: 16px;">
                                    <h2 class="card-title text-xl font-semibold mb-0"
                                        style="font-size: 1.5rem; font-family: 'Poppins', sans-serif; font-weight: bold; color: white;">
                                        Fiqih
                                    </h2>
                                </div>
                            </div>
                        </a>
                    </div>
                    <div class="col-md-3">
                        <a href="/sekolah-keasramaan/jurnal-asrama/tafsir" class="text-decoration-none">
                            <div class="card shadow-sm mb-4 hover-shadow" style="background-color:  rgba(0, 128, 0, 0.25);">
                                <div class="card-body d-flex align-items-center">
                                    <img src="https://firebasestorage.googleapis.com/v0/b/explorefireb4se.appspot.com/o/Icons%2Fdictionary.gif?alt=media&token=8ad812de-9089-4550-8506-ea44cbb8b12f" alt=""
                                        style="width: 50%; height: auto; margin-right: 16px;">
                                    <h2 class="card-title text-xl font-semibold mb-0"
                                        style="font-size: 1.5rem; font-family: 'Poppins', sans-serif; font-weight: bold; color: white;">
                                        Tafsir
                                    </h2>
                                </div>
                            </div>
                        </a>
                    </div>
                    <div class="col-md-3">
                        <a href="/sekolah-keasramaan/jurnal-asrama/tajwid" class="text-decoration-none">
                            <div class="card shadow-sm mb-4 hover-shadow" style="background-color:  rgba(0, 128, 0, 0.25);">
                                <div class="card-body d-flex align-items-center">
                                    <img src="https://firebasestorage.googleapis.com/v0/b/explorefireb4se.appspot.com/o/Icons%2Fread.gif?alt=media&token=a7c1c407-a9c0-4fd3-bb44-8da5d1f3ace4" alt=""
                                        style="width: 50%; height: auto; margin-right: 16px;">
                                    <h2 class="card-title text-xl font-semibold mb-0"
                                        style="font-size: 1.5rem; font-family: 'Poppins', sans-serif; font-weight: bold; color: white;">
                                        Tajwid
                                    </h2>
                                </div>
                            </div>
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
