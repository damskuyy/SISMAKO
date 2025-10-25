<!DOCTYPE html>
<html>
<head>
    <style>
        table {
            width: 100%;
            border-collapse: collapse;
        }
        th, td {
            border: 1px solid black;
            padding: 8px;
            text-align: left;
        }
        th {
            background-color: #f2f2f2;
        }
        .container {
            width: 100%;
            margin: 0 auto;
            font-family: Arial, sans-serif;
        }
        .header {
            text-align: center;
            margin-bottom: 20px;
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="header">
            <h1>Data Kelas</h1>
        </div>
        <table>
            <thead>
                <tr>
                    <th>No</th>
                    <th>Nama</th>
                    <th>Tahun Pelajaran</th>
                    <th>Kelas</th>
                    <th>Jurusan</th>
                    <th>Angkatan</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($dataKelas as $index => $data)
                    <tr>
                        <td>{{ $index + 1 }}</td>
                        <td>{{ $data->siswa->nama ?? 'Tidak ada data' }}</td>
                        <td>{{ $data->tahun_pelajaran }}</td>
                        <td>{{ $data->kelas }}</td>
                        <td>{{ $data->jurusan }}</td>
                        <td>{{ $data->angkatan }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</body>
</html>
