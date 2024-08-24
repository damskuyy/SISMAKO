<?php

namespace App\Http\Controllers\korespondensi;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Storage;
use App\Models\korespondensi\NomorSurat;
use App\Http\Requests\korespondensi\NomorSuratRequest;

class NomorSuratController extends Controller
{
        /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {

    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(NomorSuratRequest $request)
    {
        // dd($request->all());
        $validated = $request->validated();

        $validated['file_surat'] = $request->file('file_surat')->store('nomor-surat');

        NomorSurat::create($validated);
        return redirect()->route('inbox.index')->with('success', 'Data nomor surat berhasil ditambahkan');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(NomorSuratRequest $request, $id)
{
    // Validasi input
    $validated = $request->validated();

    // Cari nomor surat berdasarkan ID
    $nomorSurat = NomorSurat::findOrFail($id);

    // Update file jika diupload
    if ($request->hasFile('file_surat')) {
        // Hapus file lama jika ada
        if ($nomorSurat->file_surat) {
            Storage::delete($nomorSurat->file_surat);
        }
        // Simpan file baru
        $validated['file_surat'] = $request->file('file_surat')->store('nomor-surat');
    }

    // Update data
    $nomorSurat->update($validated);

    // Redirect dengan pesan sukses
    return redirect()->route('inbox.index')->with('success', 'Data nomor surat berhasil diupdate');
}


    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        NomorSurat::findOrFail($id)->delete();
        return redirect()->route('inbox.edit')->with('success', 'Data nomor surat berhasil dihapus');
    }
}
