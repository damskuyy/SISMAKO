<?php

namespace App\Http\Controllers\keasramaan;

use Illuminate\Http\Request;
use App\Models\database\Siswa;
use App\Http\Controllers\Controller;
use App\Models\keasramaan\pelatihan;
use Illuminate\Support\Facades\Storage;

class pelatihanController extends Controller
{
    public function index()
    {
        $pelatihan = pelatihan::where('type', 'pelatihan')
        ->with(['siswa:id,nama,nisn']) // Menentukan kolom yang ingin dimuat dari model siswa
        ->get();
        return view('page.keasramaan.akademik.pelatihan.pelatihan', compact('pelatihan'));
    }

    // public function create()
    // {
    //     return view('page.keasramaan.akademik.pelatihan.create');
    // }

    public function create(Request $request)
    {
        $mutasiFilter = $request->query('angkatan', ''); // Default empty filter

        // Fetch distinct angkatan values from Siswa model
        $angkatan = Siswa::distinct()->pluck('angkatan');

        // Get the selected angkatan from the request or default to an empty string
        $defaultAngkatan = $request->angkatan;

        // Fetch names for the selected angkatan if available
        $names = $defaultAngkatan ? Siswa::where('angkatan', $defaultAngkatan)->get(['id', 'nama', 'angkatan']) : collect();

        // return view('page.keasramaan.akademik.pelatihan.create', compact('angkatan', 'names');
        return view('page.keasramaan.akademik.pelatihan.create', compact('angkatan', 'names'));

        // return view('database.kelas.add', compact('angkatan', 'names'));
    }

    public function store(Request $request)
    {
        // dd($request->all());
        $validateData = $request->validate([
            'tanggal' => 'required',
            'siswa_id' => 'required',
            'kegiatan' => 'required',
            'keterangan' => 'required',
            'dokumentasi.' => 'file|max:10240',
            'undangan.' => 'file|max:10240',
        ],[
            'siswa_id.required' => 'NISN wajib diisi',
            'keterangan.required' => 'Keterangan wajib diisi',
            'tanggal.required' => 'Tanggal wajib diisi',
            'dokumentasi.*.max' => 'Maksimal file size adalah 10MB',
            'undangan.*.max' => 'Maksimal file size adalah 10MB',
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

        pelatihan::create(array_merge($validateData, ['type' => 'pelatihan']));
        return redirect('/sekolah-keasramaan/akademik/pelatihan')->with('success', 'Data berhasil ditambahkan');
    }


    public function edit($id)
    {

        // Fetch distinct angkatan values from Siswa model
        $angkatan = Siswa::distinct()->pluck('angkatan');

        // Get the selected angkatan from the request or default to an empty string

        // Fetch names for the selected angkatan if available
        $pelatihan = pelatihan::findOrFail($id);
        return view('page.keasramaan.akademik.pelatihan.edit', compact('pelatihan', 'angkatan'));
    }

    public function update(Request $request, $id)
    {
        $validateData = $request->validate([
            'tanggal' => 'required',
            'siswa_id' => 'required',
            'kegiatan' => 'required',
            'keterangan' => 'required',
            'dokumentasi.*' => 'file|max:10240',
            'undangan.*' => 'file|max:10240',
        ],[
            'nisn.required' => 'NISN wajib diisi',
            'keterangan.required' => 'Keterangan wajib diisi',
            'tanggal.required' => 'Tanggal wajib diisi',
            'dokumentasi.*.max' => 'Maksimal file size adalah 10MB',
            'undangan.*.max' => 'Maksimal file size adalah 10MB',
        ]);

        $pelatihan = pelatihan::findOrFail($id);

        $fileFields = ['dokumentasi', 'undangan'];

        foreach ($fileFields as $fileField) {
            if ($request->hasFile($fileField)) {
                $files = $request->file($fileField);
                $storedFiles = [];

                foreach ($files as $index => $file) {
                    if ($index < 3) {
                        // Hapus file lama jika ada
                        $existingFiles = json_decode($pelatihan->$fileField);
                        if (isset($existingFiles[$index])) {
                            Storage::delete($existingFiles[$index]);
                        }

                        $originalName = $file->getClientOriginalName();
                        $storedFiles[] = $file->storeAs($fileField, $originalName);
                    }
                }
                $validateData[$fileField] = json_encode($storedFiles);
            } else {
                $validateData[$fileField] = $pelatihan->$fileField;
            }
        }
        $pelatihan->update($validateData);
        return redirect('/sekolah-keasramaan/akademik/pelatihan')->with('success', 'Data berhasil diperbaharui');
    }


    public function destroy($id)
    {
        $pelatihan = pelatihan::findOrFail($id);

        $fileFields = [
            'dokumentasi',
            'undangan',
        ];

        foreach ($fileFields as $fileField) {
            if ($pelatihan->$fileField) {
                Storage::delete(  $pelatihan->$fileField);
            }
        }

        $pelatihan->delete();

        return redirect('/sekolah-keasramaan/akademik/pelatihan')->with('success', 'Data berhasil dihapus');
    }
}
