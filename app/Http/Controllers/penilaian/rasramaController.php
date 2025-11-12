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
        return redirect()->route('rasrama')->with("success", "Berhasil disimpan");
    }

    public function edit($id)
    {
        $rasrama = rasrama::findOrFail($id);
        // Pass ubudiyyah array separately for easier usage in the blade
        $ubudiyyah = $rasrama->ubudiyyah ?? [];
        return view('penilaian.rapor.asrama.edit', compact('rasrama', 'ubudiyyah'));
    }

    public function update(rasramaRequest $request, $id)
    {
        $rasrama = rasrama::findOrFail($id);
        $data = $request->validated();
        $rasrama->update($data);
        return redirect()->route('rasrama')->with("success", "Berhasil diubah");
    }

    public function destroy($id)
    {
        rasrama::findOrFail($id)->delete();
        return redirect()->route('rasrama')->with("success", "Berhasil dihapus");
    }

    public function pdf(Request $request, $id)
    {
        $prayers = ['Subuh', 'Dzuhur', 'Ashar', 'Maghrib', 'Isya'];

        // Load rasrama first so we can fallback to its date range if request params missing
        $rasrama = rasrama::findOrFail($id);

        $startDate = $request->query('start_date') ?? $rasrama->start_date ?? Carbon::now()->toDateString();
        $endDate = $request->query('end_date') ?? $rasrama->end_date ?? $startDate;

        // Ensure valid Carbon instances
        try {
            $startCarbon = Carbon::parse($startDate);
            $endCarbon = Carbon::parse($endDate);
        } catch (\Exception $e) {
            $startCarbon = Carbon::now();
            $endCarbon = Carbon::now();
        }

        $dateRange = $startCarbon->toPeriod($endCarbon->addDay());
        $totalDays = $startCarbon->diffInDays($endCarbon) + 1;
        $totalPrayers = $totalDays * count($prayers); // Total slot sholat

        $studentDetails = []; // Menyimpan detail kehadiran setiap siswa

        /** @var \Carbon\Carbon $date */
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
                    if (!isset($studentDetails[$idSiswa]['attendance'][$sholat][$status])) {
                        // Initialize if unexpected status appears
                        $studentDetails[$idSiswa]['attendance'][$sholat][$status] = 0;
                    }
                    $studentDetails[$idSiswa]['attendance'][$sholat][$status]++;
                    $studentDetails[$idSiswa]['total'][$status]++;
                }
            }
        }

        // Prepare data array expected by the view
        $data = [
            'rasrama' => $rasrama,
            'totalPrayers' => $totalPrayers,
            'startDate' => $startCarbon->toDateString(),
            'endDate' => $endCarbon->toDateString(),
            'prayers' => $prayers,
            'studentDetails' => $studentDetails,
        ];

        $pdf = Pdf::loadView('penilaian.rapor.asrama.pdf', compact('rasrama', 'data'))
            ->setPaper([0, 0, 595, 935], 'portrait'); // Ukuran kertas
        return $pdf->stream('asrama.pdf');
    }
}
