@extends('layouts.app')

@section('content')
<link rel="stylesheet" href="{{ asset('dist/css/style.css') }}">
    <div class="banner">
        <div class="slider" style="--quantity: 11">
            @for ($i = 1; $i <= 11; $i++)
                <div class="item" style="--position: {{ $i }}">
                    <img src="{{ asset('dist/img/createdBy/dragon_' . $i . '.jpg') }}" alt="">
                    <div class="overlay">
                        @if ($i == 1)
                            <h3>Ahmad Dahlan, S.Ag</h3>
                            <p>Kepala SMK TI BAZMA (Inisiator & Pembuat Skema Alur Kerja)</p>
                        @elseif($i == 2)
                            <h3 class="long-name">I Gde Bayu Priyambada M. S.Kom</h3>
                            <p>Kepala LABKOM & Guru IT</p>
                        @elseif($i == 3)
                            <h3>Fadhil Rabbani XII</h3>
                            <p>Project Database</p>
                        @elseif($i == 4)
                            <h3>Mufiz Ihsanulhaq XII</h3>
                            <p>Project Penilaian</p>
                        @elseif($i == 5)
                            <h3>Attar Rifai XII</h3>
                            <p>Project Sarpras </p>
                        @elseif($i == 6)
                            <h3>Muhammad Abdullah Al-Aziz XII</h3>
                            <p>Project Korespondensi </p>
                        @elseif($i == 7)
                            <h3>Muhammad Saeful Romadhon XII</h3>
                            <p>Project Administrasi Keguruan</p>
                        @elseif($i == 8)
                            <h3>Gemi Widodo XII</h3>
                            <p>Project PKG</p>
                        @elseif($i == 9)
                            <h3>Hafith Muhammad Fauzan XII</h3>
                            <p>Project PKG</p>
                        @elseif($i == 10)
                            <h3>Syahban Syahputra XII</h3>
                            <p>Project Keuangan</p>
                        @elseif($i == 11)
                            <h3>Hanif Gibran Syidiq XII</h3>
                            <p>Project Keuangan</p>
                        @endif
                    </div>
                </div>
            @endfor
        </div>

        <div class="content">
            <div class="author">
                <h2>SISMAKO</h2>
                <p><b>Sistem Manajemen Sekolah</b></p>
                <p>
                    Sistem integrasi data dan administrasi sekolah otomatis.
                </p>
            </div>
        </div>
    </div>
@endsection

