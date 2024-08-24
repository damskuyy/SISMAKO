@extends('layouts.app')

@section('content')
    <div class="py-12">
        <div class="container">
            <div class="row">
                <div class="col-md-6">
                    <div class="card bg-white shadow-sm mb-4">
                        <div class="card-body">
                            <h2 class="card-title text-xl font-semibold mb-4">Administrasi Ujian</h2>
                            <p class="card-text mb-4">Kelola ujian dan file-file terkait.</p>
                            <a href="{{ route('pts') }}" class="btn btn-primary">
                                Pergi ke PTS
                            </a>
                            <a href="{{ route('pas') }}" class="btn btn-primary">
                                Pergi ke PAS
                            </a>
                            <a href="{{ route('pat') }}" class="btn btn-primary">
                                Pergi ke PAT
                            </a>
                        </div>
                    </div>
                </div>

                <!-- Card 2 -->
                <div class="col-md-6">
                    <div class="card bg-white shadow-sm mb-4">
                        <div class="card-body">
                            <h2 class="card-title text-xl font-semibold mb-4">Rapor</h2>
                            <p class="card-text mb-4">Melihat dan mengelola rapor siswa.</p>
                            <a href="{{ route('rapor') }}" class="btn btn-success">
                                Pergi ke Rapor
                            </a>
                            <a href="{{ route('rpts') }}" class="btn btn-success">
                                Pergi ke Rapor PTS
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
