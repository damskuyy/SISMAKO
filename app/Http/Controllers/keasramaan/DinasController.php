<?php

namespace App\Http\Controllers\keasramaan;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\keasramaan\kunjungan;
use App\Http\Requests\keasramaan\KunjunganRequest;

class DinasController extends Controller
{
    public function index()
    {
        $dinas = kunjungan::paginate(10);
        return view('keasramaan.kunjungan.dinas.dinas', compact('dinas'));
    }

    public function create()
    {
        return view('keasramaan.kunjungan.dinas.create');
    }

    public function store(KunjunganRequest $request)
    {
        $request->validated();
        kunjungan::create($request->all());
        return redirect('/sekolah-keasramaan/kunjungan/dinas')->with('success', 'Data berhasil ditambahkan!');
    }

    public function edit()
    {
        return view('keasramaan.kunjungan.dinas.edit');
    }

    public function update(KunjunganRequest $request, $id)
    {
        $data = kunjungan::findOrFail($id);
        $data->update($request->all());
        return redirect('/sekolah-keasramaan/kunjungan/dinas')->with('success', 'Data berhasil diupdate!');
    }

    public function destroy($id)
    {
        $data = kunjungan::findOrFail($id);
        $data->delete();
        return redirect('/sekolah-keasramaan/kunjungan/dinas')->with('success', 'Data berhasil dihapus!');
    }
}
