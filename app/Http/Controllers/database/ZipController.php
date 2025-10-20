<?php

namespace App\Http\Controllers\database;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use App\Http\Controllers\Controller;
use App\Models\database\PklAdministrasiSekolah as DatabasePklAdministrasiSekolah;
use App\Models\database\PklAdministrasiSiswa as DatabasePklAdministrasiSiswa;
use App\Models\PklAdministrasiSekolah;
use App\Models\PklAdministrasiSiswa;
use ZipArchive;

class ZipController extends Controller
{
    public function zipFileGuru($nama)
    {
        $zip = new ZipArchive;
        $fileName = $nama . '.zip';
        $folderPath = public_path('img/guru/' . str_replace(' ', '_', $nama));

        // Cek apakah folder ada
        if (!file_exists($folderPath) || !is_dir($folderPath)) {
            return response()->json(['error' => 'Folder tidak ditemukan'], 404);
        }

        if ($zip->open($fileName, ZipArchive::CREATE)) {
            $this->addFolderToZip($folderPath, $zip, strlen(public_path()) + 1);
            $zip->close();
        }

        $response = response()->download($fileName);

        // Hapus file setelah selesai diunduh
        $response->deleteFileAfterSend(true);

        return $response;
    }

    public function zipFileTendik($nama)
    {
        $zip = new ZipArchive;
        $fileName = $nama . '.zip';
        $folderPath = public_path('img/tendik/' . str_replace(' ', '_', $nama));

        // Cek apakah folder ada
        if (!file_exists($folderPath) || !is_dir($folderPath)) {
            return response()->json(['error' => 'Folder tidak ditemukan'], 404);
        }

        if ($zip->open($fileName, ZipArchive::CREATE)) {
            $this->addFolderToZip($folderPath, $zip, strlen(public_path()) + 1);
            $zip->close();
        }

        $response = response()->download($fileName);

        // Hapus file setelah selesai diunduh
        $response->deleteFileAfterSend(true);

        return $response;
    }

    public function zipFileSiswa($name)
    {
        // decode URL dan normalisasi nama folder
        $nameDecoded = urldecode($name);
        $dirName = str_replace(' ', '_', $nameDecoded);
        $fullPath = public_path("img/Siswa/{$dirName}");

        if (!File::exists($fullPath) || !File::isDirectory($fullPath)) {
            return response()->json(['error' => 'Folder tidak ditemukan'], 404);
        }

        $zipName = "{$dirName}.zip";
        $zipPath = public_path("zip/{$zipName}");

        // pastikan folder zip ada
        if (!File::exists(public_path('zip'))) {
            File::makeDirectory(public_path('zip'), 0755, true);
        }

        // buat zip (sederhana)
        $zip = new ZipArchive;
        if ($zip->open($zipPath, ZipArchive::CREATE | ZipArchive::OVERWRITE) === TRUE) {
            $files = new \RecursiveIteratorIterator(new \RecursiveDirectoryIterator($fullPath));
            foreach ($files as $file) {
                if (!$file->isDir()) {
                    $filePath = $file->getRealPath();
                    $relativePath = substr($filePath, strlen($fullPath) + 1);
                    $zip->addFile($filePath, $relativePath);
                }
            }
            $zip->close();
            return response()->download($zipPath)->deleteFileAfterSend(true);
        }

        return response()->json(['error' => 'Gagal membuat zip'], 500);
    }

    public function zipFilePklSekolah($id)
    {
        $sekolah = DatabasePklAdministrasiSekolah::findOrFail($id);
        $zip = new ZipArchive;
        $fileName = 'sekolah_' . $id . '.zip';

        // Tentukan jalur file
        $fotoSiswaDanPerusahaanPath = public_path($sekolah->path_foto_siswa_dan_perusahaan);
        $fotoMovPath = public_path($sekolah->path_foto_mov);

        // Cek apakah file ada
        if ((!file_exists($fotoSiswaDanPerusahaanPath) || !is_file($fotoSiswaDanPerusahaanPath)) &&
            (!file_exists($fotoMovPath) || !is_file($fotoMovPath))
        ) {
            return response()->json(['error' => 'Files not found'], 404);
        }

        if ($zip->open($fileName, ZipArchive::CREATE) === TRUE) {
            // Tambahkan file ke arsip ZIP
            if (file_exists($fotoSiswaDanPerusahaanPath) && is_file($fotoSiswaDanPerusahaanPath)) {
                $zip->addFile($fotoSiswaDanPerusahaanPath, basename($fotoSiswaDanPerusahaanPath));
            }
            if (file_exists($fotoMovPath) && is_file($fotoMovPath)) {
                $zip->addFile($fotoMovPath, basename($fotoMovPath));
            }
            $zip->close();
        } else {
            return response()->json(['error' => 'Could not create ZIP file'], 500);
        }

        $response = response()->download($fileName);

        // Hapus file ZIP setelah selesai diunduh
        $response->deleteFileAfterSend(true);

        return $response;
    }

    public function zipFilePklSiswa($id)
    {
        // Ambil data siswa berdasarkan ID
        $siswa = DatabasePklAdministrasiSiswa::findOrFail($id);
        $zip = new ZipArchive;
        $fileName = 'siswa_' . $id . '.zip';

        // Tentukan jalur file
        $rekapKehadiranPath = public_path($siswa->path_rekap_kehadiran);
        $jurnalPklPath = public_path($siswa->path_jurnal_pkl);

        // Cek apakah file ada
        if ((!file_exists($rekapKehadiranPath) || !is_file($rekapKehadiranPath)) &&
            (!file_exists($jurnalPklPath) || !is_file($jurnalPklPath))
        ) {
            return response()->json(['error' => 'Files not found'], 404);
        }

        // Buat file ZIP dan tambahkan file ke dalamnya
        if ($zip->open($fileName, ZipArchive::CREATE) === TRUE) {
            if (file_exists($rekapKehadiranPath) && is_file($rekapKehadiranPath)) {
                $zip->addFile($rekapKehadiranPath, basename($rekapKehadiranPath));
            }
            if (file_exists($jurnalPklPath) && is_file($jurnalPklPath)) {
                $zip->addFile($jurnalPklPath, basename($jurnalPklPath));
            }
            $zip->close();
        } else {
            return response()->json(['error' => 'Could not create ZIP file'], 500);
        }

        // Unduh file ZIP dan hapus setelah selesai diunduh
        $response = response()->download($fileName);
        $response->deleteFileAfterSend(true);

        return $response;
    }



    private function addFolderToZip($folder, $zip, $exclusiveLength)
    {
        $handle = opendir($folder);
        while (false !== ($f = readdir($handle))) {
            if ($f != '.' && $f != '..') {
                $filePath = "$folder/$f";
                $localPath = substr($filePath, $exclusiveLength);
                if (is_file($filePath)) {
                    $zip->addFile($filePath, $localPath);
                } elseif (is_dir($filePath)) {
                    // Tambahkan direktori kosong ke zip jika diperlukan
                    $zip->addEmptyDir($localPath);
                    $this->addFolderToZip($filePath, $zip, $exclusiveLength);
                }
            }
        }
        closedir($handle);
    }
}
