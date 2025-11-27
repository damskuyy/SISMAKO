<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Pkg;
use App\Models\database\Guru;
use App\Models\database\Tendik;
use App\Http\Requests\PkgRequest;
use Barryvdh\DomPDF\Facade\Pdf;

class PkgController extends Controller
{
    public function index(Request $request)
    {
        $query = Pkg::query();
        if ($request->filled('q')) {
            $query->where('nama','like','%'.$request->q.'%');
        }
        $pkgs = $query->orderBy('created_at','desc')->paginate(10);
        return view('pkg.index', compact('pkgs'));
    }

    public function create()
    {
        $gurus = Guru::select('id','nama','no_nik')->orderBy('nama')->get();
        $tendiks = Tendik::select('id','nama','no_nik')->orderBy('nama')->get();
        return view('pkg.create', compact('gurus','tendiks'));
    }

    public function store(PkgRequest $request)
    {
        $data = $request->validated();
        // include id_guru/id_tendik and penilai ids from form (they are submitted as hidden inputs)
        $data['id_guru'] = $request->input('id_guru') ?: null;
        $data['id_tendik'] = $request->input('id_tendik') ?: null;
        $data['penilai_id_guru'] = $request->input('penilai_id_guru') ?: null;
        $data['penilai_id_tendik'] = $request->input('penilai_id_tendik') ?: null;
        if ($request->hasFile('foto_dokumentasi_kegiatan')) {
            $f = $request->file('foto_dokumentasi_kegiatan');
            $name = time().'_'.preg_replace('/[^a-z0-9\._-]/i','_', $f->getClientOriginalName());
            $f->move(public_path('files/pkg'), $name);
            $data['foto_dokumentasi_kegiatan'] = '/files/pkg/'.$name;
        }
        Pkg::create($data);
        return redirect()->route('pkg.index')->with('success','PKG created successfully.');
    }

    public function edit($id)
    {
        $pkg = Pkg::findOrFail($id);
        $gurus = Guru::select('id','nama','no_nik')->orderBy('nama')->get();
        $tendiks = Tendik::select('id','nama','no_nik')->orderBy('nama')->get();
        return view('pkg.edit', compact('pkg','gurus','tendiks'));
    }

    public function update(PkgRequest $request, $id)
    {
        $pkg = Pkg::findOrFail($id);
        $data = $request->validated();
        $data['id_guru'] = $request->input('id_guru') ?: null;
        $data['id_tendik'] = $request->input('id_tendik') ?: null;
        $data['penilai_id_guru'] = $request->input('penilai_id_guru') ?: null;
        $data['penilai_id_tendik'] = $request->input('penilai_id_tendik') ?: null;
        if ($request->hasFile('foto_dokumentasi_kegiatan')) {
            $f = $request->file('foto_dokumentasi_kegiatan');
            $name = time().'_'.preg_replace('/[^a-z0-9\._-]/i','_', $f->getClientOriginalName());
            $f->move(public_path('files/pkg'), $name);
            $data['foto_dokumentasi_kegiatan'] = '/files/pkg/'.$name;
        }
        $pkg->update($data);
        return redirect()->route('pkg.index')->with('success','PKG updated successfully.');
    }

    public function destroy($id)
    {
        $pkg = Pkg::findOrFail($id);
        $pkg->delete();
        return redirect()->route('pkg.index')->with('success','PKG deleted successfully.');
    }

    public function exportPdf()
    {
        $pkgs = Pkg::orderBy('created_at','desc')->get();
        $pdf = Pdf::loadView('pkg.pdf', compact('pkgs'));
        return $pdf->download('pkg-'.now()->format('Ymd_His').'.pdf');
    }

    // export single PKG as PDF
    public function exportSinglePdf($id)
    {
        $pkg = Pkg::findOrFail($id);
            $pdf = Pdf::loadView('pkg.pdf', compact('pkg'));
            $nama = preg_replace('/[^a-zA-Z0-9_\- ]/', '', $pkg->nama ?? 'Guru');
            $tanggal = date('Ymd', strtotime($pkg->created_at ?? now()));
            $filename = 'PKG-' . $nama . '-' . $tanggal . '.pdf';
            return $pdf->download($filename);
    }
}
