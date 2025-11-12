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

class PtsController extends Controller
{
    public function index(Request $request)
    {
        $tahunAjaran = $request->input('tahun_ajaran');
        $kelas = $request->input('kelas');
        $mapel = $request->input('mapel');

        // Build the query with optional filters
        $query = pas::where('type', 'pts');

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
        $pts = $query->take(500)->paginate(10);

        // Return the view with filtered data
        return view('penilaian.exam.pts.pts', compact('pts', 'tahunAjaran', 'kelas', 'mapel'));
    }

    public function create()
    {
        return view('penilaian.exam.pts.create');
    }

    public function store(PasRequest $request)
    {
        $validateData = $request->validated();

        // Menyimpan file-file yang di-upload dengan nama asli
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
            if ($request->file($fileField)) {
                $file = $request->file($fileField);
                $originalName = $file->getClientOriginalName();
                // Simpan di public/storage/{fileField}/{originalName}
                $validateData[$fileField] = $file->storeAs($fileField, $originalName, 'public');
            }
        }

        pas::create(array_merge($validateData, ['type' => 'pts']));

        return redirect('/penilaian/pts')->with('success', 'Data berhasil ditambahkan');
    }


    public function edit($id)
    {
        $pts = pas::find($id);
        return view('penilaian.exam.pts.edit', compact('pts'));
    }

    public function update(PasRequest $request, $id)
    {
        $validateData = $request->validated();
        $pts = pas::findOrFail($id);

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
            if ($request->file($fileField)) {
                // Hapus file lama jika ada
                if ($pts->$fileField) {
                    // Hapus file dari storage/public
                    Storage::disk('public')->delete($pts->$fileField);
                }
                // Simpan file baru
                $file = $request->file($fileField);
                $originalName = $file->getClientOriginalName();
                $validateData[$fileField] = $file->storeAs($fileField, $originalName, 'public');
            } else {
                // Set the field to the old value if no file was uploaded
                $validateData[$fileField] = $pts->$fileField;
            }
        }

        $pts->update($validateData);

        return redirect('/penilaian/pts')->with('success', 'Data berhasil diperbaharui');
    }

    public function destroy($id)
    {
        $pts = pas::findOrFail($id);

        $fileFields = [
            'kisi_kisi',
            'soal',
            'jawaban',
            'kehadiran',
            'daftar_nilai',
        ];

        foreach ($fileFields as $fileField) {
            if ($pts->$fileField) {
                $filePath = $pts->$fileField;

                // Hapus file dari public disk
                if (Storage::disk('public')->exists($filePath)) {
                    Storage::disk('public')->delete($filePath);
                }
            }
        }

        $pts->delete();

        return redirect('/penilaian/pts')->with('success', 'Data berhasil dihapus');
    }


    public function download($id)
    {
        $pts = pas::findOrFail($id);

        $directories = [
            'kisi_kisi',
            'soal',
            'jawaban',
            'kehadiran',
            'daftar_nilai',
        ];

        // Create a temporary file to store the zip (unique name to avoid collisions)
        $zipFileName = 'pts_files_' . preg_replace('/[^A-Za-z0-9_-]/', '_', $pts->mapel) . '_' . time() . '.zip';
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
            $dbValue = $pts->$dir;
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

    private function addDirectoryToZip($zip, $dirPath, $zipPath)
    {
        $files = new RecursiveIteratorIterator(
            new RecursiveDirectoryIterator($dirPath),
            RecursiveIteratorIterator::LEAVES_ONLY
        );

        foreach ($files as $name => $file) {
            if (!$file->isDir()) {
                // Get the relative path for the zip file
                $filePath = $file->getRealPath();
                $relativePath = $zipPath . '/' . substr($filePath, strlen($dirPath) + 1);

                // Add file to the zip
                $zip->addFile($filePath, $relativePath);
            }
        }
    }
    
    }
