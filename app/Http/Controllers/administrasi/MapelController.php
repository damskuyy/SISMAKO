<?php


namespace App\Http\Controllers\administrasi;


use ZipArchive;
use Illuminate\Http\Request;
use App\Models\administrasi\Mapel;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Log;
// use App\Http\Helpers\TahunAjaranHelper;
use Illuminate\Support\Facades\Storage;
use App\Http\Requests\administrasi\MapelRequest;


class MapelController extends Controller
{
    public function index(Request $request)
    {
        $tahunAjaranFilter = $request->query('tahun_ajaran', '');
        $kelasFilter = $request->query('kelas', '');
        $mapelFilter = $request->query('mapel', '');


        $query = Mapel::query();


        if ($tahunAjaranFilter) {
            $query->where('tahun_ajaran', $tahunAjaranFilter);
        }


        if ($kelasFilter) {
            $query->where('kelas', $kelasFilter);
        }


        if ($mapelFilter) {
            $query->where('mapel', $mapelFilter);
        }


        $mapels = $query->paginate(10);


        $tahunAjaranOptions = Mapel::select('tahun_ajaran')->distinct()->pluck('tahun_ajaran');
        $kelasOptions = Mapel::select('kelas')->distinct()->pluck('kelas');
        $mapelOptions = Mapel::select('mapel')->distinct()->pluck('mapel');


        // return view('page.administrasi.mapel.index', compact('mapels', 'tahunAjaranFilter', 'kelasFilter', 'mapelFilter', 'tahunAjaranOptions', 'kelasOptions', 'mapelOptions'));
        return view('administrasi.mapel.index', compact('mapels', 'tahunAjaranFilter', 'kelasFilter', 'mapelFilter', 'tahunAjaranOptions', 'kelasOptions', 'mapelOptions'));
    }




    public function create()
    {
        // $startYear = 2024;
        // $endYear = $startYear + 6;
        // $tahunAjaran = [];


        // for ($year = $startYear; $year < $endYear; $year++) {
        //     $tahunAjaran[] = $year . '-' . ($year + 1);
        // }


        // $tahunAjaran = TahunAjaranHelper::generateTahunAjaran();


        return view('administrasi.mapel.create');
    }


    public function store(MapelRequest $request)
    {
        // Validasi input
        $validateData = $request->validated();


        $fileFields = [
            'CapaianPembelajaran',
            'TPATP',
            'KKTP',
            'KodeEtikGuru',
            'IkrarGuru',
            'TatibGuru',
            'PembiasaanGuru',
            'Kaldik',
            'AlokasiWaktu',
            'Prota',
            'Prosem',
            'JurnalAgendaGuru',
            'DaftarHadirSiswa',
            'DaftarNilaiSiswa',
            'PSS',
            'AnalisisHasilPenilaian',
            'PRP',
            'JadwalMengajarGuru',
            'TugasTerstruktur',
            'TugasTidakTerstruktur',
            'rpp_1',
            'pendukung_rpp_1',
            'rpp_2',
            'pendukung_rpp_2',
            'rpp_3',
            'pendukung_rpp_3',
            'rpp_4',
            'pendukung_rpp_4',
            'rpp_5',
            'pendukung_rpp_5',
            'rpp_6',
            'pendukung_rpp_6',
            'rpp_7',
            'pendukung_rpp_7',
            'rpp_8',
            'pendukung_rpp_8',
            'rpp_9',
            'pendukung_rpp_9',
            'rpp_10',
            'pendukung_rpp_10',
            'rpp_11',
            'pendukung_rpp_11',
            'rpp_12',
            'pendukung_rpp_12',
            'rpp_13',
            'pendukung_rpp_13',
        ];


        foreach ($fileFields as $fileField) {
            if ($request->file($fileField)) {
                $file = $request->file($fileField);
                $originalName = $file->getClientOriginalName();
                $validateData[$fileField] = $file->storeAs($fileField, $originalName);
            }
        }
        Mapel::create($validateData);


        return redirect()->route('mapel.index')->with('success', 'Mapel created successfully.');
    }


