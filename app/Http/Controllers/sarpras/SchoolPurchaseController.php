<?php

namespace App\Http\Controllers\sarpras;

use ZipArchive;
use Barryvdh\DomPDF\Facade\Pdf;
use Termwind\Components\Dd;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\sarpras\SchoolPurchaseRequest;
use App\Models\sarpras\SchoolPurchase;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;

class SchoolPurchaseController extends Controller
{
    public function index(Request $request)
    {
        $query = SchoolPurchase::query();

        if ($request->filled('tahun_pembelian')) {
            $query->whereYear('tanggal_pembelian', $request->tahun_pembelian);
        }

        if ($request->filled('bulan_pembelian')) {
            $query->whereMonth('tanggal_pembelian', $request->bulan_pembelian);
        }

        $schoolPurchases = $query->paginate(10); // Menggunakan paginate alih-alih get

        return view('sarpras.sekolah.index', compact('schoolPurchases'));
    }

    public function goodItems()
    {
        $schoolPurchases = SchoolPurchase::all();
        return view("sarpras.sekolah.goodItems", compact("schoolPurchases"));
    }

    public function damagedItems()
    {
        $schoolPurchases = SchoolPurchase::all();
        return view("sarpras.sekolah.damagedItems", compact("schoolPurchases"));
    }

    public function store(SchoolPurchaseRequest $request)
    {
        // dd($request->all());/
        $request->validated();

        $data = $request->except('gambar');

        $schoolPurchase = SchoolPurchase::create($data);

        if ($request->hasFile('gambar')) {
            foreach ($request->file('gambar') as $file) {
                $path = $file->storeAs('school_purchases', $file->getClientOriginalName(), 'public');
                $schoolPurchase->images()->create(['path' => $path]);
            }
        }

        return redirect("/sarpras/school-purchase")->with("success", "Berhasil menambahkan data Pembelian Sekolah.");
    }

    public function update(SchoolPurchaseRequest $request, $id)
    {
        // Use the validated data from the FormRequest. The FormRequest
        // handles create vs update uniqueness for `kode`.
        $validated = $request->validated();

        $schoolPurchase = SchoolPurchase::findOrFail($id);
        $data = $request->except('gambar');

        if ($request->hasFile('gambar')) {
            // Hapus gambar lama dari database dan storage
            $oldImages = $schoolPurchase->images;
            foreach ($oldImages as $image) {
                Storage::disk('public')->delete('school_purchases/' . $image->path); // Sesuaikan jalur penyimpanan gambar
                $image->delete();
            }

            // Simpan gambar baru
            foreach ($request->file('gambar') as $file) {
                $path = $file->storeAs('school_purchases', $file->getClientOriginalName(), 'public');
                $schoolPurchase->images()->create(['path' => $path]);
            }
        }

        $schoolPurchase->update($data);

        return redirect("/sarpras/school-purchase")->with("success", "Berhasil memperbarui data Pembelian Sekolah.");
    }

    public function getDamaged($id)
    {
        $schoolPurchase = SchoolPurchase::findOrFail($id);
        return view("sarpras.sekolah.damagedItems", compact("schoolPurchase"));
    }

    /**
     * Return JSON details for an item (used by AJAX on the damaged items modal).
     */
    public function getItemDetails($id)
    {
        $schoolPurchase = SchoolPurchase::find($id);

        if (! $schoolPurchase) {
            return response()->json(['status' => 'error', 'message' => 'Item not found'], 404);
        }

        return response()->json([
            'status' => 'success',
            'data' => [
                'id' => $schoolPurchase->id,
                'nama_barang' => $schoolPurchase->nama_barang,
                'jumlah_baik' => $schoolPurchase->jumlah_baik,
            ],
        ]);
    }

    public function showForm()
    {
        $schoolPurchases = SchoolPurchase::all();
        return view('sarpras.sekolah.damagedItems', compact('schoolPurchases'));
    }

    public function edit($id)
    {
        try {
            $schoolPurchase = SchoolPurchase::findOrFail($id);
            return view('sarpras.sekolah.edit', compact('schoolPurchase'));
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Error fetching data');
        }
    }

