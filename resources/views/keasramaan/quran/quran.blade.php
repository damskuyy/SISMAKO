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
                    <div class="col-md-4">
                        <a href="/sekolah-keasramaan/al-quran/tahfidz" class="text-decoration-none">
                            <div class="card shadow-sm mb-4 hover-shadow" style="background-color:  rgba(255, 0, 0, 0.25);">
                                <div class="card-body d-flex align-items-center">
                                    <img src="https://firebasestorage.googleapis.com/v0/b/explorefireb4se.appspot.com/o/Icons%2Frub-el-hizb.gif?alt=media&token=ea70d78b-28e5-4223-8b7f-af30772890ae" alt=""
                                        style="width: 50%; height: auto; margin-right: 16px;">
                                    <h2 class="card-title text-xl font-semibold mb-0"
                                        style="font-size: 1.5rem; font-family: 'Poppins', sans-serif; font-weight: bold; color: white;">
                                        Tahfidz
                                    </h2>
                                </div>
                            </div>
                        </a>
                    </div>
                    <div class="col-md-4">
                        <a href="/sekolah-keasramaan/al-quran/tahsin" class="text-decoration-none">
                            <div class="card shadow-sm mb-4 hover-shadow"
                                style="background-color:  rgba(0, 123, 255, 0.25);">
                                <div class="card-body d-flex align-items-center">
                                    <img src="https://firebasestorage.googleapis.com/v0/b/explorefireb4se.appspot.com/o/Icons%2Frecomendation.gif?alt=media&token=63cef42f-52eb-4ec8-a121-0f144fcdcbf3" alt=""
                                        style="width: 50%; height: auto; margin-right: 16px;">
                                    <h2 class="card-title text-xl font-semibold mb-0"
                                        style="font-size: 1.5rem; font-family: 'Poppins', sans-serif; font-weight: bold; color: white;">
                                        Tahsin
                                    </h2>
                                </div>
                            </div>
                        </a>
                    </div>
                    <div class="col-md-4">
                        <a href="/sekolah-keasramaan/al-quran/sertif" class="text-decoration-none">
                            <div class="card shadow-sm mb-4 hover-shadow" style="background-color:  rgba(0, 128, 0, 0.25);">
                                <div class="card-body d-flex align-items-center">
                                    <img src="https://firebasestorage.googleapis.com/v0/b/explorefireb4se.appspot.com/o/Icons%2Fcertificate.gif?alt=media&token=7e610a3e-cd80-4a12-a315-4b37e99d851a" alt=""
                                        style="width: 50%; height: auto; margin-right: 16px;">
                                    <h2 class="card-title text-xl font-semibold mb-0"
                                        style="font-size: 1.5rem; font-family: 'Poppins', sans-serif; font-weight: bold; color: white;">
                                        Sertifikat
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
