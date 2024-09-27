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
                $query->where('name', 'like', '%' . $searchGuru . '%');
            });
        }

        // Filter berdasarkan kelas jika ada input
        if ($searchKelas) {
            $labs->whereHas('kelas', function ($query) use ($searchKelas) {
                $query->where('name', 'like', '%' . $searchKelas . '%');
            });
        }

        // Filter berdasarkan siswa jika ada input
        if ($searchSiswa) {
            $labs->whereHas('siswa', function ($query) use ($searchSiswa) {
                $query->where('name', 'like', '%' . $searchSiswa . '%');
            });
        }

        // Ambil data dengan pagination
        $labs = $labs->take(500)->paginate(10);

        return view('keasramaan.akses-lab.lab', compact('labs'));
    }


    public function create()
    {
        $guru = Guru::select('nama', 'id')->get();
        return view('keasramaan.akses-lab.create', compact('guru')); // Buat view untuk form tambah
    }

    public function store(LabRequest $request)
    {
        $data = [
            'guru' => Guru::findOrFail($request->guru_id),
            'siswa' => Siswa::select('nama')->findOrFail($request->siswa_id),
            'class' => $request->kelas_id,
            'description' => $request->keterangan,
            'start' => $request->start
        ];
        $validated = $request->validated();
        Lab::create(attributes: $validated);
        Http::post('http://localhost:5000/send-whatsapp-message', [
            'data' => $data
        ]);
        return redirect('/sekolah-keasramaan/akses-lab')->with('success', 'Data berhasil ditambahkan!');
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
}