    public function damaged(Request $request, $id)
    {
        Log::info('Damaged items request:', [
            'method' => $request->method(),
            'data' => $request->all()
        ]);
        
        // Validasi input
        $validated = $request->validate([
            'jumlah_rusak' => 'required|integer|min:1',
            'keterangan' => 'required|string|max:255',
        ]);

        // Temukan data pembelian sekolah
        $schoolPurchase = SchoolPurchase::findOrFail($id);

        if ($request->method() === 'DELETE') {
            // Jika method DELETE, kembalikan semua barang rusak menjadi baik
            $schoolPurchase->jumlah_baik += $schoolPurchase->jumlah_rusak;
            $schoolPurchase->jumlah_rusak = 0;
            $schoolPurchase->keterangan = null;
            $schoolPurchase->save();

            return redirect('/sarpras/damaged-items-school')
                ->with('success', 'Barang berhasil dipulihkan ke kondisi baik.');
        }

        // Untuk POST/PUT, proses perubahan status rusak
        // Pastikan jumlah rusak yang dimasukkan tidak melebihi jumlah baik yang tersedia
        if ($request->method() === 'POST' && $request->jumlah_rusak > $schoolPurchase->jumlah_baik) {
            return redirect()->back()->withErrors(['jumlah_rusak' => 'Jumlah rusak tidak boleh melebihi jumlah baik yang tersedia.']);
        }

        if ($request->method() === 'PUT') {
            // Untuk edit, kembalikan dulu jumlah lama ke stok baik
            $schoolPurchase->jumlah_baik += $schoolPurchase->jumlah_rusak;
            // Lalu cek apakah jumlah baru valid
            if ($request->jumlah_rusak > $schoolPurchase->jumlah_baik) {
                return redirect()->back()->withErrors(['jumlah_rusak' => 'Jumlah rusak tidak boleh melebihi jumlah baik yang tersedia.']);
            }
        }

        // Update jumlah baik/rusak
        if ($request->method() === 'POST') {
            $schoolPurchase->jumlah_baik -= $request->jumlah_rusak;
            $schoolPurchase->jumlah_rusak += $request->jumlah_rusak;
        } else if ($request->method() === 'PUT') {
            $schoolPurchase->jumlah_baik -= $request->jumlah_rusak;
            $schoolPurchase->jumlah_rusak = $request->jumlah_rusak;
        }
        
        $schoolPurchase->keterangan = $request->keterangan;
        $schoolPurchase->save();

        return redirect('/sarpras/damaged-items-school')
            ->with('success', 'Data barang rusak berhasil ' . 
                ($request->method() === 'PUT' ? 'diperbarui.' : 'ditambahkan.'));
    }

    /**
     * Restore damaged items back to good condition (called by DELETE route)
     */
    public function restoreDamaged($id)
    {
        $schoolPurchase = SchoolPurchase::findOrFail($id);

        // Move all damaged back to jumlah_baik
        $schoolPurchase->jumlah_baik += $schoolPurchase->jumlah_rusak;
        $schoolPurchase->jumlah_rusak = 0;
        $schoolPurchase->keterangan = null;
        $schoolPurchase->save();

        return redirect('/sarpras/damaged-items-school')
            ->with('success', 'Barang berhasil dipulihkan ke kondisi baik.');
    }

    public function destroy($id)
    {
        SchoolPurchase::findOrFail($id)->delete();
        return redirect("/sarpras/school-purchase")->with("success", "Berhasil menghapus data Pembelian Sekolah.");
    }

    public function print()
    {
        $schoolPurchases = SchoolPurchase::all();
        $pdf = Pdf::loadView('sarpras.sekolah.print', compact('schoolPurchases'));
        return $pdf->stream('Sarpras Sekolah.pdf');
    }
    public function pdf()
    {
        $schoolPurchases = SchoolPurchase::get();
        return view("sarpras.sekolah.print", compact("schoolPurchases"));
    }

    public function download($id)
    {
        $schoolPurchase = SchoolPurchase::findOrFail($id);
        $images = $schoolPurchase->images;

        if ($images->count() == 1) {
            $image = $images->first();
            $path = storage_path('app/public/' . $image->path);

            if (!file_exists($path)) {
                abort(404, 'Image not found.');
            }

            return response()->download($path);
        } else {
            $zip = new ZipArchive;
            $fileName = 'download.zip';
            $zipPath = storage_path('app/public/' . $fileName);

            // Hapus file ZIP lama jika ada
            if (file_exists($zipPath)) {
                unlink($zipPath);
            }

            // Coba buka file ZIP baru
            if ($zip->open($zipPath, ZipArchive::CREATE) === TRUE) {
                foreach ($images as $image) {
                    $imagePath = storage_path('app/public/' . $image->path);

                    if (file_exists($imagePath)) {
                        $zip->addFile($imagePath, basename($image->path));
                    } else {
                        Log::warning('Image not found: ' . $imagePath);
                    }
                }
                $zip->close();

                // Periksa apakah file ZIP berhasil dibuat dan ukurannya lebih dari 0
                if (file_exists($zipPath) && filesize($zipPath) > 0) {
                    return response()->download($zipPath)->deleteFileAfterSend(true);
                } else {
                    abort(500, 'Failed to create ZIP file or ZIP file is empty.');
                }
            } else {
                abort(500, 'Could not open ZIP file.');
            }
        }
    }
}
