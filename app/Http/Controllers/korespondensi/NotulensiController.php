<?php

namespace App\Http\Controllers\korespondensi;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\korespondensi\Notulensi;
use Illuminate\Support\Facades\Storage;
use App\Http\Requests\korespondensi\NotulensiRequest;

class NotulensiController extends Controller
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
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(NotulensiRequest $request)
    {
        // dd($request->all());
        $validated = $request->validated();
        $file = $request->file('file_surat');
        $fileName = $file->getClientOriginalName();
        $validated['file_surat'] = $file->storeAs('notulensi', $fileName, 'public');
        if ($request->hasFile('file_dokumentasi')) {
            $file = $request->file('file_dokumentasi');
            $fileNameDoksli = $file->getClientOriginalName();
            $validated['file_dokumentasi'] = $file->storeAs('notulensi', $fileNameDoksli, 'public');
        }

        Notulensi::create($validated);
        return redirect()->route('inbox.index')->with('success', 'Data notulensi berhasil ditambahkan');
    }

    //

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

    public function downloadSurat($id)
    {

        $notulensi = Notulensi::findOrFail($id);


        $filePath = public_path('storage/' . $notulensi->file_surat);


        if (file_exists($filePath)) {

            return response()->download($filePath);
        }


        return redirect()->route('inbox.index')->with('error', 'File surat tidak ditemukan');
    }


    /**
     * Download the specified file dokumentasi.
     */
    public function downloadDokumentasi($id)
    {
        $notulensi = Notulensi::findOrFail($id);

        $filePath = public_path('storage/' . $notulensi->file_dokumentasi);

        if (file_exists($filePath)) {

            return response()->download($filePath);
        }

        return redirect()->route('inbox.index')->with('error', 'File dokumentasi tidak ditemukan');
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(NotulensiRequest $request, $id)
{
    $validated = $request->validated();

    // Temukan notulensi berdasarkan ID
    $notulensi = Notulensi::findOrFail($id);

    // Mengelola file_surat jika ada di request
    if ($request->hasFile('file_surat')) {
        // Jika ada file yang sudah ada, hapus file tersebut
        if ($notulensi->file_surat) {
            Storage::disk('public')->delete($notulensi->file_surat);
        }

        // Simpan file baru dan update data yang sudah tervalidasi
        $file = $request->file('file_surat');
        $fileName = $file->getClientOriginalName();
        $validated['file_surat'] = $file->storeAs('notulensi', $fileName, 'public');
    } else {
        // Jika tidak ada file baru, pertahankan file_surat yang lama
        $validated['file_surat'] = $notulensi->file_surat;
    }

    // Mengelola file_dokumentasi jika ada di request
    if ($request->hasFile('file_dokumentasi')) {
        // Jika ada file yang sudah ada, hapus file tersebut
        if ($notulensi->file_dokumentasi) {
            Storage::disk('public')->delete($notulensi->file_dokumentasi);
        }

        // Simpan file baru dan update data yang sudah tervalidasi
        $fileDokumentasi = $request->file('file_dokumentasi');
        $fileNameDoksli = $fileDokumentasi->getClientOriginalName();
        $validated['file_dokumentasi'] = $fileDokumentasi->storeAs('notulensi', $fileNameDoksli, 'public');
    } else {
        // Jika tidak ada file baru, pertahankan file_dokumentasi yang lama
        $validated['file_dokumentasi'] = $notulensi->file_dokumentasi;
    }

    // Update notulensi dengan data yang sudah tervalidasi
    $notulensi->update($validated);

    return redirect()->route('inbox.index')->with('success', 'Data notulensi berhasil diperbarui');
}




    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        Notulensi::findOrFail($id)->delete();
        return redirect()->route('inbox.index')->with('success', 'Data notulensi berhasil dihapus');
    }
}
