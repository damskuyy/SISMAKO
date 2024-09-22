<?php

namespace App\Http\Controllers\keasramaan;

use App\Models\keasramaan\Lab;
use App\Http\Controllers\Controller;
use App\Http\Requests\keasramaan\LabRequest;
use App\Models\database\Guru;
use App\Models\database\Siswa;
use Illuminate\Support\Facades\Http;

class LabController extends Controller
{
    public function index()
    {
        $labs = Lab::all();
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
            'guru' => Guru::select('nama')->findOrFail($request->guru_id),
            'siswa' => Siswa::select('nama')->findOrFail($request->siswa_id),
            'class' => $request->kelas_id,
            'description' => $request->keterangan,
            'start' => $request->start
        ];

        $validated = $request->validated();
        Lab::create(attributes: $validated);

        $response = Http::post('http://localhost:5000/send-whatsapp-message', [
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
