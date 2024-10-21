<?php

namespace App\Http\Controllers\keasramaan;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\View;
use App\Http\Requests\keasramaan\KunjunganRequest;
use App\Models\keasramaan\Kunjungan;

class KunjunganController extends Controller
{
    //
    public function editIndustriDinas($id)
    {
        $kunjungan = Kunjungan::find($id);
        return view('keasramaan.kunjungan.ortu.IndustriDinas', compact('kunjungan', 'id'));
    }

    public function editOrtuTamuAlumni($id)
    {
        $kunjungan = Kunjungan::find($id);
        return view('keasramaan.kunjungan.ortu.edit', compact('kunjungan', 'id'));
    }

    public function store(KunjunganRequest $request, $status_kunjungan)
    {
        $request->validated();

        // Menggunakan array_merge dengan request->all() yang benar
        Kunjungan::create(array_merge($request->all(), [
            'status_kunjungan' => $status_kunjungan,
        ]));

        return redirect(to: '/sekolah-keasramaan/kunjungan')->with('success', 'Data berhasil ditambahkan!');
    }


    public function update(KunjunganRequest $request, $id)
    {
        $data = Kunjungan::findOrFail($id);
        $data->update($request->all());
        return redirect('/sekolah-keasramaan/kunjungan')->with('success', 'Data berhasil diupdate!');
    }

    public function destroy($id)
    {
        $data = Kunjungan::findOrFail($id);
        $data->delete();
        return redirect('/sekolah-keasramaan/kunjungan')->with('success', 'Data berhasil dihapus!');
    }

    public function exportPdf()
    {
        $dataKunjungan = Kunjungan::get();

        $html = View::make('keasramaan.kunjungan.export', compact(var_name: 'dataKunjungan'))->render();

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
        return $dompdf->stream(filename: 'dataKunjungan.pdf');
    }

}
