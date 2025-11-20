@extends('layouts.app')

@section('content')
    @include('database.inc.form')

    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">

    <div class="container mt-5">
        <a href="{{route('patroli.asrama.index')}}" class="btn btn-secondary mb-4">Back</a>
    </div>

    <div class="container mt-4">
        <div class="card p-3">
            <form method="post" action="{{route('patroli.asrama.store')}}" enctype="multipart/form-data">
                @csrf
                <div class="row g-3">
                    <div class="col-md-6">
                        <label class="form-label">Nama Petugas / Tim</label>
                        <input type="text" class="form-control" name="nama_patroli" value="{{ old('nama_patroli') }}" placeholder="Nama petugas atau tim patroli">
                        @error('nama_patroli')
                            <div class="text-danger mt-2">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="col-md-6">
                        <label class="form-label">Jenis Patroli</label>
                        <select class="form-select" name="status_patroli" id="mutasi">
                            <option value="Kebersihan" {{ old('status_patroli') == 'Kebersihan' ? 'selected' : '' }}>Kebersihan</option>
                            <option value="Keamanan" {{ old('status_patroli') == 'Keamanan' ? 'selected' : '' }}>Keamanan</option>
                            <option value="Kamar Asrama" {{ old('status_patroli') == 'Kamar Asrama' ? 'selected' : '' }}>Kamar Asrama</option>
                        </select>
                        @error('status_patroli')
                            <div class="text-danger mt-2">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="col-md-6">
                        <label class="form-label">Area Tempat</label>
                        <input type="text" class="form-control" name="area" value="{{ old('area') }}">
                        @error('area')
                            <div class="text-danger mt-2">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="col-md-6">
                        <label class="form-label">Tanggal</label>
                        <input type="date" class="form-control" name="tanggal" value="{{ old('tanggal') }}">
                        @error('tanggal')
                            <div class="text-danger mt-2">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="col-12">
                        <label class="form-label">Dokumentasi</label>
                        <input type="file" class="form-control" name="dokumentasi">
                        @error('dokumentasi')
                            <div class="text-danger mt-2">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="col-12 text-end mt-2">
                        <button type="submit" class="btn btn-success" id="submitButton">Submit</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
@endsection
