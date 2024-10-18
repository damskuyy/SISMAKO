<?php

namespace App\Http\Controllers\keasramaan;

use Illuminate\Http\Request;
use App\Models\database\Guru;
use App\Models\database\Siswa;
use App\Models\keasramaan\Lab;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Http;
use App\Http\Requests\keasramaan\LabRequest;

class LabController extends Controller
{
    public function index(Request $request)
    {
        // Ambil filter dari input
        $startDate = $request->input('start_date');
        $endDate = $request->input('end_date');
        $searchGuru = $request->input('search_guru');
        $searchKelas = $request->input('search_kelas');
        $searchSiswa = $request->input('search_siswa');

        // Mulai dengan query dasar
        $labs = Lab::query();

        // Filter berdasarkan tanggal jika ada input
        if ($startDate) {
            $labs->where('tanggal', '>=', $startDate);
        }
        if ($endDate) {
            $labs->where('tanggal', '<=', $endDate);
        }

        // Filter berdasarkan guru jika ada input
        if ($searchGuru) {
            $labs->whereHas('guru', function ($query) use ($searchGuru) {
                $query->where('nama', 'like', '%' . $searchGuru . '%');
            });
        }

        // Filter berdasarkan kelas jika ada input
        if ($searchKelas) {
            $labs->whereHas('kelas', function ($query) use ($searchKelas) {
                $query->where('nama', 'like', '%' . $searchKelas . '%');
            });
        }

        // Filter berdasarkan siswa jika ada input
        if ($searchSiswa) {
            $labs->whereHas('siswa', function ($query) use ($searchSiswa) {
                $query->where('nama', 'like', '%' . $searchSiswa . '%');
            });
        }

        // Ambil data dengan pagination
        $labs = $labs->with([
            'guru:id,nama', // Hanya mengambil kolom id dan nama dari guru
            'kelas:id,kelas',        // Memuat semua data dari kelas
            'siswa:id,nama' // Hanya mengambil kolom id dan nama dari siswa
        ])->paginate(10);
        return view('keasramaan.akses-lab.lab', compact('labs'));
    }



    public function create()
    {
        $guru = Guru::select('nama', 'id')->get();
        return view('keasramaan.akses-lab.create', compact('guru')); // Buat view untuk form tambah
    }

    public function edit(Lab $aksesLab)
    {
        return view('keasramaan.akses-lab.edit', compact('aksesLab')); // Hanya ambil lab yang akan diedit
    }

    public function update(LabRequest $request, Lab $aksesLab)
    {
        $validated = $request->validated();
        $aksesLab->update($validated);
        return redirect('/sekolah-keasramaan/akses-lab')->with('success', 'Data berhasil diupdate!');
    }

    public function destroy(Lab $aksesLab)
    {
        $aksesLab->delete();
        return redirect('/sekolah-keasramaan/akses-lab')->with('success', 'Data berhasil dihapus!');
    }
    public function store(LabRequest $request)
    {
        $getGuru = Guru::findOrFail($request->guru_id);
        $getSiswa = Siswa::select('id', 'nama')->findOrFail($request->siswa_id);
        $waktuTerkini = now();
        $validated = $request->validated();

        // Simpan data lab ke database
        Lab::create($validated);  // Hanya menggunakan $validated

        try {
            // Kirim pesan WhatsApp ke guru
            $response = Http::post('https://wasismako.smktibazma.sch.id/waapi', [
                'token' => 'shjdksahlsakjdkaqijdsajhda',
                'nohp' => $getGuru->no_hp,
                'pesan' =>
                'SMK TI BAZMA' . "\n" .
                    'Akses LAB : ' . $waktuTerkini->isoFormat('dddd, D MMMM Y') . "\n\n" .
                    'Nama           : ' . $getSiswa->nama . "\n" .
                    'Kelas          : ' . $validated['kelas_id'] . "\n" .
                    'Jam Masuk      : ' . $waktuTerkini->format('H:i') . "\n" .
                    'Project Guru   : ' . $getGuru->nama . "\n" .
                    'Keterangan     : ' . $validated['keterangan'] . "\n\n" .
                    'Bagi bapak ibu guru yang memberi tugas, harap mengawasi langsung via CCTV' . "\n" .
                    'Bagi Bapak/Ibu yang tidak merasa memberikan tugas, silahkan untuk ditindaklanjuti' . "\n\n" .
                    'Notification sent by the system' . "\n" .
                    'E-Akses Lab Digital SMK TI BAZMA'
            ]);

            // Tangani respons
            $responseData = $response->json();

            if ($response->failed() || (isset($responseData['success']) && !$responseData['success'])) {
                return redirect('/sekolah-keasramaan/akses-lab')->with('error', 'Data berhasil ditambahkan, namun pesan gagal terkirim!');
            }

            return redirect('/sekolah-keasramaan/akses-lab')->with('success', 'Data berhasil ditambahkan dan pesan terkirim!');
        } catch (\Throwable $th) {
            return redirect('/sekolah-keasramaan/akses-lab')->with('error', 'Data gagal ditambahkan!');
        }
    }
}
