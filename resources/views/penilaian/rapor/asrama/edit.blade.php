@extends('layouts.app')

@section('content')
<div class="py-5">
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
        <div class="col container">
            <div class="row row-cards">
                <div class="col-12">
                    <div class="mb-4 col">
                        <a href="/penilaian/rapor/asrama" class="btn btn-secondary">
                            Back
                        </a>
                    </div>
                    <form class="card" action="{{ route('rasrama.update', $rasrama->id) }}" method="POST"
                        enctype="multipart/form-data">
                        @csrf
                        @method('PUT')
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
                                                <option value="{{ $tahun }}" {{ $rasrama->tahun_ajaran == $tahun ?
                                                    'selected' : '' }}>
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
                                            <label class="form-label">Semester</label>
                                            <select class="form-control form-select" name="semester" required>
                                                <option value="">Pilih Semester</option>
                                                <option value="Ganjil" {{ old('semester', $rasrama->semester ?? '') ==
                                                    'Ganjil' ? 'selected' : '' }}>
                                                    Ganjil
                                                </option>
                                                <option value="Genap" {{ old('semester', $rasrama->semester ?? '') ==
                                                    'Genap' ? 'selected' : '' }}>
                                                    Genap
                                                </option>
                                            </select>
                                            @error('semester')
                                            <div class="text-danger mt-2">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-sm-6 col-md-4">
                                        <div class="mb-3">
                                            <label class="form-label">Nama Siswa</label>
                                            <input type='text' class="form-control" placeholder="Masukan Nama"
                                                name="siswa_id" value="{{ old('siswa_id', $rasrama->siswa_id) }}"
                                                required>
                                            @error('siswa_id')
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
                                    <div class="col-sm-6 col-md-4">
                                        <div class="mb-3">
                                            <label class="form-label">Tanggal dikeluarkan</label>
                                            <input type='date' class="form-control datepicker"
                                                placeholder="Masukan Tanggal" name="released"
                                                value="{{ old('released', $rasrama->released) }}" autocomplete='off'>
                                        </div>
                                    </div>
                                    <div class="col-sm-6 col-md-4">
                                        <div class="mb-3">
                                            <label class="form-label">Nama Wali Asrama</label>
                                            <input type='text' class="form-control" placeholder="Masukan Nama"
                                                name="wname" value="{{ old('wname', $rasrama->wname) }}">
                                        </div>
                                    </div>
                                    <div class="col-sm-6 col-md-4">
                                        <div class="mb-3">
                                            <label class="form-label">Keterangan</label>
                                            <select class="form-control form-select" name="keterangan" required>
                                                <option value="">Pilih keterangan</option>
                                                <option value="Tercapai" {{ old('keterangan', $rasrama->keterangan ??
                                                    '') ==
                                                    'Tercapai' ? 'selected' : '' }}>
                                                    Tercapai
                                                </option>
                                                <option value="Tidak Tercapai" {{ old('keterangan', $rasrama->keterangan
                                                    ?? '') ==
                                                    'Tidak Tercapai' ? 'selected' : '' }}>
                                                    Tidak Tercapai
                                                </option>
                                            </select>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div id="step3">
                            <div class="card-body">
                                <h3 class="card-title text-center mb-4">Tahfidzul Qur'an</h3>
                                <table class="table table-bordered table-striped text-center">
                                    <tbody>
                                        @foreach ([
                                            'Makhrojul Huruf' => 'makhrojul',
                                            'Tajwid' => 'tajwid',
                                            'Waqof' => 'waqof',
                                            'Kelancaran' => 'kelancaran',
                                        ] as $label => $name)
                                        <tr>
                                            <td class="align-middle">{{ $label }}</td>
                                            <td>
                                                <input type="number" name="tahfidz[{{ $name }}][nilai]"
                                                    class="form-control"
                                                    value="{{ old('tahfidz.' . $name . '.nilai', $rasrama->tahfidz[$name]['nilai'] ?? '') }}"
                                                    placeholder="Masukan Nilai">
                                            </td>
                                        </tr>
                                        @endforeach
                                        <tr>
                                            <td class="align-middle">Izin</td>
                                            <td>
                                                <input type="number" name="tahfidz[izin]" class="form-control"
                                                    value="{{ old('tahfidz.izin', $rasrama->tahfidz['izin'] ?? '') }}" placeholder="Masukan Nilai">
                                            </td>
                                        </tr>
                                        <tr>
                                            <td class="align-middle">Sakit</td>
                                            <td>
                                                <input type="number" name="tahfidz[sakit]" class="form-control"
                                                    value="{{ old('tahfidz.sakit', $rasrama->tahfidz['sakit'] ?? '') }}" placeholder="Masukan Nilai">
                                            </td>
                                        </tr>
                                        <tr>
                                            <td class="align-middle">Alpha</td>
                                            <td>
                                                <input type="number" name="tahfidz[alpha]" class="form-control"
                                                    value="{{ old('tahfidz.alpha', $rasrama->tahfidz['alpha'] ?? '') }}" placeholder="Masukan Nilai">
                                            </td>
                                        </tr>
                                        <tr>
                                            <td class="align-middle">Hadir</td>
                                            <td>
                                                <input type="number" name="tahfidz[hadir]" class="form-control"
                                                    value="{{ old('tahfidz.hadir', $rasrama->tahfidz['hadir'] ?? '') }}" placeholder="Masukan Nilai">
                                            </td>
                                        </tr>
                                        <tr>
                                            <td class="align-middle">Jumlah</td>
                                            <td>
                                                <input type="number" name="tahfidz[jumlah]" class="form-control"
                                                    value="{{ old('tahfidz.jumlah', $rasrama->tahfidz['jumlah'] ?? '') }}" placeholder="Masukan Nilai">
                                            </td>
                                        </tr>
                                        <tr>
                                            <td class="align-middle">Jenis</td>
                                            <td>
                                                <select name="tahfidz[jenis]" id="tahfidz_jenis" class="form-control">
                                                    <option value="">Pilih Jenis</option>
                                                    <option value="Praktek" {{ old('tahfidz.jenis', $rasrama->tahfidz['jenis'] ?? '') == 'Praktek' ? 'selected' : '' }}>Praktek</option>
                                                    <option value="Teori" {{ old('tahfidz.jenis', $rasrama->tahfidz['jenis'] ?? '') == 'Teori' ? 'selected' : '' }}>Teori</option>
                                                </select>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td class="align-middle">Deskripsi</td>
                                            <td colspan="2">
                                                <textarea placeholder="Masukan Deskripsi" name="tahfidz[deskripsi]" class="form-control">{{ old('tahfidz.deskripsi', $rasrama->tahfidz['deskripsi'] ?? '') }}</textarea>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td class="align-middle">Batas Hafalan</td>
                                            <td colspan="2">
                                                <input placeholder="Masukan Batas Hafalan" type="text"
                                                    name="tahfidz[hafalan]" class="form-control"
                                                    value="{{ old('tahfidz.hafalan', $rasrama->tahfidz['hafalan'] ?? '') }}">
                                            </td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>

                        <div id="step4">
                            <div class="card-body">
                                <h3 class="card-title text-center mb-4">Tahsinul Qur'an</h3>
                                <table class="table table-bordered table-striped text-center">
                                    <tbody>
                                        @foreach ([
                                            'Makhrojul Huruf' => 'makhrojul',
                                            'Tajwid' => 'tajwid',
                                            'Waqof' => 'waqof',
                                            'Kelancaran' => 'kelancaran',
                                        ] as $label => $name)
                                        <tr>
                                            <td class="align-middle">{{ $label }}</td>
                                            <td>
                                                <input type="number" name="tahsin[{{ $name }}][nilai]"
                                                    class="form-control"
                                                    value="{{ old('tahsin.' . $name . '.nilai', $rasrama->tahsin[$name]['nilai'] ?? '') }}"
                                                    placeholder="Masukan Nilai">
                                            </td>
                                        </tr>
                                        @endforeach
                                        <tr>
                                            <td class="align-middle">Izin</td>
                                            <td>
                                                <input type="number" name="tahsin[izin]" class="form-control"
                                                    value="{{ old('tahsin.izin', $rasrama->tahsin['izin'] ?? '') }}" placeholder="Masukan Nilai">
                                            </td>
                                        </tr>
                                        <tr>
                                            <td class="align-middle">Sakit</td>
                                            <td>
                                                <input type="number" name="tahsin[sakit]" class="form-control"
                                                    value="{{ old('tahsin.sakit', $rasrama->tahsin['sakit'] ?? '') }}" placeholder="Masukan Nilai">
                                            </td>
                                        </tr>
                                        <tr>
                                            <td class="align-middle">Alpha</td>
                                            <td>
                                                <input type="number" name="tahsin[alpha]" class="form-control"
                                                    value="{{ old('tahsin.alpha', $rasrama->tahsin['alpha'] ?? '') }}" placeholder="Masukan Nilai">
                                            </td>
                                        </tr>
                                        <tr>
                                            <td class="align-middle">Hadir</td>
                                            <td>
                                                <input type="number" name="tahsin[hadir]" class="form-control"
                                                    value="{{ old('tahsin.hadir', $rasrama->tahsin['hadir'] ?? '') }}" placeholder="Masukan Nilai">
                                            </td>
                                        </tr>
                                        <tr>
                                            <td class="align-middle">Jumlah</td>
                                            <td>
                                                <input type="number" name="tahsin[jumlah]" class="form-control"
                                                    value="{{ old('tahsin.jumlah', $rasrama->tahsin['jumlah'] ?? '') }}" placeholder="Masukan Nilai">
                                            </td>
                                        </tr>
                                        <tr>
                                            <td class="align-middle">Jenis</td>
                                            <td>
                                                <select name="tahsin[jenis]" id="tahfidz_jenis" class="form-control">
                                                    <option value="">Pilih Jenis</option>
                                                    <option value="Praktek" {{ old('tahsin.jenis', $rasrama->tahsin['jenis'] ?? '') == 'Praktek' ? 'selected' : '' }}>Praktek</option>
                                                    <option value="Teori" {{ old('tahsin.jenis', $rasrama->tahsin['jenis'] ?? '') == 'Teori' ? 'selected' : '' }}>Teori</option>
                                                </select>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td class="align-middle">Deskripsi</td>
                                            <td colspan="2">
                                                <textarea placeholder="Masukan Deskripsi" name="tahsin[deskripsi]" class="form-control">{{ old('tahsin.deskripsi', $rasrama->tahsin['deskripsi'] ?? '') }}</textarea>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td class="align-middle">Batas Hafalan</td>
                                            <td colspan="2">
                                                <input placeholder="Masukan Batas Hafalan" type="text"
                                                    name="tahsin[hafalan]" class="form-control"
                                                    value="{{ old('tahsin.hafalan', $rasrama->tahsin['hafalan'] ?? '') }}">
                                            </td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>

                        <div id="step5">
                            <div class="card-body">
                                <h3 class="card-title">Edit Kegiatan Ubudiyyah</h3>
                                <div class="table-responsive">
                                    <table class="table">
                                        <thead>
                                            <tr>
                                                <th>Kegiatan</th>
                                                <th>Hadir</th>
                                                <th>Total</th>
                                                <th>Jenis</th>
                                                <th>Deskripsi</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach ([
                                                "Jama'ah Sholat Subuh" => 'Subuh',
                                                "Jama'ah Sholat Dzuhur" => 'Dzuhur',
                                                "Jama'ah Sholat Ashar" => 'Ashar',
                                                "Jama'ah Sholat Magrib" => 'Maghrib',
                                                "Jama'ah Sholat Isya" => 'Isya',
                                                "Sholat Dhuha" => 'dhuha',
                                                "Imam Sholat" => 'imam',
                                                "Muadzin" => 'muadzin',
                                                "Khutbah" => 'khutbah',
                                                "Kultum" => 'kultum',
                                                "Muroja'ah Surat Pilihan" => 'murojaah',
                                            ] as $label => $name)
                                            <tr>
                                                <td>{{ $label }}</td>
                                                <td>
                                                    <input type="number" name="ubudiyyah[{{ $name }}][hadir]"
                                                        id="{{ $name }}_hadir" class="form-control"
                                                        value="{{ old('ubudiyyah.' . $name . '.hadir', $ubudiyyah[$name]['hadir'] ?? '') }}"
                                                        placeholder="Hadir">
                                                </td>
                                                <td>
                                                    <input type="number" name="ubudiyyah[{{ $name }}][total]"
                                                        id="{{ $name }}_total" class="form-control"
                                                        value="{{ old('ubudiyyah.' . $name . '.total', $ubudiyyah[$name]['total'] ?? '') }}"
                                                        placeholder="Total">
                                                </td>
                                                <td>
                                                    <select name="ubudiyyah[{{ $name }}][jenis]" id="{{ $name }}_jenis"
                                                        class="form-select">
                                                        <option value="">Pilih Jenis</option>
                                                        <option value="Praktek" {{ (isset($rasrama->
                                                            ubudiyyah[$name]['jenis']) &&
                                                            $rasrama->ubudiyyah[$name]['jenis'] == 'Praktek') ?
                                                            'selected' : '' }}>
                                                            Praktek
                                                        </option>
                                                        <option value="Teori" {{ (isset($rasrama->
                                                            ubudiyyah[$name]['jenis']) &&
                                                            $rasrama->ubudiyyah[$name]['jenis'] == 'Teori') ? 'selected'
                                                            : '' }}>
                                                            Teori
                                                        </option>
                                                    </select>
                                                </td>
                                                <td>
                                                    <textarea name="ubudiyyah[{{ $name }}][deskripsi]"
                                                        class="form-control" rows="1"
                                                        placeholder="Deskripsi">{{ $rasrama->ubudiyyah[$name]['deskripsi'] ?? old('ubudiyyah.' . $name . '.deskripsi') }}</textarea>
                                                </td>
                                            </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>

                        <div id="step6">
                            <div class="card mb-4">
                                <div class="card-body">
                                    <h3 class="card-title">Kegiatan Amaliyyah</h3>
                                    <div class="table-responsive">
                                        <table class="table text-center">
                                            <thead class="table-light">
                                                <tr>
                                                    <th>Kegiatan Amaliyyah</th>
                                                    <th>Predikat</th>
                                                    <th>Izin</th>
                                                    <th>Sakit</th>
                                                    <th>Alpha</th>
                                                    <th>Hadir</th>
                                                    <th>Total</th>
                                                    <th>Jenis</th>
                                                    <th>Deskripsi</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @foreach ([
                                                'Inisiatif Kebersihan' => 'kebersihan',
                                                'Inisiatif Kedisiplinan' => 'disiplin',
                                                'Inisiatif Kerajinan' => 'kerajinan',
                                                'Inisiatif Sosial' => 'sosial',
                                                'Inisiatif Salam Sapa' => 'salam',
                                                ] as $label => $name)
                                                <tr>
                                                    <!-- Kegiatan -->
                                                    <td>{{ $label }}</td>

                                                    <!-- Dropdown Predikat -->
                                                    <td>
                                                        <select name="amaliyyah[{{ $name }}][jenis]" id="{{ $name }}_jenis"
                                                            class="form-select">
                                                            <option value="">Pilih Jenis</option>
                                                            <option value="Praktek" {{ (isset($rasrama->
                                                                amaliyyah[$name]['jenis']) &&
                                                                $rasrama->amaliyyah[$name]['jenis'] == 'Praktek') ?
                                                                'selected' : '' }}>
                                                                Praktek
                                                            </option>
                                                            <option value="Teori" {{ (isset($rasrama->
                                                                amaliyyah[$name]['jenis']) &&
                                                                $rasrama->amaliyyah[$name]['jenis'] == 'Teori') ? 'selected'
                                                                : '' }}>
                                                                Teori
                                                            </option>
                                                        </select>
                                                    </td>

                                                    <!-- Input Izin -->
                                                    <td>
                                                        <input type="number" name="amaliyyah[{{ $name }}][izin]"
                                                            class="form-control"
                                                            value="{{ $rasrama->amaliyyah[$name]['izin'] ?? old('amaliyyah.' . $name . '.izin') }}"
                                                            min="0" placeholder="0">
                                                    </td>

                                                    <!-- Input Sakit -->
                                                    <td>
                                                        <input type="number" name="amaliyyah[{{ $name }}][sakit]"
                                                            class="form-control"
                                                            value="{{ $rasrama->amaliyyah[$name]['sakit'] ?? old('amaliyyah.' . $name . '.sakit') }}"
                                                            min="0" placeholder="0">
                                                    </td>

                                                    <!-- Input Alpha -->
                                                    <td>
                                                        <input type="number" name="amaliyyah[{{ $name }}][alpha]"
                                                            class="form-control"
                                                            value="{{ $rasrama->amaliyyah[$name]['alpha'] ?? old('amaliyyah.' . $name . '.alpha') }}"
                                                            min="0" placeholder="0">
                                                    </td>

                                                    <!-- Input Hadir -->
                                                    <td>
                                                        <input type="number" name="amaliyyah[{{ $name }}][hadir]"
                                                            class="form-control"
                                                            value="{{ $rasrama->amaliyyah[$name]['hadir'] ?? old('amaliyyah.' . $name . '.hadir') }}"
                                                            min="0" placeholder="0">
                                                    </td>

                                                    <!-- Input Total -->
                                                    <td>
                                                        <input type="number" name="amaliyyah[{{ $name }}][total]"
                                                            class="form-control"
                                                            value="{{ $rasrama->amaliyyah[$name]['total'] ?? old('amaliyyah.' . $name . '.total') }}"
                                                            min="0" placeholder="0">
                                                    </td>

                                                    <!-- Dropdown Jenis -->
                                                    <td>
                                                        <select name="amaliyyah[{{ $name }}][jenis]"
                                                            class="form-select">
                                                            <option value="">Pilih Jenis</option>
                                                            <option value="Praktek" {{ isset($rasrama->
                                                                amaliyyah[$name]['jenis']) &&
                                                                $rasrama->amaliyyah[$name]['jenis'] == 'Praktek' ?
                                                                'selected' : '' }}>
                                                                Praktek
                                                            </option>
                                                            <option value="Teori" {{ isset($rasrama->
                                                                amaliyyah[$name]['jenis']) &&
                                                                $rasrama->amaliyyah[$name]['jenis'] == 'Teori' ?
                                                                'selected' : '' }}>
                                                                Teori
                                                            </option>
                                                        </select>
                                                    </td>

                                                    <!-- Input Deskripsi -->
                                                    <td>
                                                        <textarea name="amaliyyah[{{ $name }}][deskripsi]"
                                                            class="form-control" rows="1"
                                                            placeholder="Deskripsi">{{ $rasrama->amaliyyah[$name]['deskripsi'] ?? old('amaliyyah.' . $name . '.deskripsi') }}</textarea>
                                                    </td>
                                                </tr>
                                                @endforeach
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div id="step7">
                            <div class="card mb-4">
                                <div class="card-body">
                                    <h3 class="card-title">Mata Pelajaran Asrama</h3>
                                    <div class="table-responsive">
                                        <table class="table text-center">
                                            <thead class="table-light">
                                                <tr>
                                                    <th>Mata Pelajaran</th>
                                                    <th>Nilai</th>
                                                    <th>Jenis</th>
                                                    <th>Deskripsi</th>
                                                    <th>Alpha</th>
                                                    <th>Izin</th>
                                                    <th>Sakit</th>
                                                    <th>Hadir</th>
                                                    <th>Total</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @foreach ([
                                                'Kitab Tajwid' => 'tajwid',
                                                'Kitab Tafsir' => 'tafsir',
                                                'Kitab Fiqih' => 'fiqih',
                                                'Kitab Akhlak' => 'akhlak',
                                                'Matrikulasi' => 'matriks',
                                                'Bahasa Arab' => 'bhs_arab',
                                                'Vocabulary' => 'vocab',
                                                'Khot Arabic' => 'khot',
                                                ] as $label => $name)
                                                <tr>
                                                    <!-- Nama Mata Pelajaran -->
                                                    <td>{{ $label }}</td>

                                                    <!-- Input Nilai -->
                                                    <td>
                                                        <input type="number" name="mapel[{{ $name }}][nilai]"
                                                            id="{{ $name }}_nilai" class="form-control"
                                                            value="{{ $rasrama->mapel[$name]['nilai'] ?? old('mapel.' . $name . '.nilai') }}"
                                                            placeholder="Nilai">
                                                    </td>

                                                    <!-- Dropdown Jenis -->
                                                    <td>
                                                        <select name="mapel[{{ $name }}][jenis]" id="{{ $name }}_jenis"
                                                            class="form-select">
                                                            <option value="">Pilih Jenis</option>
                                                            <option value="Praktek" {{ (isset($rasrama->
                                                                mapel[$name]['jenis']) &&
                                                                $rasrama->mapel[$name]['jenis'] == 'Praktek') ?
                                                                'selected' : '' }}>
                                                                Praktek
                                                            </option>
                                                            <option value="Teori" {{ (isset($rasrama->
                                                                mapel[$name]['jenis']) &&
                                                                $rasrama->mapel[$name]['jenis'] == 'Teori') ? 'selected'
                                                                : '' }}>
                                                                Teori
                                                            </option>
                                                        </select>
                                                    </td>

                                                    <!-- Input Deskripsi -->
                                                    <td>
                                                        <textarea name="mapel[{{ $name }}][deskripsi]"
                                                            id="{{ $name }}_deskripsi" class="form-control" rows="1"
                                                            placeholder="Deskripsi">{{ $rasrama->mapel[$name]['deskripsi'] ?? old('mapel.' . $name . '.deskripsi') }}</textarea>
                                                    </td>

                                                    <!-- Input Alpha -->
                                                    <td>
                                                        <input type="number" name="mapel[{{ $name }}][alpha]"
                                                            id="{{ $name }}_alpha" class="form-control"
                                                            value="{{ $rasrama->mapel[$name]['alpha'] ?? old('mapel.' . $name . '.alpha') }}"
                                                            min="0" placeholder="Alpha">
                                                    </td>

                                                    <!-- Input Izin -->
                                                    <td>
                                                        <input type="number" name="mapel[{{ $name }}][izin]"
                                                            id="{{ $name }}_izin" class="form-control"
                                                            value="{{ $rasrama->mapel[$name]['izin'] ?? old('mapel.' . $name . '.izin') }}"
                                                            min="0" placeholder="Izin">
                                                    </td>

                                                    <!-- Input Sakit -->
                                                    <td>
                                                        <input type="number" name="mapel[{{ $name }}][sakit]"
                                                            id="{{ $name }}_sakit" class="form-control"
                                                            value="{{ $rasrama->mapel[$name]['sakit'] ?? old('mapel.' . $name . '.sakit') }}"
                                                            min="0" placeholder="Sakit">
                                                    </td>

                                                    <!-- Input Hadir -->
                                                    <td>
                                                        <input type="number" name="mapel[{{ $name }}][hadir]"
                                                            id="{{ $name }}_hadir" class="form-control"
                                                            value="{{ $rasrama->mapel[$name]['hadir'] ?? old('mapel.' . $name . '.hadir') }}"
                                                            min="0" placeholder="Hadir">
                                                    </td>

                                                    <!-- Input Total Kehadiran -->
                                                    <td>
                                                        <input type="number" name="mapel[{{ $name }}][total]"
                                                            id="{{ $name }}_total" class="form-control"
                                                            value="{{ $rasrama->mapel[$name]['total'] ?? old('mapel.' . $name . '.total') }}"
                                                            min="0" placeholder="Total">
                                                    </td>
                                                </tr>
                                                @endforeach
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div id="step8">
                            <div class="card mb-4">
                                <div class="card-body">
                                    <h3 class="card-title">Informasi Siswa</h3>
                                    <div class="table-responsive">
                                        <table class="table text-center">
                                            <thead class="table-light">
                                                <tr>
                                                    <th>Informasi</th>
                                                    <th>Deskripsi</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @foreach ([
                                                'Tinggi Badan' => 'tb',
                                                'Berat Badan' => 'bb',
                                                'Parfum' => 'parfum',
                                                'Reward/Juara' => 'juara',
                                                'Punishment' => 'punishment',
                                                'Jumlah Poin Pelanggaran' => 'poin',
                                                ] as $label => $name)
                                                <tr>
                                                    <!-- Label Informasi -->
                                                    <td>{{ $label }}</td>

                                                    <!-- Input Deskripsi -->
                                                    <td>
                                                        <textarea name="data_siswa[{{ $name }}][deskripsi]"
                                                            id="{{ $name }}_deskripsi" class="form-control" rows="2"
                                                            placeholder="Masukkan deskripsi">{{ $rasrama->data_siswa[$name]['deskripsi'] ?? old('data_siswa.' . $name . '.deskripsi') }}</textarea>
                                                    </td>
                                                </tr>
                                                @endforeach
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div id="step9">
                            <div class="card-body">
                                <h3 class="card-title">Pengembangan Diri</h3>
                                <table class="table">
                                    <thead>
                                        <tr>
                                            <th>No</th>
                                            <th>Nama Kegiatan</th>
                                            <th>Nilai</th>
                                            <th>Jenis</th>
                                        </tr>
                                    </thead>
                                    <tbody>
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

                                        @foreach ($achievements as $index => $achievement)
                                        <tr>
                                            <td>{{ $index + 1 }}</td>
                                            <td>
                                                <input type="text"
                                                    name="pengembangan_diri[{{ $achievement['name'] }}][adse]"
                                                    id="{{ $achievement['name'] }}_adse" class="form-control"
                                                    value="{{ $rasrama->pengembangan_diri[$achievement['name']]['adse'] ?? old('pengembangan_diri.' . $achievement['name'] . '.adse') }}">
                                            </td>
                                            <td>
                                                <input type="text"
                                                    name="pengembangan_diri[{{ $achievement['name'] }}][nilai]"
                                                    id="{{ $achievement['name'] }}_nilai" class="form-control"
                                                    value="{{ $rasrama->pengembangan_diri[$achievement['name']]['nilai'] ?? old('pengembangan_diri.' . $achievement['name'] . '.nilai') }}">
                                            </td>
                                            <td>
                                                <select name="pengembangan_diri[{{ $achievement['name'] }}][jenis]"
                                                    id="{{ $achievement['name'] }}_jenis" class="form-control">
                                                    <option value="">Pilih Jenis</option>
                                                    <option value="Teori" {{ (old('pengembangan_diri.' .
                                                        $achievement['name'] . '.jenis' ) ?? ($rasrama->
                                                        pengembangan_diri[$achievement['name']]['jenis'] ?? '')) ==
                                                        'Teori' ? 'selected' : '' }}>Teori</option>
                                                    <option value="Praktek" {{ (old('pengembangan_diri.' .
                                                        $achievement['name'] . '.jenis' ) ?? ($rasrama->
                                                        pengembangan_diri[$achievement['name']]['jenis'] ?? '')) ==
                                                        'Praktek' ? 'selected' : '' }}>Praktek</option>
                                                </select>
                                            </td>
                                        </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>

                        <div id="step10">
                            <div class="card-body">
                                <h3 class="card-title">Pencapaian Hafalan</h3>
                                <table class="table">
                                    <thead>
                                        <tr>
                                            <th>Juz</th>
                                            <th>Ujian Tashih</th>
                                            <th>Ujian Tasmi</th>
                                            <th>Sertifikat</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach (['30', '29', '28'] as $level)
                                        <tr>
                                            <td rowspan="2">Juz {{ $level }}</td>
                                            <!-- Dropdown Sudah/Belum -->
                                            @foreach (['ujian_tashih', 'ujian_tasmi', 'sertifikat'] as $name)
                                            <td>
                                                <select name="sertifikat[{{ $level }}][{{ $name }}][status]"
                                                    id="{{ $level }}_{{ $name }}_status" class="form-control">
                                                    <option value="Belum" {{ (old('sertifikat.' . $level . '.' . $name
                                                        . '.status' ) ?? ($rasrama->sertifikat[$level][$name]['status']
                                                        ??
                                                        '')) == 'Belum' ? 'selected' : '' }}>
                                                        Belum
                                                    </option>
                                                    <option value="Sudah" {{ (old('sertifikat.' . $level . '.' . $name
                                                        . '.status' ) ?? ($rasrama->sertifikat[$level][$name]['status']
                                                        ??
                                                        '')) == 'Sudah' ? 'selected' : '' }}>
                                                        Sudah
                                                    </option>
                                                </select>
                                            </td>
                                            @endforeach
                                        </tr>
                                        <tr>
                                            <!-- Input Tanggal -->
                                            @foreach (['ujian_tashih', 'ujian_tasmi', 'sertifikat'] as $name)
                                            <td>
                                                <input type="date" name="sertifikat[{{ $level }}][{{ $name }}][tanggal]"
                                                    id="{{ $level }}_{{ $name }}_tanggal" class="form-control"
                                                    value="{{ old('sertifikat.' . $level . '.' . $name . '.tanggal') ?? ($rasrama->sertifikat[$level][$name]['tanggal'] ?? '') }}">
                                            </td>
                                            @endforeach
                                        </tr>
                                        @endforeach
                                    </tbody>
                                </table>
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
</div>

<script>
    // datepicker


        document.addEventListener('DOMContentLoaded', function() {
            const steps = ['step1', 'step2', 'step3', 'step4', 'step5', 'step6', 'step7', 'step8', 'step9',
                'step10'
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