    public function edit($id)
    {
        // $tahunAjaran = TahunAjaranHelper::generateTahunAjaran();
        $mapel = Mapel::findOrFail($id);
        return view('administrasi.mapel.edit', compact('mapel'));
    }


    public function update(MapelRequest $request, $id)
    {
        $mapel = Mapel::findOrFail($id);


        $validateData = $request->validated();


        $fileFields = [
            'CapaianPembelajaran',
            'TPATP',
            'KKTP',
            'KodeEtikGuru',
            'IkrarGuru',
            'TatibGuru',
            'PembiasaanGuru',
            'Kaldik',
            'AlokasiWaktu',
            'Prota',
            'Prosem',
            'JurnalAgendaGuru',
            'DaftarHadirSiswa',
            'DaftarNilaiSiswa',
            'PSS',
            'AnalisisHasilPenilaian',
            'PRP',
            'JadwalMengajarGuru',
            'TugasTerstruktur',
            'TugasTidakTerstruktur',
            'rpp_1',
            'pendukung_rpp_1',
            'rpp_2',
            'pendukung_rpp_2',
            'rpp_3',
            'pendukung_rpp_3',
            'rpp_4',
            'pendukung_rpp_4',
            'rpp_5',
            'pendukung_rpp_5',
            'rpp_6',
            'pendukung_rpp_6',
            'rpp_7',
            'pendukung_rpp_7',
            'rpp_8',
            'pendukung_rpp_8',
            'rpp_9',
            'pendukung_rpp_9',
            'rpp_10',
            'pendukung_rpp_10',
            'rpp_11',
            'pendukung_rpp_11',
            'rpp_12',
            'pendukung_rpp_12',
            'rpp_13',
            'pendukung_rpp_13',
        ];


        foreach ($fileFields as $fileField) {
            if ($request->hasFile($fileField)) {
                // Jika ada file baru, hapus file lama jika ada
                if (isset($validateData[$fileField])) {
                    $oldFile = $validateData[$fileField];
                    if ($oldFile && Storage::exists($oldFile)) {
                        Storage::delete($oldFile);
                    }
                }
                // Simpan file baru
                $file = $request->file($fileField);
                $originalName = $file->getClientOriginalName();
                $validateData[$fileField] = $file->storeAs($fileField, $originalName);
            } else {
                // Jika tidak ada file baru, pertahankan data lama
                $validateData[$fileField] = $mapel->$fileField;
            }
        }


        $mapel->update($validateData);


        return redirect()->route('mapel.index')->with('success', 'Mapel updated successfully.');
    }


    public function destroy($id)
    {
        // Temukan mapel berdasarkan ID
        $mapel = Mapel::findOrFail($id);


        // Define file fields
        $fileFields = [
            'CapaianPembelajaran',
            'TPATP',
            'KKTP',
            'KodeEtikGuru',
            'IkrarGuru',
            'TatibGuru',
            'PembiasaanGuru',
            'Kaldik',
            'AlokasiWaktu',
            'Prota',
            'Prosem',
            'JurnalAgendaGuru',
            'DaftarHadirSiswa',
            'DaftarNilaiSiswa',
            'PSS',
            'AnalisisHasilPenilaian',
            'PRP',
            'JadwalMengajarGuru',
            'TugasTerstruktur',
            'TugasTidakTerstruktur',
            'rpp_1',
            'pendukung_rpp_1',
            'rpp_2',
            'pendukung_rpp_2',
            'rpp_3',
            'pendukung_rpp_3',
            'rpp_4',
            'pendukung_rpp_4',
            'rpp_5',
            'pendukung_rpp_5',
            'rpp_6',
            'pendukung_rpp_6',
            'rpp_7',
            'pendukung_rpp_7',
            'rpp_8',
            'pendukung_rpp_8',
            'rpp_9',
            'pendukung_rpp_9',
            'rpp_10',
            'pendukung_rpp_10',
            'rpp_11',
            'pendukung_rpp_11',
            'rpp_12',
            'pendukung_rpp_12',
            'rpp_13',
            'pendukung_rpp_13',
        ];


        foreach ($fileFields as $fileField) {
            if ($mapel->$fileField) {
                Storage::delete($mapel->$fileField);
            }
        }


        // Hapus entri dari database
        $mapel->delete();


        return redirect()->route('mapel.index')->with('success', 'Mapel deleted successfully.');
    }


