<?php

namespace App\Http\Controllers\korespondensi;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Storage;
use App\Models\korespondensi\SuratPengajuan;
use App\Http\Requests\korespondensi\SuratPengajuanRequest;

class SuratPengajuanController extends Controller
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
    public function store(SuratPengajuanRequest $request)
    {
        // dd($request->all());
        $validated = $request->validated();
        $file = $request->file('file_surat');
        $fileName = $file->getClientOriginalName();
        $validated['file_surat'] = $file->storeAs('surat-pengajuan', $fileName,'public');

        SuratPengajuan::create($validated);
        return redirect()->route('inbox.index')->with('success', 'Data surat pengajuan berhasil ditambahkan');
    }

    public function download($id)
    {
        $import = SuratPengajuan::findOrFail($id);

        $filePath = public_path('storage/' . $import->file_surat);

        return response()->download($filePath);
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
    public function update(SuratPengajuanRequest $request, $id)
    {
        $validated = $request->validated();

        $suratPengajuan = SuratPengajuan::findOrFail($id);

        if ($request->hasFile('file_surat')) {
            if($suratPengajuan->file_surat){
                Storage::disk('public')->delete($suratPengajuan->file_surat);
            }
            $file = $request->file('file_surat');
        $fileName = $file->getClientOriginalName();
        $validated['file_surat'] = $file->storeAs('surat-pengajuan', $fileName,'public');
        }

        $suratPengajuan->update($validated);
        return redirect()->route('inbox.index')->with('success', 'Data surat pengajuan berhasil diubah');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        SuratPengajuan::findOrFail($id)->delete();
        return redirect()->route('inbox.index')->with('success', 'Data surat pengajuan berhasil dihapus');
    }
}
