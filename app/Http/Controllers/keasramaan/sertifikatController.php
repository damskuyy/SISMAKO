<?php

namespace App\Http\Controllers\keasramaan;


use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\keasramaan\sertifikat;
use Illuminate\Support\Facades\Storage;

class sertifikatController extends Controller
{
    public function index()
    {
        $sertifikat = sertifikat::get();
        return view('page.keasramaan.quran.sertifikat.sertif', compact('sertifikat'));
    }

    public function create()
    {
        return view('page.keasramaan.quran.sertifikat.create');
    }

    public function store(Request $request)
    {
        $validateData = $request->validate([
            'tanggal' => 'required',
            'kelas' => 'required',
            'nama' => 'required',
            'nisn' => 'required',
            'juz_30' => 'file|max:10240',
            'juz_29' => 'file|max:10240',
            'juz_28' => 'file|max:10240',
            'juz_umum' => 'file|max:10240',

        ], [
            'tanggal.required' => 'Tahun ajaran harus diisi',
            'kelas.required' => 'Kelas harus diisi',
            'nama.required' => 'nama harus diisi',
            'nisn.required' => 'NISN harus diisi',
        ]);

        // Menyimpan file-file yang di-upload dengan nama asli
        $fileFields = [
            'juz_30',
            'juz_29',
            'juz_28',
            'juz_umum',
        ];

        foreach ($fileFields as $fileField) {
            if ($request->file($fileField)) {
                $file = $request->file($fileField);
                $originalName = $file->getClientOriginalName();
                $validateData[$fileField] = $file->storeAs($fileField, $originalName);
            }
        }

        sertifikat::create($validateData);

        return redirect('/sekolah-keasramaan/al-quran/sertif')->with('success', 'Data berhasil ditambahkan');
    }

    public function edit($id)
    {
        $sertifikat = sertifikat::find($id);
        return view('page.keasramaan.quran.sertifikat.edit', compact('sertifikat'));
    }

    public function update(Request $request, $id)
    {
        $validateData = $request->validate([
            'tanggal' => 'required',
            'kelas' => 'required',
            'nama' => 'required',
            'nisn' => 'required',
            'juz_30' => 'file|max:10240',
            'juz_29' => 'file|max:10240',
            'juz_28' => 'file|max:10240',
            'juz_umum' => 'file|max:10240',
        ], [
            'tanggal.required' => 'Tahun ajaran harus diisi',
            'kelas.required' => 'Kelas harus diisi',
            'nama.required' => 'nama harus diisi',
            'nisn.required' => 'NISN harus diisi',
        ]);

        $sertifikat = sertifikat::findOrFail($id);

        $fileFields = [
            'juz_30',
            'juz_29',
            'juz_28',
            'juz_umum',
        ];

        foreach ($fileFields as $fileField) {
            if ($request->file($fileField)) {
                // Hapus file lama jika ada
                if ($sertifikat->$fileField) {
                    Storage::delete($sertifikat->$fileField);
                }
                // Simpan file baru
                $file = $request->file($fileField);
                $originalName = $file->getClientOriginalName();
                $validateData[$fileField] = $file->storeAs($fileField, $originalName);
            } else {
                // Set the field to the old value if no file was uploaded
                $validateData[$fileField] = $sertifikat->$fileField;
            }
        }

        $sertifikat->update($validateData);

        return redirect('/sekolah-keasramaan/al-quran/sertif')->with('success', 'Data berhasil diperbaharui');
    }


    public function destroy($id)
    {
        $sertifikat = sertifikat::findOrFail($id);

        $fileFields = [
            'juz_30',
            'juz_29',
            'juz_28',
            'juz_umum',
        ];

        foreach ($fileFields as $fileField) {
            if ($sertifikat->$fileField) {
                Storage::delete($sertifikat->$fileField);
            }
        }

        $sertifikat->delete();

        return redirect('/sekolah-keasramaan/al-quran/sertif')->with('success', 'Data berhasil dihapus');
    }
}
