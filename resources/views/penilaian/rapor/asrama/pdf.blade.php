<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>report card</title>

    <style type="text/css">
        @Page {
            margin-top: 0px;
            margin-bottom: 0px;
            margin-right: 0px;
            margin-left: 0px;
        }

        body {
            font-family: arial, sans-serif;
            margin: 0;
            padding: 20px;
            font-size: 12px;
            margin-left: auto;
            margin-right: auto;
        }

        .section-1,
        .section-2,
        .section-3,
        .section-4 {
            font-size: 14px
        }

        .section-5,
        .section-6,
        .section-7,
        .section-8 {
            font-size: 10px
        }

        .header {
            text-align: center;
            margin: 20px;
        }

        .header img {
            width: 110%;
        }

        .header h2 {
            margin: 0;
        }

        table.d-none {
            border: none;
            width: 100%;
            border-collapse: collapse;
            /* hilangkan jarak antar sel */
        }

        .d-none td {
            text-align: left;
            vertical-align: top;
            padding: 2px;
            /* kurangi padding antar sel */
        }

        .label,
        .long-label {
            display: inline-block;
            font-weight: bold;
            vertical-align: top;
            margin: 0;
            padding: 0;
            /* hilangkan padding */
        }

        .label {
            width: 50px;
        }

        .long-label {
            width: 100px;
        }

        .value {
            display: inline-block;
            font-weight: bold;
            margin: 0;
            padding: 0;
            /* hilangkan padding */
        }

        .right,
        .left {
            font-size: 13px;
        }

        .right {
            width: 55%;
        }

        .left {
            width: 45%;
        }

        .label,
        .long-label,
        .value {
            font-size: 12px;
        }

        .number,
        .type,
        .score,
        .attendance,
        {
        width: 5%
        }

        .mapel,
        .description {
            width: 21%;
        }

        .table,
        .certificate-table {
            width: 100%;
            border-collapse: collapse;
            /* margin-top: 10px; */
        }

        .table,
        .table th,
        .table td,
        .certificate-table,
        .certificate-table th,
        .certificate-table td {
            border: 1px solid black;
        }

        .small-text {
            font-size: 12px;
            text-align: left !important;
        }

        .blue-text {
            background-color: #cfecfa;
        }

        .certificate-table th,
        .certificate-table td,
        .table th,
        .table td {
            padding: 6px;
            text-align: center;
            vertical-align: middle;
        }

        .certificate-table {
            width: 100%;
            margin-top: -1px;
        }

        .table th {
            background-color: #cfecfa;
        }

        .subject {
            text-align: left;
            padding-left: 5px;
            font-weight: bold;
            background-color: #f0f0f0;
        }

        .no-border {
            border: none;
        }

        .category-title {
            font-weight: bold;
            text-align: left;
            padding-left: 5px;
            background-color: #f7f7f7;
        }

        .check td img {
            width: 20px;
        }

        .signature {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
        }

        .signature td {
            text-align: center;
            vertical-align: top;
            font-size: 12px
        }

        .location-date {
            text-align: right;
            margin-top: 20px margin-bottom: 20px;
            font-size: 12px;
        }

        .signature-title {
            font-size: 12px;
            margin-bottom: 60px;
        }

        .name {
            font-size: 12px;
            text-decoration: underline;
        }

        .info {
            font-size: 12px;
            margin-top: 5px;
        }
    </style>
</head>

