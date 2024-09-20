<?php

namespace App\Http\Controllers\keasramaan;

use App\Models\keasramaan\Lab;
use App\Http\Controllers\Controller;
use App\Http\Requests\keasramaan\LabRequest;
use App\Models\database\Guru;
use Illuminate\Http\Request;

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
        $validated = $request->validated();
        Lab::create(attributes: $validated);
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
