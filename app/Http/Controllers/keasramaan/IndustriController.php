<?php

namespace App\Http\Controllers\keasramaan;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\keasramaan\kunjungan;
use App\Http\Requests\keasramaan\KunjunganRequest;
use App\Models\keasramaan\Kunjungan as KeasramaanKunjungan;

class IndustriController extends Controller
{
    public function index()
    {
        $industri = KeasramaanKunjungan::where('status_kunjungan', operator: 'Industri')->paginate(10);

        return view('keasramaan.kunjungan.industri.industri', compact('industri'));
    }

    public function create()
    {
        return view('keasramaan.kunjungan.industri.create');
    }

    public function store(KunjunganRequest $request)
    {
        $request->validated();
        kunjungan::create($request->all());
        return redirect('/sekolah-keasramaan/kunjungan/industri')->with('success', 'Data berhasil ditambahkan!');
    }

    public function edit()
    {
        return view('keasramaan.kunjungan.industri.edit');
    }

    public function update(KunjunganRequest $request, $id)
    {
        $data = kunjungan::findOrFail($id);
        $data->update($request->all());
        return redirect('/sekolah-keasramaan/kunjungan/industri')->with('success', 'Data berhasil diupdate!');
    }

    public function destroy($id)
    {
        $data = kunjungan::findOrFail($id);
        $data->delete();
        return redirect('/sekolah-keasramaan/kunjungan/industri')->with('success', 'Data berhasil dihapus!');
    }
}
