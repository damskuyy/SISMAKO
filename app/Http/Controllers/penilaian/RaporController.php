<?php

namespace App\Http\Controllers\penilaian;

use Illuminate\Http\Request;
use App\Models\penilaian\rapor;
use Barryvdh\DomPDF\Facade\Pdf;
use App\Http\Controllers\Controller;
use App\Http\Requests\penilaian\RaporRequest;

class RaporController extends Controller
{
    public function index(Request $request)
    {
        // Ambil nilai filter dari request
        $filterKelas = $request->input('kelas');
        $filterNama = $request->input('nama');

        // Query untuk rapor dengan filter kelas dan nama jika ada
        $query = rapor::query();

        if ($filterKelas) {
            // Menggunakan pencocokan yang tepat (exact match) alih-alih LIKE
            $query->where('kelas', '=', $filterKelas);
        }

        if ($filterNama) {
            // Nama tetap menggunakan LIKE karena mungkin ingin pencarian sebagian
            $query->where('nama', 'like', '%' . $filterNama . '%');
        }

        // Lakukan pagination dan ambil hasilnya
        $rapor = $query->paginate(10);

        // Mengembalikan view dengan data rapor dan filter yang diterapkan
        return view('penilaian.rapor.rapor', compact('rapor', 'filterKelas', 'filterNama'));
    }

    public function create()
    {
        return view('penilaian.rapor.create');
    }

    public function store(RaporRequest $request)
    {
        $data = $request->validated();

        rapor::create($data);

        return redirect("/penilaian/rapor")->with("success", "Berhasil disimpan");
    }

    public function edit($id)
    {
        $rapor = rapor::findOrFail($id);
        return view('penilaian.rapor.edit', compact('rapor'));
    }

    public function update(RaporRequest $request, $id)
    {
        $rapor = Rapor::findOrFail($id);
        $data = $request->validated();

        // Save the updated rapor
        $rapor->update($data);

        return redirect("/penilaian/rapor")->with("success", "Berhasil diperbarui");
    }


    public function destroy($id)
    {
        rapor::findOrFail($id)->delete();
        return redirect("/penilaian/rapor")->with("success", "Berhasil dihapus");
    }

    public function pdf($id)
    {
        $rapor = rapor::findOrFail($id);
        $pdf = Pdf::loadView('penilaian.rapor.merdeka', compact('rapor'));
        return $pdf->stream('rapor.pdf');
    }
}
