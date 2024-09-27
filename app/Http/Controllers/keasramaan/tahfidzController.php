<?php

namespace App\Http\Controllers\keasramaan;

use Illuminate\Http\Request;
use App\Models\database\Siswa;
use App\Models\keasramaan\tahfidz;
use App\Http\Controllers\Controller;
use App\Http\Requests\keasramaan\TahfidzRequest;

class tahfidzController extends Controller
{
    public function index(Request $request)
    {
        // Ambil tanggal dan nama dari input
        $startDate = $request->input('start_date');
        $endDate = $request->input('end_date');
        $searchName = $request->input('search_name');

        // Mulai dengan query dasar
        $tahfidz = tahfidz::with(['siswa:id,nama,nisn']);

        // Tambahkan filter tanggal jika ada input
        if ($startDate) {
            $tahfidz->where('tanggal', '>=', $startDate);
        }
        if ($endDate) {
            $tahfidz->where('tanggal', '<=', $endDate);
        }

        // Tambahkan filter nama jika ada input
        if ($searchName) {
            $tahfidz->whereHas('siswa', function ($query) use ($searchName) {
                $query->where('nama', 'like', '%' . $searchName . '%');
            });
        }

        // Paginate hasil
        $tahfidz = $tahfidz->paginate(10);

        return view('keasramaan.quran.tahfidz.tahfidz', compact('tahfidz'));
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
        return view('keasramaan.quran.tahfidz.create', compact('angkatan', 'names'));
    }

    public function store(TahfidzRequest $request)
    {
        $validatedData = $request->validated();

        tahfidz::create($validatedData);

        return redirect("/sekolah-keasramaan/al-quran/tahfidz")->with("success", "Berhasil disimpan");
    }

    public function edit($id)
    {
        $tahfidz = tahfidz::find($id);
        return view('keasramaan.quran.tahfidz.edit', compact('tahfidz'));
    }

    public function update(Request $request, $id)
    {
        $validatedData = $request->validate([
            'tanggal' => 'required',
            'surat' => 'required',
            'ayat' => 'required',
            'predikat' => 'required',
            'pengajar' => 'required',
        ], [
            'tanggal.required' => 'Tahun ajaran harus diisi',
            'surat.required' => 'Surat harus diisi',
            'ayat.required' => 'Ayat harus diisi',
            'predikat.required' => 'Predikat harus diisi',
            'pengajar.required' => 'Pengajar harus diisi',
        ]);

        tahfidz::find($id)->update($validatedData);

        return redirect("/sekolah-keasramaan/al-quran/tahfidz")->with("success", "Berhasil diPerbaharui");
    }

    public function destroy($id)
    {
        $tahfidz = tahfidz::findOrFail($id);
        $tahfidz->delete();
        return redirect('/sekolah-keasramaan/al-quran/tahfidz')->with('success', 'Data berhasil dihapus');
    }
}
