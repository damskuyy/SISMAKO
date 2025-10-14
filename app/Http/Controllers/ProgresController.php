<?php

namespace App\Http\Controllers;

use App\Models\database\Siswa as DatabaseSiswa;
use Illuminate\Http\Request;
use App\Models\database\Siswa; // Pastikan model Siswa sudah ada
use Carbon\Carbon;
use Illuminate\Support\Facades\Http;
use App\Models\keasramaan\Fiqih;
use App\Models\keasramaan\tajwid;
use App\Models\keasramaan\akhlak;

class ProgresController extends Controller
{
    public function showForm()
    {
        return view('progres');
    }

    public function hasilProgres(Request $request)
    {
        $nisn = $request->input('nisn');
        $start_date = $request->input('start_date');
        $end_date = $request->input('end_date');

        if (!$nisn) {
            $nisn = session('nisn');
            $start_date = session('start_date');
            $end_date = session('end_date');
        } else {
            session([
                'nisn' => $nisn,
                'start_date' => $start_date,
                'end_date' => $end_date,
            ]);
        }

        $siswa = \App\Models\database\Siswa::where('nisn', $nisn)->first();

        $akhlak = [];
        $data = null;
        if ($siswa) {
            $akhlak = akhlak::where('siswa_id', $siswa->id)
                ->whereBetween('tanggal', [$start_date, $end_date])
                ->orderBy('tanggal', 'desc')
                ->paginate(10)
                ->appends([
                    'nisn' => $nisn,
                    'start_date' => $start_date,
                    'end_date' => $end_date,
                ]);
            $data = [
                'nama' => $siswa->nama,
                'nisn' => $siswa->nisn,
                'tahun_pelajaran' => $siswa->tahun_pelajaran ?? '-',
                'akhlak' => $akhlak,
            ];
        }

        return view('progres', compact('data'));
    }
}
