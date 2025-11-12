<?php

namespace App\Http\Controllers\penilaian;

use ZipArchive;
use Illuminate\Http\Request;
use App\Models\penilaian\pas;
use RecursiveIteratorIterator;
use RecursiveDirectoryIterator;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Storage;
use App\Http\Requests\penilaian\PasRequest;

class PanitiaController extends Controller
{
    public function index(Request $request)
    {
        // Fetch the filter from the request
        $tahunAjaran = $request->input('tahun_ajaran');

        // Build the query based on whether the filter is present
        $query = pas::where('type', 'panitia');

        if ($tahunAjaran) {
            $query->where('tahun_ajaran', $tahunAjaran);
        }

        // Paginate the results
        $panitia = $query->take(500)->paginate(20);

        // Return the view with filtered data
        return view('penilaian.exam.panitia.panitia', compact('panitia', 'tahunAjaran'));
    }


    public function create()
    {
        return view('penilaian.exam.panitia.create');
    }

    public function store(PasRequest $request)
    {
        $validateData = $request->validated();

        // Menyimpan file-file yang di-upload dengan nama asli
        $fileFields = [
            'proker',
            'ba',
            'sk_panitia',
            'tatib_pengawas',
            'tatib_peserta',
            'surat_pemberitahuan_guru',
            'surat_pemberitahuan_ortu',
            'jadwal',
            'denah_ruangan',
            'denah_duduk',
            'daftar_nilai',
            'tanda_terima_dan_penerimaan_soal',
            'kehadiran_panitia',
            'keterangan',
        ];

        foreach ($fileFields as $fileField) {
            if ($request->hasFile($fileField)) {
                $file = $request->file($fileField);
                $originalName = $file->getClientOriginalName();
                // Simpan di public/storage/{fileField}/{originalName}
                $validateData[$fileField] = $file->storeAs($fileField, $originalName, 'public');
            }
        }

        pas::create(array_merge($validateData, ['type' => 'panitia']));
        return redirect('/penilaian/panitia')->with('success', 'Data berhasil ditambahkan');
    }

    public function edit($id)
    {
        $panitia = pas::find($id);
        return view('penilaian.exam.panitia.edit', compact('panitia'));
    }

    public function update(PasRequest $request, $id)
    {
        $validateData = $request->validated();
        $panitia = pas::findOrFail($id);

        $fileFields = [
            'proker',
            'ba',
            'sk_panitia',
            'tatib_pengawas',
            'tatib_peserta',
            'keterangan',
            'surat_pemberitahuan_guru',
            'surat_pemberitahuan_ortu',
            'jadwal',
            'denah_ruangan',
            'denah_duduk',
            'daftar_nilai',
            'tanda_terima_dan_penerimaan_soal',
            'kehadiran_panitia'
        ];

        foreach ($fileFields as $fileField) {
            if ($request->hasFile($fileField)) {
                // Hapus file lama jika ada
                if ($panitia->$fileField) {
                    // Hapus file dari storage/public
                    Storage::disk('public')->delete($panitia->$fileField);
                }
                // Simpan file baru
                $file = $request->file($fileField);
                $originalName = $file->getClientOriginalName();
                $validateData[$fileField] = $file->storeAs($fileField, $originalName, 'public');
            } else {
                // Set the field to the old value if no file was uploaded
                $validateData[$fileField] = $panitia->$fileField;
            }
        }

        $panitia->update($validateData);

        return redirect('/penilaian/panitia')->with('success', 'Data berhasil diperbaharui');
    }

    public function destroy($id)
    {
        // Menemukan data dengan ID yang diberikan
        $panitia = pas::findOrFail($id);

        // Memeriksa apakah data memiliki type 'pas'
        if ($panitia->type !== 'panitia') {
            return redirect('/penilaian/panitia')->with('error', 'Data tidak dapat dihapus karena type tidak sesuai.');
        }

        $fileFields = [
            'proker',
            'ba',
            'sk_panitia',
            'tatib_pengawas',
            'tatib_peserta',
            'keterangan',
            'surat_pemberitahuan_guru',
            'surat_pemberitahuan_ortu',
            'jadwal',
            'denah_ruangan',
            'denah_duduk',
            'daftar_nilai',
            'tanda_terima_dan_penerimaan_soal',
            'kehadiran_panitia'
        ];

        foreach ($fileFields as $fileField) {
            if ($panitia->$fileField) {
                $filePath = $panitia->$fileField;

                if (Storage::disk('public')->exists($filePath)) {
                    Storage::disk('public')->delete($filePath);
                }
            }
        }

        // Menghapus entri dari database
        $panitia->delete();

        return redirect('/penilaian/panitia')->with('success', 'Data berhasil dihapus');
    }

    public function download($id)
    {
        $panitia = pas::findOrFail($id);

        $directories = [
            'proker',
            'ba',
            'sk_panitia',
            'tatib_pengawas',
            'tatib_peserta',
            'surat_pemberitahuan_guru',
            'surat_pemberitahuan_ortu',
            'jadwal',
            'denah_ruangan',
            'denah_duduk',
            'daftar_nilai',
            'tanda_terima_dan_penerimaan_soal',
            'kehadiran_panitia',
            'keterangan'
        ];

        // Create a temporary file to store the zip (unique name to avoid collisions)
        $zipFileName = 'panitia_files_' . preg_replace('/[^A-Za-z0-9_-]/', '_', $panitia->mapel ?? 'export') . '_' . time() . '.zip';
        $tempDir = storage_path('app/temp');
        $zipFilePath = $tempDir . DIRECTORY_SEPARATOR . $zipFileName;

        // Ensure the temp directory exists
        if (!is_dir($tempDir)) {
            mkdir($tempDir, 0755, true);
        }

        $zip = new ZipArchive;
        if ($zip->open($zipFilePath, ZipArchive::CREATE | ZipArchive::OVERWRITE) !== TRUE) {
            return back()->with('error', 'Failed to create temporary zip file');
        }

        $fileCount = 0;
        foreach ($directories as $dir) {
            $dbValue = $panitia->$dir;
            if (!$dbValue) {
                continue;
            }

            // Files are stored on the 'public' disk (storage/app/public/...)
            if (Storage::disk('public')->exists($dbValue)) {
                $filePath = Storage::disk('public')->path($dbValue);
                if (is_file($filePath)) {
                    $zip->addFile($filePath, $dir . '/' . basename($filePath));
                    $fileCount++;
                }
            } else {
                // also try the public/storage path (if symlink exists)
                $publicPath = public_path('storage/' . $dbValue);
                if (is_file($publicPath)) {
                    $zip->addFile($publicPath, $dir . '/' . basename($publicPath));
                    $fileCount++;
                }
            }
        }

        $zip->close();

        if ($fileCount === 0 || !file_exists($zipFilePath) || filesize($zipFilePath) === 0) {
            // Clean up empty zip if created
            if (file_exists($zipFilePath)) {
                @unlink($zipFilePath);
            }
            return back()->with('error', 'No files found to download. Ensure files were uploaded.');
        }

        return response()->download($zipFilePath, $zipFileName)->deleteFileAfterSend(true);
    }

}
