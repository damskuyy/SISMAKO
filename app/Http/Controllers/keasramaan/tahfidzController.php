<?php

namespace App\Http\Controllers\keasramaan;


use Illuminate\Http\Request;
use App\Models\keasramaan\tahfidz;
use App\Http\Controllers\Controller;
class tahfidzController extends Controller
{
    public function index()
    {
        $tahfidz = tahfidz::get();
        return view('page.keasramaan.quran.tahfidz.tahfidz', compact('tahfidz'));
    }

    public function create()
    {
        return view('page.keasramaan.quran.tahfidz.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'tanggal' => 'required',
            'kelas' => 'required',
            'nama' => 'required',
            'nisn' => 'required',
            'surat' => 'required',
            'ayat' => 'required',
            'predikat' => 'required',
            'pengajar' => 'required',
        ], [
            'tanggal.required' => 'Tahun ajaran harus diisi',
            'kelas.required' => 'Kelas harus diisi',
            'nama.required' => 'Nama harus diisi',
            'nisn.required' => 'NISN harus diisi',
            'surat.required' => 'Surat harus diisi',
            'ayat.required' => 'Ayat harus diisi',
            'predikat.required' => 'Predikat harus diisi',
            'pengajar.required' => 'Pengajar harus diisi',
        ]);

        tahfidz::create([
            'tanggal' => $request->tanggal,
            'kelas' => $request->kelas,
            'nama' => $request->nama,
            'nisn' => $request->nisn,
            'surat' => $request->surat,
            'ayat' => $request->ayat,
            'predikat' => $request->predikat,
            'pengajar' => $request->pengajar,
        ]);

        return redirect("/sekolah-keasramaan/al-quran/tahfidz")->with("success", "Berhasil disimpan");
    }

    public function edit($id)
    {
        $tahfidz = tahfidz::find($id);
        return view('page.keasramaan.quran.tahfidz.edit', compact('tahfidz'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'tanggal' => 'required',
            'kelas' => 'required',
            'nama' => 'required',
            'nisn' => 'required',
            'surat' => 'required',
            'ayat' => 'required',
            'predikat' => 'required',
            'pengajar' => 'required',
        ], [
            'tanggal.required' => 'Tahun ajaran harus diisi',
            'kelas.required' => 'Kelas harus diisi',
            'nama.required' => 'Nama harus diisi',
            'nisn.required' => 'NISN harus diisi',
            'surat.required' => 'Surat harus diisi',
            'ayat.required' => 'Ayat harus diisi',
            'predikat.required' => 'Predikat harus diisi',
            'pengajar.required' => 'Pengajar harus diisi',
        ]);

        tahfidz::find($id)->update([
            'tanggal' => $request->tanggal,
            'kelas' => $request->kelas,
            'nama' => $request->nama,
            'nisn' => $request->nisn,
            'surat' => $request->surat,
            'ayat' => $request->ayat,
            'predikat' => $request->predikat,
            'pengajar' => $request->pengajar,
        ]);

        return redirect("/sekolah-keasramaan/al-quran/tahfidz")->with("success", "Berhasil diPerbaharui");
    }

    public function destroy($id)
    {
        tahfidz::findOrFail($id)->delete();
        return redirect("/sekolah-keasramaan/al-quran/tahfidz")->with("success", "Berhasil dihapus");
    }
}
