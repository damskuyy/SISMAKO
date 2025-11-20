<?php

namespace App\Http\Controllers\Finance;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Finance\Pengeluaran;
use App\Models\sarpras\SchoolPurchase;
use App\Models\sarpras\DormPurchase;
use App\Http\Requests\Finance\PengeluaranRequest;
use Barryvdh\DomPDF\Facade\Pdf;

class PengeluaranController extends Controller
{
    public function index(Request $request)
    {
        $query = Pengeluaran::query();
        if ($request->filled('tanggal')) {
            $query->whereDate('tanggal_pengeluaran', $request->tanggal);
        }
        $pengeluarans = $query->orderBy('tanggal_pengeluaran','desc')->paginate(10);
        $school = SchoolPurchase::select('id','nama_barang','kode')->get();
        $dorm = DormPurchase::select('id','nama_barang','kode')->get();
        return view('finance.pengeluaran.index', compact('pengeluarans','school','dorm'));
    }

    public function create()
    {
        $school = SchoolPurchase::select('id','nama_barang','kode')->get();
        $dorm = DormPurchase::select('id','nama_barang','kode')->get();
        return view('finance.pengeluaran.create', compact('school','dorm'));
    }

    public function store(PengeluaranRequest $request)
    {
        $data = $request->validated();
        Pengeluaran::create($data);
        return redirect()->route('finance.pengeluaran.index')->with('success','Pengeluaran created successfully.');
    }

    public function edit($id)
    {
        $pengeluaran = Pengeluaran::findOrFail($id);
        $school = SchoolPurchase::select('id','nama_barang','kode')->get();
        $dorm = DormPurchase::select('id','nama_barang','kode')->get();
        return view('finance.pengeluaran.edit', compact('pengeluaran','school','dorm'));
    }

    public function update(PengeluaranRequest $request, $id)
    {
        $pengeluaran = Pengeluaran::findOrFail($id);
        $pengeluaran->update($request->validated());
        return redirect()->route('finance.pengeluaran.index')->with('success','Pengeluaran updated successfully.');
    }

    public function destroy($id)
    {
        $pengeluaran = Pengeluaran::findOrFail($id);
        $pengeluaran->delete();
        return redirect()->route('finance.pengeluaran.index')->with('success','Pengeluaran deleted successfully.');
    }

    public function exportPdf(Request $request)
    {
        $pengeluarans = Pengeluaran::orderBy('tanggal_pengeluaran','desc')->get();
        $pdf = Pdf::loadView('finance.pengeluaran.pdf', compact('pengeluarans'));
        return $pdf->download('pengeluaran-'.now()->format('Ymd_His').'.pdf');
    }
}