<body>

    <div class="header">
        <img src="img\Kop.png" alt="Kop Surat">
        <h2>Laporan Hasil Belajar Asrama</h2>
        <h2>SMK TI BAZMA</h2>
    </div>
    <table class="d-none">
        <tr>
            <td class="right">
                <h2 class="label"></h2>
                <h2 class="label">Nama</h2>
                <h2 class="value">: {{ $rasrama->siswa->nama }}</h2>
                <br>
                <h2 class="label"></h2>
                <h2 class="label">Kelas</h2>
                <h2 class="value">: {{ $rasrama->siswa->dataKelas[0]->kelas }}</h2>
            </td>
            <td class="center"></td>
            <td class="left">
                <h2 class="long-label"></h2>
                <h2 class="long-label">Semester</h2>
                <h2 class="value">: {{ $rasrama->semester }}</h2>
                <br>
                <h2 class="long-label"></h2>
                <h2 class="long-label">Tahun Ajaran</h2>
                <h2 class="value">: {{ $rasrama->tahun_ajaran }}</h2>
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
                // Daftar sholat wajib
                $sholatWajib = ['Subuh', 'Dzuhur', 'Ashar', 'Maghrib', 'Isya'];

                // Daftar ibadah lainnya
                $ibadahLainnya = ['dhuha', 'imam', 'muadzin', 'khutbah', 'kultum', 'murojaah'];
            @endphp

            <!-- Menampilkan Sholat Wajib -->
            @foreach ($sholatWajib as $index => $sholat)
                <tr class="section-3">
                    @php
                        $alphabet = chr(65 + $index); // Konversi index ke huruf (A, B, C, ...)
                        $totalSholatPerDay = $data['totalPrayers'] / 5;
                        $jenisSholat = $rasrama->ubudiyyah[$sholat]['jenis'] ?? null;
                        $deskripsiSholat = $rasrama->ubudiyyah[$sholat]['deskripsi_sholat'] ?? '-';
                        $deskripsiKegiatan = $rasrama->ubudiyyah[$sholat]['deskripsi_kegiatan'] ?? '-';
                    @endphp
                    <td class="small-text">{{ $alphabet }}. {{ ucfirst($sholat) }}</td>

                    <!-- Menampilkan Predikat untuk Setiap Siswa -->
                    @foreach ($data['studentDetails'] as $idSiswa => $jamaah)
                        @php
                            $attendance = $jamaah['attendance'][$sholat] ?? [
                                'Hadir' => 0,
                                'Sakit' => 0,
                                'Izin' => 0,
                                'Alpha' => 0,
                            ];
                            $hadir = $attendance['Hadir'];
                            $percentage = calculatepercentage($hadir, $totalSholatPerDay);
                            $predikat = getpredikat($percentage);
                        @endphp
                        <td>{{ $predikat }}</td>
                    @endforeach

                    <!-- Menampilkan Jenis Sholat -->
                    <td>
                        {{ $jenisSholat === 'Teori' ? 'T' : ($jenisSholat === 'Praktek' ? 'P' : '-') }}
                    </td>

                    <!-- Menampilkan Statistik Kehadiran -->
                    @foreach (['Alpha', 'Izin', 'Sakit', 'Hadir'] as $status)
                        @foreach ($data['studentDetails'] as $idSiswa => $jamaah)
                            <td>{{ $jamaah['attendance'][$sholat][$status] ?? 0 }}</td>
                        @endforeach
                    @endforeach

                    <!-- Menampilkan Total dan Deskripsi -->
                    <td>{{ $totalSholatPerDay }}</td>
                    @if ($loop->first)
                        <td colspan="2" rowspan="5">
                            {{ $deskripsiSholat }}
                        </td>
                    @endif
                </tr>
            @endforeach


            <!-- Menampilkan Ibadah Lainnya -->
            @foreach ($ibadahLainnya as $index => $ibadah)
                <tr class="section-3">
                    @php
                        $alphabet = chr(65 + count($sholatWajib) + $index); // Huruf lanjutan setelah sholat wajib
                    @endphp
                    <td class="small-text">{{ $alphabet }}. {{ ucfirst($ibadah) }}</td>

                    @foreach ($data['studentDetails'] as $idSiswa => $jamaah)
                        @php
                            $hadir = $rasrama->ubudiyyah[$ibadah]['hadir'] ?? 0; // Data hadir diambil dari `ubudiyyah`
                            $total = $rasrama->ubudiyyah[$ibadah]['total'] ?? 0; // Asumsi total sholat

                            // Hitung persentase
                            $percentage = calculatepercentage($hadir, $total);

                            // Dapatkan predikat
                            $predikat = getpredikat($percentage);
                        @endphp
                        <td>{{ $predikat }}</td> <!-- Menampilkan predikat berdasarkan kehadiran -->
                    @endforeach

                    <td>
                        {{ $rasrama->ubudiyyah[$ibadah]['jenis'] === 'Teori' ? 'T' : ($rasrama->ubudiyyah[$ibadah]['jenis'] === 'Praktek' ? 'P' : '-') }}
                    </td>

                    @foreach ($data['studentDetails'] as $idSiswa => $jamaah)
                        <td>{{ $rasrama->ubudiyyah[$ibadah]['alpha'] ?? 0 }}</td> <!-- Jumlah Alpha -->
                    @endforeach

                    @foreach ($data['studentDetails'] as $idSiswa => $jamaah)
                        <td>{{ $rasrama->ubudiyyah[$ibadah]['izin'] ?? 0 }}</td> <!-- Jumlah Izin -->
                    @endforeach

                    @foreach ($data['studentDetails'] as $idSiswa => $jamaah)
                        <td>{{ $rasrama->ubudiyyah[$ibadah]['sakit'] ?? 0 }}</td> <!-- Jumlah Sakit -->
                    @endforeach

                    @foreach ($data['studentDetails'] as $idSiswa => $jamaah)
                        <td>{{ $rasrama->ubudiyyah[$ibadah]['hadir'] ?? 0 }}</td> <!-- Jumlah Hadir -->
                    @endforeach

                    @foreach ($data['studentDetails'] as $idSiswa => $jamaah)
                        <td>{{ $rasrama->ubudiyyah[$ibadah]['total'] ?? 0 }}</td> <!-- Jumlah Hadir -->
                    @endforeach

                    @if ($loop->first)
                        <td colspan="2" rowspan="6">
                            {{ $deskripsiKegiatan }}
                        </td>
                    @endif
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

    <table style="float: right; text-align: left; margin-top: 20px;">
        <tr>
            <td style="padding: 5px;"><strong>Dikeluarkan di</strong></td>
            <td style="padding: 5px;">: Bogor</td>
        </tr>
        <tr>
            <td style="padding: 5px;"><strong>Tanggal</strong></td>
            <td style="padding: 5px;">: {{ \Carbon\Carbon::parse($rasrama->released)->translatedFormat('d F Y') }}
            </td>
        </tr>
        <tr>
            <td style="padding: 5px;"><strong>Keterangan</strong></td>
            <td style="padding: 5px;">: {{ $rasrama->keterangan }}</td>
        </tr>
    </table>

    <table class="signature" style="float: right; text-align: left; margin-top: 150px; clear: both; margin-left: 0;">
        <tr>
            <td>Mengetahui,</td>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
        </tr>
        <tr>
            <td class="right-signature">Orang Tua/Wali,</td>
            <td class="center-signature"></td>
            <td class="center-signature"></td>
            <td class="center-signature"></td>
            <td class="center-signature"></td>
            <td class="left-signature">Wali Asrama</td>
        </tr>
        <tr>
            <td><br><br><br><br><br><br></td>
            <td><br><br><br><br><br><br></td>
            <td><br><br><br><br><br><br></td>
            <td><br><br><br><br><br><br></td>
            <td><br><br><br><br><br><br></td>
        </tr>
        <tr>
            <td>________________</td>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
            <td class="name">{{ $rasrama->wname }}</td>
        </tr>
        <tr>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
            <td>NIK. {{ $rasrama->nik }}</td>
        </tr>
    </table>

</body>

</html>
