<?php

namespace App\Http\Controllers\Finance;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Finance\Pengajuan;
use App\Models\database\Guru;
use App\Http\Requests\Finance\PengajuanRequest;
use Barryvdh\DomPDF\Facade\Pdf;

class PengajuanController extends Controller
{
    public function index(Request $request)
    {
        $query = Pengajuan::query();
        if ($request->filled('tanggal')) {
            $query->whereDate('tanggal_pengajuan', $request->tanggal);
        }
        $pengajuans = $query->orderBy('tanggal_pengajuan','desc')->paginate(10);
        $gurus = Guru::select('id','nama')->get();
        return view('finance.pengajuan.index', compact('pengajuans','gurus'));
    }

    public function create()
    {
        $gurus = Guru::select('id','nama')->get();
        return view('finance.pengajuan.create', compact('gurus'));
    }

    public function store(PengajuanRequest $request)
    {
        $data = $request->validated();

        if ($request->hasFile('foto_lpj')) {
            $file = $request->file('foto_lpj');
            $name = time().'_'.preg_replace('/[^a-z0-9\._-]/i','_', $file->getClientOriginalName());
            $file->move(public_path('files/finance/pengajuan'), $name);
            $data['foto_lpj'] = '/files/finance/pengajuan/'.$name;
        }

        Pengajuan::create($data);
        return redirect()->route('finance.pengajuan.index')->with('success','Pengajuan created successfully.');
    }

    public function edit($id)
    {
        $pengajuan = Pengajuan::findOrFail($id);
        $gurus = Guru::select('id','nama')->get();
        return view('finance.pengajuan.edit', compact('pengajuan','gurus'));
    }

    public function update(PengajuanRequest $request, $id)
    {
        $pengajuan = Pengajuan::findOrFail($id);
        $data = $request->validated();

        if ($request->hasFile('foto_lpj')) {
            $file = $request->file('foto_lpj');
            $name = time().'_'.preg_replace('/[^a-z0-9\._-]/i','_', $file->getClientOriginalName());
            $file->move(public_path('files/finance/pengajuan'), $name);
            $data['foto_lpj'] = '/files/finance/pengajuan/'.$name;
        }

        $pengajuan->update($data);
        return redirect()->route('finance.pengajuan.index')->with('success','Pengajuan updated successfully.');
    }

    public function destroy($id)
    {
        $pengajuan = Pengajuan::findOrFail($id);
        $pengajuan->delete();
        return redirect()->route('finance.pengajuan.index')->with('success','Pengajuan deleted successfully.');
    }

    public function exportPdf(Request $request)
    {
        $pengajuans = Pengajuan::orderBy('tanggal_pengajuan','desc')->get();
        $pdf = Pdf::loadView('finance.pengajuan.pdf', compact('pengajuans'));
        return $pdf->download('pengajuan-'.now()->format('Ymd_His').'.pdf');
    }
}
