<?php

namespace App\Http\Controllers\penilaian;
use Illuminate\Http\Request;
use App\Models\penilaian\rpts;
use Barryvdh\DomPDF\Facade\Pdf;
use App\Http\Controllers\Controller;
use App\Http\Requests\penilaian\RptsRequest;

class RptsController extends Controller
{
    public function index(Request $request)
    {
        // Ambil nilai filter dari request
        $filterKelas = $request->input('kelas');
        $filterNama = $request->input('nama');

        // Query untuk rapor dengan filter kelas dan nama jika ada
        $query = rpts::query();

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
        return view('penilaian.rapor.pts.create');
    }

    public function store(RptsRequest $request)
    {
        rpts::create($request->validated());
        return redirect("/penilaian/rpts")->with("success", "Berhasil disimpan");
    }

    public function edit($id)
    {
        $rpts = rpts::find($id);
        return view('penilaian.rapor.pts.edit', compact('rpts'));
    }

    public function update(RptsRequest $request, $id)
    {
        rpts::find($id)->update($request->validated());
        return redirect("/penilaian/rpts")->with("success", "Berhasil diperbaharui");
    }

    public function destroy($id)
    {
        rpts::findOrFail($id)->delete();
        return redirect("/penilaian/rpts")->with("success", "Berhasil dihapus");
    }

    public function pdf($id)
    {
        $rpts = rpts::findOrFail($id);
        $pdf = Pdf::loadView('penilaian.rapor.pts.merdeka', compact('rpts'));
        return $pdf->stream('rpts.pdf');
    }
}
