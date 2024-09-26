<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Form Layout</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 20px;
        }

        .logo {
            width: 100%;
        }

        .container {
            width: 600px;
            margin: 0 auto;
            border: 1px solid #ddd;
            padding: 20px;
            position: relative;
        }

        .header {
            width: 80%;
            text-align: center;
        }

        .header h2,
        .header h3,
        .header p {
            margin: 0;
        }

        .info-table {
            width: 100%;
            margin-bottom: 20px;
        }

        .info-table td {
            padding: 5px;
            vertical-align: top;
        }

        .info-table td:first-child {
            width: 50px;
        }

        .photo-box {
            width: 225px;
            height: 300px;
            overflow: hidden;
            margin-left: 40px;
            position: absolute;
            top: 0;
            right: 0;
        }

        .photo-box img {
            width: 100%;
            height: 100%;
            object-fit: cover;
            border-radius: 10px;
        }

        .section {
            width: 100%;
            margin-bottom: 20px;
            border-collapse: collapse;
            text-align: center;
            font-size: 12px;
        }

        .section th,
        .section td {
            border: 1px solid #000;
            padding: 5px;
            text-align: center;
        }

        .section th {
            background-color: #d9d9da;
        }

        .certificates {
            padding-top: 10px;
            font-size: 13px;
        }

        .certificates td {
            border: none;
        }

        .certificates input[type="checkbox"] {
            margin-right: 10px;
        }

        .jurnal-section {
            margin-top: 20px;
        }

        .jurnal-section td {
            text-align: center;
        }
    </style>
</head>

<body>
    <div class="container">
        <div>
            <table class="logo">
                <tr>
                    <td class="header">
                        <h2>PROGRES PESERTA DIDIK</h2>
                        <h3>SMK TI BAZMA</h3>
                        <p>Tanggal: {{ \Carbon\Carbon::parse($start_date)->translatedFormat('d F Y') }} -
                            {{ \Carbon\Carbon::parse($end_date)->translatedFormat('d F Y') }}</p>
                    </td>
                    <td style="width:20%; vertical-align: text-top;">
                        <img src="https://smktibazma.sch.id/static/media/main-logo-2.7b74690f86ab4e9a4743.png"
                            alt="Logo" style="height: 63px">
                    </td>
                </tr>
            </table>
        </div>
        <table class="info-table">
            <tr>
                <td style="width: 50%;">
                    <p><span>Nama</span> : {{$siswa->nama}}</p>
                    <p><span>NISN</span> : {{$siswa->nisn}}</p>
                    <p><span>Kelas</span> : {{$siswa->dataKelas[0]->kelas}}</p>
                    <p><span>TP</span> : {{$siswa->tahun_pelajaran}}</p>
                </td>
                <td style="width: 50%; text-align: right;">
                    <!-- Text-align: right untuk meratakan ke kanan -->
                    <img src="{{ $siswa->fotoSiswa[0]->path_file }}" alt="Foto Siswa" style="width: 50%; float: right;">
                    <!-- Tambahkan float: right -->
                </td>
            </tr>
        </table>
        <table class="section tahfidz-section" id="tahfidzTable">
            <thead>
                <tr>
                    <th colspan="6" style="background-color: #A9D08E;">Tahfidz</th>
                </tr>
                <tr>
                    <th style="width: 5%;">No</th>
                    <th style="width: 19%;">Tanggal</th>
                    <th style="width: 19%;">Surat</th>
                    <th style="width: 19%;">Ayat</th>
                    <th style="width: 19%;">Keterangan</th>
                    <th style="width: 19%;">Pengajar</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($siswa->tahfidzSiswa as $item)
                <tr>
                    <td>{{ $loop->iteration }}</td>
                    <td>{{ $item->tanggal }}</td>
                    <td>{{ $item->surat }}</td>
                    <td>{{ $item->ayat }}</td>
                    <td>{{ $item->predikat }}</td>
                    <td>{{ $item->pengajar }}</td>
                </tr>
                @endforeach
            </tbody>
        </table>
        <table class="certificates" id="certificateTable">
            <tr>
                <td>Sertifikat Juz 30:</td>
                <td>
                    <input type="checkbox" {{ isset($siswa->sertifikatSiswa[0]->juz_30) &&
                    !is_null($siswa->sertifikatSiswa[0]->juz_30) ? 'checked' : '' }}>
                </td>
                <td>Sertifikat Juz 29:</td>
                <td>
                    <input type="checkbox" {{ isset($siswa->sertifikatSiswa[0]->juz_29) &&
                    !is_null($siswa->sertifikatSiswa[0]->juz_29) ? 'checked' : '' }}>
                </td>
                <td>Sertifikat Juz 28:</td>
                <td>
                    <input type="checkbox" {{ isset($siswa->sertifikatSiswa[0]->juz_28) &&
                    !is_null($siswa->sertifikatSiswa[0]->juz_28) ? 'checked' : '' }}>
                </td>
                <td>Sertifikat Juz Umum</td>
                <td>
                    <input type="checkbox" {{ isset($siswa->sertifikatSiswa[0]->juz_umum) &&
                    !is_null($siswa->sertifikatSiswa[0]->juz_umum) ? 'checked' : '' }}>
                </td>
            </tr>
        </table>
        <table class="section tahsin-section" id="tahsinTable">
            <thead>
                <tr>
                    <th colspan="6" style="background-color: #FF6666;">Tahsin</th>
                </tr>
                <tr>
                    <th style="width: 5%;">No</th>
                    <th style="width: 19%;">Tanggal</th>
                    <th style="width: 19%;">Surat</th>
                    <th style="width: 19%;">Ayat</th>
                    <th style="width: 19%;">Keterangan</th>
                    <th style="width: 19%;">Pengajar</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($siswa->tahsinSiswa as $item)
                <tr>
                    <td>{{ $loop->iteration }}</td>
                    <td>{{ $item->tanggal }}</td>
                    <td>{{ $item->surat }}</td>
                    <td>{{ $item->ayat }}</td>
                    <td>{{ $item->predikat }}</td>
                    <td>{{ $item->pengajar }}</td>
                </tr>
                @endforeach
            </tbody>
        </table>
        <table class="section akademik-section" id="akademikTable">
            <thead>
                <tr>
                    <th colspan="4" style="background-color: #BDD7EE;">Akademik</th>
                </tr>
                <tr>
                    <th style="width: 5%;">No</th>
                    <th style="width: 19%;">Tanggal</th>
                    <th>Nama Kegiatan</th>
                    <th>Keterangan</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($siswa->pelatihanSiswa as $item)
                <tr>
                    <td>{{ $loop->iteration }}</td>
                    <td>{{ $item->tanggal }}</td>
                    <td>{{ $item->kegiatan }}</td>
                    <td>{{ $item->keterangan }}</td>
                </tr>
                @endforeach
            </tbody>
        </table>
        <table id="jurnalTable" class="section jurnal-section">
            <thead>
                <tr>
                    <th colspan="8" style="background-color: #f7caac;">Jurnal Asrama</th>
                </tr>
                <tr>
                    <th colspan="2">FIQIH</th>
                    <th colspan="2">AKHLAK</th>
                    <th colspan="2">TAFSIR</th>
                    <th colspan="2">TAJWID</th>
                </tr>
                <tr>
                    <td>Tanggal</td>
                    <td>Materi</td>
                    <td>Tanggal</td>
                    <td>Materi</td>
                    <td>Tanggal</td>
                    <td>Materi</td>
                    <td>Tanggal</td>
                    <td>Materi</td>
                </tr>
            </thead>
            <tbody id="jurnalBody">
                <!-- Rows will be dynamically inserted here -->
            </tbody>
        </table>

    </div>
