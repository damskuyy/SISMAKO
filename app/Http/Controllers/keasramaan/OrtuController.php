<?php

namespace App\Http\Controllers\keasramaan;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\keasramaan\kunjungan;
use App\Http\Requests\keasramaan\KunjunganRequest;

class OrtuController extends Controller
{
    public function index()
    {
        $ortu = kunjungan::paginate(10);
        return view('keasramaan.kunjungan.ortu.ortu', compact('ortu'));
    }

    public function create()
    {
        return view('keasramaan.kunjungan.ortu.create');
    }

    public function store(KunjunganRequest $request)
    {
        $request->validated();
        kunjungan::create($request->all());
        return redirect('/sekolah-keasramaan/kunjungan/ortu')->with('success', 'Data berhasil ditambahkan!');
    }

    public function edit()
    {
        return view('keasramaan.kunjungan.ortu.edit');
    }

    public function update(KunjunganRequest $request, $id)
    {
        $data = kunjungan::findOrFail($id);
        $data->update($request->all());
        return redirect('/sekolah-keasramaan/kunjungan/ortu')->with('success', 'Data berhasil diupdate!');
    }

    public function destroy($id)
    {
        $data = kunjungan::findOrFail($id);
        $data->delete();
        return redirect('/sekolah-keasramaan/kunjungan/ortu')->with('success', 'Data berhasil dihapus!');
    }
}
