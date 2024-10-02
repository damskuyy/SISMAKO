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
                        <a href="/sekolah-keasramaan/akademik/pelatihan" class="text-decoration-none">
                            <div class="card shadow-sm mb-4 hover-shadow" style="background-color:  rgba(255, 0, 0, 0.25);">
                                <div class="card-body d-flex align-items-center">
                                    <img src="https://firebasestorage.googleapis.com/v0/b/explorefireb4se.appspot.com/o/Icons%2Fpresentation.gif?alt=media&token=bfb568b1-0a5f-4c8d-9d1a-1d39b1140f29" alt=""
                                        style="width: 50%; height: auto; margin-right: 16px;">
                                    <h2 class="card-title text-xl font-semibold mb-0"
                                        style="font-size: 1.5rem; font-family: 'Poppins', sans-serif; font-weight: bold; color: white;">
                                        Pelatihan
                                    </h2>
                                </div>
                            </div>
                        </a>
                    </div>
                    <div class="col-md-4">
                        <a href="/sekolah-keasramaan/akademik/lomba" class="text-decoration-none">
                            <div class="card shadow-sm mb-4 hover-shadow"
                                style="background-color:  rgba(0, 123, 255, 0.25);">
                                <div class="card-body d-flex align-items-center">
                                    <img src="https://firebasestorage.googleapis.com/v0/b/explorefireb4se.appspot.com/o/Icons%2FPodium.gif?alt=media&token=f49d2aca-5f00-4ca1-823f-02749a55eb0c" alt=""
                                        style="width: 50%; height: auto; margin-right: 16px;">
                                    <h2 class="card-title text-xl font-semibold mb-0"
                                        style="font-size: 1.5rem; font-family: 'Poppins', sans-serif; font-weight: bold; color: white;">
                                        Lomba
                                    </h2>
                                </div>
                            </div>
                        </a>
                    </div>
                    <div class="col-md-4">
                        <a href="/sekolah-keasramaan/akademik/eventual" class="text-decoration-none">
                            <div class="card shadow-sm mb-4 hover-shadow" style="background-color:  rgba(0, 128, 0, 0.25);">
                                <div class="card-body d-flex align-items-center">
                                    <img src="https://firebasestorage.googleapis.com/v0/b/explorefireb4se.appspot.com/o/Icons%2Fidea.gif?alt=media&token=b6dd2565-fb6b-47e2-9bb2-7fe1add9ec9d" alt=""
                                        style="width: 50%; height: auto; margin-right: 16px;">
                                    <h2 class="card-title text-xl font-semibold mb-0"
                                        style="font-size: 1.5rem; font-family: 'Poppins', sans-serif; font-weight: bold; color: white;">
                                        Eventual
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
