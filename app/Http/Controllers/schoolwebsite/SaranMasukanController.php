<?php

namespace App\Http\Controllers\schoolwebsite;

use App\Http\Controllers\Controller;
use App\Http\Requests\schoolwebsite\SaranMasukanRequest;
use App\Models\schoolwebsite\SaranMasukan;
use Illuminate\Http\Request;

class SaranMasukanController extends Controller
{
    public function create()
    {
        return view('schoolwebsite.saranmasukan.create', compact('SaranMasukan.create'));
    }
    public function store(Request $request)
{
    // Validasi secara manual jika belum menggunakan Form Request
    $validatedData = $request->validate([
        'nama' => 'required|string|max:255',
        'status' => 'required|string',
        'email' => 'required|email',
        'pesan' => 'required|string',
    ]);

    // Simpan data
    $saranMasukan = SaranMasukan::create($validatedData);

    // Mengembalikan respons JSON dengan pesan sukses
    return response()->json([
        'success' => true,
        'message' => 'Berhasil disimpan',
        'data' => $saranMasukan
    ], 201);
}


}
