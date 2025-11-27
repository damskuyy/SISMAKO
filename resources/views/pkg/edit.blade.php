@extends('layouts.app')

@section('content')
    <div class="container mt-4">
        <a href="{{ route('pkg.index') }}" class="btn btn-secondary mb-3">Back</a>
        <form id="pkgForm" method="POST" action="{{ route('pkg.update', $pkg->id) }}" enctype="multipart/form-data">
            @csrf
            @method('PUT')

            @if ($errors->any())
                <div class="alert alert-danger">
                    <strong>Terjadi kesalahan:</strong>
                    <ul class="mb-0">
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <div class="card">
                <div class="card-body">
                    <div class="mb-3">Langkah <span id="currentStep">1</span> dari <span id="totalSteps">5</span></div>

                    <!-- Step 1: Identitas Guru yang Dinilai -->
                    <div class="pkg-step" data-step="1">
                        <h4>1. Identitas Guru yang Dinilai</h4>
                        <div class="row g-3 mb-3">
                            <div class="col-md-6">
                                <label>Pilih Nama (Guru / Tendik)</label>
                                <select id="personSelect" class="form-control">
                                    <option value="">-- Pilih Nama --</option>
                                    @if(isset($gurus) && $gurus->count())
                                        <optgroup label="Guru">
                                            @foreach($gurus as $g)
                                                <option value="guru-{{ $g->id }}" data-id="{{ $g->id }}" data-nip="{{ $g->no_nik }}" data-name="{{ $g->nama }}">{{ $g->nama }} (Guru)</option>
                                            @endforeach
                                        </optgroup>
                                    @endif
                                    @if(isset($tendiks) && $tendiks->count())
                                        <optgroup label="Tendik">
                                            @foreach($tendiks as $t)
                                                <option value="tendik-{{ $t->id }}" data-id="{{ $t->id }}" data-nip="{{ $t->no_nik }}" data-name="{{ $t->nama }}">{{ $t->nama }} (Tendik)</option>
                                            @endforeach
                                        </optgroup>
                                    @endif
                                </select>
                            </div>
                            <div class="col-md-3"><label>Nama</label><input type="text" id="nama" name="nama" class="form-control" value="{{ old('nama', $pkg->nama) }}" readonly required></div>
                            <div class="col-md-3"><label>NIP</label><input type="text" id="nip" name="nip" class="form-control" value="{{ old('nip', $pkg->nip) }}" inputmode="numeric" pattern="[0-9]*" readonly></div>
                            <input type="hidden" name="id_guru" id="id_guru" value="{{ old('id_guru', $pkg->id_guru) }}">
                            <input type="hidden" name="id_tendik" id="id_tendik" value="{{ old('id_tendik', $pkg->id_tendik) }}">

                            <div class="col-md-4"><label>Mapel</label><input type="text" name="mapel" class="form-control" value="{{ old('mapel', $pkg->mapel) }}"></div>
                            <div class="col-md-4"><label>Jabatan</label><input type="text" name="jabatan" class="form-control" value="{{ old('jabatan', $pkg->jabatan) }}"></div>
                            <div class="col-md-4"><label>Periode Penilaian</label>
                                <select name="periode_penilaian" class="form-control">
                                    @php $year = date('Y'); @endphp
                                    <option value="">-- Pilih Periode --</option>
                                    @for($i=0;$i<6;$i++)
                                        @php $y1 = $year - $i; $y2 = $y1 + 1; $p = $y1.'-'.$y2; @endphp
                                        <option value="{{ $p }}" {{ old('periode_penilaian', $pkg->periode_penilaian) == $p ? 'selected' : '' }}>{{ $p }}</option>
                                    @endfor
                                </select>
                            </div>
                        </div>
                    </div>

                    <!-- Step 2: Identitas Penilai -->
                    <div class="pkg-step" data-step="2" style="display:none;">
                        <h4>2. Identitas Penilai / Penguji</h4>
                        <div class="row g-3 mb-3">
                            <div class="col-md-6">
                                <label>Pilih Nama Penilai (Guru / Tendik)</label>
                                <select id="penilaiSelect" class="form-control">
                                    <option value="">-- Pilih Penilai --</option>
                                    @if(isset($gurus) && $gurus->count())
                                        <optgroup label="Guru">
                                            @foreach($gurus as $g)
                                                <option value="guru-{{ $g->id }}" data-id="{{ $g->id }}" data-nip="{{ $g->no_nik }}" data-name="{{ $g->nama }}">{{ $g->nama }} (Guru)</option>
                                            @endforeach
                                        </optgroup>
                                    @endif
                                    @if(isset($tendiks) && $tendiks->count())
                                        <optgroup label="Tendik">
                                            @foreach($tendiks as $t)
                                                <option value="tendik-{{ $t->id }}" data-id="{{ $t->id }}" data-nip="{{ $t->no_nik }}" data-name="{{ $t->nama }}">{{ $t->nama }} (Tendik)</option>
                                            @endforeach
                                        </optgroup>
                                    @endif
                                </select>
                            </div>
                            <div class="col-md-3"><label>Nama Penilai</label><input type="text" id="penilai_nama" name="penilai_nama" class="form-control" value="{{ old('penilai_nama', $pkg->penilai_nama) }}" readonly></div>
                            <div class="col-md-3"><label>NIP Penilai</label><input type="text" id="penilai_nip" name="penilai_nip" class="form-control" value="{{ old('penilai_nip', $pkg->penilai_nip) }}" inputmode="numeric" pattern="[0-9]*" readonly></div>
                            <div class="col-md-3"><label>Jabatan Penilai</label><input type="text" name="penilai_jabatan" class="form-control" value="{{ old('penilai_jabatan', $pkg->penilai_jabatan) }}"></div>
                            <input type="hidden" name="penilai_id_guru" id="penilai_id_guru" value="{{ old('penilai_id_guru', $pkg->penilai_id_guru) }}">
                            <input type="hidden" name="penilai_id_tendik" id="penilai_id_tendik" value="{{ old('penilai_id_tendik', $pkg->penilai_id_tendik) }}">
                        </div>
                    </div>

                    <!-- Step 3: Penilaian Kompetensi Utama -->
                    <div class="pkg-step" data-step="3" style="display:none;">
                        <h4>3. Penilaian Kompetensi Utama</h4>
                        <div class="row g-3 mb-3">
                            <div class="col-md-3"><label>Kompetensi Pedagogik</label>
                                <select name="kompetensi_pedagogik" class="form-control">
                                    <option value="">-</option>
                                    @for($i=1;$i<=5;$i++)
                                        <option value="{{ $i }}" {{ old('kompetensi_pedagogik', $pkg->kompetensi_pedagogik) == $i ? 'selected' : '' }}>{{ $i }}</option>
                                    @endfor
                                </select>
                            </div>
                            <div class="col-md-3"><label>Kompetensi Kepribadian</label>
                                <select name="kompetensi_kepribadian" class="form-control">
                                    <option value="">-</option>
                                    @for($i=1;$i<=5;$i++)
                                        <option value="{{ $i }}" {{ old('kompetensi_kepribadian', $pkg->kompetensi_kepribadian) == $i ? 'selected' : '' }}>{{ $i }}</option>
                                    @endfor
                                </select>
                            </div>
                            <div class="col-md-3"><label>Kompetensi Profesional</label>
                                <select name="kompetensi_profesional" class="form-control">
                                    <option value="">-</option>
                                    @for($i=1;$i<=5;$i++)
                                        <option value="{{ $i }}" {{ old('kompetensi_profesional', $pkg->kompetensi_profesional) == $i ? 'selected' : '' }}>{{ $i }}</option>
                                    @endfor
                                </select>
                            </div>
                            <div class="col-md-3"><label>Kompetensi Sosial</label>
                                <select name="kompetensi_sosial" class="form-control">
                                    <option value="">-</option>
                                    @for($i=1;$i<=5;$i++)
                                        <option value="{{ $i }}" {{ old('kompetensi_sosial', $pkg->kompetensi_sosial) == $i ? 'selected' : '' }}>{{ $i }}</option>
                                    @endfor
                                </select>
                            </div>
                            <div class="col-md-12"><label>Keterangan</label><textarea name="kompetensi_keterangan" class="form-control">{{ old('kompetensi_keterangan', $pkg->kompetensi_keterangan) }}</textarea></div>
                        </div>
                    </div>

                    <!-- Step 4: Penilaian Pelaksanaan Praktik -->
                    <div class="pkg-step" data-step="4" style="display:none;">
                        <h4>4. Penilaian Pelaksanaan Praktik</h4>
                        <div class="row g-3 mb-3">
                            <div class="col-md-4"><label>Praktik Kinerja</label>
                                <select name="praktik_kinerja" class="form-control">
                                    <option value="">-- Pilih --</option>
                                    <option value="diatas ekspektasi" {{ old('praktik_kinerja', $pkg->praktik_kinerja) == 'diatas ekspektasi' ? 'selected' : '' }}>Diatas Ekspektasi</option>
                                    <option value="sesuai ekspektasi" {{ old('praktik_kinerja', $pkg->praktik_kinerja) == 'sesuai ekspektasi' ? 'selected' : '' }}>Sesuai Ekspektasi</option>
                                    <option value="dibawah ekspektasi" {{ old('praktik_kinerja', $pkg->praktik_kinerja) == 'dibawah ekspektasi' ? 'selected' : '' }}>Dibawah Ekspektasi</option>
                                </select>
                            </div>
                            <div class="col-md-8"><label>Keterangan Praktik</label><input type="text" name="praktik_keterangan" class="form-control" value="{{ old('praktik_keterangan', $pkg->praktik_keterangan) }}"></div>

                            <div class="col-md-4"><label>Perilaku Kerja</label>
                                <select name="perilaku_kerja" class="form-control">
                                    <option value="">-- Pilih --</option>
                                    <option value="diatas ekspektasi" {{ old('perilaku_kerja', $pkg->perilaku_kerja) == 'diatas ekspektasi' ? 'selected' : '' }}>Diatas Ekspektasi</option>
                                    <option value="sesuai ekspektasi" {{ old('perilaku_kerja', $pkg->perilaku_kerja) == 'sesuai ekspektasi' ? 'selected' : '' }}>Sesuai Ekspektasi</option>
                                    <option value="dibawah ekspektasi" {{ old('perilaku_kerja', $pkg->perilaku_kerja) == 'dibawah ekspektasi' ? 'selected' : '' }}>Dibawah Ekspektasi</option>
                                </select>
                            </div>
                            <div class="col-md-8"><label>Keterangan Perilaku</label><input type="text" name="perilaku_keterangan" class="form-control" value="{{ old('perilaku_keterangan', $pkg->perilaku_keterangan) }}"></div>

                            <div class="col-md-4"><label>Predikat Kinerja</label>
                                <select name="predikat_kinerja" class="form-control">
                                    <option value="">-- Pilih --</option>
                                    @php $preds = ['sangat baik','baik','butuh perbaikan','kurang','sangat kurang','penilaian belum selesai']; @endphp
                                    @foreach($preds as $p)
                                        <option value="{{ $p }}" {{ old('predikat_kinerja', $pkg->predikat_kinerja) == $p ? 'selected' : '' }}>{{ ucwords($p) }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="col-md-8"><label>Keterangan Predikat</label><input type="text" name="predikat_keterangan" class="form-control" value="{{ old('predikat_keterangan', $pkg->predikat_keterangan) }}"></div>
                        </div>
                    </div>

                    <!-- Step 5: Kesimpulan & Foto -->
                    <div class="pkg-step" data-step="5" style="display:none;">
                        <h4>5. Kesimpulan & Rekomendasi</h4>
                        <div class="row g-3 mb-3">
                            <div class="col-md-12"><label>Kekuatan Guru</label><textarea name="kekuatan_guru" class="form-control">{{ old('kekuatan_guru', $pkg->kekuatan_guru) }}</textarea></div>
                            <div class="col-md-12"><label>Area Peningkatan</label><textarea name="area_peningkatan" class="form-control">{{ old('area_peningkatan', $pkg->area_peningkatan) }}</textarea></div>
                            <div class="col-md-12"><label>Rekomendasi Tingkat Lanjut</label><textarea name="rekomendasi_tingkat_lanjut" class="form-control">{{ old('rekomendasi_tingkat_lanjut', $pkg->rekomendasi_tingkat_lanjut) }}</textarea></div>
                            <div class="col-md-6">
                                <label>Foto Dokumentasi Kegiatan</label>
                                @if($pkg->foto_dokumentasi_kegiatan)
                                    <div class="mb-2"><img src="{{ $pkg->foto_dokumentasi_kegiatan }}" style="max-width:200px;" alt="foto"></div>
                                @endif
                                <input type="file" name="foto_dokumentasi_kegiatan" class="form-control">
                            </div>
                        </div>
                    </div>

                    <div class="d-flex justify-content-between">
                        <div>
                            <button type="button" id="prevBtn" class="btn btn-secondary" style="display:none;">Back</button>
                        </div>
                        <div>
                            <button type="button" id="nextBtn" class="btn btn-primary">Next</button>
                            <button type="submit" id="submitBtn" class="btn btn-success" style="display:none;">Update</button>
                        </div>
                    </div>
                </div>
            </div>
        </form>
    </div>
@endsection

<script>
document.addEventListener('DOMContentLoaded', function(){
    const steps = Array.from(document.querySelectorAll('.pkg-step'));
    const totalSteps = steps.length;
    const currentStepEl = document.getElementById('currentStep');
    const totalStepsEl = document.getElementById('totalSteps');
    const prevBtn = document.getElementById('prevBtn');
    const nextBtn = document.getElementById('nextBtn');
    const submitBtn = document.getElementById('submitBtn');
    let current = 1;
    totalStepsEl.textContent = totalSteps;

    function showStep(n){
        steps.forEach(s => s.style.display = 'none');
        const el = document.querySelector('.pkg-step[data-step="'+n+'"]');
        if(el) el.style.display = '';
        currentStepEl.textContent = n;
        prevBtn.style.display = (n === 1) ? 'none' : '';
        nextBtn.style.display = (n === totalSteps) ? 'none' : '';
        submitBtn.style.display = (n === totalSteps) ? '' : 'none';
    }

    function validateStep(n){
        const el = document.querySelector('.pkg-step[data-step="'+n+'"]');
        if(!el) return true;
        const invalid = el.querySelector(':invalid');
        if(invalid){
            invalid.reportValidity();
            invalid.focus();
            return false;
        }
        return true;
    }

    nextBtn.addEventListener('click', function(){
        if(!validateStep(current)) return;
        if(current < totalSteps) current++;
        showStep(current);
    });

    prevBtn.addEventListener('click', function(){
        if(current > 1) current--;
        showStep(current);
    });

    // handle person selection to populate nama and nip and id fields
    const personSelect = document.getElementById('personSelect');
    const namaInput = document.getElementById('nama');
    const nipInput = document.getElementById('nip');
    const idGuruInput = document.getElementById('id_guru');
    const idTendikInput = document.getElementById('id_tendik');
    if(personSelect){
        personSelect.addEventListener('change', function(){
            const opt = personSelect.options[personSelect.selectedIndex];
            if(!opt || !opt.value){
                namaInput.value = '';
                nipInput.value = '';
                idGuruInput.value = '';
                idTendikInput.value = '';
                return;
            }
            const parts = opt.value.split('-');
            const type = parts[0];
            const id = parts[1];
            const dataName = opt.dataset.name || '';
            const dataNip = opt.dataset.nip || '';
            namaInput.value = dataName;
            nipInput.value = dataNip;
            if(type === 'guru'){
                idGuruInput.value = id;
                idTendikInput.value = '';
            } else if(type === 'tendik'){
                idTendikInput.value = id;
                idGuruInput.value = '';
            }
        });
        // restore old selection if id present
        if(idGuruInput.value){
            const val = 'guru-' + idGuruInput.value;
            personSelect.value = val;
            personSelect.dispatchEvent(new Event('change'));
        } else if(idTendikInput.value){
            const val = 'tendik-' + idTendikInput.value;
            personSelect.value = val;
            personSelect.dispatchEvent(new Event('change'));
        } else if(namaInput.value){
            for(const opt of personSelect.options){
                if(opt.dataset && opt.dataset.name === namaInput.value){
                    personSelect.value = opt.value;
                    break;
                }
            }
        }
    }

    // handle penilai select
    const penilaiSelect = document.getElementById('penilaiSelect');
    const penilaiNama = document.getElementById('penilai_nama');
    const penilaiNip = document.getElementById('penilai_nip');
    const penilaiIdGuru = document.getElementById('penilai_id_guru');
    const penilaiIdTendik = document.getElementById('penilai_id_tendik');
    if(penilaiSelect){
        penilaiSelect.addEventListener('change', function(){
            const opt = penilaiSelect.options[penilaiSelect.selectedIndex];
            if(!opt || !opt.value){
                penilaiNama.value = '';
                penilaiNip.value = '';
                penilaiIdGuru.value = '';
                penilaiIdTendik.value = '';
                return;
            }
            const parts = opt.value.split('-');
            const type = parts[0];
            const id = parts[1];
            const dataName = opt.dataset.name || '';
            const dataNip = opt.dataset.nip || '';
            penilaiNama.value = dataName;
            penilaiNip.value = dataNip;
            if(type === 'guru'){
                penilaiIdGuru.value = id;
                penilaiIdTendik.value = '';
            } else if(type === 'tendik'){
                penilaiIdTendik.value = id;
                penilaiIdGuru.value = '';
            }
        });
        // restore old selection if present
        if(penilaiIdGuru.value){
            penilaiSelect.value = 'guru-' + penilaiIdGuru.value;
            penilaiSelect.dispatchEvent(new Event('change'));
        } else if(penilaiIdTendik.value){
            penilaiSelect.value = 'tendik-' + penilaiIdTendik.value;
            penilaiSelect.dispatchEvent(new Event('change'));
        } else if(penilaiNama.value){
            for(const opt of penilaiSelect.options){
                if(opt.dataset && opt.dataset.name === penilaiNama.value){
                    penilaiSelect.value = opt.value;
                    break;
                }
            }
        }
    }

    // If server-side validation errors exist, open the step containing the first error
    const serverErrors = @json($errors->keys());
    if(serverErrors && serverErrors.length){
        let targetStep = 1;
        for(const name of serverErrors){
            const field = document.querySelector('[name="'+name+'"]');
            if(field){
                const parent = field.closest('.pkg-step');
                if(parent) {
                    targetStep = parseInt(parent.getAttribute('data-step')) || 1;
                    break;
                }
            }
        }
        current = targetStep;
        showStep(current);
    } else {
        showStep(1);
    }
});
</script>
