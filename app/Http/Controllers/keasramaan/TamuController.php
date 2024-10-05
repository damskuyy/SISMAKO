<?php

namespace App\Http\Controllers\keasramaan;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\keasramaan\kunjungan;
use App\Http\Requests\keasramaan\KunjunganRequest;
use App\Models\keasramaan\Kunjungan as KeasramaanKunjungan;

class TamuController extends Controller
{
    public function index()
    {
        $tamu = KeasramaanKunjungan::where('status_kunjungan', operator: 'Tamu')->paginate(10);
        return view('keasramaan.kunjungan.tamu.tamu', compact('tamu'));
    }

    public function create()
    {
        return view('keasramaan.kunjungan.tamu.create');
    }

    public function store(KunjunganRequest $request)
    {
        $request->validated();
        kunjungan::create($request->all());
        return redirect('/sekolah-keasramaan/kunjungan/tamu')->with('success', 'Data berhasil ditambahkan!');
    }

    public function edit()
    {
        return view('keasramaan.kunjungan.tamu.edit');
    }

    public function update(KunjunganRequest $request, $id)
    {
        $data = kunjungan::findOrFail($id);
        $data->update($request->all());
        return redirect('/sekolah-keasramaan/kunjungan/tamu')->with('success', 'Data berhasil diupdate!');
    }

    public function destroy($id)
    {
        $data = kunjungan::findOrFail($id);
        $data->delete();
        return redirect('/sekolah-keasramaan/kunjungan/tamu')->with('success', 'Data berhasil dihapus!');
    }
}