</body>
<script>
    const data = @json($siswa);
    console.log(data)

    // Convert tajwid object to an array
    const tajwidArray = Object.values(data.jurnalAsramaSiswa.tajwid);

    // Calculate the maximum number of rows needed
    const maxRows = Math.max(
        data.jurnalAsramaSiswa.akhlak.length,
        data.jurnalAsramaSiswa.fiqih.length,
        data.jurnalAsramaSiswa.tafsir.length,
        tajwidArray.length
    );

    // Get the table body element
    const jurnalBody = document.getElementById('jurnalBody');

    // Function to create a table cell with text
    const createCell = (text) => {
        const cell = document.createElement('td');
        cell.innerText = text || '';
        return cell;
    };

    // Populate the table
    for (let i = 0; i < maxRows; i++) {
        const row = document.createElement('tr');

        const fiqih = data.jurnalAsramaSiswa.fiqih[i] || {};
        row.appendChild(createCell(fiqih.tanggal));
        row.appendChild(createCell(fiqih.materi));

        const akhlak = data.jurnalAsramaSiswa.akhlak[i] || {};
        row.appendChild(createCell(akhlak.tanggal));
        row.appendChild(createCell(akhlak.materi));

        const tafsir = data.jurnalAsramaSiswa.tafsir[i] || {};
        row.appendChild(createCell(tafsir.tanggal));
        row.appendChild(createCell(tafsir.materi));

        const tajwid = tajwidArray[i] || {};
        row.appendChild(createCell(tajwid.tanggal));
        row.appendChild(createCell(tajwid.materi));

        jurnalBody.appendChild(row);
    }
</script>

</html>
