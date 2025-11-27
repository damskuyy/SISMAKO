<!doctype html>
<html>

<head>
    <meta charset="utf-8">
    <title>PKG Report</title>
    <style>
        body {
            font-family: DejaVu Sans, sans-serif;
            font-size: 12px;
        }

        h2 {
            text-align: center;
        }

        .section {
            margin-bottom: 12px;
        }

        .k {
            font-weight: bold;
            width: 200px;
            display: inline-block
        }

        .photo {
            margin-top: 10px
        }

        table {
            width: 100%
        }

        td {
            vertical-align: top;
            padding: 4px
        }
    </style>
</head>

<body>
    <div style="display:flex; align-items:center; justify-content:space-between; margin-bottom:8px;">
        <div style="display:flex; align-items:center; gap:12px;">
            @php $logoPath = public_path('dist/img/logo/Logo.png'); @endphp
            @if(file_exists($logoPath))
                <img src="{{ $logoPath }}" style="height:150px;" alt="logo">
            @endif
            <div>
                <div style="font-size:16px; font-weight:700">SMK TI BAZMA</div>
                <div style="font-size:12px">Laporan Penilaian Kinerja Guru (PKG)</div>
            </div>
        </div>
        <div style="text-align:right; font-size:12px">Dicetak: {{ now()->format('d M Y H:i') }}</div>
    </div>

    @if(isset($pkgs) && $pkgs->count())
        @foreach($pkgs as $pkg)
            <div style="border:1px solid #e2e2e2; padding:10px; margin-bottom:10px; border-radius:6px;">
                <h4 style="margin:0 0 8px 0;">1. Identitas Guru yang Dinilai</h4>
                <table style="width:100%; border-collapse:collapse; margin-bottom:18px; border:1px solid #ccc;">
                    <thead style="background:#f8f9fa;">
                        <tr>
                            <th style="padding:6px; border:1px solid #ccc;">Nama</th>
                            <th style="padding:6px; border:1px solid #ccc;">NIP</th>
                            <th style="padding:6px; border:1px solid #ccc;">Mapel</th>
                            <th style="padding:6px; border:1px solid #ccc;">Jabatan</th>
                            <th style="padding:6px; border:1px solid #ccc;">Periode</th>
                            <th style="padding:6px; border:1px solid #ccc;">Penilai</th>
                            <th style="padding:6px; border:1px solid #ccc;">Jabatan Penilai</th>
                            <th style="padding:6px; border:1px solid #ccc;">Kompetensi</th>
                            <th style="padding:6px; border:1px solid #ccc;">Praktik Kinerja</th>
                            <th style="padding:6px; border:1px solid #ccc;">Perilaku Kerja</th>
                            <th style="padding:6px; border:1px solid #ccc;">Predikat</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($pkgs as $pkg)
                            <tr>
                                <td style="border:1px solid #ccc; padding:6px;">{{ $pkg->nama }}</td>
                                <td style="border:1px solid #ccc; padding:6px;">{{ $pkg->nip }}</td>
                                <td style="border:1px solid #ccc; padding:6px;">{{ $pkg->mapel }}</td>
                                <td style="border:1px solid #ccc; padding:6px;">{{ $pkg->jabatan }}</td>
                                <td style="border:1px solid #ccc; padding:6px;">{{ $pkg->periode_penilaian }}</td>
                                <td style="border:1px solid #ccc; padding:6px;">{{ $pkg->penilai_nama }}</td>
                                <td style="border:1px solid #ccc; padding:6px;">{{ $pkg->penilai_jabatan }}</td>
                                <td style="border:1px solid #ccc; padding:6px;">
                                    Pedagogik: {{ $pkg->kompetensi_pedagogik }}<br>
                                    Kepribadian: {{ $pkg->kompetensi_kepribadian }}<br>
                                    Profesional: {{ $pkg->kompetensi_profesional }}<br>
                                    Sosial: {{ $pkg->kompetensi_sosial }}
                                </td>
                                <td style="border:1px solid #ccc; padding:6px;">{{ $pkg->praktik_kinerja }}</td>
                                <td style="border:1px solid #ccc; padding:6px;">{{ $pkg->perilaku_kerja }}</td>
                                <td style="border:1px solid #ccc; padding:6px;">
                                    @php
                                        $pred = strtolower(trim($pkg->predikat_kinerja ?? ''));
                                        $color = '#6c757d';
                                        if ($pred === 'sangat baik') {
                                            $color = '#28a745';
                                        } elseif ($pred === 'baik') {
                                            $color = '#17a2b8';
                                        } elseif (str_contains($pred, 'butuh')) {
                                            $color = '#ffc107';
                                        } elseif ($pred === 'kurang') {
                                            $color = '#dc3545';
                                        } elseif ($pred === 'sangat kurang') {
                                            $color = '#343a40';
                                        } elseif ($pred === 'penilaian belum selesai') {
                                            $color = '#6c757d';
                                        }
                                    @endphp
                                    <span
                                        style="display:inline-block; min-width:90px; padding:4px 10px; border-radius:6px; font-weight:600; color:#fff; background:{{ $color }}; text-align:center;">{{ ucwords($pkg->predikat_kinerja) }}</span>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        @endforeach
    @elseif(isset($pkg))
        <h4 style="margin:18px 0 8px 0;">1. Identitas Guru yang Dinilai</h4>
        <table style="width:100%; border-collapse:collapse; border:1px solid #ccc; margin-bottom:12px;">
            <tbody>
                <tr><td class="k">Nama</td><td>{{ $pkg->nama }}</td></tr>
                <tr><td class="k">NIP</td><td>{{ $pkg->nip }}</td></tr>
                <tr><td class="k">Mapel</td><td>{{ $pkg->mapel }}</td></tr>
                <tr><td class="k">Jabatan</td><td>{{ $pkg->jabatan }}</td></tr>
                <tr><td class="k">Periode Penilaian</td><td>{{ $pkg->periode_penilaian }}</td></tr>
            </tbody>
        </table>

        <h4 style="margin:18px 0 8px 0;">2. Identitas Penilai / Penguji</h4>
        <table style="width:100%; border-collapse:collapse; border:1px solid #ccc; margin-bottom:12px;">
            <tbody>
                <tr><td class="k">Nama Penilai</td><td>{{ $pkg->penilai_nama }}</td></tr>
                <tr><td class="k">NIP Penilai</td><td>{{ $pkg->penilai_nip }}</td></tr>
                <tr><td class="k">Jabatan Penilai</td><td>{{ $pkg->penilai_jabatan }}</td></tr>
            </tbody>
        </table>

        <h4 style="margin:18px 0 8px 0;">3. Penilaian Kompetensi Utama</h4>
        <table style="width:100%; border-collapse:collapse; border:1px solid #ccc; margin-bottom:12px;">
            <tbody>
                <tr><td class="k">Kompetensi Pedagogik</td><td>{{ $pkg->kompetensi_pedagogik }}</td></tr>
                <tr><td class="k">Kompetensi Kepribadian</td><td>{{ $pkg->kompetensi_kepribadian }}</td></tr>
                <tr><td class="k">Kompetensi Profesional</td><td>{{ $pkg->kompetensi_profesional }}</td></tr>
                <tr><td class="k">Kompetensi Sosial</td><td>{{ $pkg->kompetensi_sosial }}</td></tr>
                <tr><td class="k">Keterangan Kompetensi</td><td>{{ $pkg->kompetensi_keterangan }}</td></tr>
            </tbody>
        </table>

        <h4 style="margin:18px 0 8px 0;">4. Penilaian Pelaksanaan Praktik</h4>
        <table style="width:100%; border-collapse:collapse; border:1px solid #ccc; margin-bottom:12px;">
            <tbody>
                <tr><td class="k">Praktik Kinerja</td><td>{{ $pkg->praktik_kinerja }}</td></tr>
                <tr><td class="k">Keterangan Praktik</td><td>{{ $pkg->praktik_keterangan }}</td></tr>
                <tr><td class="k">Perilaku Kerja</td><td>{{ $pkg->perilaku_kerja }}</td></tr>
                <tr><td class="k">Keterangan Perilaku</td><td>{{ $pkg->perilaku_keterangan }}</td></tr>
                <tr><td class="k">Predikat Kinerja</td>
                    <td>
                        @php
                            $pred = strtolower(trim($pkg->predikat_kinerja ?? ''));
                            $color = '#6c757d';
                            if ($pred === 'sangat baik') {
                                $color = '#28a745';
                            } elseif ($pred === 'baik') {
                                $color = '#17a2b8';
                            } elseif (str_contains($pred, 'butuh')) {
                                $color = '#ffc107';
                            } elseif ($pred === 'kurang') {
                                $color = '#dc3545';
                            } elseif ($pred === 'sangat kurang') {
                                $color = '#343a40';
                            } elseif ($pred === 'penilaian belum selesai') {
                                $color = '#6c757d';
                            }
                        @endphp
                        <span style="display:inline-block; min-width:90px; padding:4px 10px; border-radius:6px; font-weight:600; color:#fff; background:{{ $color }}; text-align:center;">{{ ucwords($pkg->predikat_kinerja) }}</span>
                    </td>
                </tr>
                <tr><td class="k">Keterangan Predikat</td><td>{{ $pkg->predikat_keterangan }}</td></tr>
            </tbody>
        </table>

        <h4 style="margin:18px 0 8px 0;">5. Kesimpulan & Rekomendasi</h4>
        <table style="width:100%; border-collapse:collapse; border:1px solid #ccc; margin-bottom:12px;">
            <tbody>
                <tr><td class="k">Kekuatan Guru</td><td>{{ $pkg->kekuatan_guru }}</td></tr>
                <tr><td class="k">Area Peningkatan</td><td>{{ $pkg->area_peningkatan }}</td></tr>
                <tr><td class="k">Rekomendasi Tingkat Lanjut</td><td>{{ $pkg->rekomendasi_tingkat_lanjut }}</td></tr>
            </tbody>
        </table>
        @if($pkg->foto_dokumentasi_kegiatan)
            <div class="section photo">
                <h4>Foto Dokumentasi Kegiatan</h4>
                <img src="{{ public_path(ltrim($pkg->foto_dokumentasi_kegiatan, '/')) }}" style="max-width:400px;" alt="foto">
            </div>
        @endif
    @endif

</body>

</html>