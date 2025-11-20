<!doctype html>
<html>
<head>
    <meta charset="utf-8">
    <title>Pengajuan PDF</title>
    <style>body{font-family: DejaVu Sans, sans-serif;} table{width:100%;border-collapse:collapse} td,th{border:1px solid #ccc;padding:6px}</style>
</head>
<body>
    <h3>Daftar Pengajuan</h3>
    <table>
        <thead><tr><th>No</th><th>Tanggal</th><th>Guru</th><th>Deskripsi</th><th>Nominal</th></tr></thead>
        <tbody>
            @foreach($pengajuans as $p)
                <tr>
                    <td>{{ $loop->iteration }}</td>
                    <td>{{ $p->tanggal_pengajuan->format('d-m-Y') }}</td>
                    <td>{{ optional($p->guru)->nama ?? '-' }}</td>
                    <td>{{ $p->deskripsi }}</td>
                    <td>{{ number_format($p->nominal,0,',','.') }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>
</body>
</html>
