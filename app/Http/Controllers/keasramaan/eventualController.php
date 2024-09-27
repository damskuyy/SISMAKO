<?php

namespace App\Http\Controllers\keasramaan;

use Illuminate\Http\Request;
use App\Models\database\Siswa;
use App\Http\Controllers\Controller;
use App\Models\keasramaan\pelatihan;
use Illuminate\Support\Facades\Storage;
use App\Http\Requests\keasramaan\PelatihanRequest;

class eventualController extends Controller
{
    public function index(Request $request)
    {
        // Ambil tanggal dan nama dari input
        $startDate = $request->input('start_date');
        $endDate = $request->input('end_date');
        $searchName = $request->input('search_name');

        // Mulai dengan query dasar
        $eventual = Pelatihan::where('type', 'eventual')
            ->with(['siswa:id,nama,nisn']);

        // Tambahkan filter tanggal jika ada input
        if ($startDate) {
            $eventual->where('tanggal', '>=', $startDate);
        }
        if ($endDate) {
            $eventual->where('tanggal', '<=', $endDate);
        }

        // Tambahkan filter nama jika ada input
        if ($searchName) {
            $eventual->whereHas('siswa', function ($query) use ($searchName) {
                $query->where('nama', 'like', '%' . $searchName . '%');
            });
        }

        // Paginate hasil
        $eventual = $eventual->paginate(10);

        return view('keasramaan.akademik.volentir.volentir', compact('eventual'));
    }

    public function create(Request $request)
    {
        $mutasiFilter = $request->query('angkatan', ''); // Default empty filter

        // Fetch distinct angkatan values from Siswa model
        $angkatan = Siswa::distinct()->pluck('angkatan');

        // Get the selected angkatan from the request or default to an empty string
        $defaultAngkatan = $request->angkatan;

        // Fetch names for the selected angkatan if available
        $names = $defaultAngkatan ? Siswa::where('angkatan', $defaultAngkatan)->get(['id', 'nama', 'angkatan']) : collect();
        return view('keasramaan.akademik.volentir.create', compact('angkatan', 'names'));
    }

    public function store(PelatihanRequest $request)
    {
        $validateData = $request->validated();

        $fileFields = ['dokumentasi', 'undangan'];

        foreach ($fileFields as $fileField) {
            if ($request->hasFile($fileField)) {
                $files = $request->file($fileField);
                $storedFiles = [];

                foreach ($files as $index => $file) {
                    if ($index < 3) { // Batas maksimal 3 file
                        $originalName = $file->getClientOriginalName();
                        $storedFiles[] = $file->storeAs($fileField, $originalName, 'public');
                    }
                }
                $validateData[$fileField] = json_encode($storedFiles);
            }
        }

        pelatihan::create(array_merge($validateData, ['type' => 'eventual', 'siswa_id' => $request->siswa_id]));
        return redirect('/sekolah-keasramaan/akademik/eventual')->with('success', 'Data berhasil ditambahkan');
    }


    public function edit($id)
    {
        $eventual = pelatihan::findOrFail($id);
        return view('keasramaan.akademik.volentir.edit', compact('eventual'));
    }

    public function update(PelatihanRequest $request, $id)
    {
        $validateData = $request->validated();

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
