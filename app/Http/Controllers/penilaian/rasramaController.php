<?php

namespace App\Http\Controllers\penilaian;

use Illuminate\Http\Request;
use App\Models\database\Siswa;
use Barryvdh\DomPDF\Facade\Pdf;
use App\Models\penilaian\rasrama;
use App\Http\Controllers\Controller;
use App\Http\Requests\penilaian\rasramaRequest;
use App\Models\keasramaan\JamaahSiswa;
use Carbon\Carbon;


class rasramaController extends Controller
{
    public function index(Request $request)
    {
        // Ambil nilai filter dari request
        $filterKelas = $request->input('kelas');
        $filterNama = $request->input('nama');

        // Query untuk rapor dengan filter kelas dan nama jika ada
        $query = rasrama::query();

        if ($filterKelas) {
            // Menggunakan pencocokan yang tepat (exact match) alih-alih LIKE
            $query->where('kelas', '=', $filterKelas);
        }

        if ($filterNama) {
            // Nama tetap menggunakan LIKE karena mungkin ingin pencarian sebagian
            $query->where('nama', 'like', '%' . $filterNama . '%');
        }

        // Lakukan pagination dan ambil hasilnya
        $rasrama = $query->paginate(10);

        // Mengembalikan view dengan data rapor dan filter yang diterapkan
        return view('penilaian.rapor.asrama.rapor', compact('rasrama', 'filterKelas', 'filterNama'));
    }

    public function create()
    {
        return view('penilaian.rapor.asrama.create');
    }

    public function store(rasramaRequest $request)
    {
        // dd($request->all());
        rasrama::create($request->validated());
        return redirect("/penilaian/rapor/asrama")->with("success", "Berhasil disimpan");
    }

    public function edit($id)
    {
        $rasrama = rasrama::findOrFail($id);
        return view('penilaian.rapor.asrama.edit', compact('rasrama'));
    }

    public function update(rasramaRequest $request, $id)
    {
        $rasrama = rasrama::findOrFail($id);
        $data = $request->validated();
        $rasrama->update($data);
        return redirect("/penilaian/rapor/asrama")->with("success", "Berhasil diubah");
    }

    public function destroy($id)
    {
        rasrama::findOrFail($id)->delete();
        return redirect("/penilaian/rapor/asrama")->with("success", "Berhasil dihapus");
    }

    // public function pdf(Request $request, $id)
    // {
    //     $prayers = ['Subuh', 'Dzuhur', 'Ashar', 'Maghrib', 'Isya'];
    //     $startDate = $request->query('start_date');
    //     $endDate = $request->query('end_date');

    //     $dateRange = Carbon::parse($startDate)->toPeriod(Carbon::parse($endDate)->addDay());
    //     $totalDays = Carbon::parse($startDate)->diffInDays(Carbon::parse($endDate)) + 1;
    //     $totalPrayers =  $totalDays * 5; // Correct calculation for total prayer slots

    //     // Initialize scores and detailed points
    //     $studentScores = [];
    //     $studentDetails = [];

    //     // Initialize counters for "Sakit" and "Alpha"
    //     $studentAbsences = [];
    //     $studentSick = [];

    //     foreach ($dateRange as $date) {
    //         foreach ($prayers as $sholat) {
    //             $query = JamaahSiswa::query()
    //                 ->join('siswa', 'jamaah_siswa.id_siswa', '=', 'siswa.id')
    //                 ->join('dokumentasi_jamaah_siswa', 'jamaah_siswa.dokumentasi_jamaah', '=', 'dokumentasi_jamaah_siswa.id')
    //                 ->where('dokumentasi_jamaah_siswa.tanggal', $date->format('Y-m-d'))
    //                 ->where('dokumentasi_jamaah_siswa.sholat', $sholat)
    //                 ->orderBy('siswa.nama', 'asc')
    //                 ->select('jamaah_siswa.*', 'siswa.nama as nama_siswa', 'dokumentasi_jamaah_siswa.sholat', 'status_jamaah')
    //                 ->get();

    //             foreach ($query as $record) {
    //                 $idSiswa = $record->id_siswa;

    //                 if (!isset($studentScores[$idSiswa])) {
    //                     $studentScores[$idSiswa] = 0; // Initialize score to 0
    //                     $studentDetails[$idSiswa] = []; // Initialize details to empty array

    //                     // Initialize absence counters
    //                     $studentAbsences[$idSiswa] = 0;
    //                     $studentSick[$idSiswa] = 0;
    //                     $studentIzin[$idSiswa] = 0;
    //                 }

    //                 if ($record->status_jamaah == 'Hadir') {
    //                     $studentScores[$idSiswa]++; // Increment for Hadir

