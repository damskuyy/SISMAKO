<?php

namespace App\Http\Controllers\keasramaan;

use App\Http\Controllers\Controller;
use App\Http\Requests\keasramaan\KunjunganRequest;
use App\Models\keasramaan\kunjungan;
use App\Models\keasramaan\Kunjungan as KeasramaanKunjungan;

class AlumniController extends Controller
{
    public function index()
    {
        $alumni = KeasramaanKunjungan::where('status_kunjungan', operator: 'Alumni')->paginate(10);
        return view('keasramaan.kunjungan.alumni.alumni', compact('alumni'));
    }

    public function create()
    {
        return view('keasramaan.kunjungan.alumni.create');
    }

    public function store(KunjunganRequest $request)
    {
        $request->validated();
        kunjungan::create($request->all());
        return redirect('/sekolah-keasramaan/kunjungan/alumni')->with('success', 'Data berhasil ditambahkan!');
    }

    public function edit()
    {
        return view('keasramaan.kunjungan.alumni.edit');
    }

    public function update(KunjunganRequest $request, $id)
    {
        $data = kunjungan::findOrFail($id);
        $data->update($request->all());
        return redirect('/sekolah-keasramaan/kunjungan/alumni')->with('success', 'Data berhasil diupdate!');
    }

    public function destroy($id)
    {
        $data = kunjungan::findOrFail($id);
        $data->delete();
        return redirect('/sekolah-keasramaan/kunjungan/alumni')->with('success', 'Data berhasil dihapus!');
    }
}
