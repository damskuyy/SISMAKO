@extends('layouts.app')

@section('content')
<div class="py-5">
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
        <div class="col container">
            <div class="row row-cards">
                <div class="col-12">
                    <div class="mb-4 col">
                        <a href="/penilaian/rapor/rerata" class="btn btn-secondary">
                            Back
                        </a>
                    </div>
                    <form class="card" action="{{ route('average.update', $average->id) }}" method="POST"
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
                                                    <option value="{{ $tahun }}"
                                                        {{ $average->tahun_ajaran == $tahun ? 'selected' : '' }}>
                                                        {{ $tahun }}</option>
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
                                            <select class="form-control form-select" name="kelas">
                                                <option value="">Pilih Kelas</option>
                                                <option value="X" {{ $average->kelas == 'X' ? 'selected' : '' }}>X
                                                </option>
                                                <option value="XI" {{ $average->kelas == 'XI' ? 'selected' : '' }}>XI
                                                </option>
                                                <option value="XII" {{ $average->kelas == 'XII' ? 'selected' : '' }}>XII
                                                </option>
                                                <option value="XIII" {{ $average->kelas == 'XIII' ? 'selected' : ''
                                                    }}>XIII</option>
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
                                                <option value="Ganjil" {{ $average->semester == 'Ganjil' ? 'selected' :
                                                    '' }}>Ganjil</option>
                                                <option value="Genap" {{ $average->semester == 'Genap' ? 'selected' : ''
                                                    }}>Genap</option>
                                            </select>
                                            @error('semester')
                                            <div class="text-danger mt-2"> {{ $message }} </div>
                                            @enderror
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div id="step2">
                            <div class="card-body">
                                <h3 class="card-title">Muatan Nasional</h3>
                                <div class="row row-cards">
                                    <div class="col-sm-6 col-md-4">
                                        <div class="mb-3">
                                            <label class="form-label"> Pendidikan Agama dan Budi Pekerti</label>
                                            <input type="number" class="form-control" name="pai"
                                                placeholder="Masukan Nilai" value="{{$average->pai}}">
                                        </div>
                                    </div>
                                    <div class="col-sm-6 col-md-4">
                                        <div class="mb-3">
                                            <label class="form-label">Pendidikan Pancasila dan
                                                Kewarganegaraan</label>
                                            <input type="number" class="form-control" name="pkn"
                                                placeholder="Masukan Nilai" value="{{$average->pkn}}">
                                        </div>
                                    </div>
                                    <div class="col-sm-6 col-md-4">
                                        <div class="mb-3">
                                            <label class="form-label">Bahasa Indonesia</label>
                                            <input type='number ' class="form-control" name="indo"
                                                placeholder="Masukan Nilai" value="{{$average->indo}}">
                                        </div>
                                    </div>
                                    <div class="col-sm-6 col-md-4">
                                        <div class="mb-3">
                                            <label class="form-label">Matematika</label>
                                            <input type='number ' class="form-control" name="mtk"
                                                placeholder="Masukan Nilai" value="{{$average->mtk}}">
                                        </div>
                                    </div>
                                    <div class="col-sm-6 col-md-4">
                                        <div class="mb-3">
                                            <label class="form-label">Sejarah Indonesia</label>
                                            <input type='number ' class="form-control" name="sejindo"
                                                placeholder="Masukan Nilai" value="{{$average->sejindo}}">
                                        </div>
                                    </div>
                                    <div class="col-sm-6 col-md-4">
                                        <div class="mb-3">
                                            <label class="form-label">Bahasa Asing</label>
                                            <input type='number ' class="form-control" name="bhs_asing"
                                                placeholder="Masukan Nilai" value="{{$average->bhs_asing}}">
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div id="step3">
                            <div class="card-body">
                                <h3 class="card-title">Muatan Kewilayahan</h3>
                                <div class="row row-cards">
                                    <div class="col-sm-6 col-md-6">
                                        <div class="mb-3">
                                            <label class="form-label">Seni Budaya</label>
                                            <input type='number ' class="form-control" name="sbd"
                                                placeholder="Masukan Nilai" value="{{$average->sbd}}">
                                        </div>
                                    </div>
                                    <div class="col-sm-6 col-md-6">
                                        <div class="mb-3">
                                            <label class="form-label">PJOK</label>
                                            <input type='number ' class="form-control" name="pjok"
                                                placeholder="Masukan Nilai" value="{{$average->pjok}}">
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div id="step4">
                            <div class="card-body">
                                <h3 class="card-title">C1. Dasar Bidang Keahlian</h3>
                                <div class="row row-cards">
                                    <div class="col-sm-6 col-md-4">
                                        <div class="mb-3">
                                            <label class="form-label">Simulasi dan Komunikasi Digital</label>
                                            <input type='number ' class="form-control" name="simdig"
                                                placeholder="Masukan Nilai" value="{{$average->simdig}}">
                                        </div>
                                    </div>
                                    <div class="col-sm-6 col-md-4">
                                        <div class="mb-3">
                                            <label class="form-label">Fisika</label>
                                            <input type='number ' class="form-control" name="fis"
                                                placeholder="Masukan Nilai" value="{{$average->fis}}">
                                        </div>
                                    </div>
                                    <div class="col-sm-6 col-md-4">
                                        <div class="mb-3">
                                            <label class="form-label">Kimia</label>
                                            <input type='number ' class="form-control" name="kim"
                                                placeholder="Masukan Nilai" value="{{$average->kim}}">
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div id="step5">
                            <div class="card-body">
                                <h3 class="card-title">C2. Dasar Program Keahlian</h3>
                                <div class="row row-cards">
                                    <div class="col-sm-6 col-md-4">
                                        <div class="mb-3">
                                            <label class="form-label">Sistem Komputer</label>
                                            <input type='number ' class="form-control" name="sis_kom"
                                                placeholder="Masukan Nilai" value="{{$average->sis_kom}}">
                                        </div>
                                    </div>
                                    <div class="col-sm-6 col-md-4">
                                        <div class="mb-3">
                                            <label class="form-label">Komputer dan Jaringan</label>
                                            <input type='number ' class="form-control" name="komjar"
                                                placeholder="Masukan Nilai" value="{{$average->komjar}}">
                                        </div>
                                    </div>
                                    <div class="col-sm-6 col-md-4">
                                        <div class="mb-3">
                                            <label class="form-label">Pemograman Dasar</label>
                                            <input type='number ' class="form-control" name="progdas"
                                                placeholder="Masukan Nilai" value="{{$average->progdas}}">
                                        </div>
                                    </div>
                                    <div class="col-sm-6 col-md-4">
                                        <div class="mb-3">
                                            <label class="form-label">Dasar Design Grafis</label>
                                            <input type='number ' class="form-control" name="ddg"
                                                placeholder="Masukan Nilai" value="{{$average->ddg}}">
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div id="step6">
                            <div class="card-body">
                                <h3 class="card-title">C3. Kompetensi Keahlian</h3>
                                <div class="row row-cards">
                                    <div class="col-sm-6 col-md-4">
                                        <div class="mb-3">
                                            <label class="form-label">Infrastruktur Komputasi Awan </label>
                                            <input type='number ' class="form-control" name="iaas"
                                                placeholder="Masukan Nilai" value="{{$average->iaas}}">
                                        </div>
                                    </div>
                                    <div class="col-sm-6 col-md-4">
                                        <div class="mb-3">
                                            <label class="form-label">Platform Komputasi Awan</label>
                                            <input type='number ' class="form-control" name="paas"
                                                placeholder="Masukan Nilai" value="{{$average->paas}}">
                                        </div>
                                    </div>
                                    <div class="col-sm-6 col-md-4">
                                        <div class="mb-3">
                                            <label class="form-label">Layanan Komputasi Awan</label>
                                            <input type='number ' class="form-control" name="saas"
                                                placeholder="Masukan Nilai" value="{{$average->saas}}">
                                        </div>
                                    </div>
                                    <div class="col-sm-6 col-md-4">
                                        <div class="mb-3">
                                            <label class="form-label">Sistem Internet of Things</label>
                                            <input type='number ' class="form-control" name="siot"
                                                placeholder="Masukan Nilai" value="{{$average->siot}}">
                                        </div>
                                    </div>
                                    <div class="col-sm-6 col-md-4">
                                        <div class="mb-3">
                                            <label class="form-label">Sistem Keamanan Jaringan</label>
                                            <input type='number ' class="form-control" name="skj"
                                                placeholder="Masukan Nilai" value="{{$average->skj}}">
                                        </div>
                                    </div>
                                    <div class="col-sm-6 col-md-4">
                                        <div class="mb-3">
                                            <label class="form-label">Produk Kreatif dan Kewirausahaan</label>
                                            <input type='number ' class="form-control" name="pkk"
                                                placeholder="Masukan Nilai" value="{{$average->pkk}}">
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
    document.addEventListener('DOMContentLoaded', function() {
            const steps = ['step1', 'step2', 'step3', 'step4', 'step5', 'step6', ];
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
