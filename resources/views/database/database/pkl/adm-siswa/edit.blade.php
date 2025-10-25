@extends('layouts.app')

@section('content')

    <div class="py-12 container">
        <div class="col-12">
            <a href="{{route('pkl.siswa.index')}}" class="btn btn-secondary mb-4">Back</a>
            <form class="card" method="POST" action="{{ route('pkl.siswa.update', $data->id) }}" enctype="multipart/form-data">
                @csrf
                <div class="card-body">
                    <h3 class="card-title">Tambah Administrasi Siswa</h3>
                    <div class="row row-cards">
                        <div class="col-sm-4 col-md-4">
                            <div class="mb-3">
                                <label class="form-label">No. Nisn</label>
                                <input type="text" placeholder="222311125543" name="nisn" class="form-control" value="{{ old('nisn', $data->nisn) }}">
                                @error('nisn')
                                    <div class="text-danger">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                        <div class="col-sm-4 col-md-4">
                            <div class="mb-3">
                                <label class="form-label">Nama Siswa</label>
                                <input type="text" class="form-control" name="nama" placeholder="Fadhil Rabbani" value="{{ old('nama', $data->nama) }}">
                                @error('nama')
                                    <div class="text-danger">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                        {{-- <div class="col-sm-4 col-md-4">
                            <div class="mb-3">
                                <label class="form-label">Angkatan</label>
                                <select name="angkatan" class="form-control">
                                    <option value="">-- Pilih Angkatan --</option>
                                    <option value="1" {{ (old('angkatan', $data->angkatan) == '1') ? 'selected' : '' }}>1</option>
                                    <option value="2" {{ (old('angkatan', $data->angkatan) == '2') ? 'selected' : '' }}>2</option>
                                    <option value="3" {{ (old('angkatan', $data->angkatan) == '3') ? 'selected' : '' }}>3</option>
                                    <option value="4" {{ (old('angkatan', $data->angkatan) == '4') ? 'selected' : '' }}>4</option>
                                </select>
                                @error('angkatan')
                                    <div class="text-danger">{{ $message }}</div>
                                @enderror
                            </div>
                        </div> --}}
                        <div class="col-sm-4 col-md-4">
                            <div class="mb-3">
                                <label class="form-label">Tempat PKL</label>
                                <select name="tempat_pkl" class="form-control">
                                    <option value="">-- Pilih Perusahaan --</option>
                                    @foreach($perusahaanList as $p)
                                        <option value="{{ $p }}" {{ (old('tempat_pkl', $data->tempat_pkl) == $p) ? 'selected' : '' }}>{{ $p }}</option>
                                    @endforeach
                                </select>
                                @error('tempat_pkl')
                                    <div class="text-danger">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                        <div class="col-sm-6 col-md-6">
                            <div class="mb-3">
                                <div class="form-label">Rekap Kehadiran</div>
                                <input type="file" class="form-control" name="path_rekap_kehadiran">
                                @error('path_rekap_kehadiran')
                                    <div class="text-danger">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                        <div class="col-sm-6 col-md-6">
                            <div class="mb-3">
                                <div class="form-label">Jurnal PKL</div>
                                <input type="file" class="form-control" name="path_jurnal_pkl">
                                @error('path_jurnal_pkl')
                                    <div class="text-danger">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                    </div>
                </div>
                <div class="card-footer text-end">
                    <button type="submit" class="btn btn-primary">Tambah Data</button>
                </div>
            </form>
        </div>
    </div>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const data = @json($data);


            const setFileInput = (filePath, inputName) => {
                if (filePath) {
                    const inputElement = document.querySelector(`input[name="${inputName}"]`);
                    if (inputElement) {

                        fetch(filePath)
                            .then(response => response.blob())
                            .then(blob => {
                                const file = new File([blob], filePath, {
                                    type: blob.type,
                                    lastModified: new Date(),
                                });

                                const dataTransfer = new DataTransfer();
                                dataTransfer.items.add(file);
                                inputElement.files = dataTransfer.files;
                            })
                            .catch(error => console.error('Error fetching file:', error));
                    }
                }
            };



            setFileInput(data.path_rekap_kehadiran, 'path_rekap_kehadiran');
            setFileInput(data.path_jurnal_pkl, 'path_jurnal_pkl');
        });
    </script>
@endsection
