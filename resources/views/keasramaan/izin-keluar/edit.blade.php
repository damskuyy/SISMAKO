@extends('layouts.app')

@section('content')
<div class="py-5">
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
        <div class="col container">
            <div class="row row-cards">
                <div class="col-12">
                    <div class="mb-4 col">
                        <a href="{{ route('izin.keluar.index') }}" class="btn btn-secondary">Back</a>
                    </div>
                    <form class="card" action="{{ route('izin.keluar.update', $izinKeluar->id) }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        @method('PUT')
                        <div class="card-body">
                            <h3 class="card-title">Edit Izin Keluar</h3>
                            <div class="row row-cards">
                                <div class="col-sm-4 col-md-4">
                                    <div class="mb-3">
                                        <label class="form-label">Tanggal Keluar</label>
                                        <input type='datetime-local' class="form-control datepicker" name="tanggal_keluar"
                                            value="{{ old('tanggal_keluar', $izinKeluar->tanggal_keluar) }}" autocomplete='off'>
                                        @error('tanggal_keluar')
                                            <div class="text-danger mt-2"> {{ $message }} </div>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-sm-4 col-md-4">
                                    <div class="mb-3">
                                        <label class="form-label">Tanggal Kembali</label>
                                        <input type='datetime-local' class="form-control datepicker" name="tanggal_kembali"
                                            value="{{ old('tanggal_kembali', $izinKeluar->tanggal_kembali) }}" autocomplete='off'>
                                        @error('tanggal_kembali')
                                            <div class="text-danger mt-2"> {{ $message }} </div>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-sm-4 col-md-4">
                                    <div class="mb-3">
                                        <label class="form-label">Guru Piket</label>
                                        <select class="form-control" name="guru_id" id="guru_id">
                                            <option value="">Pilih Nama Guru</option>
                                            @foreach ($guru as $item)
                                                <option value="{{ $item->id }}" {{ $izinKeluar->guru_id == $item->id ? 'selected' : '' }}>{{ $item->nama }}</option>
                                            @endforeach
                                        </select>
                                        @error('guru_id')
                                            <div class="text-danger mt-2">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-sm-4 col-md-4">
                                    <div class="mb-3">
                                        <label class="form-label">Kelas</label>
                                        <select class="form-control" id="kelas_id" name="kelas_id">
                                            <option value="">Pilih Kelas</option>
                                            <option value="X" {{ $izinKeluar->siswa->dataKelas[0]->kelas == 'X' ? 'selected' : '' }}>X</option>
                                            <option value="XI" {{ $izinKeluar->siswa->dataKelas[0]->kelas == 'XI' ? 'selected' : '' }}>XI</option>
                                            <option value="XII" {{ $izinKeluar->siswa->dataKelas[0]->kelas == 'XII' ? 'selected' : '' }}>XII</option>
                                        </select>
                                        @error('kelas_id')
                                            <div class="text-danger mt-2">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-sm-4 col-md-4">
                                    <div class="mb-3">
                                        <label class="form-label">Nama Siswa</label>
                                        <select class="form-control" id="siswa_id" name="siswa_id">
                                            <option value="{{$izinKeluar->siswa_id}}">{{$izinKeluar->siswa->nama}}</option>
                                        </select>
                                        @error('siswa_id')
                                            <div class="text-danger mt-2">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-sm-12 col-md-12">
                                    <div class="mb-3">
                                        <label for="keterangan" class="form-label">Alasan</label>
                                        <textarea class="form-control @error('keterangan') is-invalid @enderror" id="keterangan" name="alasan">{{ old('alasan', $izinKeluar->alasan) }}</textarea>
                                        @error('alasan')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="card-footer text-end">
                            <button type="submit" class="btn btn-primary">Update</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
<script>
    document.addEventListener('DOMContentLoaded', function() {
        const kelasSelect = document.getElementById('kelas_id');
        const namesSelect = document.getElementById('siswa_id');

        if (kelasSelect && namesSelect) {
            kelasSelect.addEventListener('change', function() {
                const angkatan = this.value;

                // Kosongkan opsi dalam select siswa sebelum menambah data baru
                namesSelect.innerHTML = '<option value="">Pilih Nama Siswa</option>';

                fetch(`/api/siswa/kelas?kelas=${angkatan}`)
                    .then(response => response.json())
                    .then(data => {
                        console.log(data);
                        data.forEach(siswa => {
                            const option = document.createElement('option');
                            option.value = siswa.id_siswa;
                            option.textContent = siswa.siswa.nama;
                            namesSelect.appendChild(option);
                        });
                    })
                    .catch(error => console.error('Error fetching names:', error));
            });
        }
    });
</script>
@endsection
