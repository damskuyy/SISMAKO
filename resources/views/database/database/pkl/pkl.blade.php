@extends('layouts.app')

@section('content')

    <div class="container mt-4">
        <a href="{{route('dashboard')}}" class="btn btn-secondary">Back</a>
    </div>
    <div class="py-12 container mt-4">
        <div class="row g-3">
            <div class="col-lg-6">
                <div class="card card-bordered card-kelulusan" style="cursor: pointer" onclick="toHref('/pkl/adm-sekolah')">
                    <div class="card-body d-flex" style="gap: 25px">
                        <div class="content-body-1" style="width: 35%">
                            <img src="https://res.cloudinary.com/dqzc35nrh/image/upload/v1761117217/school_l31ags.gif" alt="" class="img-icons">
                        </div>
                        <div class="content-body-2 d-flex justify-content-center align-items-center"
                            style="gap: 20px; width: 100%">
                            <div class="content-body-2-1">
                                <h2 class="text-center">Data Perusahaan</h2>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-6">
                <div class="card card-bordered card-kelulusan" style="cursor: pointer" onclick="toHref('/pkl/adm-siswa')">
                    <div class="card-body d-flex" style="gap: 25px">
                        <div class="content-body-1" style="width: 35%">
                            <img src="https://res.cloudinary.com/dqzc35nrh/image/upload/v1761117249/student-unscreen_kozokt.gif" alt="" class="img-icons">
                        </div>
                        <div class="content-body-2 d-flex justify-content-center align-items-center"
                            style="gap: 20px; width: 100%">
                            <div class="content-body-2-1">
                                <h2 class="text-center">Data Siswa PKL</h2>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script>
        async function toHref(link) {
            window.location.href = link;
        }
    </script>
@endsection
