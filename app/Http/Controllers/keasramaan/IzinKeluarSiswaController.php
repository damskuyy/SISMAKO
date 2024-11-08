<?php

namespace App\Http\Controllers\keasramaan;

use App\Http\Controllers\Controller;
use App\Models\database\Guru;
use App\Models\keasramaan\IzinKeluarSiswa;
use Illuminate\Http\Request;
use App\Http\Requests\keasramaan\IzinSiswaRequest;
use Illuminate\Support\Facades\View;

class IzinKeluarSiswaController extends Controller
{
    public function index()
    {
        $izinKeluarSiswa = IzinKeluarSiswa::with([
            'siswa:id,nama',
            'siswa.dataKelas:id,id_siswa,kelas',
            'guru:id,nama'
        ])->paginate(10);
        return view('keasramaan.izin-keluar.index', compact(var_name: 'izinKeluarSiswa'));
    }

    public function create()
    {
        $guru = Guru::select('nama', 'id')->get();
        return view('keasramaan.izin-keluar.create', compact('guru'));
    }

    public function store(IzinSiswaRequest $request)
    {
        // dd($request->all());
        $request->validated();

        IzinKeluarSiswa::create($request->all());

        return redirect()->route('izin.keluar.index')->with('success', 'Izin keluar siswa berhasil dibuat.');
    }



    public function edit($id)
    {
        $izinKeluar = IzinKeluarSiswa::with([
            'siswa:id,nama',
            'siswa.dataKelas:id,id_siswa,kelas',
            'guru:id,nama'
        ])->findOrFail($id);

        $guru = Guru::all();

        return view('keasramaan.izin-keluar.edit', compact('izinKeluar', 'guru'));
    }

    // Memperbarui izin keluar siswa
    public function update(IzinSiswaRequest $request, $id)
    {
        $request->validated();

        $izinKeluar = IzinKeluarSiswa::findOrFail($id);
        $izinKeluar->update($request->all());

        return redirect()->route('izin.keluar.index')->with('success', 'Izin keluar siswa berhasil diupdate.');
    }

    // Menghapus izin keluar siswa
    public function destroy($id)
    {
        $data = IzinKeluarSiswa::findOrFail($id);
        $data->delete();

        return redirect()->route('izin.keluar.index')->with('success', 'Izin keluar siswa berhasil dihapus.');
    }

    public function exportPdf()
    {
        $dataCatatanGrooming = IzinKeluarSiswa::with([
            'siswa:id,nama',
            'siswa.dataKelas:id,id_siswa,kelas',
            'guru:id,nama'
        ])->get();

        $html = View::make('keasramaan.izin-keluar.export', compact(var_name: 'dataCatatanGrooming'))->render();

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
