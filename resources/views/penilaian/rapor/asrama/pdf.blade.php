<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>report card</title>

    <style type="text/css">
        @Page {
            margin-top: 10px;
            margin-bottom: 10px;
            margin-right: 15px;
            margin-left: 15px;
            size: A4;
        }

        body {
            font-family: 'Times New Roman', Times, serif;
            margin: 0;
            padding: 10px;
            font-size: 12px;
            line-height: 1.5;
        }

        .section-1,
        .section-2,
        .section-3,
        .section-4 {
            font-size: 12px;
        }

        .section-5,
        .section-6,
        .section-7,
        .section-8 {
            font-size: 11px;
        }

        .header {
            text-align: center;
            margin: 10px 0 15px 0;
            padding: 0;
        }

        .header img {
            width: 90px;
            height: auto;
            margin-bottom: 5px;
        }

        .header h2 {
            margin: 2px 0;
            font-size: 16px;
            font-weight: bold;
        }

        .header h3 {
            margin: 2px 0;
            font-size: 14px;
            font-weight: bold;
        }

        table.d-none {
            border: none;
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 10px;
        }

        .d-none td {
            text-align: left;
            vertical-align: top;
            padding: 2px 5px;
            font-size: 12px;
        }

        .label,
        .long-label {
            display: inline-block;
            font-weight: normal;
            vertical-align: top;
            margin: 0;
            padding: 0;
        }

        .label {
            width: auto;
            min-width: 60px;
        }

        .long-label {
            width: auto;
            min-width: 100px;
        }

        .value {
            display: inline-block;
            font-weight: normal;
            margin: 0;
            padding: 0;
        }

        .right,
        .left {
            font-size: 12px;
        }

        .right {
            width: 50%;
            padding-right: 20px;
        }

        .left {
            width: 50%;
        }

        .label,
        .long-label,
        .value {
            font-size: 12px;
        }

        .number {
            width: 4%;
            text-align: center;
        }

        .type {
            width: 5%;
            text-align: center;
        }

        .score {
            width: 6%;
            text-align: center;
        }

        .attendance {
            width: 5%;
            text-align: center;
        }

        .mapel,
        .description {
            width: 20%;
            text-align: left;
        }

        .table,
        .certificate-table {
            width: 100%;
            border-collapse: collapse;
            margin: 5px 0;
            font-size: 11px;
        }

        .table,
        .table th,
        .table td,
        .certificate-table,
        .certificate-table th,
        .certificate-table td {
            border: 0.5px solid #333;
        }

        .small-text {
            font-size: 11px;
            text-align: left !important;
        }

        .blue-text {
            background-color: #e8f4f8;
        }

        .certificate-table th,
        .certificate-table td,
        .table th,
        .table td {
            padding: 4px 3px;
            text-align: center;
            vertical-align: middle;
            font-size: 11px;
        }

        .certificate-table {
            width: 100%;
            margin-top: 5px;
        }

        .table th {
            background-color: #d4e9f7;
            font-weight: bold;
        }

        .subject {
            text-align: left;
            padding-left: 8px;
            font-weight: bold;
            background-color: #e8e8e8;
            font-size: 11px;
        }

        .no-border {
            border: none;
        }

        .category-title {
            font-weight: bold;
            text-align: left;
            padding-left: 8px;
            background-color: #f0f0f0;
            font-size: 11px;
        }

        .check td img {
            width: 16px;
        }

        .signature {
            width: 100%;
            border-collapse: collapse;
            margin-top: 30px;
        }

        .signature td {
            text-align: center;
            vertical-align: top;
            font-size: 10px;
            padding: 5px;
            width: 17%;
        }

        .location-date {
            text-align: right;
            margin-top: 15px;
            margin-bottom: 15px;
            font-size: 11px;
        }

        .signature-title {
            font-size: 10px;
            margin-bottom: 55px;
        }

        .name {
            font-size: 10px;
            text-decoration: underline;
            font-weight: bold;
        }

        .info {
            font-size: 10px;
            margin-top: 3px;
        }

        .info-label {
            font-weight: bold;
        }
    </style>
</head>

