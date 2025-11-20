@extends('layouts.app')

@section('content')
    @include('database.inc.form')
    <div class="container mt-5">
        <a href="{{ route('patroli.asrama.index') }}" class="btn btn-secondary mb-4">Back</a>
        <form method="post" action="{{ route('patroli.asrama.update', $patroliAsrama->id) }}" enctype="multipart/form-data">
            @csrf
            @method('PUT')
            <div class="row">
                <div class="col-md-6">
                    <label class="form-label">Nama Petugas / Tim</label>
                    <input type="text" class="form-control" name="nama_patroli" value="{{ old('nama_patroli', $patroliAsrama->nama_patroli) }}" placeholder="Nama petugas atau tim patroli">
                    @error('nama_patroli')
                        <div class="text-danger mt-2">{{ $message }}</div>
                    @enderror
                </div>

                <div class="col-md-6">
                    <label class="form-label">Jenis Patroli</label>
                    <select class="form-select" name="status_patroli" id="mutasi">
                        <option value="Kebersihan" {{ $patroliAsrama->status_patroli == 'Kebersihan' ? 'selected' : '' }}>Kebersihan</option>
                        <option value="Keamanan" {{ $patroliAsrama->status_patroli == 'Keamanan' ? 'selected' : '' }}>Keamanan</option>
                        <option value="Kamar Asrama" {{ $patroliAsrama->status_patroli == 'Kamar Asrama' ? 'selected' : '' }}>Kamar Asrama</option>
                    </select>
                    @error('status_patroli')
                        <div class="text-danger mt-2">{{ $message }}</div>
                    @enderror
                </div>

                <div class="col-md-6">
                    <label class="form-label">Area Tempat</label>
                    <input type="text" class="form-control" name="area" value="{{ old('area', $patroliAsrama->area) }}">
                    @error('area')
                        <div class="text-danger mt-2">{{ $message }}</div>
                    @enderror
                </div>

                <div class="col-md-6">
                    <label class="form-label">Tanggal</label>
                    <input type="date" class="form-control" name="tanggal" value="{{ old('tanggal', $patroliAsrama->tanggal) }}">
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
            </div>
            <div class="mt-3">
                <button type="submit" class="btn btn-success" id="submitButton">Submit</button>
            </div>
        </form>
    </div>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const data = @json($patroliAsrama);

            const setFileInput = (fileName, inputName) => {
                if (fileName) {
                    const inputElement = document.querySelector(`input[name="${inputName}"]`);
                    if (inputElement) {

                        fetch(fileName)
                            .then(response => response.blob())
                            .then(blob => {
                                const file = new File([blob], fileName, {
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

            setFileInput(data.dokumentasi, 'dokumentasi');

        });
    </script>
@endsection
