<?php

namespace App\Http\Controllers\keasramaan;

use Illuminate\Http\Request;
use App\Models\keasramaan\pelatihan;
use Illuminate\Support\Facades\Storage;
use App\Http\Controllers\Controller;

class lombaController extends Controller
{
    public function index()
    {
        $lomba = pelatihan::where('type', 'lomba')->get();
        return view('page.keasramaan.akademik.lomba.lomba', compact('lomba'));
    }

    public function create()
    {
        return view('page.keasramaan.akademik.lomba.create');
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
        ],[
            'dokumentasi.*.file' => 'Dokumen Dokumentasi harus berformat file (.pdf,.docx,.jpg,.png)',
            'undangan.*.file' => 'Dokumen Undangan harus berformat file (.pdf,.docx,.jpg,.png)',
            'tanggal.required' => 'Tanggal harus diisi',
            'kelas.required' => 'Kelas harus diisi',
            'nama.required' => 'Nama harus diisi',
            'nisn.required' => 'NISN harus diisi',
            'kegiatan.required' => 'Kegiatan harus diisi',
            'keterangan.required' => 'Keterangan harus diisi',
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

        pelatihan::create(array_merge($validateData, ['type' => 'lomba']));
        return redirect('/sekolah-keasramaan/akademik/lomba')->with('success', 'Data berhasil ditambahkan');
    }


    public function edit($id)
    {
        $lomba = pelatihan::findOrFail($id);
        return view('page.keasramaan.akademik.lomba.edit', compact('lomba'));
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
            'dokumentasi.*.file' => 'Dokumen Dokumentasi harus berformat file (.pdf,.docx,.jpg,.png)',
            'undangan.*.file' => 'Dokumen Undangan harus berformat file (.pdf,.docx,.jpg,.png)',
            'tanggal.required' => 'Tanggal harus diisi',
            'kelas.required' => 'Kelas harus diisi',
            'nama.required' => 'Nama harus diisi',
            'nisn.required' => 'NISN harus diisi',
            'kegiatan.required' => 'Kegiatan harus diisi',
            'keterangan.required' => 'Keterangan harus diisi',
        ]);

        $lomba = pelatihan::findOrFail($id);

        $fileFields = ['dokumentasi', 'undangan'];

        foreach ($fileFields as $fileField) {
            if ($request->hasFile($fileField)) {
                $files = $request->file($fileField);
                $storedFiles = [];

                foreach ($files as $index => $file) {
                    if ($index < 3) {
                        // Hapus file lama jika ada
                        $existingFiles = json_decode($lomba->$fileField);
                        if (isset($existingFiles[$index])) {
                            Storage::delete($existingFiles[$index]);
                        }

                        $originalName = $file->getClientOriginalName();
                        $storedFiles[] = $file->storeAs($fileField, $originalName);
                    }
                }
                $validateData[$fileField] = json_encode($storedFiles);
            } else {
                $validateData[$fileField] = $lomba->$fileField;
            }
        }
        $lomba->update($validateData);
        return redirect('/sekolah-keasramaan/akademik/lomba')->with('success', 'Data berhasil diperbaharui');
    }


    public function destroy($id)
    {
        $lomba = pelatihan::findOrFail($id);

        $fileFields = [
            'dokumentasi',
            'undangan',
        ];

        foreach ($fileFields as $fileField) {
            if ($lomba->$fileField) {
                Storage::delete($lomba->$fileField);
            }
        }

        $lomba->delete();

        return redirect('/sekolah-keasramaan/akademik/lomba')->with('success', 'Data berhasil dihapus');
    }
}
