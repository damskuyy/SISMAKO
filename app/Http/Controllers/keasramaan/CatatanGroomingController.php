<?php

namespace App\Http\Controllers\keasramaan;

use App\Http\Controllers\Controller;
use App\Models\keasramaan\CatatanGrooming;
use App\Models\database\Guru;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\View;

class CatatanGroomingController extends Controller
{
    public function index()
    {
        $catatanGrooming = CatatanGrooming::select('id', 'tanggal', 'catatan', 'guru_piket_id', 'siswa_id')
            ->with([
                'guruPiket:id,nama',
                'siswa:id,nama',
                'siswa.dataKelas'
            ])
            ->paginate(10);

        return view('keasramaan.catatan-grooming.index', compact(var_name: 'catatanGrooming'));
    }

    public function create()
    {
        $guru = Guru::select('nama', 'id')->get();
        return view('keasramaan.catatan-grooming.create', compact('guru'));
    }
    public function store(Request $request)
    {
        // dd($request->all());
        $validatedData = $request->validate([
            'tanggal' => 'required|date',
            'guru_piket_id' => 'required|exists:guru,id',
            'siswa_id' => 'required|exists:siswa,id',
            'catatan' => 'required|string',
        ]);

        CatatanGrooming::create($validatedData);
        return redirect()->route('catatan.grooming.index')->with('success', 'Data berhasil di tambahkan.');
    }

    public function edit($id)
    {
        $data = CatatanGrooming::with([
            'siswa:id,nama',
            'siswa.dataKelas:id,id_siswa,kelas',
        ])->findOrFail($id);

        $guru = Guru::all();

        return view('keasramaan.catatan-grooming.edit', compact('data', 'guru'));
    }


    public function update(Request $request, $id)
    {
        $validatedData = $request->validate([
            'guru_piket_id' => 'sometimes|exists:guru,id',
            'siswa_id' => 'sometimes|exists:siswa,id',
            'catatan' => 'sometimes|string',
        ]);

        $catatan = CatatanGrooming::findOrFail($id);
        $catatan->update($validatedData);
        return redirect()->route('catatan.grooming.index')->with('success', 'Catatan Grooming siswa berhasil diperbarui.');
    }

    /**
     * Menghapus catatan grooming berdasarkan ID.
     */
    public function destroy($id)
    {
        $catatan = CatatanGrooming::findOrFail($id);
        $catatan->delete();
        return redirect()->route('catatan.grooming.index')->with('success', 'Catatan Grooming siswa berhasil dihapus.');
    }

    public function exportPdf()
    {
        $dataCatatanGrooming = CatatanGrooming::with([
            'siswa:id,nama',
            'siswa.dataKelas:id,id_siswa,kelas',
            'guruPiket:id,nama'
        ])->get();

        $html = View::make('keasramaan.catatan-grooming.export', compact(var_name: 'dataCatatanGrooming'))->render();

        // Mengatur opsi DomPDF
        $options = new \Dompdf\Options();
        $options->set('isRemoteEnabled', true);
        $options->set('isHtml5ParserEnabled', true);

        // Membuat instance DomPDF
        $dompdf = new \Dompdf\Dompdf($options);

        // Memuat HTML ke DomPDF
        $dompdf->loadHtml($html);
        $dompdf->setPaper('A4', 'landscape');
        $dompdf->render();

        // Mengembalikan stream PDF
        return $dompdf->stream(filename: 'dataCatatanGrooming.pdf');
    }
}
