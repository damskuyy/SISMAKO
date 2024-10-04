@extends('layouts.app')

@section('content')

<div class="py-5">
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
        <div class="col container">
            <div class="row row-cards">
                <div class="col-12">
                    <div class="mb-4 col">
                        <a href="/sekolah-keasramaan/kunjungan/dinas" class="btn btn-secondary">
                            Back
                        </a>
                    </div>
                    <div class="card">
                        <div class="card-body">
                            <form action="{{ route('dinas.store') }}" method="POST" enctype="multipart/form-data">
                                @csrf
                                <div class="mb-3">
                                    <label for="nama" class="form-label">Nama</label>
                                    <input type="text" class="form-control @error('nama') is-invalid @enderror"
                                        id="nama" name="nama" value="{{ old('nama') }}">
                                    @error('nama')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="mb-3">
                                    <label for="materi" class="form-label">Nama materi</label>
                                    <input type="text" class="form-control @error('materi') is-invalid @enderror"
                                        id="materi" name="materi" value="{{ old('materi') }}">
                                    @error('materi')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="mb-3">
                                    <label for="materi" class="form-label">Nama materi</label>
                                    <input type="text" class="form-control @error('materi') is-invalid @enderror"
                                        id="materi" name="materi" value="{{ old('materi') }}">
                                    @error('materi')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="mb-3">
                                    <label for="materi" class="form-label">Nama materi</label>
                                    <input type="text" class="form-control @error('materi') is-invalid @enderror"
                                        id="materi" name="materi" value="{{ old('materi') }}">
                                    @error('materi')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="mb-3">
                                    <label for="materi" class="form-label">Nama materi</label>
                                    <input type="text" class="form-control @error('materi') is-invalid @enderror"
                                        id="materi" name="materi" value="{{ old('materi') }}">
                                    @error('materi')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="mb-3">
                                    <label for="materi" class="form-label">Nama materi</label>
                                    <input type="text" class="form-control @error('materi') is-invalid @enderror"
                                        id="materi" name="materi" value="{{ old('materi') }}">
                                    @error('materi')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="card-footer text-end">
                                    <button type="submit" class="btn btn-primary">Add Data</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    @include('database.js.getNameByAngkatan')
    @endsection
