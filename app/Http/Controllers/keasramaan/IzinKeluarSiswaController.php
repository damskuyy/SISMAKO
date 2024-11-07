<?php

namespace App\Http\Controllers\keasramaan;

use App\Http\Controllers\Controller;
use App\Models\database\Guru;
use App\Models\keasramaan\IzinKeluarSiswa;
use Illuminate\Http\Request;
use App\Http\Requests\keasramaan\IzinSiswaRequest;
use App\Models\database\Siswa;

class IzinKeluarSiswaController extends Controller
{
    // with([
    //     'siswa:id,nama',
    //     'guru:id,nama'
    // ])->
    public function index()
    {
        $izinKeluarSiswa = IzinKeluarSiswa::with([
            'siswa:id,nama',
            'siswa.dataKelas:id,id_siswa,kelas',
            'guru:id,nama'
        ])->paginate(10);
        return view('keasramaan.izin-keluar.index', compact(var_name: 'izinKeluarSiswa'));
    }

    // Menampilkan form untuk membuat izin keluar siswa
    public function create()
    {
        $guru = Guru::select('nama', 'id')->get();
        return view('keasramaan.izin-keluar.create', compact('guru'));
    }

    // Menyimpan izin keluar siswa yang baru
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

        $guru = Guru::all(); // ambil data guru untuk opsi select
        // $siswa = Siswa::all(); // ambil data siswa untuk opsi select

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
}
