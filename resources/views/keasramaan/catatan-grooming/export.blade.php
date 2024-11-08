<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Data Kunjungan</title>
    <style>
        /* Styling for the entire document */
        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            margin: 0;
            padding: 0;
        }

        .container {
            width: 90%;
            max-width: 1400px;
            margin: 40px auto;
            padding: 7px;
            box-shadow: 0 8px 20px rgba(0, 0, 0, 0.1);
            border-radius: 10px;
        }

        h1 {
            text-align: center;
            color: #333;
            font-size: 2.5em;
            margin-bottom: 20px;
            text-transform: uppercase;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 20px;
            overflow: hidden;
            border-radius: 8px;
        }

        th,
        td {
            border: 1px solid #ddd;
            padding: 12px 15px;
            text-align: left;
            transition: background-color 0.3s ease;
        }

        th {
            background-color: #6c7ae0;
            color: #fff;
            font-weight: bold;
        }

        tr:nth-child(even) {
            background-color: #f9f9f9;
        }

        tr:hover {
            background-color: #f1f1f1;
        }

        th,
        td {
            text-align: left;
        }

        thead {
            background-color: #6c7ae0;
        }

        td {
            font-size: 0.95em;
            color: #555;
        }

        /* Adding hover effect on rows */
        tbody tr:hover {
            background-color: #f0f8ff;
            cursor: pointer;
        }

        /* Responsive design */
        @media (max-width: 768px) {
            table {
                font-size: 0.9em;
            }
        }
    </style>
</head>

<body>
    <h1>Catatan Grooming</h1>
    <div class="container">
        <table>
            <thead>
                <tr>
                    <th>No.</th>
                    <th>Tanggal</th>
                    <th>Nama</th>
                    <th>Kelas</th>
                    <th>Catatan</th>
                    <th>Guru Piket</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($dataCatatanGrooming as $data)
                    <tr>
                        <td>{{ $loop->iteration }}</td>
                        <td>{{ $data->tanggal }}</td>
                        <td>{{ $data->siswa->nama }}</td>
                        <td>{{ $data->siswa->dataKelas[0]->kelas }}</td>
                        <td>{{ $data->catatan }}</td>
                        <td>{{ $data->guruPiket->nama }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</body>

</html>
