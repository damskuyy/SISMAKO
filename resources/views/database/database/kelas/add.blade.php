@extends('layouts.app')

@section('content')
    <div class="container mt-5">
        <a href="{{route('kelas.index')}}" class="btn btn-secondary mb-4">Back</a>
        <form method="post" action="{{ route('kelas.store') }}" enctype="multipart/form-data">
            @csrf
            <div class="row border p-3 rounded-3">
                <!-- Angkatan Filter -->
                <div class="col-lg-3">
                    <div class="mb-3">
                        <label class="form-label">Angkatan</label>
                        <select class="form-control" name="angkatan" id="angkatan-select">
                            <option value="">-- Pilih Angkatan --</option>
                            @foreach($angkatan as $data)
                                <option value="{{ $data }}" {{ old('angkatan') == $data ? 'selected' : '' }}>{{ $data }}</option>
                            @endforeach
                        </select>
                        @error('angkatan')
                            <div class="text-danger mt-2">{{ $message }}</div>
                        @enderror
                    </div>
                </div>
                <!-- Nama Filter -->
                <div class="col-lg-9">
                    <div class="mb-3">
                        <label class="form-label">Nama</label>
                        <select class="form-control" name="id_siswa" id="nama-select">
                            <option value="">-- Pilih Nama --</option>
                            <!-- Options will be populated dynamically -->
                        </select>
                        @error('id_siswa')
                            <div class="text-danger mt-2">{{ $message }}</div>
                        @enderror
                    </div>
                </div>
                <!-- Other Form Fields -->
                <div class="col-lg-4">
                    <div class="mb-3">
                        <label class="form-label">Tahun Pelajaran</label>
                        <input type="text" class="form-control" name="tahun_pelajaran" placeholder="2024-2025" value="{{ old('tahun_pelajaran') }}">
                        @error('tahun_pelajaran')
                            <div class="text-danger mt-2">{{ $message }}</div>
                        @enderror
                    </div>
                </div>
                <div class="col-lg-4">
                    <div class="mb-3">
                        <label class="form-label">Jurusan</label>
                        <input type="text" class="form-control" name="jurusan" placeholder="SIJA" value="{{ old('jurusan') }}">
                        @error('jurusan')
                            <div class="text-danger mt-2">{{ $message }}</div>
                        @enderror
                    </div>
                </div>
                <div class="col-lg-4">
                    <div class="mb-3">
                        <label class="form-label">Kelas</label>
                        <select class="form-select" name="kelas" id="kelas" value="{{ old('kelas') }}">
                            <option value="X" selected>X</option>
                            <option value="XI">XI</option>
                            <option value="XII">XII</option>
                            <option value="XIII">XIII</option>
                        </select>
                        @error('kelas')
                            <div class="text-danger mt-2">{{ $message }}</div>
                        @enderror
                    </div>
                </div>
            </div>
            <div class="mt-3">
                <button type="submit" class="btn btn-success" id="submitButton">Submit</button>
            </div>
        </form>
    </div>
    <script>
        document.getElementById('angkatan-select').addEventListener('change', function() {
            const angkatan = this.value;
            const namesSelect = document.getElementById('nama-select');
            namesSelect.innerHTML = '<option value="">-- Pilih Nama --</option>';

            // Fetch the student names based on the selected angkatan
            fetch(`/api/siswa?angkatan=${angkatan}`)
                .then(response => response.json())
                .then(data => {
                    data.forEach(siswa => {
                        const option = document.createElement('option');
                        option.value = siswa.id;
                        console.log(siswa)
                        option.textContent = siswa.nama;
                        namesSelect.appendChild(option);
                    });
                })
                .catch(error => console.error('Error fetching names:', error));
        });
    </script>
<script>
document.addEventListener('DOMContentLoaded', function() {
    const form = document.querySelector('form');
    const namaSelect = document.getElementById('nama-select');
    
    form.addEventListener('submit', function(e) {
        if (!namaSelect.value) {
            e.preventDefault();
            const errorDiv = document.createElement('div');
            errorDiv.className = 'text-danger mt-2';
            errorDiv.textContent = 'Silahkan pilih nama siswa terlebih dahulu';
            
            // Remove any existing error message
            const existingError = namaSelect.parentNode.querySelector('.text-danger');
            if (existingError) {
                existingError.remove();
            }
            
            namaSelect.parentNode.appendChild(errorDiv);
            return false;
        }
    });

    // Enable/disable submit button based on nama selection
    const submitButton = document.querySelector('button[type="submit"]');
    namaSelect.addEventListener('change', function() {
        submitButton.disabled = !this.value;
    });
    
    // Initially disable submit button
    submitButton.disabled = true;
});
</script>
@endsection
