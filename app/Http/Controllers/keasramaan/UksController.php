<?php

namespace App\Http\Controllers\keasramaan;

use App\Http\Controllers\Controller;
use App\Http\Requests\keasramaan\UksRequest;
use App\Models\database\Guru;
use App\Models\keasramaan\Uks;
use Illuminate\Http\Request;

class UksController extends Controller
{
    public function index()
    {

        $uks = Uks::with([
            'siswa:id,nama',
            'siswa.dataKelas:id,id_siswa,kelas',
            'guru:id,nama'
        ])->paginate(10);
        return view('keasramaan.uks.index', compact(var_name: 'uks'));
    }


     public function create()
     {
        $guru = Guru::select('nama', 'id')->get();
        return view('keasramaan.uks.create', compact('guru'));
     }
    public function store(UksRequest $request)
    {
        // dd($request->all());
        $request->validated();
        $Uks = Uks::create(attributes: $request->all());
        return redirect()->route('uks.index')->with('success', 'Data Uks berhasil dibuat.');
    }

    /**
     * Menampilkan detail dari satu data Uks berdasarkan ID.
     */
    public function show($id)
    {
        $Uks = Uks::with('guru')->findOrFail($id);
        return response()->json($Uks);
    }

    /**
     * Mengupdate data Uks berdasarkan ID.
     */
    public function update(Request $request, $id)
    {
        $validatedData = $request->validate([
            'tanggal' => 'sometimes|date',
            'nama' => 'sometimes|string|max:255',
            'status' => 'sometimes|string|max:25',
            'keluhan' => 'sometimes|string',
            'penanganan' => 'sometimes|string',
            'guru_id' => 'sometimes|exists:guru,id',
        ]);

        $Uks = Uks::findOrFail($id);
        $Uks->update($validatedData);
        return redirect()->route('uks.index')->with('success', 'Data Uks berhasil di update.');
    }

    /**
     * Menghapus data Uks berdasarkan ID.
     */
    public function destroy($id)
    {
        $Uks = Uks::findOrFail($id);
        $Uks->delete();
        return redirect()->route('uks.index')->with('success', 'Data Uks berhasil dihapus.');
    }
}
