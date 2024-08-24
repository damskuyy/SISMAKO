<?php

namespace App\Http\Controllers\keasramaan;

use Illuminate\Http\Request;
use App\Models\keasramaan\akhlak;
use App\Http\Controllers\Controller;

class fiqihController extends Controller
{
    public function index()
    {
        $fiqih = akhlak::where('type', 'fiqih')->get();
        return view('page.keasramaan.jurnal.fiqih.fiqih', compact('fiqih'));
    }
    public function create()
    {
        return view('page.keasramaan.jurnal.fiqih.create');
    }

    public function store(Request $request)
    {
        $validateData = $request->validate([
            'tanggal' => 'required',
            'kelas' => 'required',
            'materi' => 'required',
            'nisn' => 'required',
        ], [
            'tanggal.required' => 'Tahun ajaran harus diisi',
            'kelas.required' => 'Kelas harus diisi',
            'materi.required' => 'Materi harus diisi',
            'nisn.required' => 'NISN harus diisi',
        ]);

        akhlak::create(array_merge($validateData, ['type' => 'fiqih']));
        return redirect("/sekolah-keasramaan/jurnal-asrama/fiqih")->with("success", "Berhasil disimpan");
    }

    public function edit($id)
    {
        $fiqih = akhlak::find($id);
        return view('page.keasramaan.jurnal.fiqih.edit', compact('fiqih'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'tanggal' => 'required',
            'kelas' => 'required',
            'materi' => 'required',
            'nisn' => 'required',
        ], [
            'tanggal.required' => 'Tahun ajaran harus diisi',
            'kelas.required' => 'Kelas harus diisi',
            'materi.required' => 'Materi harus diisi',
            'nisn.required' => 'NISN harus diisi',
        ]);

        akhlak::find($id)->update([
            'tanggal' => $request->tanggal,
            'kelas' => $request->kelas,
            'materi' => $request->materi,
            'nisn' => $request->nisn,
        ]);

        return redirect("/sekolah-keasramaan/jurnal-asrama/fiqih")->with("success", "Berhasil diPerbaharui");
    }

    public function destroy($id)
    {
        akhlak::findOrFail($id)->delete();
        return redirect("/sekolah-keasramaan/jurnal-asrama/fiqih")->with("success", "Berhasil dihapus");
    }
}
