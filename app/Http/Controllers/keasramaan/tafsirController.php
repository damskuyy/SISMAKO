<?php

namespace App\Http\Controllers\keasramaan;


use Illuminate\Http\Request;
use App\Models\keasramaan\akhlak;
use App\Http\Controllers\Controller;

class tafsirController extends Controller
{
    public function index()
    {
        $tafsir = akhlak::where('type', 'tafsir')->get();
        return view('page.keasramaan.jurnal.tafsir.tafsir', compact('tafsir'));
    }
    public function create()
    {
        return view('page.keasramaan.jurnal.tafsir.create');
    }

    public function store(Request $request)
    {
        $validateData = $request->validate([
            'tanggal' => 'required',
            'kelas' => 'required',
            'materi' => 'required',
            'nisn' => 'required'
        ], [
            'tanggal.required' => 'Tahun ajaran harus diisi',
            'kelas.required' => 'Kelas harus diisi',
            'materi.required' => 'Materi harus diisi',
        ]);

        akhlak::create(array_merge($validateData, ['type' => 'tafsir']));
        return redirect("/sekolah-keasramaan/jurnal-asrama/tafsir")->with("success", "Berhasil disimpan");
    }

    public function edit($id)
    {
        $tafsir = akhlak::find($id);
        return view('page.keasramaan.jurnal.tafsir.edit', compact('tafsir'));
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

        return redirect("/sekolah-keasramaan/jurnal-asrama/tafsir")->with("success", "Berhasil diPerbaharui");
    }

    public function destroy($id)
    {
        akhlak::findOrFail($id)->delete();
        return redirect("/sekolah-keasramaan/jurnal-asrama/tafsir")->with("success", "Berhasil dihapus");
    }
}