    //                     // Add detail for each sholat
    //                     if (!isset($studentDetails[$idSiswa][$sholat])) {
    //                         $studentDetails[$idSiswa][$sholat] = 0;
    //                     }
    //                     $studentDetails[$idSiswa][$sholat]++;
    //                 } elseif ($record->status_jamaah == 'Sakit') {
    //                     $studentSick[$idSiswa]++;
    //                 } elseif ($record->status_jamaah == 'Izin') {
    //                     $studentIzin[$idSiswa]++;
    //                 } else {
    //                     $studentAbsences[$idSiswa]++;
    //                 }
    //             }
    //         }
    //     }

    //     // Normalize scores to a maximum of 7 points
    //     foreach ($studentScores as $idSiswa => $score) {
    //         // Ensure the score is between 0 and 7
    //         $studentScores[$idSiswa] = max(0, min(7, $score));
    //     }

    //     // Fetch names for the final report
    //     $students = Siswa::whereIn('id', array_keys($studentScores))->pluck('nama', 'id')->toArray();
    //     foreach ($studentScores as $idSiswa => $score) {
    //         $studentScores[$idSiswa] = [
    //             'score' => $score,
    //             'details' => $studentDetails[$idSiswa], // Include detailed points
    //             'sick' => $studentSick[$idSiswa] ?? 0, // Include sick count
    //             'absences' => $studentAbsences[$idSiswa] ?? 0, // Include absences count
    //             'name' => $students[$idSiswa] ?? 'Unknown',
    //             'izin' => $studentIzin[$idSiswa] ?? 0
    //         ];
    //     }


    //     $rasrama = rasrama::with([
    //         'siswa:id,nama',
    //         'siswa.dataKelas',
    //         'siswa.jamaahSiswa',
    //     ])->findOrFail($id);

    //     $data = [
    //         'rasrama' => $rasrama,
    //         'totalPrayers' => $totalPrayers,
    //         'startDate' => $startDate,
    //         'endDate' => $endDate,
    //         'prayers' => $prayers,
    //         'studentScores' => $studentScores,
    //     ];

    //     // return response()->json($data);

    //     $pdf = Pdf::loadView('penilaian.rapor.asrama.pdf', compact('data', 'rasrama'))
    //         ->setPaper([0, 0, 595, 935], 'portrait');
    //     return $pdf->stream('asrama.pdf');

    // }

    public function pdf(Request $request, $id)
    {
        $prayers = ['Subuh', 'Dzuhur', 'Ashar', 'Maghrib', 'Isya'];
        $startDate = $request->query('start_date');
        $endDate = $request->query('end_date');

        $dateRange = Carbon::parse($startDate)->toPeriod(Carbon::parse($endDate)->addDay());
        $totalDays = Carbon::parse($startDate)->diffInDays(Carbon::parse($endDate)) + 1;
        $totalPrayers = $totalDays * count($prayers); // Total slot sholat

        $studentDetails = []; // Menyimpan detail kehadiran setiap siswa

        foreach ($dateRange as $date) {
            foreach ($prayers as $sholat) {
                $query = JamaahSiswa::query()
                    ->join('siswa', 'jamaah_siswa.id_siswa', '=', 'siswa.id')
                    ->join('dokumentasi_jamaah_siswa', 'jamaah_siswa.dokumentasi_jamaah', '=', 'dokumentasi_jamaah_siswa.id')
                    ->where('dokumentasi_jamaah_siswa.tanggal', $date->format('Y-m-d'))
                    ->where('dokumentasi_jamaah_siswa.sholat', $sholat)
                    ->orderBy('siswa.nama', 'asc')
                    ->select('jamaah_siswa.*', 'siswa.nama as nama_siswa', 'dokumentasi_jamaah_siswa.sholat', 'status_jamaah')
                    ->get();

                foreach ($query as $record) {
                    $idSiswa = $record->id_siswa;

                    if (!isset($studentDetails[$idSiswa])) {
                        $studentDetails[$idSiswa] = [
                            'name' => $record->nama_siswa,
                            'attendance' => array_fill_keys($prayers, ['Hadir' => 0, 'Sakit' => 0, 'Izin' => 0, 'Alpha' => 0]),
                            'total' => ['Hadir' => 0, 'Sakit' => 0, 'Izin' => 0, 'Alpha' => 0],
                        ];
                    }

                    $status = $record->status_jamaah; // Hadir, Sakit, Izin, atau Alpha
                    $studentDetails[$idSiswa]['attendance'][$sholat][$status]++;
                    $studentDetails[$idSiswa]['total'][$status]++;
                }
            }
        }

        $rasrama = rasrama::with([
            'siswa:id,nama',
            'siswa.dataKelas',
            'siswa.jamaahSiswa',
        ])->findOrFail($id);

        $data = [
            'rasrama' => $rasrama,
            'totalPrayers' => $totalPrayers,
            'startDate' => $startDate,
            'endDate' => $endDate,
            'prayers' => $prayers,
            'studentDetails' => $studentDetails,
        ];
        return response()->json($data);
        $pdf = Pdf::loadView('penilaian.rapor.asrama.pdf', compact('data', 'rasrama'))
            ->setPaper([0, 0, 595, 935], 'portrait'); // Ukuran kertas
        return $pdf->stream('asrama.pdf');
    }
}
