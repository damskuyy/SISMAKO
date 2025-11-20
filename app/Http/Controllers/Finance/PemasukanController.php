<?php

namespace App\Http\Controllers\Finance;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Finance\Pemasukan;
use App\Http\Requests\Finance\PemasukanRequest;
use Barryvdh\DomPDF\Facade\Pdf;

class PemasukanController extends Controller
{
    public function index(Request $request)
    {
        $query = Pemasukan::query();
        if ($request->filled('tanggal')) {
            $query->whereDate('tanggal_pemasukan', $request->tanggal);
        }
        $pemasukans = $query->orderBy('tanggal_pemasukan','desc')->paginate(10);
        return view('finance.pemasukan.index', compact('pemasukans'));
    }

    public function create()
    {
        return view('finance.pemasukan.create');
    }

    public function store(PemasukanRequest $request)
    {
        $data = $request->validated();
        Pemasukan::create($data);
        return redirect()->route('finance.pemasukan.index')->with('success','Pemasukan created successfully.');
    }

    public function edit($id)
    {
        $pemasukan = Pemasukan::findOrFail($id);
        return view('finance.pemasukan.edit', compact('pemasukan'));
    }

    public function update(PemasukanRequest $request, $id)
    {
        $pemasukan = Pemasukan::findOrFail($id);
        $pemasukan->update($request->validated());
        return redirect()->route('finance.pemasukan.index')->with('success','Pemasukan updated successfully.');
    }

    public function destroy($id)
    {
        $pemasukan = Pemasukan::findOrFail($id);
        $pemasukan->delete();
        return redirect()->route('finance.pemasukan.index')->with('success','Pemasukan deleted successfully.');
    }

    public function exportPdf(Request $request)
    {
        $pemasukans = Pemasukan::orderBy('tanggal_pemasukan','desc')->get();
        $pdf = Pdf::loadView('finance.pemasukan.pdf', compact('pemasukans'));
        return $pdf->download('pemasukan-'.now()->format('Ymd_His').'.pdf');
    }
}
