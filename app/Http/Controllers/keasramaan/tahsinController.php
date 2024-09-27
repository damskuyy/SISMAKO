<?php

namespace App\Http\Controllers\keasramaan;

use Illuminate\Http\Request;
use App\Models\database\Siswa;
use App\Models\keasramaan\tahsin;
use App\Http\Controllers\Controller;
use App\Http\Requests\keasramaan\TahsinRequest;

class tahsinController extends Controller
{
    public function index(Request $request)
    {
        // Ambil tanggal dan nama dari input
        $startDate = $request->input('start_date');
        $endDate = $request->input('end_date');
        $searchName = $request->input('search_name');

        // Mulai dengan query dasar
        $tahsin = tahsin::with(['siswa:id,nama,nisn']);

        // Tambahkan filter tanggal jika ada input
        if ($startDate) {
            $tahsin->where('tanggal', '>=', $startDate);
        }
        if ($endDate) {
            $tahsin->where('tanggal', '<=', $endDate);
        }

        // Tambahkan filter nama jika ada input
        if ($searchName) {
            $tahsin->whereHas('siswa', function ($query) use ($searchName) {
                $query->where('nama', 'like', '%' . $searchName . '%');
            });
        }

        // Paginate hasil
        $tahsin = $tahsin->paginate(10);

        return view('keasramaan.quran.tahsin.tahsin', compact('tahsin'));
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
        return view('keasramaan.quran.tahsin.create', compact('angkatan', 'names'));
    }

    public function store(TahsinRequest $request)
    {
        $validatedData = $request->validated();

        tahsin::create($validatedData);

        return redirect("/sekolah-keasramaan/al-quran/tahsin")->with("success", "Berhasil disimpan");
    }

    public function edit($id)
    {
        $tahsin = tahsin::find($id);
        return view('keasramaan.quran.tahsin.edit', compact('tahsin'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'tanggal' => 'required',
            'surat' => 'required',
            'ayat' => 'required',
            'predikat' => 'required',
            'pengajar' => 'required',
        ], [
            'tanggal.required' => 'Tanggal harus diisi',
            'surat.required' => 'Surat tahfidz harus diisi',
            'ayat.required' => 'Ayat tahfidz harus diisi',
            'predikat.required' => 'Predikat tahfidz harus diisi',
            'pengajar.required' => 'Pengajar harus diisi',
        ]);

        tahsin::find($id)->update([
            'tanggal' => $request->tanggal,
            'surat' => $request->surat,
            'ayat' => $request->ayat,
            'predikat' => $request->predikat,
            'pengajar' => $request->pengajar,
        ]);

        return redirect("/sekolah-keasramaan/al-quran/tahsin")->with("success", "Berhasil diPerbaharui");
    }

    public function destroy($id)
    {
        $tahsin = tahsin::findOrFail($id);
        $tahsin->delete();
        return redirect('/sekolah-keasramaan/al-quran/tahsin')->with('success', 'Data berhasil dihapus');
    }

}
