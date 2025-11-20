<!doctype html>
<html>
<head>
    <meta charset="utf-8">
    <title>Pemasukan PDF</title>
    <style>body{font-family: DejaVu Sans, sans-serif;} table{width:100%;border-collapse:collapse} td,th{border:1px solid #ccc;padding:6px}</style>
</head>
<body>
    <h3>Daftar Pemasukan</h3>
    <table>
        <thead><tr><th>No</th><th>Tanggal</th><th>Jenis</th><th>Nama</th><th>Asal</th><th>Nominal</th></tr></thead>
        <tbody>
            @foreach($pemasukans as $p)
                <tr>
                    <td>{{ $loop->iteration }}</td>
                    <td>{{ $p->tanggal_pemasukan->format('d-m-Y') }}</td>
                    <td>{{ $p->jenis }}</td>
                    <td>{{ $p->nama }}</td>
                    <td>{{ $p->asal }}</td>
                    <td>{{ number_format($p->nominal,0,',','.') }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>
</body>
</html>
