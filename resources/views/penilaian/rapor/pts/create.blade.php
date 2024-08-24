@extends('layouts.app')

@section('content')

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="col">
                <div class="row row-cards">
                    <div class="col-12">
                        <form class="card" action="{{ route('average.perform') }}" method="POST" enctype="multipart/form-data">
                            @csrf
                            <div id="step1">
                                <div class="card-body">
                                    <h3 class="card-title">Data Siswa</h3>
                                    <div class="row row-cards">
                                        <div class="col-sm-6 col-md-4">
                                            <div class="mb-3">
                                                <label class="form-label">Tahun Ajaran</label>
                                                <select class="form-control form-select" name="tahun_ajaran">
                                                    <option value="">Pilih Tahun Ajaran</option>
                                                    <option value="2024-2025" {{ old('tahun_ajaran') == '2024-2025' ? 'selected' : '' }}>2024-2025</option>
                                                    <option value="2025-2026" {{ old('tahun_ajaran') == '2025-2026' ? 'selected' : '' }}>2025-2026</option>
                                                    <option value="2026-2027" {{ old('tahun_ajaran') == '2026-2027' ? 'selected' : '' }}>2026-2027</option>
                                                    <option value="2027-2028" {{ old('tahun_ajaran') == '2027-2028' ? 'selected' : '' }}>2027-2028</option>
                                                    <option value="2028-2029" {{ old('tahun_ajaran') == '2028-2029' ? 'selected' : '' }}>2028-2029</option>
                                                    <option value="2029-2030" {{ old('tahun_ajaran') == '2029-2030' ? 'selected' : '' }}>2029-2030</option>
                                                </select>
                                                @error('tahun_ajaran')
                                                    <div class="text-danger mt-2"> {{ $message }} </div>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="col-sm-6 col-md-4">
                                            <div class="mb-3">
                                                <label class="form-label">Kelas</label>
                                                <select class="form-control form-select" name="kelas">
                                                    <option value="">Pilih Kelas</option>
                                                    <option value="X" {{ old('kelas') == 'X' ? 'selected' : '' }}>X</option>
                                                    <option value="XI" {{ old('kelas') == 'XI' ? 'selected' : '' }}>XI</option>
                                                    <option value="XII" {{ old('kelas') == 'XII' ? 'selected' : '' }}>XII</option>
                                                    <option value="XIII" {{ old('kelas') == 'XIII' ? 'selected' : '' }}>XIII</option>
                                                </select>
                                                @error('kelas')
                                                    <div class="text-danger mt-2"> {{ $message }} </div>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="col-sm-6 col-md-4">
                                            <div class="mb-3">
                                                <label class="form-label">Semester</label>
                                                <select class="form-control form-select" name="semester">
                                                    <option value="">Pilih Semester</option>
                                                    <option value="1 (Ganjil)" {{ old('semester') == '1 (Ganjil)' ? 'selected' : '' }}>1 (Ganjil)</option>
                                                    <option value="2 (Genap)" {{ old('semester') == '2 (Genap)' ? 'selected' : '' }}>2 (Genap)</option>
                                                </select>
                                                @error('semester')
                                                    <div class="text-danger mt-2"> {{ $message }} </div>
                                                @enderror
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div id="step2" class="d-none">
                                <div class="card-body">
                                    <h3 class="card-title">Muatan Nasional</h3>
                                    <div class="row row-cards">
                                        <div class="col-sm-6 col-md-4">
                                            <div class="mb-3">
                                                <label class="form-label">Pendidikan Agama dan Budi Pekerti</label>
                                                <input type="number" class="form-control" name="pai" placeholder="Masukan Nilai" value="{{ old('pai') }}">
                                                @error('pai')
                                                    <div class="text-danger mt-2"> {{ $message }} </div>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="col-sm-6 col-md-4">
                                            <div class="mb-3">
                                                <label class="form-label">Pendidikan Pancasila dan Kewarganegaraan</label>
                                                <input type="number" class="form-control" name="pkn" placeholder="Masukan Nilai" value="{{ old('pkn') }}">
                                                @error('pkn')
                                                    <div class="text-danger mt-2"> {{ $message }} </div>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="col-sm-6 col-md-4">
                                            <div class="mb-3">
                                                <label class="form-label">Bahasa Indonesia</label>
                                                <input type="number" class="form-control" name="indo" placeholder="Masukan Nilai" value="{{ old('indo') }}">
                                                @error('indo')
                                                    <div class="text-danger mt-2"> {{ $message }} </div>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="col-sm-6 col-md-4">
                                            <div class="mb-3">
                                                <label class="form-label">Matematika</label>
                                                <input type="number" class="form-control" name="mtk" placeholder="Masukan Nilai" value="{{ old('mtk') }}">
                                                @error('mtk')
                                                    <div class="text-danger mt-2"> {{ $message }} </div>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="col-sm-6 col-md-4">
                                            <div class="mb-3">
                                                <label class="form-label">Sejarah Indonesia</label>
                                                <input type="number" class="form-control" name="sejindo" placeholder="Masukan Nilai" value="{{ old('sejindo') }}">
                                                @error('sejindo')
                                                    <div class="text-danger mt-2"> {{ $message }} </div>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="col-sm-6 col-md-4">
                                            <div class="mb-3">
                                                <label class="form-label">Bahasa Asing</label>
                                                <input type="number" class="form-control" name="bhs_asing" placeholder="Masukan Nilai" value="{{ old('bhs_asing') }}">
                                                @error('bhs_asing')
                                                    <div class="text-danger mt-2"> {{ $message }} </div>
                                                @enderror
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div id="step3" class="d-none">
                                <div class="card-body">
                                    <h3 class="card-title">Muatan Kewilayahan</h3>
                                    <div class="row row-cards">
                                        <div class="col-sm-6 col-md-6">
                                            <div class="mb-3">
                                                <label class="form-label">Seni Budaya</label>
                                                <input type="number" class="form-control" name="sbd" placeholder="Masukan Nilai" value="{{ old('sbd') }}">
                                                @error('sbd')
                                                    <div class="text-danger mt-2"> {{ $message }} </div>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="col-sm-6 col-md-6">
                                            <div class="mb-3">
                                                <label class="form-label">PJOK</label>
                                                <input type="number" class="form-control" name="pjok" placeholder="Masukan Nilai" value="{{ old('pjok') }}">
                                                @error('pjok')
                                                    <div class="text-danger mt-2"> {{ $message }} </div>
                                                @enderror
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div id="step4" class="d-none">
                                <div class="card-body">
                                    <h3 class="card-title">C1. Dasar Bidang Keahlian</h3>
                                    <div class="row row-cards">
                                        <div class="col-sm-6 col-md-4">
                                            <div class="mb-3">
                                                <label class="form-label">Simulasi dan Komunikasi Digital</label>
                                                <input type="number" class="form-control" name="simkom" placeholder="Masukan Nilai" value="{{ old('simkom') }}">
                                                @error('simkom')
                                                    <div class="text-danger mt-2"> {{ $message }} </div>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="col-sm-6 col-md-4">
                                            <div class="mb-3">
                                                <label class="form-label">Jaringan Komputer</label>
                                                <input type="number" class="form-control" name="jk" placeholder="Masukan Nilai" value="{{ old('jk') }}">
                                                @error('jk')
                                                    <div class="text-danger mt-2"> {{ $message }} </div>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="col-sm-6 col-md-4">
                                            <div class="mb-3">
                                                <label class="form-label">Sistem Komputer</label>
                                                <input type="number" class="form-control" name="sk" placeholder="Masukan Nilai" value="{{ old('sk') }}">
                                                @error('sk')
                                                    <div class="text-danger mt-2"> {{ $message }} </div>
                                                @enderror
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div id="step5" class="d-none">
                                <div class="card-body">
                                    <h3 class="card-title">C2. Kompetensi Keahlian</h3>
                                    <div class="row row-cards">
                                        <div class="col-sm-6 col-md-6">
                                            <div class="mb-3">
                                                <label class="form-label">Penyusunan Kegiatan</label>
                                                <input type="number" class="form-control" name="penyusunan" placeholder="Masukan Nilai" value="{{ old('penyusunan') }}">
                                                @error('penyusunan')
                                                    <div class="text-danger mt-2"> {{ $message }} </div>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="col-sm-6 col-md-6">
                                            <div class="mb-3">
                                                <label class="form-label">Analisis Kebutuhan</label>
                                                <input type="number" class="form-control" name="analisis" placeholder="Masukan Nilai" value="{{ old('analisis') }}">
                                                @error('analisis')
                                                    <div class="text-danger mt-2"> {{ $message }} </div>
                                                @enderror
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="card-footer text-end">
                                <button type="button" class="btn btn-primary" id="next-btn">Next</button>
                                <button type="button" class="btn btn-secondary d-none" id="prev-btn">Previous</button>
                                <button type="submit" class="btn btn-success d-none" id="submit-btn">Submit</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            let currentStep = 1;
            const totalSteps = 5;

            const showStep = (step) => {
                document.querySelectorAll('.card-body > div[id^="step"]').forEach(el => {
                    el.classList.add('d-none');
                });
                document.getElementById('step' + step).classList.remove('d-none');

                document.getElementById('prev-btn').classList.toggle('d-none', step === 1);
                document.getElementById('next-btn').classList.toggle('d-none', step === totalSteps);
                document.getElementById('submit-btn').classList.toggle('d-none', step !== totalSteps);
            };

            document.getElementById('next-btn').addEventListener('click', function() {
                if (currentStep < totalSteps) {
                    currentStep++;
                    showStep(currentStep);
                }
            });

            document.getElementById('prev-btn').addEventListener('click', function() {
                if (currentStep > 1) {
                    currentStep--;
                    showStep(currentStep);
                }
            });

            showStep(currentStep);
        });
    </script>

@endsection
