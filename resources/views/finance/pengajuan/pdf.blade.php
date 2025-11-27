<!doctype html>
<html>
<head>
    <meta charset="utf-8">
    <title>Laporan Pengajuan Dana</title>
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }
        body {
            font-family: 'DejaVu Sans', Arial, sans-serif;
            color: #333;
            line-height: 1.6;
        }
        .container {
            max-width: 100%;
            padding: 20px;
        }
        .header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            border-bottom: 3px solid #1e5a96;
            padding-bottom: 15px;
            margin-bottom: 25px;
        }
        .header-left h1 {
            font-size: 24px;
            color: #1e5a96;
            font-weight: bold;
            margin-bottom: 5px;
        }
        .header-left p {
            font-size: 12px;
            color: #666;
        }
        .header-right {
            text-align: right;
            font-size: 11px;
            color: #666;
        }
        .header-right p {
            margin-bottom: 3px;
        }
        .info-box {
            background-color: #f0f4f8;
            border-left: 4px solid #1e5a96;
            padding: 12px 15px;
            margin-bottom: 20px;
            border-radius: 4px;
        }
        .info-box p {
            font-size: 12px;
            color: #555;
            margin-bottom: 3px;
        }
        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 10px;
        }
        thead {
            background: linear-gradient(135deg, #1e5a96 0%, #2a7fb8 100%);
        }
        th {
            color: #000000;
            padding: 12px;
            text-align: left;
            font-weight: 600;
            font-size: 12px;
            border: 1px solid #1e5a96;
        }
        td {
            padding: 10px 12px;
            border: 1px solid #ddd;
            font-size: 11px;
        }
        tbody tr:nth-child(even) {
            background-color: #f9f9f9;
        }
        .text-center {
            text-align: center;
        }
        .text-right {
            text-align: right;
        }
        .nominal {
            font-weight: 600;
            color: #1e5a96;
        }
        .footer {
            margin-top: 30px;
            padding-top: 15px;
            border-top: 1px solid #ddd;
            text-align: center;
            font-size: 10px;
            color: #999;
        }
        .total-row {
            background-color: #e8f0f7;
            font-weight: bold;
            color: #1e5a96;
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="header">
            <div class="header-left">
                <h1>LAPORAN PENGAJUAN DANA</h1>
                <p>SMK TI BAZMA</p>
            </div>
            <div class="header-right">
                <p><strong>Tanggal Cetak:</strong> {{ now()->format('d M Y H:i') }}</p>
                <p><strong>Total Record:</strong> {{ count($pengajuans) }}</p>
            </div>
        </div>

        <div class="info-box">
            <p><strong>Periode:</strong> {{ now()->format('F Y') }}</p>
            <p><strong>Status:</strong> Laporan Resmi</p>
        </div>

        <table>
            <thead>
                <tr>
                    <th style="width:5%">No</th>
                    <th style="width:15%">Tanggal</th>
                    <th style="width:25%">Nama Guru</th>
                    <th style="width:40%">Deskripsi</th>
                    <th style="width:15%; text-align:right">Nominal</th>
                </tr>
            </thead>
            <tbody>
                @forelse($pengajuans as $p)
                    <tr>
                        <td class="text-center">{{ $loop->iteration }}</td>
                        <td>{{ $p->tanggal_pengajuan->format('d-m-Y') }}</td>
                        <td>{{ optional($p->guru)->nama ?? '-' }}</td>
                        <td>{{ $p->deskripsi }}</td>
                        <td class="text-right nominal">Rp {{ number_format($p->nominal,0,',','.') }}</td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="5" class="text-center">Tidak ada data pengajuan</td>
                    </tr>
                @endforelse
                @if(count($pengajuans) > 0)
                    <tr class="total-row">
                        <td colspan="4" class="text-right">TOTAL PENGAJUAN:</td>
                        <td class="text-right">Rp {{ number_format($pengajuans->sum('nominal'),0,',','.') }}</td>
                    </tr>
                @endif
            </tbody>
        </table>

        <div class="footer">
            <p>Dokumen ini adalah laporan resmi dan telah diverifikasi oleh sistem.</p>
            <p>Dicetak pada {{ now()->format('d F Y H:i:s') }}</p>
        </div>
    </div>
</body>
</html>
