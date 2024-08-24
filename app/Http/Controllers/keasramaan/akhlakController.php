<?php

namespace App\Http\Controllers\keasramaan;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\keasramaan\akhlak;

class akhlakController extends Controller
{
    public function index()
    {
        $akhlak = akhlak::where('type', 'akhlak')->get();
        return view('keasramaan.jurnal.akhlak.akhlak', compact('akhlak'));
    }
    public function create()
    {
        return view('keasramaan.jurnal.akhlak.create');
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

        akhlak::create(array_merge($validateData, ['type' => 'akhlak']));
        return redirect("/sekolah-keasramaan/jurnal-asrama/akhlak")->with("success", "Berhasil disimpan");
    }

    public function edit($id)
    {
        $akhlak = akhlak::find($id);
        return view('keasramaan.jurnal.akhlak.edit', compact('akhlak'));
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

        return redirect("/sekolah-keasramaan/jurnal-asrama/akhlak")->with("success", "Berhasil diPerbaharui");
    }

    public function destroy($id)
    {
        akhlak::findOrFail($id)->delete();
        return redirect("/sekolah-keasramaan/jurnal-asrama/akhlak")->with("success", "Berhasil dihapus");
    }
}
