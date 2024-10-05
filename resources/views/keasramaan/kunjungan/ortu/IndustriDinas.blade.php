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
                            <form action="{{ route('kunjungan.update',  $id) }}" method="POST" enctype="multipart/form-data">
                                @method('PUT')
                                @csrf
                                <div class="mb-3">
                                    <label for="nama" class="form-label">Nama</label>
                                    <input type="text" value="{{$kunjungan->nama}}" class="form-control @error('nama') is-invalid @enderror"
                                        id="nama" name="nama" value="{{ old('nama') }}">
                                    @error('nama')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="mb-3">
                                    <label for="nama_instansi" class="form-label">nama instansi</label>
                                    <input type="text" value="{{$kunjungan->nama_instansi}}" class="form-control @error('nama_instansi') is-invalid @enderror"
                                        id="nama_instansi" name="nama_instansi" value="{{ old('nama_instansi') }}">
                                    @error('nama_instansi')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="mb-3">
                                    <label for="jabatan" class="form-label">jabatan</label>
                                    <input type="text" value="{{$kunjungan->jabatan}}" class="form-control @error('jabatan') is-invalid @enderror"
                                        id="jabatan" name="jabatan" value="{{ old('jabatan') }}">
                                    @error('jabatan')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="mb-3">
                                    <label for="tujuan" class="form-label">Tujuan</label>
                                    <input type="text" value="{{$kunjungan->tujuan}}" class="form-control @error('tujuan') is-invalid @enderror"
                                        id="tujuan" name="tujuan" value="{{ old('tujuan') }}">
                                    @error('tujuan')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="mb-3">
                                    <label for="keterangan" class="form-label">Keterangan</label>
                                    <input type="text" value="{{$kunjungan->keterangan}}" class="form-control @error('keterangan') is-invalid @enderror"
                                        id="keterangan" name="keterangan" value="{{ old('keterangan') }}">
                                    @error('keterangan')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="mb-3">
                                    <label for="no_hp" class="form-label">No Handphone</label>
                                    <input type="number" value="{{$kunjungan->no_hp}}" class="form-control @error('no_hp') is-invalid @enderror"
                                        id="no_hp" name="no_hp" value="{{ old('no_hp') }}">
                                    @error('no_hp')
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
