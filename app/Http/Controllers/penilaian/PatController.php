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

class PatController extends Controller
{
    public function index(Request $request)
    {
        $tahunAjaran = $request->input('tahun_ajaran');
        $kelas = $request->input('kelas');
        $mapel = $request->input('mapel');

        // Build the query with optional filters
        $query = pas::where('type', 'pat');

        if ($tahunAjaran) {
            $query->where('tahun_ajaran', $tahunAjaran);
        }

        if ($kelas) {
            $query->where('kelas', $kelas);
        }

        if ($mapel) {
            $query->where('mapel', $mapel);
        }

        // Paginate the results
        $pat = $query->take(500)->paginate(10);

        // Return the view with filtered data
        return view('penilaian.exam.pat.pat', compact('pat', 'tahunAjaran', 'kelas', 'mapel'));
    }

    public function create()
    {
        return view('penilaian.exam.pat.create');
    }

    public function store(PasRequest $request)
    {
        $validateData = $request->validated();

        // Menyimpan file-file yang di-upload dengan nama asli
        $fileFields = [
            'kisi_kisi',
            'soal',
            'jawaban',
            'kehadiran',
            'daftar_nilai',
        ];

        foreach ($fileFields as $fileField) {
            if ($request->hasFile($fileField)) {
                $file = $request->file($fileField);
                $originalName = $file->getClientOriginalName();
                // Simpan di public/storage/{fileField}/{originalName}
                $validateData[$fileField] = $file->storeAs($fileField, $originalName, 'public');
            }
        }

        pas::create(array_merge($validateData, ['type' => 'pat']));
        return redirect('/penilaian/pat')->with('success', 'Data berhasil ditambahkan');
    }

    public function edit($id)
    {
        $pat = pas::find($id);
        return view('penilaian.exam.pat.edit', compact('pat'));
    }

    public function update(PasRequest $request, $id)
    {
        $validateData = $request->validated();
        $pat = pas::findOrFail($id);

        $fileFields = [
            'kisi_kisi',
            'soal',
            'jawaban',
            'kehadiran',
            'daftar_nilai',
        ];

        foreach ($fileFields as $fileField) {
            if ($request->hasFile($fileField)) {
                // Hapus file lama jika ada
                if ($pat->$fileField) {
                    // Hapus file dari storage/public
                    Storage::disk('public')->delete($pat->$fileField);
                }
                // Simpan file baru
                $file = $request->file($fileField);
                $originalName = $file->getClientOriginalName();
                $validateData[$fileField] = $file->storeAs($fileField, $originalName, 'public');
            } else {
                // Set the field to the old value if no file was uploaded
                $validateData[$fileField] = $pat->$fileField;
            }
        }

        $pat->update($validateData);

        return redirect('/penilaian/pat')->with('success', 'Data berhasil diperbaharui');
    }

    public function destroy($id)
    {
        // Menemukan data dengan ID yang diberikan
        $pat = pas::findOrFail($id);

        // Memeriksa apakah data memiliki type 'pas'
        if ($pat->type !== 'pat') {
            return redirect('/penilaian/pat')->with('error', 'Data tidak dapat dihapus karena type tidak sesuai.');
        }

        $fileFields = [
            'kisi_kisi',
            'soal',
            'jawaban',
            'proker',
            'kehadiran',
            'ba',
            'sk_panitia',
            'tatib',
            'surat_pemberitahuan',
            'jadwal',
            'daftar_nilai',
            'tanda_terima_dan_penerimaan_soal',
            'kehadiran_panitia'
        ];

        foreach ($fileFields as $fileField) {
            if ($pat->$fileField) {
                $filePath = $pat->$fileField;

                if (Storage::disk('public')->exists($filePath)) {
                    Storage::disk('public')->delete($filePath);
                }
            }
        }

        // Menghapus entri dari database
        $pat->delete();

        return redirect('/penilaian/pat')->with('success', 'Data berhasil dihapus');
    }

    public function download($id)
    {
        $pat = pas::findOrFail($id);

        $directories = [
            'kisi_kisi',
            'soal',
            'jawaban',
            'kehadiran',
            'daftar_nilai',
        ];

        // Create a temporary file to store the zip (unique name to avoid collisions)
        $zipFileName = 'pat_files_' . preg_replace('/[^A-Za-z0-9_-]/', '_', $pat->mapel) . '_' . time() . '.zip';
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
            $dbValue = $pat->$dir;
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