    public function downloadFiles($id)
    {
        $mapel = Mapel::findOrFail($id);


        // Daftar direktori file yang ingin didownload
        $directories = [
            'CapaianPembelajaran',
            'TPATP',
            'KKTP',
            'KodeEtikGuru',
            'IkrarGuru',
            'TatibGuru',
            'PembiasaanGuru',
            'Kaldik',
            'AlokasiWaktu',
            'Prota',
            'Prosem',
            'JurnalAgendaGuru',
            'DaftarHadirSiswa',
            'DaftarNilaiSiswa',
            'PSS',
            'AnalisisHasilPenilaian',
            'PRP',
            'JadwalMengajarGuru',
            'TugasTerstruktur',
            'TugasTidakTerstruktur',
            'rpp_1',
            'pendukung_rpp_1',
            'rpp_2',
            'pendukung_rpp_2',
            'rpp_3',
            'pendukung_rpp_3',
            'rpp_4',
            'pendukung_rpp_4',
            'rpp_5',
            'pendukung_rpp_5',
            'rpp_6',
            'pendukung_rpp_6',
            'rpp_7',
            'pendukung_rpp_7',
            'rpp_8',
            'pendukung_rpp_8',
            'rpp_9',
            'pendukung_rpp_9',
            'rpp_10',
            'pendukung_rpp_10',
            'rpp_11',
            'pendukung_rpp_11',
            'rpp_12',
            'pendukung_rpp_12',
            'rpp_13',
            'pendukung_rpp_13',
        ];


        // Cek apakah ada file yang tersedia untuk didownload
        $filesAvailable = false;


        foreach ($directories as $dir) {
            if ($mapel->$dir) {
                // Mendapatkan path file dari public directory
                $filePath = public_path($mapel->$dir);
                if (file_exists($filePath)) {
                    $filesAvailable = true;
                    break; // Jika satu file ditemukan, hentikan loop
                }
            }
        }


        // Jika tidak ada file yang tersedia, kembalikan pesan error
        if (!$filesAvailable) {
            return back()->with('error', 'Tidak ada file yang tersedia untuk didownload.');
        }


        // Buat nama file zip sementara untuk menyimpan semua file
        $zipFileName = 'Mapel_files_' . $mapel->mapel . '.zip';
        $zipFilePath = public_path('zips/' . $zipFileName);


        // Pastikan direktori 'zips' ada
        if (!File::exists(public_path('zips'))) {
            File::makeDirectory(public_path('zips'), 0755, true);
        }


        // Membuat file ZIP
        $zip = new ZipArchive;
        if ($zip->open($zipFilePath, ZipArchive::CREATE | ZipArchive::OVERWRITE) === TRUE) {
            foreach ($directories as $dir) {
                if ($mapel->$dir) {
                    $filePath = public_path($mapel->$dir); // Mengambil file dari public
                    if (file_exists($filePath)) {
                        $zip->addFile($filePath, basename($filePath)); // Tambahkan file ke zip
                    } else {
                        Log::error('File tidak ditemukan: ' . $filePath);
                    }
                }
            }
            $zip->close();


            // Setelah ZIP dibuat, kirim untuk di-download dan hapus setelah pengiriman
            return response()->download($zipFilePath)->deleteFileAfterSend(true);
        } else {
            return back()->with('error', 'Gagal membuat file zip.');
        }
    }
}
