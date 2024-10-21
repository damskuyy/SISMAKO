<?php

namespace App\Http\Controllers\keasramaan;

use App\Http\Controllers\Controller;
use App\Http\Requests\keasramaan\KunjunganRequest;
use App\Models\keasramaan\Kunjungan;

class IndustriController extends Controller
{
    public function index()
    {
        $industri = Kunjungan::where('status_kunjungan', operator: 'Industri')->paginate(10);

        return view('keasramaan.kunjungan.industri.industri', compact('industri'));
    }

    public function create()
    {
        return view('keasramaan.kunjungan.industri.create');
    }

    public function store(KunjunganRequest $request)
    {
        $request->validated();
        Kunjungan::create($request->all());
        return redirect('/sekolah-keasramaan/kunjungan/industri')->with('success', 'Data berhasil ditambahkan!');
    }

    public function edit()
    {
        return view('keasramaan.kunjungan.industri.edit');
    }

    public function update(KunjunganRequest $request, $id)
    {
        $data = Kunjungan::findOrFail($id);
        $data->update($request->all());
        return redirect('/sekolah-keasramaan/kunjungan/industri')->with('success', 'Data berhasil diupdate!');
    }

    public function destroy($id)
    {
        $data = Kunjungan::findOrFail($id);
        $data->delete();
        return redirect('/sekolah-keasramaan/kunjungan/industri')->with('success', 'Data berhasil dihapus!');
    }
}
