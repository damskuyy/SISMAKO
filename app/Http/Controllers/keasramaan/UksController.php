<?php

namespace App\Http\Controllers\keasramaan;

use App\Http\Controllers\Controller;
use App\Models\database\Guru;
use App\Models\Uks;
use Illuminate\Http\Request;

class UksController extends Controller
{
    public function index()
    {
        $Uks = Uks::with('guru')->get();
        return response()->json($Uks);
    }

    /**
     * Menyimpan data baru ke dalam tabel UK.
     */

     public function create()
     {
        $guru = Guru::select('nama', 'id')->get();
        return view('keasramaan.uks.create', compact('guru'));
     }
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'tanggal' => 'required|date',
            'nama' => 'required|string|max:255',
            'status' => 'required|string|max:25',
            'keluhan' => 'required|string',
            'penanganan' => 'required|string',
            'guru_id' => 'required|exists:guru,id',
        ]);

        $Uks = Uks::create($validatedData);
        return response()->json($Uks, 201);
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
        return response()->json($Uks);
    }

    /**
     * Menghapus data Uks berdasarkan ID.
     */
    public function destroy($id)
    {
        $Uks = Uks::findOrFail($id);
        $Uks->delete();
        return response()->json(['message' => 'Data berhasil dihapus']);
    }
}
