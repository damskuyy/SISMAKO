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
                                        <textarea class="form-control" name="capaian_pembelajaran" rows="4">{{ $mapel->capaian_pembelajaran }}</textarea>
                                        @error('capaian_pembelajaran')
                                        <div class="text-danger">{{ $message }}</div>
                                        @enderror
                                    </div>
                                    <div class="col-md-4 mb-3">
                                        <label class="form-label fw-bold">Tujuan Pembelajaran & Silabus</label>
                                        <textarea class="form-control" name="tp_atp" rows="4">{{ $mapel->tp_atp }}</textarea>
                                        @error('tp_atp')
                                        <div class="text-danger">{{ $message }}</div>
                                        @enderror
                                    </div>
                                                                        <div class="col-md-4 mb-3">
                                        <label class="form-label fw-bold">KI, KD & SKL</label>
                                        <textarea class="form-control" name="kktp" rows="4">{{ $mapel->kktp }}</textarea>
                                        @error('kktp')
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
                                            <input type="file" class="form-control" name="kode_etik" accept="all">
                                            <div class="input-group-append">
                                                <button type="button" class="btn" style="height: 100%"
                                                    id="btn-remove-kode_etik" onclick="removeFile('kode_etik')"><i
                                                        class="fa-solid fa-x"></i></button>
                                            </div>
                                        </div>
                                        @error('kode_etik')
                                        <div class="text-danger">{{ $message }}</div>
                                        @enderror
                                    </div>
                                    <div class="col-md-4 mb-3">
                                        <label class="form-label fw-bold">Ikrar Guru</label>
                                        <div class="input-group">
                                            <input type="file" class="form-control" name="ikrar_guru" accept="all">
                                            <div class="input-group-append">
                                                <button type="button" class="btn" style="height: 100%"
                                                    id="btn-remove-ikrar_guru" onclick="removeFile('ikrar_guru')"><i
                                                        class="fa-solid fa-x"></i></button>
                                            </div>
                                        </div>
                                        @error('ikrar_guru')
                                        <div class="text-danger">{{ $message }}</div>
                                        @enderror
                                    </div>
                                    <div class="col-md-4 mb-3">
                                        <label class="form-label fw-bold">Tata Tertib Guru</label>
                                        <div class="input-group">
                                            <input type="file" class="form-control" name="tatib_guru" accept="all">
                                            <div class="input-group-append">
                                                <button type="button" class="btn" style="height: 100%"
                                                    id="btn-remove-tatib_guru" onclick="removeFile('tatib_guru')"><i
                                                        class="fa-solid fa-x"></i></button>
                                            </div>
                                        </div>
                                        @error('tatib_guru')
                                        <div class="text-danger">{{ $message }}</div>
                                        @enderror
                                    </div>
                                    <div class="col-md-4 mb-3">
                                        <label class="form-label fw-bold">Pembiasaan Guru</label>
                                        <div class="input-group">
                                            <input type="file" class="form-control" name="pembiasaan_guru" accept="all">
                                            <div class="input-group-append">
                                                <button type="button" class="btn" style="height: 100%"
                                                    id="btn-remove-pembiasaan_guru"
                                                    onclick="removeFile('pembiasaan_guru')"><i
                                                        class="fa-solid fa-x"></i></button>
                                            </div>
                                        </div>
                                        @error('pembiasaan_guru')
                                        <div class="text-danger">{{ $message }}</div>
                                        @enderror
                                    </div>
                                    <div class="col-md-4 mb-3">
                                        <label class="form-label fw-bold">Kalender Pendidikan (KALDIK)</label>
                                        <div class="input-group">
                                            <input type="file" class="form-control" name="kaldik_sekolah" accept="all">
                                            <div class="input-group-append">
                                                <button type="button" class="btn" style="height: 100%"
                                                    id="btn-remove-kaldik_sekolah" onclick="removeFile('kaldik_sekolah')"><i
                                                        class="fa-solid fa-x"></i></button>
                                            </div>
                                        </div>
                                        @error('kaldik_sekolah')
                                        <div class="text-danger">{{ $message }}</div>
                                        @enderror
                                    </div>
                                    <div class="col-md-4 mb-3">
                                        <label class="form-label fw-bold">Alokasi Waktu</label>
                                        <div class="input-group">
                                            <input type="file" class="form-control" name="alokasi_waktu" accept="all">
                                            <div class="input-group-append">
                                                <button type="button" class="btn" style="height: 100%"
                                                    id="btn-remove-alokasi_waktu" onclick="removeFile('alokasi_waktu')"><i
                                                        class="fa-solid fa-x"></i></button>
                                            </div>
                                        </div>
                                        @error('alokasi_waktu')
                                        <div class="text-danger">{{ $message }}</div>
                                        @enderror
                                    </div>
                                    <div class="col-md-4 mb-3">
                                        <label class="form-label fw-bold">Program Tahunan (PROTA)</label>
                                        <div class="input-group">
                                            <input type="file" class="form-control" name="program_tahunan" accept="all">
                                            <div class="input-group-append">
                                                <button type="button" class="btn" style="height: 100%"
                                                    id="btn-remove-program_tahunan" onclick="removeFile('program_tahunan')"><i
                                                        class="fa-solid fa-x"></i></button>
                                            </div>
                                        </div>
                                        @error('program_tahunan')
                                        <div class="text-danger">{{ $message }}</div>
                                        @enderror
                                    </div>
                                    <div class="col-md-4 mb-3">
                                        <label class="form-label fw-bold">Program Semester (PROSEM)</label>
                                        <div class="input-group">
                                            <input type="file" class="form-control" name="program_semester" accept="all">
                                            <div class="input-group-append">
                                                <button type="button" class="btn" style="height: 100%"
                                                    id="btn-remove-program_semester" onclick="removeFile('program_semester')"><i
                                                        class="fa-solid fa-x"></i></button>
                                            </div>
                                        </div>
                                        @error('program_semester')
                                        <div class="text-danger">{{ $message }}</div>
                                        @enderror
                                    </div>
                                    <div class="col-md-4 mb-3">
                                        <label class="form-label fw-bold">Jurnal Agenda Guru</label>
                                        <div class="input-group">
                                            <input type="file" class="form-control" name="jurnal_guru"
                                                accept="all">
                                            <div class="input-group-append">
                                                <button type="button" class="btn" style="height: 100%"
                                                    id="btn-remove-jurnal_guru"
                                                    onclick="removeFile('jurnal_guru')"><i
                                                        class="fa-solid fa-x"></i></button>
                                            </div>
                                        </div>
                                        @error('jurnal_guru')
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
                                            <input type="file" class="form-control" name="daftar_hadir_siswa"
                                                accept="all">
                                            <div class="input-group-append">
                                                <button type="button" class="btn" style="height: 100%"
                                                    id="btn-remove-daftar_hadir_siswa"
                                                    onclick="removeFile('daftar_hadir_siswa')"><i
                                                        class="fa-solid fa-x"></i></button>
                                            </div>
                                        </div>
                                        @error('daftar_hadir_siswa')
                                        <div class="text-danger">{{ $message }}</div>
                                        @enderror
                                    </div>
                                    <div class="col-md-6 mb-3">
                                        <label class="form-label fw-bold">Daftar Nilai Siswa</label>
                                        <div class="input-group">
                                            <input type="file" class="form-control" name="daftar_nilai_siswa"
                                                accept="all">
                                            <div class="input-group-append">
                                                <button type="button" class="btn" style="height: 100%"
                                                    id="btn-remove-daftar_nilai_siswa"
                                                    onclick="removeFile('daftar_nilai_siswa')"><i
                                                        class="fa-solid fa-x"></i></button>
                                            </div>
                                        </div>
                                        @error('daftar_nilai_siswa')
                                        <div class="text-danger">{{ $message }}</div>
                                        @enderror
                                    </div>
                                    <div class="col-md-6 mb-3">
                                        <label class="form-label fw-bold">Penilaian Sikap & Spiritual (PSS)</label>
                                        <div class="input-group">
                                            <input type="file" class="form-control" name="penilaian_sikap" accept="all">
                                            <div class="input-group-append">
                                                <button type="button" class="btn" style="height: 100%"
                                                    id="btn-remove-penilaian_sikap" onclick="removeFile('penilaian_sikap')"><i
                                                        class="fa-solid fa-x"></i></button>
                                            </div>
                                        </div>
                                        @error('penilaian_sikap')
                                        <div class="text-danger">{{ $message }}</div>
                                        @enderror
                                    </div>
                                    <div class="col-md-6 mb-3">
                                        <label class="form-label fw-bold">Analisis Hasil Penilaian</label>
                                        <div class="input-group">
                                            <input type="file" class="form-control" name="analisis_hasil_penilaian"
                                                accept="all">
                                            <div class="input-group-append">
                                                <button type="button" class="btn" style="height: 100%"
                                                    id="btn-remove-analisis_hasil_penilaian"
                                                    onclick="removeFile('analisis_hasil_penilaian')"><i
                                                        class="fa-solid fa-x"></i></button>
                                            </div>
                                        </div>
                                        @error('analisis_hasil_penilaian')
                                        <div class="text-danger">{{ $message }}</div>
                                        @enderror
                                    </div>
                                    <div class="col-md-6 mb-3">
                                        <label class="form-label fw-bold">Program Remedial & Pengayaan (PRP)</label>
                                        <div class="input-group">
                                            <input type="file" class="form-control" name="program_remedial" accept="all">
                                            <div class="input-group-append">
                                                <button type="button" class="btn" style="height: 100%"
                                                    id="btn-remove-program_remedial" onclick="removeFile('program_remedial')"><i
                                                        class="fa-solid fa-x"></i></button>
                                            </div>
                                        </div>
                                        @error('program_remedial')
                                        <div class="text-danger">{{ $message }}</div>
                                        @enderror
                                    </div>
                                    <div class="col-md-6 mb-3">
                                        <label class="form-label fw-bold">Jadwal Mengajar Guru</label>
                                        <div class="input-group">
                                            <input type="file" class="form-control" name="jadwal_pelajaran"
                                                accept="all">
                                            <div class="input-group-append">
                                                <button type="button" class="btn" style="height: 100%"
                                                    id="btn-remove-jadwal_pelajaran"
                                                    onclick="removeFile('jadwal_pelajaran')"><i
                                                        class="fa-solid fa-x"></i></button>
                                            </div>
                                        </div>
                                        @error('jadwal_pelajaran')
                                        <div class="text-danger">{{ $message }}</div>
                                        @enderror
                                    </div>
                                    <div class="col-md-6 mb-3">
                                        <label class="form-label fw-bold">Tugas Terstruktur</label>
                                        <div class="input-group">
                                            <input type="file" class="form-control" name="tugas_terstruktur"
                                                accept="all">
                                            <div class="input-group-append">
                                                <button type="button" class="btn" style="height: 100%"
                                                    id="btn-remove-tugas_terstruktur"
                                                    onclick="removeFile('tugas_terstruktur')"><i
                                                        class="fa-solid fa-x"></i></button>
                                            </div>
                                        </div>
                                        @error('tugas_terstruktur')
                                        <div class="text-danger">{{ $message }}</div>
                                        @enderror
                                    </div>
                                    <div class="col-md-6 mb-3">
                                        <label class="form-label fw-bold">Tugas Tidak Terstruktur</label>
                                        <div class="input-group">
                                            <input type="file" class="form-control" name="tugas_tidak_terstruktur"
                                                accept="all">
                                            <div class="input-group-append">
                                                <button type="button" class="btn" style="height: 100%"
                                                    id="btn-remove-tugas_tidak_terstruktur"
                                                    onclick="removeFile('tugas_tidak_terstruktur')"><i
                                                        class="fa-solid fa-x"></i></button>
                                            </div>
                                        </div>
                                        @error('tugas_tidak_terstruktur')
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
                                            <input type="file" class="form-control" name="dedkg" accept="all">
                                            <div class="input-group-append">
                                                <button type="button" class="btn" style="height: 100%"
                                                    id="btn-remove-dedkg" onclick="removeFile('dedkg')"><i
                                                        class="fa-solid fa-x"></i></button>
                                            </div>
                                        </div>
                                        @error('dedkg')
                                        <div class="text-danger">{{ $message }}</div>
                                        @enderror
                                    </div>
                                    <div class="col-md-6 mb-3">
                                        <label class="form-label fw-bold">Program Tindak Lanjut Kerja Guru
                                            (PTLKG)</label>
                                        <div class="input-group">
                                            <input type="file" class="form-control" name="ptlkg" accept="all">
                                            <div class="input-group-append">
                                                <button type="button" class="btn" style="height: 100%"
                                                    id="btn-remove-ptlkg" onclick="removeFile('ptlkg')"><i
                                                        class="fa-solid fa-x"></i></button>
                                            </div>
                                        </div>
                                        @error('ptlkg')
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