<body>

    <div class="header">
        <img src="dist/img/logo/Logo.png" alt="Logo Sekolah">
        <h2>Laporan Hasil Belajar Asrama</h2>
        <h3>SMK TI BAZMA</h3>
    </div>
    <table class="d-none">
        <tr>
            <td class="right">
                <strong class="label">Nama</strong>
                <span class="value">: {{ $rasrama->nama }}</span>
                <br>
                <strong class="label">Kelas</strong>
                <span class="value">: {{ $rasrama->kelas }}</span>
            </td>
            <td class="left">
                <strong class="long-label">Semester</strong>
                <span class="value">: {{ $rasrama->semester }}</span>
                <br>
                <strong class="long-label">Tahun Ajaran</strong>
                <span class="value">: {{ $rasrama->tahun_ajaran }}</span>
            </td>
        </tr>
    </table>

    <table class="table">
        <thead>
            <tr>
                <th rowspan="2" class="number">No</th>
                <th rowspan="2" class="mapel">Mata Pelajaran</th>
                <th rowspan="2" class="score">Nilai</th>
                <th rowspan="2" class="type">Jenis</th>
                <th colspan="5">Absensi</th>
                <th rowspan="2" colspan="2" class="description">Deskripsi</th>
            </tr>
            <tr>
                <th class="attendance">Alpa</th>
                <th class="attendance">Izin</th>
                <th class="attendance">Sakit</th>
                <th class="attendance">Hadir</th>
                <th class="attendance">Total Kehadiran</th>
            </tr>
        </thead>

        {{-- section 1 --}}
        <tbody>
            <tr class="section-1">
                <td rowspan="6">1</td>
                <td class="subject" colspan="10">Tahfidzul Qur'an</td>
            </tr>
            @php
                $aspektahfidz = [
                    'A. Makhorijul Huruf' => 'makhrojul',
                    'B. Tajwid' => 'tajwid',
                    'C. Waqof' => 'waqof',
                    'D. Kelancaran' => 'kelancaran',
                ];
            @endphp

            @foreach ($aspektahfidz as $label => $key)
                <tr class="section-1">
                    <td class="small-text">{{ $label }}</td>
                    <td>{{ $rasrama->tahfidz[$key]['nilai'] ?? '-' }}</td>
                    @if ($loop->first)
                        <td rowspan="{{ count($aspektahfidz) }}">
                            {{ $rasrama->tahfidz['jenis'] === 'Teori' ? 'T' : ($rasrama->tahfidz['jenis'] === 'Praktek' ? 'P' : '-') }}
                        </td>
                        <td rowspan="{{ count($aspektahfidz) }}" class="blue-text">
                            {{ $rasrama->tahfidz['alpha'] ?? '-' }}</td>
                        <td rowspan="{{ count($aspektahfidz) }}" class="blue-text">
                            {{ $rasrama->tahfidz['izin'] ?? '-' }}</td>
                        <td rowspan="{{ count($aspektahfidz) }}" class="blue-text">
                            {{ $rasrama->tahfidz['sakit'] ?? '-' }}</td>
                        <td rowspan="{{ count($aspektahfidz) }}" class="blue-text">
                            {{ $rasrama->tahfidz['hadir'] ?? '-' }}</td>
                        <td rowspan="{{ count($aspektahfidz) }}" class="blue-text">
                            {{ $rasrama->tahfidz['jumlah'] ?? '-' }}</td>
                        <td rowspan="{{ count($aspektahfidz) }}" rowspan="{{ count($aspektahfidz) }}" colspan="2">
                            {{ $rasrama->tahfidz['deskripsi'] ?? '-' }}
                        </td>
                    @endif
                </tr>
            @endforeach

            <tr class="section-1">
                <td class="small-text">e. batas hafalan</td>
                <td colspan="9" class="no-border">{{ $rasrama->tahfidz['hafalan'] ?? '-' }}</td>
            </tr>

            <!-- section 2 -->
            <tr class="section-2">
                <td rowspan="6">2</td>
                <td class="subject" colspan="10">Tahsinul Qur'an</td>
            </tr>
            @php
                $aspektahsin = [
                    'A. Makhorijul Huruf' => 'makhrojul',
                    'B. Tajwid' => 'tajwid',
                    'C. Waqof' => 'waqof',
                    'D. Kelancaran' => 'kelancaran',
                ];
            @endphp

            @foreach ($aspektahsin as $label => $key)
                <tr class="section-2">
                    <td class="small-text">{{ $label }}</td>
                    <td>{{ $rasrama->tahsin[$key]['nilai'] ?? '-' }}</td>
                    @if ($loop->first)
                        <td rowspan="{{ count($aspektahsin) }}">
                            {{ $rasrama->tahsin['jenis'] === 'Teori' ? 'T' : ($rasrama->tahsin['jenis'] === 'Praktek' ? 'P' : '-') }}
                        </td>
                        <td rowspan="{{ count($aspektahsin) }}" class="blue-text">
                            {{ $rasrama->tahsin['alpha'] ?? '-' }}</td>
                        <td rowspan="{{ count($aspektahsin) }}" class="blue-text">
                            {{ $rasrama->tahsin['izin'] ?? '-' }}</td>
                        <td rowspan="{{ count($aspektahsin) }}" class="blue-text">
                            {{ $rasrama->tahsin['sakit'] ?? '-' }}</td>
                        <td rowspan="{{ count($aspektahsin) }}" class="blue-text">
                            {{ $rasrama->tahsin['hadir'] ?? '-' }}</td>
                        <td rowspan="{{ count($aspektahsin) }}" class="blue-text">
                            {{ $rasrama->tahsin['jumlah'] ?? '-' }}</td>
                        <td rowspan="{{ count($aspektahsin) }}" rowspan="{{ count($aspektahsin) }}" colspan="2">
                            {{ $rasrama->tahsin['deskripsi'] ?? '-' }}
                        </td>
                    @endif
                </tr>
            @endforeach

            <tr class="section-2">
                <td class="small-text">e. batas hafalan</td>
                <td colspan="9" class="no-border">{{ $rasrama->tahsin['hafalan'] ?? '-' }}</td>
            </tr>

            <!-- section 3 -->
            <tr class="section-3">
                <td rowspan="12">3</td>
                <td class="subject" colspan="10">Kegiatan Ubudiyyah</td>
            </tr>
            @php
                // Helper function for percentage calculation
                function calculatepercentage($hadir, $total)
                {
                    return $total > 0 ? round(($hadir / $total) * 100) : 0;
                }

                // Helper function to get predikat based on the percentage
                function getpredikat($percentage)
                {
                    if ($percentage > 91 && $percentage <= 100) {
                        return 'A';
                    } elseif ($percentage > 81 && $percentage <= 90) {
                        return 'B';
                    } elseif ($percentage > 71 && $percentage <= 80) {
                        return 'C';
                    } elseif ($percentage <= 71) {
                        return 'D';
                    }
                    return '-';
                }
            @endphp

            @php
                $aspekubudiyyah = [
                    'A. Sholat Subuh' => 'Subuh',
                    'B. Sholat Dzuhur' => 'Dzuhur',
                    'C. Sholat Ashar' => 'Ashar',
                    'D. Sholat Maghrib' => 'Maghrib',
                    'E. Sholat Isya' => 'Isya',
                    'F. Sholat Dhuha' => 'dhuha',
                    'G. Imam' => 'imam',
                    'H. Muadzin' => 'muadzin',
                    'I. Khutbah' => 'khutbah',
                    'J. Kultum' => 'kultum',
                    'K. Murojaah' => 'murojaah',
                ];
            @endphp

            @foreach ($aspekubudiyyah as $label => $key)
                @php
                    // tolerant key lookup: try original, lowercase, and ucfirst(lowercase)
                    $entry = $rasrama->ubudiyyah[$key] ?? ($rasrama->ubudiyyah[strtolower($key)] ?? ($rasrama->ubudiyyah[ucfirst(strtolower($key))] ?? []));
                @endphp
                <tr class="section-3">
                    <td class="small-text">{{ $label }}</td>
                    <td>{{ $entry['predikat'] ?? '-' }}</td>
                    <td>
                        {{ ($entry['jenis'] ?? '') === 'Teori' ? 'T' : ((($entry['jenis'] ?? '') === 'Praktek') ? 'P' : '-') }}
                    </td>
                    <td class="blue-text">{{ $entry['alpha'] ?? '-' }}</td>
                    <td class="blue-text">{{ $entry['izin'] ?? '-' }}</td>
                    <td class="blue-text">{{ $entry['sakit'] ?? '-' }}</td>
                    <td class="blue-text">{{ $entry['hadir'] ?? '-' }}</td>
                    <td class="blue-text">{{ $entry['total'] ?? '-' }}</td>
                    <td colspan="2">{{ $entry['deskripsi_sholat'] ?? $entry['deskripsi_kegiatan'] ?? $entry['deskripsi'] ?? '-' }}</td>
                </tr>
            @endforeach


            <!-- section 4 -->
            <tr class="section-4">
                <td rowspan="6">4</td>
                <td class="subject" colspan="10">Kegiatan Amaliyyah</td>
            </tr>
            @php
                $aspekamaliyyah = [
                    'A. inisiatif kebersihan' => 'kebersihan',
                    'B. inisiatif kedisiplinan' => 'disiplin',
                    'C. inisiatif kerajinan' => 'kerajinan',
                    'D. inisiatif sosial' => 'sosial',
                    'E. inisiatif salam sapa' => 'salam',
                ];
            @endphp

            @foreach ($aspekamaliyyah as $label => $key)
                <tr class="section-4">
                    <td class="small-text">{{ $label }}</td>
                    <td>{{ $rasrama->amaliyyah[$key]['predikat'] ?? '-' }}</td>
                    <td>
                        {{ $rasrama->amaliyyah[$key]['jenis'] === 'Teori'
                            ? 'T'
                            : ($rasrama->amaliyyah[$key]['jenis'] === 'Praktek'
                                ? 'P'
                                : '-') }}
                    </td>
                    <td class="blue-text">{{ $rasrama->amaliyyah[$key]['alpha'] ?? '-' }}</td>
                    <td class="blue-text">{{ $rasrama->amaliyyah[$key]['izin'] ?? '-' }}</td>
                    <td class="blue-text">{{ $rasrama->amaliyyah[$key]['sakit'] ?? '-' }}</td>
                    <td class="blue-text">{{ $rasrama->amaliyyah[$key]['hadir'] ?? '-' }}</td>
                    <td class="blue-text">{{ $rasrama->amaliyyah[$key]['total'] ?? '-' }}</td>
                    <td colspan="2">{{ $rasrama->amaliyyah[$key]['deskripsi'] ?? '-' }}</td>
                </tr>
            @endforeach

            <!-- mapel section -->
            @php
                $mapel = [
                    ['id' => 5, 'label' => 'Kitab Tajwid', 'key' => 'tajwid'],
                    ['id' => 6, 'label' => 'Kitab Tafsir', 'key' => 'tafsir'],
                    ['id' => 7, 'label' => 'Kitab Fiqih', 'key' => 'fiqih'],
                    ['id' => 8, 'label' => 'Kitab Akhlak', 'key' => 'akhlak'],
                    ['id' => 9, 'label' => 'Matriks', 'key' => 'matriks'],
                    ['id' => 10, 'label' => 'Bahasa Arab', 'key' => 'bhs_arab'],
                    ['id' => 11, 'label' => 'Vocabulary', 'key' => 'vocab'],
                    ['id' => 12, 'label' => 'Khot Arabic', 'key' => 'khot'],
                ];
            @endphp

            @foreach ($mapel as $item)
                <tr class="section-5">
                    <td>{{ $item['id'] }}</td>
                    <td class="small-text">{{ $item['label'] }}</td>
                    <td>{{ $rasrama->mapel[$item['key']]['nilai'] ?? '-' }}</td>
                    <td>
                        {{ $rasrama->mapel[$item['key']]['jenis'] === 'Teori'
                            ? 'T'
                            : ($rasrama->mapel[$item['key']]['jenis'] === 'Praktek'
                                ? 'P'
                                : '-') }}
                    </td>
                    <td class="blue-text">{{ $rasrama->mapel[$item['key']]['alpha'] ?? '-' }}</td>
                    <td class="blue-text">{{ $rasrama->mapel[$item['key']]['izin'] ?? '-' }}</td>
                    <td class="blue-text">{{ $rasrama->mapel[$item['key']]['sakit'] ?? '-' }}</td>
                    <td class="blue-text">{{ $rasrama->mapel[$item['key']]['hadir'] ?? '-' }}</td>
                    <td class="blue-text">{{ $rasrama->mapel[$item['key']]['total'] ?? '-' }}</td>
                    <td colspan="2">{{ $rasrama->mapel[$item['key']]['deskripsi'] ?? '-' }}</td>
                </tr>
            @endforeach

            <!-- pengembangan diri -->
            @php
                $pengembangandiri = $rasrama->pengembangan_diri; // ambil data pengembangan diri
            @endphp

            <tr class="section-7">
                <td rowspan="{{ count($pengembangandiri) + 1 }}">14</td>
                <td class="subject" colspan="10">Pengembangan Diri</td>
            </tr>

            @foreach ($pengembangandiri as $key => $data)
                <tr class="section-7">
                    <td class="small-text">{{ $data['adse'] ?? '-' }}</td>
                    <td>{{ $data['nilai'] ?? '-' }}</td>
                    <td>{{ $data['jenis'] === 'Teori' ? 'T' : ($data['jenis'] === 'Praktek' ? 'P' : '-') }}</td>
                    <td class="blue-text"></td>
                    <td class="blue-text"></td>
                    <td class="blue-text"></td>
                    <td class="blue-text"></td>
                    <td class="blue-text"></td>
                    <td colspan="2"></td>
                </tr>
            @endforeach

            <!-- informasi siswa -->
            @php
                $datasiswa = [
                    ['label' => 'Tinggi Badan', 'key' => 'tb'],
                    ['label' => 'Berat Badan', 'key' => 'bb'],
                    ['label' => 'Parfum', 'key' => 'parfum'],
                    ['label' => 'Reward/Juara', 'key' => 'juara'],
                    ['label' => 'Punishment', 'key' => 'punishment'],
                    ['label' => 'Jumlah Poin Pelanggaran', 'key' => 'poin'],
                ];
            @endphp

            <tr class="section-6">
                <td rowspan="{{ count($datasiswa) + 1 }}">13</td>
                <td class="subject" colspan="10">Informasi Siswa</td>
            </tr>

            @foreach ($datasiswa as $item)
                <tr class="section-6">
                    <td class="small-text">{{ $item['label'] }}</td>
                    <td colspan="9">{{ $rasrama->data_siswa[$item['key']]['deskripsi'] ?? '-' }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>

    <!-- sertifikat -->
    <table class="certificate-table">
        <tr class="section-8">
            <td class="subject" colspan="21">Pencapaian Hafalan</td>
        </tr>
        <tr class="section-8">
            <td class="subject" colspan="3">Juz 30</td>
            <td class="subject" colspan="3">Juz 29</td>
            <td class="subject" colspan="15">Juz 28</td>
        </tr>
        <tr class="section-8">
            <td class="subject">Ujian Tashih</td>
            <td class="subject">Ujian Tasmi</td>
            <td class="subject">Sertifikat</td>
            <td class="subject">Ujian Tashih</td>
            <td class="subject">Ujian Tasmi</td>
            <td class="subject">Sertifikat</td>
            <td class="subject" colspan="5">Ujian Tashih</td>
            <td class="subject" colspan="5">Ujian Tasmi</td>
            <td class="subject" colspan="5">Sertifikat</td>
        </tr>
        <tr class="check section-8">
            <td>
                @if (($rasrama->sertifikat[30]['ujian_tashih']['status'] ?? '') === 'Sudah')
                    <img style="width: 15px;" src="img/check.png" alt="Checked Sign">
                @else
                    -
                @endif
            </td>
            <td>
                @if (($rasrama->sertifikat[30]['ujian_tasmi']['status'] ?? '') === 'Sudah')
                    <img style="width: 15px;" src="img/check.png" alt="Checked Sign">
                @else
                    -
                @endif
            </td>
            <td>
                @if (($rasrama->sertifikat[30]['sertifikat']['status'] ?? '') === 'Sudah')
                    <img style="width: 15px;" src="img/check.png" alt="Checked Sign">
                @else
                    -
                @endif
            </td>
            <td>
                @if (($rasrama->sertifikat[29]['ujian_tashih']['status'] ?? '') === 'Sudah')
                    <img style="width: 15px;" src="img/check.png" alt="Checked Sign">
                @else
                    -
                @endif
            </td>
            <td>
                @if (($rasrama->sertifikat[29]['ujian_tasmi']['status'] ?? '') === 'Sudah')
                    <img style="width: 15px;" src="img/check.png" alt="Checked Sign">
                @else
                    -
                @endif
            </td>
            <td>
                @if (($rasrama->sertifikat[29]['sertifikat']['status'] ?? '') === 'Sudah')
                    <img style="width: 15px;" src="img/check.png" alt="Checked Sign">
                @else
                    -
                @endif
            </td>
            <td colspan="5">
                @if (($rasrama->sertifikat[28]['ujian_tashih']['status'] ?? '') === 'Sudah')
                    <img style="width: 15px;" src="img/check.png" alt="Checked Sign">
                @else
                    -
                @endif
            </td>
            <td colspan="5">
                @if (($rasrama->sertifikat[28]['ujian_tasmi']['status'] ?? '') === 'Sudah')
                    <img style="width: 15px;" src="img/check.png" alt="Checked Sign">
                @else
                    -
                @endif
            </td>
            <td colspan="5">
                @if (($rasrama->sertifikat[28]['sertifikat']['status'] ?? '') === 'Sudah')
                    <img style="width: 15px;" src="img/check.png" alt="Checked Sign">
                @else
                    -
                @endif
            </td>
        </tr>
        <tr class="section-8">
            <td>{{ $rasrama->sertifikat[30]['ujian_tashih']['tanggal'] ?? '-' }}</td>
            <td>{{ $rasrama->sertifikat[30]['ujian_tasmi']['tanggal'] ?? '-' }}</td>
            <td>{{ $rasrama->sertifikat[30]['sertifikat']['tanggal'] ?? '-' }}</td>
            <td>{{ $rasrama->sertifikat[29]['ujian_tashih']['tanggal'] ?? '-' }}</td>
            <td>{{ $rasrama->sertifikat[29]['ujian_tasmi']['tanggal'] ?? '-' }}</td>
            <td>{{ $rasrama->sertifikat[29]['sertifikat']['tanggal'] ?? '-' }}</td>
            <td colspan="5">{{ $rasrama->sertifikat[28]['ujian_tashih']['tanggal'] ?? '-' }}</td>
            <td colspan="5">{{ $rasrama->sertifikat[28]['ujian_tasmi']['tanggal'] ?? '-' }}</td>
            <td colspan="5">{{ $rasrama->sertifikat[28]['sertifikat']['tanggal'] ?? '-' }}</td>
        </tr>

    </table>

    <table style="width: 100%; margin-top: 20px; margin-bottom: 30px;">
        <tr>
            <td style="text-align: right; padding-right: 20px;">
                <table style="text-align: right; border-collapse: collapse;">
                    <tr>
                        <td style="font-weight: bold; font-size: 12px; padding: 5px 10px 5px 0;">Dikeluarkan di</td>
                        <td style="font-size: 12px;">: Bogor</td>
                    </tr>
                    <tr>
                        <td style="font-weight: bold; font-size: 12px; padding: 5px 10px 5px 0;">Tanggal</td>
                        <td style="font-size: 12px; padding: 5px 0;">: {{ \Carbon\Carbon::parse($rasrama->released)->translatedFormat('d F Y') }}</td>
                    </tr>
                    <tr>
                        <td style="font-weight: bold; font-size: 12px; padding: 5px 10px 5px 0; vertical-align: top;">Keterangan</td>
                        <td style="font-size: 12px; padding: 5px 0; text-align: left;">: {{ $rasrama->keterangan }}</td>
                    </tr>
                </table>
            </td>
        </tr>
    </table>

    <table class="signature" style="width: 100%; margin-top: 80px; border-collapse: collapse;">
        <tr>
            <td style="width: 25%; text-align: center; font-size: 12px; font-weight: bold; padding: 10px 0;">Mengetahui,</td>
            <td style="width: 25%;"></td>
            <td style="width: 25%;"></td>
            <td style="width: 25%; text-align: center; font-size: 12px; font-weight: bold; padding: 10px 0;">Wali Asrama</td>
        </tr>
        <tr>
            <td style="width: 25%; text-align: center; font-size: 12px; padding: 5px 0;">Orang Tua/Wali</td>
            <td style="width: 25%;"></td>
            <td style="width: 25%;"></td>
            <td style="width: 25%;"></td>
        </tr>
        <tr>
            <td style="width: 25%; height: 60px; vertical-align: bottom; text-align: center; border-bottom: 1px solid #000; font-size: 12px;">&nbsp;</td>
            <td style="width: 25%;"></td>
            <td style="width: 25%;"></td>
            <td style="width: 25%; height: 60px; vertical-align: bottom; text-align: center; border-bottom: 1px solid #000; font-size: 12px;">&nbsp;</td>
        </tr>
        <tr>
            <td style="width: 25%; padding-top: 8px; text-align: center; font-size: 12px;">________________</td>
            <td style="width: 25%;"></td>
            <td style="width: 25%;"></td>
            <td style="width: 25%; padding-top: 8px; text-align: center; font-size: 12px; font-weight: bold;">{{ $rasrama->wname }}</td>
        </tr>
        <tr>
            <td style="width: 25%; padding-top: 3px; text-align: center; font-size: 12px;"></td>
            <td style="width: 25%;"></td>
            <td style="width: 25%;"></td>
            <td style="width: 25%; padding-top: 3px; text-align: center; font-size: 12px;">NIK. {{ $rasrama->nik }}</td>
        </tr>
    </table>

</body>

</html>
