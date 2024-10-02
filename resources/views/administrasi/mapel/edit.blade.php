@extends('layouts.app')


@section('content')
<div class="px-5 py-4">
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
        <div class="col">
            <div class="row row-cards">
                <div class="col-12">
                    <div class="mb-4 col">
                        <a href="{{ route('mapel.index') }}" class="btn btn-secondary">
                            kembali
                        </a>
                    </div>
                    <form class="card" action="{{ route('mapel.update', $mapel->id) }}" method="POST"
                        enctype="multipart/form-data">
                        @csrf
                        @method('PUT')
                        <div id="step1">
                            <div class="card-body">
                                <h3 class="card-title text-center mb-4">Edit Data Mata Pelajaran</h3>
                                <div class="row row-cards">
                                    <div class="col-sm-6 col-md-6">
                                        <div class="mb-3">
                                            <label class="form-label">Tahun Ajaran</label>
                                            <select class="form-control form-select" name="tahun_ajaran">
                                                <option value="">Pilih Tahun Ajaran</option>
                                                @foreach (generateTahunAjaran() as $tahun)
                                                <option value="{{ $tahun }}" {{ $mapel->tahun_ajaran == $tahun ?
                                                    'selected' : '' }}>
                                                    {{ $tahun }}
                                                </option>
                                                @endforeach
                                            </select>
                                            @error('tahun_ajaran')
                                            <div class="text-danger mt-2"> {{ $message }} </div>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-sm-6 col-md-6">
                                        <div class="mb-3">
                                            <label class="form-label">Kelas</label>
                                            <select class="form-control form-select" name="kelas">
                                                <option value="">Pilih Kelas</option>
                                                <option value="X" {{ $mapel->kelas == 'X' ? 'selected' : '' }}>X
                                                </option>
                                                <option value="XI" {{ $mapel->kelas == 'XI' ? 'selected' : '' }}>XI
                                                </option>
                                                <option value="XII" {{ $mapel->kelas == 'XII' ? 'selected' : '' }}>
                                                    XII</option>
                                                <option value="XIII" {{ $mapel->kelas == 'XIII' ? 'selected' : '' }}>
                                                    XIII</option>
                                            </select>
                                            @error('kelas')
                                            <div class="text-danger mt-2"> {{ $message }} </div>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-sm-6 col-md-6">
                                        <div class="mb-3">
                                            <label class="mb-2" for="mapel">Mapel</label>
                                            <input type="text" class="form-control" id="mapel" name="mapel"
                                                value="{{ $mapel->mapel }}" required>
                                            @error('mapel')
                                            <div class="text-danger mt-2"> {{ $message }} </div>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-sm-6 col-md-6">
                                        <div class="mb-3">
                                            <label class="form-label">Kategori Kurikulum</label>
                                            <select class="form-control form-select" name="kategori_kurikulum">
                                                <option value="">Pilih Kategori Kurikulum</option>
                                                <option value="K13" {{ $mapel->kategori_kurikulum == 'K13' ? 'selected'
                                                    : '' }}>K13
                                                </option>
                                                <option value="KUMER" {{ $mapel->kategori_kurikulum == 'KUMER' ?
                                                    'selected' : '' }}>
                                                    KUMER</option>
                                            </select>
                                            @error('kategori_kurikulum')
                                            <div class="text-danger mt-2"> {{ $message }} </div>
                                            @enderror
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div id="step2">
                            <small class="text-danger float-end"
                                style="margin-bottom: 10px; display: block; margin-top:10px; margin-right:10px;">Maksimal
                                ukuran file 2MB !!!</small>
                            <div class="card-body">
                                <h3 class="card-title">A. Buku Kerja 1</h3>
                                <div class="row row-cards">
                                    <div class="col-md-4 mb-3">
                                        <label class="form-label fw-bold">Capaian Pembelajaran</label>
                                        <div class="input-group">
                                            <input type="file" class="form-control" name="CapaianPembelajaran"
                                                accept="all">
                                            <div class="input-group-append">
                                                <button type="button" class="btn" style="height: 100%"
                                                    id="btn-remove-CapaianPembelajaran"
                                                    onclick="removeFile('CapaianPembelajaran')"><i
                                                        class="fa-solid fa-x"></i></button>
                                            </div>
                                        </div>
                                        @error('CapaianPembelajaran')
                                        <div class="text-danger">{{ $message }}</div>
                                        @enderror
                                    </div>
                                    <div class="col-md-4 mb-3">
                                        <label class="form-label fw-bold">Tujuan Pembelajaran & Alur Tujuan Pembelajaran
                                            (TPATP)</label>
                                        <div class="input-group">
                                            <input type="file" class="form-control" name="TPATP" accept="all">
                                            <div class="input-group-append">
                                                <button type="button" class="btn" style="height: 100%"
                                                    id="btn-remove-TPATP" onclick="removeFile('TPATP')"><i
                                                        class="fa-solid fa-x"></i></button>
                                            </div>
                                        </div>
                                        @error('TPATP')
                                        <div class="text-danger">{{ $message }}</div>
                                        @enderror
                                    </div>
                                    <div class="col-md-4 mb-3">
                                        <label class="form-label fw-bold">Kriteria Ketuntasan Tujuan Pembelajaran
                                            (KKTP)</label>
                                        <div class="input-group">
                                            <input type="file" class="form-control" name="KKTP" accept="all">
                                            <div class="input-group-append">
                                                <button type="button" class="btn" style="height: 100%"
                                                    id="btn-remove-KKTP" onclick="removeFile('KKTP')"><i
                                                        class="fa-solid fa-x"></i></button>
                                            </div>
                                        </div>
                                        @error('KKTP')
                                        <div class="text-danger">{{ $message }}</div>
                                        @enderror
                                    </div>
                                    <div id="rpp-wrapper">
                                        <!-- Set pertama (RPP 1) -->
                                        <div class="rpp-group">
                                            <div class="row">
                                                <div class="col-md-6 mb-3">
                                                    <label class="form-label fw-bold">RPP 1</label>
                                                    <div class="input-group">
                                                        <input type="file" class="form-control" name="rpp_1"
                                                            accept="all">
                                                        <div class="input-group-append">
                                                            <button type="button" class="btn" style="height: 100%"
                                                                id="btn-remove-rpp_1" onclick="removeFile('rpp_1')"><i
                                                                    class="fa-solid fa-x"></i></button>
                                                        </div>
                                                    </div>
                                                    @error('rpp_1')
                                                    <div class="text-danger">{{ $message }}</div>
                                                    @enderror
                                                </div>
                                                <div class="col-md-6 mb-3">
                                                    <label class="form-label fw-bold">Pendukung RPP 1</label>
                                                    <div class="input-group">
                                                        <input type="file" class="form-control" name="pendukung_rpp_1"
                                                            accept="all">
                                                        <div class="input-group-append">
                                                            <button type="button" class="btn" style="height: 100%"
                                                                id="btn-remove-pendukung_rpp_1"
                                                                onclick="removeFile('pendukung_rpp_1')"><i
                                                                    class="fa-solid fa-x"></i></button>
                                                        </div>
                                                    </div>
                                                    @error('pendukung_rpp_1')
                                                    <div class="text-danger">{{ $message }}</div>
                                                    @enderror
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <!-- Tombol untuk menambah input baru -->
                                    <button type="button" id="add-rpp" class="btn btn-primary">Tampilkan Lebih
                                        Banyak RPP</button>
                                </div>
                            </div>
                        </div>
                        <div id="step3">
                            <small class="text-danger float-end"
                                style="margin-bottom: 10px; display: block; margin-top:10px; margin-right:10px;">Maksimal
                                ukuran file 2MB !!!</small>
                            <div class="card-body">
                                <h3 class="card-title">B. Buku Kerja 2</h3>
                                <div class="row row-cards">
                                    <div class="col-md-4 mb-3">
                                        <label class="form-label fw-bold">Kode Etik Guru</label>
                                        <div class="input-group">
                                            <input type="file" class="form-control" name="KodeEtikGuru" accept="all">
                                            <div class="input-group-append">
                                                <button type="button" class="btn" style="height: 100%"
                                                    id="btn-remove-KodeEtikGuru" onclick="removeFile('KodeEtikGuru')"><i
                                                        class="fa-solid fa-x"></i></button>
                                            </div>
                                        </div>
                                        @error('KodeEtikGuru')
                                        <div class="text-danger">{{ $message }}</div>
                                        @enderror
                                    </div>
                                    <div class="col-md-4 mb-3">
                                        <label class="form-label fw-bold">Ikrar Guru</label>
                                        <div class="input-group">
                                            <input type="file" class="form-control" name="IkrarGuru" accept="all">
                                            <div class="input-group-append">
                                                <button type="button" class="btn" style="height: 100%"
                                                    id="btn-remove-IkrarGuru" onclick="removeFile('IkrarGuru')"><i
                                                        class="fa-solid fa-x"></i></button>
                                            </div>
                                        </div>
                                        @error('IkrarGuru')
                                        <div class="text-danger">{{ $message }}</div>
                                        @enderror
                                    </div>
                                    <div class="col-md-4 mb-3">
                                        <label class="form-label fw-bold">Tata Tertib Guru</label>
                                        <div class="input-group">
                                            <input type="file" class="form-control" name="TatibGuru" accept="all">
                                            <div class="input-group-append">
                                                <button type="button" class="btn" style="height: 100%"
                                                    id="btn-remove-TatibGuru" onclick="removeFile('TatibGuru')"><i
                                                        class="fa-solid fa-x"></i></button>
                                            </div>
                                        </div>
                                        @error('TatibGuru')
                                        <div class="text-danger">{{ $message }}</div>
                                        @enderror
                                    </div>
                                    <div class="col-md-4 mb-3">
                                        <label class="form-label fw-bold">Pembiasaan Guru</label>
                                        <div class="input-group">
                                            <input type="file" class="form-control" name="PembiasaanGuru" accept="all">
                                            <div class="input-group-append">
                                                <button type="button" class="btn" style="height: 100%"
                                                    id="btn-remove-PembiasaanGuru"
                                                    onclick="removeFile('PembiasaanGuru')"><i
                                                        class="fa-solid fa-x"></i></button>
                                            </div>
                                        </div>
                                        @error('PembiasaanGuru')
                                        <div class="text-danger">{{ $message }}</div>
                                        @enderror
                                    </div>
                                    <div class="col-md-4 mb-3">
                                        <label class="form-label fw-bold">Kalender Pendidikan (KALDIK)</label>
                                        <div class="input-group">
                                            <input type="file" class="form-control" name="Kaldik" accept="all">
                                            <div class="input-group-append">
                                                <button type="button" class="btn" style="height: 100%"
                                                    id="btn-remove-Kaldik" onclick="removeFile('Kaldik')"><i
                                                        class="fa-solid fa-x"></i></button>
                                            </div>
                                        </div>
                                        @error('Kaldik')
                                        <div class="text-danger">{{ $message }}</div>
                                        @enderror
                                    </div>
                                    <div class="col-md-4 mb-3">
                                        <label class="form-label fw-bold">Alokasi Waktu</label>
                                        <div class="input-group">
                                            <input type="file" class="form-control" name="AlokasiWaktu" accept="all">
                                            <div class="input-group-append">
                                                <button type="button" class="btn" style="height: 100%"
                                                    id="btn-remove-AlokasiWaktu" onclick="removeFile('AlokasiWaktu')"><i
                                                        class="fa-solid fa-x"></i></button>
                                            </div>
                                        </div>
                                        @error('AlokasiWaktu')
                                        <div class="text-danger">{{ $message }}</div>
                                        @enderror
                                    </div>
                                    <div class="col-md-4 mb-3">
                                        <label class="form-label fw-bold">Program Tahunan (PROTA)</label>
                                        <div class="input-group">
                                            <input type="file" class="form-control" name="Prota" accept="all">
                                            <div class="input-group-append">
                                                <button type="button" class="btn" style="height: 100%"
                                                    id="btn-remove-Prota" onclick="removeFile('Prota')"><i
                                                        class="fa-solid fa-x"></i></button>
                                            </div>
                                        </div>
                                        @error('Prota')
                                        <div class="text-danger">{{ $message }}</div>
                                        @enderror
                                    </div>
                                    <div class="col-md-4 mb-3">
                                        <label class="form-label fw-bold">Program Semester (PROSEM)</label>
                                        <div class="input-group">
                                            <input type="file" class="form-control" name="Prosem" accept="all">
                                            <div class="input-group-append">
                                                <button type="button" class="btn" style="height: 100%"
                                                    id="btn-remove-Prosem" onclick="removeFile('Prosem')"><i
                                                        class="fa-solid fa-x"></i></button>
                                            </div>
                                        </div>
                                        @error('Prosem')
                                        <div class="text-danger">{{ $message }}</div>
                                        @enderror
                                    </div>
                                    <div class="col-md-4 mb-3">
                                        <label class="form-label fw-bold">Jurnal Agenda Guru</label>
                                        <div class="input-group">
                                            <input type="file" class="form-control" name="jurnal-agenda-guru"
                                                accept="all">
                                            <div class="input-group-append">
                                                <button type="button" class="btn" style="height: 100%"
                                                    id="btn-remove-jurnal-agenda-guru"
                                                    onclick="removeFile('jurnal-agenda-guru')"><i
                                                        class="fa-solid fa-x"></i></button>
                                            </div>
                                        </div>
                                        @error('jurnal-agenda-guru')
                                        <div class="text-danger">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div id="step4">
                            <small class="text-danger float-end"
                                style="margin-bottom: 10px; display: block; margin-top:10px; margin-right:10px;">Maksimal
                                ukuran file 2MB !!!</small>
                            <div class="card-body">
                                <h3 class="card-title">C. Buku Kerja 3</h3>
                                <div class="row row-cards">
                                    <div class="col-md-6 mb-3">
                                        <label class="form-label fw-bold">Daftar Hadir Siswa</label>
                                        <div class="input-group">
                                            <input type="file" class="form-control" name="DaftarHadirSiswa"
                                                accept="all">
                                            <div class="input-group-append">
                                                <button type="button" class="btn" style="height: 100%"
                                                    id="btn-remove-DaftarHadirSiswa"
                                                    onclick="removeFile('DaftarHadirSiswa')"><i
                                                        class="fa-solid fa-x"></i></button>
                                            </div>
                                        </div>
                                        @error('DaftarHadirSiswa')
                                        <div class="text-danger">{{ $message }}</div>
                                        @enderror
                                    </div>
                                    <div class="col-md-6 mb-3">
                                        <label class="form-label fw-bold">Daftar Nilai Siswa</label>
                                        <div class="input-group">
                                            <input type="file" class="form-control" name="DaftarNilaiSiswa"
                                                accept="all">
                                            <div class="input-group-append">
                                                <button type="button" class="btn" style="height: 100%"
                                                    id="btn-remove-DaftarNilaiSiswa"
                                                    onclick="removeFile('DaftarNilaiSiswa')"><i
                                                        class="fa-solid fa-x"></i></button>
                                            </div>
                                        </div>
                                        @error('DaftarNilaiSiswa')
                                        <div class="text-danger">{{ $message }}</div>
                                        @enderror
                                    </div>
                                    <div class="col-md-6 mb-3">
                                        <label class="form-label fw-bold">Penilaian Sikap & Spiritual (PSS)</label>
                                        <div class="input-group">
                                            <input type="file" class="form-control" name="PSS" accept="all">
                                            <div class="input-group-append">
                                                <button type="button" class="btn" style="height: 100%"
                                                    id="btn-remove-PSS" onclick="removeFile('PSS')"><i
                                                        class="fa-solid fa-x"></i></button>
                                            </div>
                                        </div>
                                        @error('PSS')
                                        <div class="text-danger">{{ $message }}</div>
                                        @enderror
                                    </div>
                                    <div class="col-md-6 mb-3">
                                        <label class="form-label fw-bold">Analisis Hasil Penilaian</label>
                                        <div class="input-group">
                                            <input type="file" class="form-control" name="AnalisisHasilPenilaian"
                                                accept="all">
                                            <div class="input-group-append">
                                                <button type="button" class="btn" style="height: 100%"
                                                    id="btn-remove-AnalisisHasilPenilaian"
                                                    onclick="removeFile('AnalisisHasilPenilaian')"><i
                                                        class="fa-solid fa-x"></i></button>
                                            </div>
                                        </div>
                                        @error('AnalisisHasilPenilaian')
                                        <div class="text-danger">{{ $message }}</div>
                                        @enderror
                                    </div>
                                    <div class="col-md-6 mb-3">
                                        <label class="form-label fw-bold">Program Remedial & Pengayaan (PRP)</label>
                                        <div class="input-group">
                                            <input type="file" class="form-control" name="PRP" accept="all">
                                            <div class="input-group-append">
                                                <button type="button" class="btn" style="height: 100%"
                                                    id="btn-remove-PRP" onclick="removeFile('PRP')"><i
                                                        class="fa-solid fa-x"></i></button>
                                            </div>
                                        </div>
                                        @error('PRP')
                                        <div class="text-danger">{{ $message }}</div>
                                        @enderror
                                    </div>
                                    <div class="col-md-6 mb-3">
                                        <label class="form-label fw-bold">Jadwal Mengajar Guru</label>
                                        <div class="input-group">
                                            <input type="file" class="form-control" name="JadwalMengajarGuru"
                                                accept="all">
                                            <div class="input-group-append">
                                                <button type="button" class="btn" style="height: 100%"
                                                    id="btn-remove-JadwalMengajarGuru"
                                                    onclick="removeFile('JadwalMengajarGuru')"><i
                                                        class="fa-solid fa-x"></i></button>
                                            </div>
                                        </div>
                                        @error('JadwalMengajarGuru')
                                        <div class="text-danger">{{ $message }}</div>
                                        @enderror
                                    </div>
                                    <div class="col-md-6 mb-3">
                                        <label class="form-label fw-bold">Tugas Terstruktur</label>
                                        <div class="input-group">
                                            <input type="file" class="form-control" name="TugasTerstruktur"
                                                accept="all">
                                            <div class="input-group-append">
                                                <button type="button" class="btn" style="height: 100%"
                                                    id="btn-remove-TugasTerstruktur"
                                                    onclick="removeFile('TugasTerstruktur')"><i
                                                        class="fa-solid fa-x"></i></button>
                                            </div>
                                        </div>
                                        @error('TugasTerstruktur')
                                        <div class="text-danger">{{ $message }}</div>
                                        @enderror
                                    </div>
                                    <div class="col-md-6 mb-3">
                                        <label class="form-label fw-bold">Tugas Tidak Terstruktur</label>
                                        <div class="input-group">
                                            <input type="file" class="form-control" name="TugasTidakTerstruktur"
                                                accept="all">
                                            <div class="input-group-append">
                                                <button type="button" class="btn" style="height: 100%"
                                                    id="btn-remove-TugasTidakTerstruktur"
                                                    onclick="removeFile('TugasTidakTerstruktur')"><i
                                                        class="fa-solid fa-x"></i></button>
                                            </div>
                                        </div>
                                        @error('TugasTidakTerstruktur')
                                        <div class="text-danger">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div id="step5">
                            <small class="text-danger float-end"
                                style="margin-bottom: 10px; display: block; margin-top:10px; margin-right:10px;">Maksimal
                                ukuran file 2MB !!!</small>
                            <div class="card-body">
                                <h3 class="card-title">D. Buku Kerja 4</h3>
                                <div class="row row-cards">
                                    <div class="col-md-6 mb-3">
                                        <label class="form-label fw-bold">Daftar Evaluasi Diri Kerja Guru
                                            (DEDKG)</label>
                                        <div class="input-group">
                                            <input type="file" class="form-control" name="DEDKG" accept="all">
                                            <div class="input-group-append">
                                                <button type="button" class="btn" style="height: 100%"
                                                    id="btn-remove-DEDKG" onclick="removeFile('DEDKG')"><i
                                                        class="fa-solid fa-x"></i></button>
                                            </div>
                                        </div>
                                        @error('DEDKG')
                                        <div class="text-danger">{{ $message }}</div>
                                        @enderror
                                    </div>
                                    <div class="col-md-6 mb-3">
                                        <label class="form-label fw-bold">Program Tindak Lanjut Kerja Guru
                                            (PTLKG)</label>
                                        <div class="input-group">
                                            <input type="file" class="form-control" name="PTLKG" accept="all">
                                            <div class="input-group-append">
                                                <button type="button" class="btn" style="height: 100%"
                                                    id="btn-remove-PTLKG" onclick="removeFile('PTLKG')"><i
                                                        class="fa-solid fa-x"></i></button>
                                            </div>
                                        </div>
                                        @error('PTLKG')
                                        <div class="text-danger">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="card-footer text-end">
                            <button type="button" class="btn btn-secondary" id="prevButton"
                                style="display: none;">Previous</button>
                            <button type="button" class="btn btn-primary" id="nextButton">Next</button>
                            <button type="submit" class="btn btn-success d-none" id="submitButton">Update</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
