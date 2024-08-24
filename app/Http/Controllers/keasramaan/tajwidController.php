<?php

namespace App\Http\Controllers\keasramaan;


use Illuminate\Http\Request;
use App\Models\keasramaan\akhlak;
use App\Http\Controllers\Controller;

class tajwidController extends Controller
{
    public function index()
    {
        $tajwid = akhlak::where('type', 'tajwid')->get();
        return view('page.keasramaan.jurnal.tajwid.tajwid', compact('tajwid'));
    }
    public function create()
    {
        return view('page.keasramaan.jurnal.tajwid.create');
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

        akhlak::create(array_merge($validateData, ['type' => 'tajwid']));
        return redirect("/sekolah-keasramaan/jurnal-asrama/tajwid")->with("success", "Berhasil disimpan");
    }

    public function edit($id)
    {
        $tajwid = akhlak::find($id);
        return view('page.keasramaan.jurnal.tajwid.edit', compact('tajwid'));
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

        return redirect("/sekolah-keasramaan/jurnal-asrama/tajwid")->with("success", "Berhasil diPerbaharui");
    }

    public function destroy($id)
    {
        akhlak::findOrFail($id)->delete();
        return redirect("/sekolah-keasramaan/jurnal-asrama/tajwid")->with("success", "Berhasil dihapus");
    }
}
