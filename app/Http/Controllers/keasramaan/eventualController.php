<?php

namespace App\Http\Controllers\keasramaan;

use Illuminate\Http\Request;
use App\Models\keasramaan\pelatihan;
use Illuminate\Support\Facades\Storage;
use App\Http\Controllers\Controller;

class eventualController extends Controller
{
    public function index()
    {
        $eventual = pelatihan::where('type', 'eventual')->get();
        return view('page.keasramaan.akademik.volentir.volentir', compact('eventual'));
    }

    public function create()
    {
        return view('page.keasramaan.akademik.volentir.create');
    }

    public function store(Request $request)
    {
        $validateData = $request->validate([
            'tanggal' => 'required',
            'kelas' => 'required',
            'nama' => 'required',
            'nisn' => 'required',
            'kegiatan' => 'required',
            'keterangan' => 'required',
            'dokumentasi.' => 'file|max:10240',
            'undangan.' => 'file|max:10240',
        ], [
            'tanggal.required' => 'Tanggal tidak boleh kosong',
            'kelas.required' => 'Kelas tidak boleh kosong',
            'nama.required' => 'Nama tidak boleh kosong',
            'nisn.required' => 'NISN (Nomor Induk Siswa Nasional) tidak boleh kosong',
            'kegiatan.required' => 'Nama kegiatan yang dilaksanakan tidak boleh kosong',
            'keterangan.required' => 'Keterangan Tidak boleh kosong',
            'dokumentasi.*.max' => 'Ukuran file yang diupload maksimal 10MB',
            'undangan.*.max' => 'Ukuran file yang diupload maksimal 10MB',
        ]);

        $fileFields = ['dokumentasi', 'undangan'];

        foreach ($fileFields as $fileField) {
            if ($request->hasFile($fileField)) {
                $files = $request->file($fileField);
                $storedFiles = [];

                foreach ($files as $index => $file) {
                    if ($index < 3) { // Batas maksimal 3 file
                        $originalName = $file->getClientOriginalName();
                        $storedFiles[] = $file->storeAs($fileField, $originalName);
                    }
                }
                $validateData[$fileField] = json_encode($storedFiles);
            }
        }

        pelatihan::create(array_merge($validateData, ['type' => 'eventual']));
        return redirect('/sekolah-keasramaan/akademik/eventual')->with('success', 'Data berhasil ditambahkan');
    }


    public function edit($id)
    {
        $eventual = pelatihan::findOrFail($id);
        return view('page.keasramaan.akademik.volentir.edit', compact('eventual'));
    }

    public function update(Request $request, $id)
    {
        $validateData = $request->validate([
            'tanggal' => 'required',
            'kelas' => 'required',
            'nama' => 'required',
            'nisn' => 'required',
            'kegiatan' => 'required',
            'keterangan' => 'required',
            'dokumentasi.' => 'file|max:10240',
            'undangan.' => 'file|max:10240',
        ],[
            'tanggal.required' => 'Tanggal tidak boleh kosong',
            'kelas.required' => 'Kelas tidak boleh kosong',
            'nama.required' => 'Nama tidak boleh kosong',
            'nisn.required' => 'NISN (Nomor Induk Siswa Nasional) tidak boleh kosong',
            'kegiatan.required' => 'Nama kegiatan yang dilaksanakan tidak boleh kosong',
            'keterangan.required' => 'Keterangan Tidak boleh kosong',
            'dokumentasi.*.max' => 'Ukuran file yang diupload maksimal 10MB',
            'undangan.*.max' => 'Ukuran file yang diupload maksimal 10MB',
        ]);

        $eventual = pelatihan::findOrFail($id);

        $fileFields = ['dokumentasi', 'undangan'];

        foreach ($fileFields as $fileField) {
            if ($request->hasFile($fileField)) {
                $files = $request->file($fileField);
                $storedFiles = [];

                foreach ($files as $index => $file) {
                    if ($index < 3) {
                        // Hapus file lama jika ada
                        $existingFiles = json_decode($eventual->$fileField);
                        if (isset($existingFiles[$index])) {
                            Storage::delete($existingFiles[$index]);
                        }

                        $originalName = $file->getClientOriginalName();
                        $storedFiles[] = $file->storeAs($fileField, $originalName);
                    }
                }
                $validateData[$fileField] = json_encode($storedFiles);
            } else {
                $validateData[$fileField] = $eventual->$fileField;
            }
        }
        $eventual->update($validateData);
        return redirect('/sekolah-keasramaan/akademik/eventual')->with('success', 'Data berhasil diperbaharui');
    }


    public function destroy($id)
    {
        $eventual = pelatihan::findOrFail($id);

        $fileFields = [
            'dokumentasi',
            'undangan',
        ];

        foreach ($fileFields as $fileField) {
            if ($eventual->$fileField) {
                Storage::delete($eventual->$fileField);
            }
        }

        $eventual->delete();

        return redirect('/sekolah-keasramaan/akademik/eventual')->with('success', 'Data berhasil dihapus');
    }
}