<script>
    function removeFile(inputName) {
            const fileInput = document.querySelector(`input[name="${inputName}"]`);
            fileInput.value = '';
            const removeButton = document.getElementById(`btn-remove-${inputName}`);
            removeButton.classList.add('d-none');
            console.log(`File removed: ${inputName}`);
        }


        document.addEventListener('DOMContentLoaded', function() {
            const steps = ['step1', 'step2', 'step3', 'step4', 'step5'];
            let currentStep = 0;


            const nextButton = document.getElementById('nextButton');
            const prevButton = document.getElementById('prevButton');
            const submitButton = document.getElementById('submitButton');


            const toggleVisibility = (element, condition) => {
                element.style.display = condition ? 'none' : 'inline-block';
            };


            const showStep = (step) => {
                steps.forEach((id, index) => {
                    document.getElementById(id).classList.toggle('d-none', index !== step);
                });
                toggleVisibility(prevButton, step === 0);
                toggleVisibility(nextButton, step === steps.length - 1);
                submitButton.classList.toggle('d-none', step !== steps.length - 1);
            };


            nextButton.addEventListener('click', function() {
                if (currentStep < steps.length - 1) {
                    currentStep++;
                    showStep(currentStep);
                }
            });


            prevButton.addEventListener('click', function() {
                if (currentStep > 0) {
                    currentStep--;
                    showStep(currentStep);
                }
            });


            showStep(currentStep);




            let rppCount = 1;
            const maxRPP = 13; // Batas maksimal RPP
            const rppWrapper = document.getElementById('rpp-wrapper');
            const addButton = document.getElementById('add-rpp');


            addButton.addEventListener('click', function() {
                if (rppCount < maxRPP) {
                    rppCount++;
                    const newRPP = `
                <div class="rpp-group">
                    <div class="row">
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label class="form-label">RPP ${rppCount}</label>
                                <input type="file" name="rpp_${rppCount}" class="form-control">
                                @error('rpp_${rppCount}')
                                    <div class="text-danger mt-2"> {{ $message }} </div>
                                @enderror
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label class="form-label">Pendukung RPP ${rppCount}</label>
                                <input type="file" name="pendukung_rpp_${rppCount}" class="form-control">
                                @error('pendukung_rpp_${rppCount}')
                                    <div class="text-danger mt-2"> {{ $message }} </div>
                                @enderror
                            </div>
                        </div>
                    </div>
                </div>`;
                    rppWrapper.insertAdjacentHTML('beforeend', newRPP);
                } else {
                    alert('Maksimal 13 RPP!');
                }
            });
        });
</script>
@endsection
