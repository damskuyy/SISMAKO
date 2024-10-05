<?php

namespace App\Http\Controllers\keasramaan;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\View;
use App\Http\Requests\keasramaan\KunjunganRequest;
use App\Models\keasramaan\Kunjungan as KeasramaanKunjungan;

class KunjunganController extends Controller
{
    //
    public function editIndustriDinas($id)
    {
        $kunjungan = KeasramaanKunjungan::find($id);
        return view('keasramaan.kunjungan.ortu.IndustriDinas', compact('kunjungan', 'id'));
    }

    public function editOrtuTamuAlumni($id)
    {
        $kunjungan = KeasramaanKunjungan::find($id);
        return view('keasramaan.kunjungan.ortu.edit', compact('kunjungan', 'id'));
    }

    public function store(KunjunganRequest $request, $status_kunjungan)
    {
        // Memvalidasi request
        // dd($request->all());
        $request->validated();

        // Menggunakan array_merge dengan request->all() yang benar
        KeasramaanKunjungan::create(array_merge($request->all(), [
            'status_kunjungan' => $status_kunjungan,
        ]));

        // Redirect setelah data berhasil ditambahkan
        return redirect('/sekolah-keasramaan/kunjungan')->with('success', 'Data berhasil ditambahkan!');
    }


    public function update(KunjunganRequest $request, $id)
    {
        $data = KeasramaanKunjungan::findOrFail($id);
        $data->update($request->all());
        return redirect('/sekolah-keasramaan/kunjungan')->with('success', 'Data berhasil diupdate!');
    }

    public function destroy($id)
    {
        $data = KeasramaanKunjungan::findOrFail($id);
        $data->delete();
        return redirect('/sekolah-keasramaan/kunjungan')->with('success', 'Data berhasil dihapus!');
    }

    public function exportPdf()
    {
        // Mengambil data berdasarkan status_kunjungan
        $dataKunjungan = KeasramaanKunjungan::get();

        // Pastikan statusFilter juga didefinisikan, jika perlu

        // Memuat view dengan data yang sudah difilter
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
