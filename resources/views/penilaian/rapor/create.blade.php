@extends('layouts.app')

@section('content')
<div class="py-5">
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
        <div class="col container">
            <div class="row row-cards">
                <div class="col-12">
                    <div class="mb-4 col">
                        <a href="/penilaian/rapor" class="btn btn-secondary">
                            Back
                        </a>
                    </div>
                    <form class="card" action="{{ route('rapor.perform') }}" method="POST"
                        enctype="multipart/form-data">
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
                                                @foreach (generateTahunAjaran() as $tahun)
                                                    <option value="{{ $tahun }}">{{ $tahun }}</option>
                                                @endforeach
                                            </select>
                                            @error('tahun_ajaran')
                                                <div class="text-danger mt-2"> {{ $message }} </div>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-sm-6 col-md-4">
                                        <div class="mb-3">
                                            <label class="form-label">Kelas</label>
                                            <select class="form-control form-select" name="kelas" required>
                                                <option value="">Pilih Kelas</option>
                                                <option value="X-PPLG" {{ old('kelas')=='X-PPLG' ? 'selected' : '' }}>X
                                                </option>
                                                <option value="XI-SIJA" {{ old('kelas')=='XI-SIJA' ? 'selected' : '' }}>XI
                                                </option>
                                                <option value="XII-SIJA" {{ old('kelas')=='XII-SIJA' ? 'selected' : '' }}>
                                                    XII</option>
                                                <option value="XIII-SIJA" {{ old('kelas')=='XIII-SIJA' ? 'selected' : '' }}>
                                                    XIII</option>
                                            </select>
                                            @error('kelas')
                                            <div class="text-danger mt-2"> {{ $message }} </div>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-sm-6 col-md-4">
                                        <div class="mb-3">
                                            <label class="form-label">Semester</label>
                                            <select class="form-control form-select" name="semester" required>
                                                <option value="">Pilih Semester</option>
                                                <option value="1 (Ganjil)" {{ old('semester', $rapor->semester ?? '') ==
                                                    '1 (Ganjil)' ? 'selected' : '' }}>
                                                    1 (Ganjil)
                                                </option>
                                                <option value="2 (Genap)" {{ old('semester', $rapor->semester ?? '') ==
                                                    '2 (Genap)' ? 'selected' : '' }}>
                                                    2 (Genap)
                                                </option>
                                            </select>
                                            @error('semester')
                                            <div class="text-danger mt-2">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-sm-6 col-md-6">
                                        <div class="mb-3">
                                            <label class="form-label">Nama Siswa</label>
                                            <input type='text' class="form-control" placeholder="Masukan Nama"
                                                name="nama" value="{{ old('nama') }}" required>
                                            @error('nama')
                                            <div class="text-danger mt-2"> {{ $message }} </div>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-sm-6 col-md-6">
                                        <div class="mb-3">
                                            <label class="form-label">NISN Siswa</label>
                                            <input type='number' class="form-control" placeholder="Masukan NISN"
                                                name="nisn" value="{{ old('nisn') }}" required>
                                            @error('nisn')
                                            <div class="text-danger mt-2"> {{ $message }} </div>
                                            @enderror
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div id="step2">
                            <div class="card-body">
                                <h3 class="card-title">Data Tambahan</h3>
                                <div class="row row-cards">
                                    <div class="col-sm-6 col-md-6">
                                        <div class="mb-3">
                                            <label class="form-label">Tanggal dikeluarkan</label>
                                            <input type='date' class="form-control datepicker"
                                                placeholder="Masukan Tanggal" name="released"
                                                value="{{ old('released') }}" autocomplete='off'>
                                        </div>
                                    </div>
                                    <div class="col-sm-6 col-md-6">
                                        <div class="mb-3">
                                            <label class="form-label">Nama Walas</label>
                                            <input type='text' class="form-control" placeholder="Masukan Nama"
                                                name="wname" value="{{ old('wname') }}">
                                        </div>
                                    </div>
                                    <div class="col-sm-6 col-md-6">
                                        <div class="mb-3">
                                            <label class="form-label">NIK Walas</label>
                                            <input type='number' class="form-control" placeholder="Masukan NIK"
                                                name="nip" value="{{ old('nip') }}">
                                        </div>
                                    </div>
                                    <div class="col-sm-6 col-md-6">
                                        <div class="mb-3">
                                            <label class="form-label">Nama Kepala Sekolah</label>
                                            <input type='text' class="form-control" placeholder="Masukan Nama"
                                                name="hmaster" value="{{ old('hmaster') }}">
                                        </div>
                                    </div>
                                    <div class="col-sm-6 col-md-6">
                                        <div class="mb-3">
                                            <label class="form-label">NIK Kepala Sekolah</label>
                                            <input type='number' class="form-control" placeholder="Masukan NIK"
                                                name="hmnip" value="{{ old('hmnip') }}">
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div id="step3">
                            <div class="card-body">
                                <h3 class="card-title">Nilai Sikap</h3>
                                <div class="row row-cards">
                                    @foreach([
                                        'Beriman, bertakwa kepada Tuhan Yang Maha Esa, dan berakhlak mulia' => 'beriman',
                                        'Mandiri' => 'mandiri',
                                        'Bergotong royong' => 'gotong_royong'
                                    ] as $label => $name)
                                    <div class="col-sm-6 col-md-6">
                                        <div class="mb-3">
                                            <label class="form-label">{{ $label }}</label>
                                            <textarea name="attitude[{{ $name }}][deskripsi]" id="{{ $name }}_deskripsi" class="form-control">{{ old('attitude.'.$name.'.deskripsi') }}</textarea>
                                        </div>
                                    </div>
                                    @endforeach
                                </div>
                            </div>
                        </div>

                        <div id="step4">
                            <div class="card-body">
                                <h3 class="card-title">Muatan Nasional</h3>
                                <div class="row row-cards">
                                    @foreach([
                                        'Pendidikan Agama Islam dan Budi Pekerti' => 'pai',
                                        'Pendidikan Pancasila dan Kewarganegaraan' => 'pkn',
                                        'Bahasa Indonesia' => 'bindo',
                                        'Matematika' => 'mtk',
                                        'Sejarah Indonesia' => 'sejindo',
                                        'Bahasa Inggris' => 'bhsAsing'
                                    ] as $label => $name)
                                    <div class="col-sm-6 col-md-4">
                                        <div class="mb-3">
                                            <label class="form-label">{{ $label }}</label>
                                            <input type="number" name="muatan_nasional[{{ $name }}][nilai]" id="{{ $name }}_nilai" class="form-control" value="{{ old('muatan_nasional.'.$name.'.nilai') }}">
                                        </div>
                                        <div class="mb-3">
                                            <label class="form-label">Deskripsi {{ $label }}</label>
                                            <textarea name="muatan_nasional[{{ $name }}][deskripsi]" id="{{ $name }}_deskripsi" class="form-control">{{ old('muatan_nasional.'.$name.'.deskripsi') }}</textarea>
                                        </div>
                                    </div>
                                    @endforeach
                                </div>
                            </div>
                        </div>

                        <div id="step5">
                            <div class="card-body">
                                <h3 class="card-title">Muatan Kewilayahan</h3>
                                <div class="row row-cards">
                                    @foreach([
                                        'Seni Budaya' => 'sbd',
                                        'PJOK' => 'pjok'
                                    ] as $label => $name)
                                    <div class="col-sm-6 col-md-6">
                                        <div class="mb-3">
                                            <label class="form-label">{{ $label }}</label>
                                            <input type="number" name="muatan_kewilayahan[{{ $name }}][nilai]" id="{{ $name }}_nilai" class="form-control" value="{{ old('muatan_kewilayahan.'.$name.'.nilai') }}">
                                        </div>
                                        <div class="mb-3">
                                            <label class="form-label">Deskripsi {{ $label }}</label>
                                            <textarea name="muatan_kewilayahan[{{ $name }}][deskripsi]" id="{{ $name }}_deskripsi" class="form-control">{{ old('muatan_kewilayahan.'.$name.'.deskripsi') }}</textarea>
                                        </div>
                                    </div>
                                    @endforeach
                                </div>
                            </div>
                        </div>

                        <div id="step6">
                            <div class="card-body">
                                <h3 class="card-title">C1. Dasar Bidang Keahlian</h3>
                                <div class="row row-cards">
                                    @foreach([
                                        'Informatika' => 'simdig',
                                        'IPAS' => 'fisika',
                                        'DDPK' => 'kimia'
                                    ] as $label => $name)
                                    <div class="col-sm-6 col-md-4">
                                        <div class="mb-3">
                                            <label class="form-label">{{ $label }}</label>
                                            <input type="number" name="muatan_peminatan[{{ $name }}][nilai]" id="{{ $name }}_nilai" class="form-control" value="{{ old('muatan_peminatan.'.$name.'.nilai') }}">
                                        </div>
                                        <div class="mb-3">
                                            <label class="form-label">Deskripsi {{ $label }}</label>
                                            <textarea name="muatan_peminatan[{{ $name }}][deskripsi]" id="{{ $name }}_deskripsi" class="form-control">{{ old('muatan_peminatan.'.$name.'.deskripsi') }}</textarea>
                                        </div>
                                    </div>
                                    @endforeach
                                </div>
                            </div>
                        </div>

                        <div id="step7">
                            <div class="card-body">
                                <h3 class="card-title">C2. Dasar Program Keahlian</h3>
                                <div class="row row-cards">
                                    @php
                                        $subjects = [
                                            ['label' => 'Sistem Komputer', 'name' => 'siskom'],
                                            ['label' => 'Komputer dan Jaringan', 'name' => 'komjar'],
                                            ['label' => 'Pemrograman Dasar', 'name' => 'progdas'],
                                            ['label' => 'Dasar Design Grafis', 'name' => 'ddg'],
                                        ];
                                    @endphp

                                    @foreach ($subjects as $subject)
                                        <div class="col-sm-6 col-md-3">
                                            <div class="mb-3">
                                                <label class="form-label">{{ $subject['label'] }}</label>
                                                <input type="number" name="muatan_peminatan[{{ $subject['name'] }}][nilai]"
                                                    id="{{ $subject['name'] }}_nilai" class="form-control"
                                                    value="{{ old('muatan_peminatan.' . $subject['name'] . '.nilai') }}">
                                            </div>
                                        </div>
                                    @endforeach

                                    @foreach ($subjects as $subject)
                                        <div class="col-sm-6 col-md-3">
                                            <div class="mb-3">
                                                <label class="form-label">Deskripsi {{ $subject['label'] }}</label>
                                                <textarea name="muatan_peminatan[{{ $subject['name'] }}][deskripsi]"
                                                    id="{{ $subject['name'] }}_deskripsi" class="form-control">
                                                    {{ old('muatan_peminatan.' . $subject['name'] . '.deskripsi') }}
                                                </textarea>
                                            </div>
                                        </div>
                                    @endforeach
                                </div>
                            </div>
                        </div>

                        <div id="step8">
                            <div class="card-body">
                                <h3 class="card-title">C3. Kompetensi Keahlian</h3>
                                <div class="row row-cards">
                                    @php
                                        $competencies = [
                                            ['label' => 'Infrastruktur Komputasi Awan', 'name' => 'iaas'],
                                            ['label' => 'Platform Komputasi Awan', 'name' => 'paas'],
                                            ['label' => 'Layanan Komputasi Awan', 'name' => 'saas'],
                                            ['label' => 'Sistem Internet of Things', 'name' => 'siot'],
                                            ['label' => 'Sistem Keamanan Jaringan', 'name' => 'skj'],
                                            ['label' => 'Produk Kreatif dan Kewirausahaan', 'name' => 'pkk'],
                                        ];
                                    @endphp

                                    @foreach ($competencies as $competency)
                                        <div class="col-sm-6 col-md-4">
                                            <div class="mb-3">
                                                <label class="form-label">{{ $competency['label'] }}</label>
                                                <input type="number" name="muatan_peminatan[{{ $competency['name'] }}][nilai]"
                                                    id="{{ $competency['name'] }}_nilai" class="form-control"
                                                    value="{{ old('muatan_peminatan.' . $competency['name'] . '.nilai') }}">
                                            </div>
                                        </div>
                                    @endforeach

                                    @foreach ($competencies as $competency)
                                        <div class="col-sm-6 col-md-4">
                                            <div class="mb-3">
                                                <label class="form-label">Deskripsi {{ $competency['label'] }}</label>
                                                <textarea name="muatan_peminatan[{{ $competency['name'] }}][deskripsi]"
                                                    id="{{ $competency['name'] }}_deskripsi" class="form-control">
                                                    {{ old('muatan_peminatan.' . $competency['name'] . '.deskripsi') }}
                                                </textarea>
                                            </div>
                                        </div>
                                    @endforeach
                                </div>
                            </div>
                        </div>

                        <div id="step9">
                            <div class="card-body">
                                <h3 class="card-title">Ekstrakurikuler</h3>
                                <div class="row row-cards">
                                    @php
                                        $extracurriculars = [
                                            ['label' => 'Pramuka', 'name' => 'pramuka'],
                                            ['label' => 'Bulu Tangkis', 'name' => 'bultang'],
                                            ['label' => 'Futsal', 'name' => 'futsal'],
                                            ['label' => 'Silat', 'name' => 'silat'],
                                        ];
                                    @endphp

                                    @foreach ($extracurriculars as $extra)
                                        <div class="col-sm-6 col-md-3">
                                            <div class="mb-3">
                                                <label class="form-label">{{ $extra['label'] }}</label>
                                                <input type="text" name="extracurricular[{{ $extra['name'] }}][nilai]"
                                                    id="{{ $extra['name'] }}_nilai" class="form-control"
                                                    value="{{ old('extracurricular.' . $extra['name'] . '.nilai') }}">
                                            </div>
                                        </div>
                                    @endforeach

                                    @foreach ($extracurriculars as $extra)
                                        <div class="col-sm-6 col-md-3">
                                            <div class="mb-3">
                                                <label class="form-label">Deskripsi {{ $extra['label'] }}</label>
                                                <textarea name="extracurricular[{{ $extra['name'] }}][deskripsi]"
                                                    id="{{ $extra['name'] }}_deskripsi" class="form-control">
                                                    {{ old('extracurricular.' . $extra['name'] . '.deskripsi') }}
                                                </textarea>
                                            </div>
                                        </div>
                                    @endforeach
                                </div>
                            </div>
                        </div>

                        <div id="step10">
                            <div class="card-body">
                                <h3 class="card-title">Kehadiran (Walas)</h3>
                                <div class="row row-cards">
                                    <div class="col-sm-6 col-md-4">
                                        <div class="mb-3">
                                            <label class="form-label">Izin</label>
                                            <input type='number' class="form-control" name="izin"
                                                placeholder="Masukan Nilai" value="{{ old('izin') }}">
                                        </div>
                                    </div>
                                    <div class="col-sm-6 col-md-4">
                                        <div class="mb-3">
                                            <label class="form-label">Sakit</label>
                                            <input type='number' class="form-control" name="sakit"
                                                placeholder="Masukan Nilai" value="{{ old('sakit') }}">
                                        </div>
                                    </div>
                                    <div class="col-sm-6 col-md-4">
                                        <div class="mb-3">
                                            <label class="form-label">Alpha</label>
                                            <input type='number' class="form-control" name="alpha"
                                                placeholder="Masukan Nilai" value="{{ old('alpha') }}">
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div id="step11">
                            <div class="card-body">
                                <h3 class="card-title">Prestasi Siswa</h3>
                                <div class="row row-cards">
                                    @php
                                        $achievements = [
                                            ['label' => 'Prestasi 1', 'name' => 'one'],
                                            ['label' => 'Prestasi 2', 'name' => 'two'],
                                            ['label' => 'Prestasi 3', 'name' => 'three'],
                                            ['label' => 'Prestasi 4', 'name' => 'four'],
                                            ['label' => 'Prestasi 5', 'name' => 'five'],
                                            ['label' => 'Prestasi 6', 'name' => 'six'],
                                        ];
                                    @endphp

                                    @foreach ($achievements as $achievement)
                                        <div class="col-sm-6 col-md-4">
                                            <div class="mb-3">
                                                <label class="form-label">{{ $achievement['label'] }}</label>
                                                <input type="text" name="achievements[{{ $achievement['name'] }}][nilai]"
                                                    id="{{ $achievement['name'] }}_nilai" class="form-control"
                                                    value="{{ old('achievements.' . $achievement['name'] . '.nilai') }}">
                                            </div>
                                        </div>
                                    @endforeach

                                    @foreach ($achievements as $achievement)
                                        <div class="col-sm-6 col-md-4">
                                            <div class="mb-3">
                                                <label class="form-label">Deskripsi {{ $achievement['label'] }}</label>
                                                <textarea name="achievements[{{ $achievement['name'] }}][deskripsi]"
                                                    id="{{ $achievement['name'] }}_deskripsi" class="form-control">
                                                    {{ old('achievements.' . $achievement['name'] . '.deskripsi') }}
                                                </textarea>
                                            </div>
                                        </div>
                                    @endforeach
                                </div>
                            </div>
                        </div>

                        <div id="step12">
                            <div class="card-body">
                                <h3 class="card-title">Catatan Wali Kelas</h3>
                                <div class="row row-cards">
                                    <div class="col-sm-6 col-md-12">
                                        <div class="mb-3">
                                            <label class="form-label">Catatan</label>
                                            <textarea rows="5" class="form-control" placeholder="Deskripsi"
                                                name="note">{{ old('note') }}</textarea>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="card-footer text-end">
                            <button type="button" class="btn btn-secondary" id="prevButton"
                                style="display: none;">Previous</button>
                            <button type="button" class="btn btn-primary" id="nextButton">Next</button>
                            <button type="submit" class="btn btn-success d-none" id="submitButton">Submit</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
    // datepicker
        function initializeDatepickers() {
            var datepickers = document.querySelectorAll('[id^="datepicker-icon-"]');
            datepickers.forEach(function(datepicker) {
                new Litepicker({
                    element: datepicker,
                    format: 'DD MMMM YYYY', // Format tanggal
                    buttonText: {
                        previousMonth: `<svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24"
                viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none"
                stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"/>
                <path d="M15 6l-6 6l6 6" /></svg>`,
                        nextMonth: `<svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24"
                viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none"
                stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"/>
                <path d="M9 6l6 6l-6 6" /></svg>`,
                    },
                    locale: {
                        months: ['Januari', 'Februari', 'Maret', 'April', 'Mei', 'Juni', 'Juli', 'Agustus',
                            'September', 'Oktober', 'November', 'Desember'
                        ],
                        weekdays: ['Minggu', 'Senin', 'Selasa', 'Rabu', 'Kamis', 'Jumat', 'Sabtu'],
                    }
                });
            });
        }

        document.addEventListener('DOMContentLoaded', function() {
            const steps = ['step1', 'step2', 'step3', 'step4', 'step5', 'step6', 'step7', 'step8', 'step9',
                'step10', 'step11', 'step12'
            ];
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
            initializeDatepickers();
        });
</script>
@endsection
