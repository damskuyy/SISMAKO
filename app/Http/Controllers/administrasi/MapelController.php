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

        // Map certain form file field names to DB column names (keep as file-mapping)
        $fieldMapping = [
            'KodeEtikGuru' => 'kode_etik',
            'Prosem' => 'program_semester',
            'Prota' => 'program_tahunan',
            'Kaldik' => 'kaldik_sekolah',
            'JurnalAgendaGuru' => 'jurnal_guru',
            'AlokasiWaktu' => 'alokasi_waktu',
            'DaftarHadirSiswa' => 'daftar_hadir_siswa',
            'JadwalMengajarGuru' => 'jadwal_pelajaran',
        ];

        $fileFields = [
            'kode_etik',
            'ikrar_guru',
            'tatib_guru',
            'pembiasaan_guru',
            'program_semester',
            'program_tahunan',
            'kaldik_sekolah',
            'jurnal_guru',
            'alokasi_waktu',
            'daftar_hadir_siswa',
            'daftar_nilai_siswa',
            'jadwal_pelajaran',
            'penilaian_sikap',
            'analisis_hasil_penilaian',
            'program_remedial',
            'tugas_terstruktur',
            'tugas_tidak_terstruktur',
            'dedkg',
            'ptlkg',
            'kisi_kisi_soal_kartu_soal',
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


        // Handle file uploads with field mapping
        foreach ($fieldMapping as $oldField => $newField) {
            if ($request->file($oldField)) {
                $file = $request->file($oldField);
                $originalName = $file->getClientOriginalName();
                $validateData[$newField] = $file->storeAs($newField, $originalName);
            }
        }

        // Handle RPP and related files
        foreach ($fileFields as $fileField) {
            if ($request->file($fileField)) {
                $file = $request->file($fileField);
                $originalName = $file->getClientOriginalName();
                $validateData[$fileField] = $file->storeAs($fileField, $originalName);
            }
        }

        // Create the record
        // Map textual fields from legacy form keys (if present) to DB columns.
        if (isset($validateData['pkg'])) {
            $validateData['capaian_pembelajaran'] = $validateData['pkg'];
            unset($validateData['pkg']);
        }
        if (isset($validateData['silabus'])) {
            $validateData['tp_atp'] = $validateData['silabus'];
            unset($validateData['silabus']);
        }
        if (isset($validateData['ki_kd_skl'])) {
            $validateData['kktp'] = $validateData['ki_kd_skl'];
            unset($validateData['ki_kd_skl']);
        }

        Mapel::create($validateData);


        return redirect()->route('mapel.index')->with('success', 'Mapel created successfully.');
    }


    public function edit($id)
    {
        // $tahunAjaran = TahunAjaranHelper::generateTahunAjaran();
        $mapel = Mapel::findOrFail($id);
        // If needed, expose legacy attributes; prefer using new column names
        // $mapel->makeVisible(['pkg', 'silabus', 'ki_kd_skl']);
        return view('administrasi.mapel.edit', compact('mapel'));
    }


    public function update(MapelRequest $request, $id)
    {
        $mapel = Mapel::findOrFail($id);


        $validateData = $request->validated();


        // Only handle file fields (legacy/form names are mapped separately in store)
        $fileFields = [
            'kode_etik',
            'ikrar_guru',
            'tatib_guru',
            'pembiasaan_guru',
            'program_semester',
            'program_tahunan',
            'kaldik_sekolah',
            'jurnal_guru',
            'alokasi_waktu',
            'daftar_hadir_siswa',
            'daftar_nilai_siswa',
            'jadwal_pelajaran',
            'penilaian_sikap',
            'analisis_hasil_penilaian',
            'program_remedial',
            'tugas_terstruktur',
            'tugas_tidak_terstruktur',
            'dedkg',
            'ptlkg',
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


        // Map for legacy form file fields (same mapping used in store)
        $fieldMapping = [
            'KodeEtikGuru' => 'kode_etik',
            'Prosem' => 'program_semester',
            'Prota' => 'program_tahunan',
            'Kaldik' => 'kaldik_sekolah',
            'JurnalAgendaGuru' => 'jurnal_guru',
            'AlokasiWaktu' => 'alokasi_waktu',
            'DaftarHadirSiswa' => 'daftar_hadir_siswa',
            'JadwalMengajarGuru' => 'jadwal_pelajaran',
        ];

        // Handle mapped legacy form file fields first (if provided)
        foreach ($fieldMapping as $oldField => $newField) {
            if ($request->hasFile($oldField)) {
                // delete old
                if ($mapel->$newField && Storage::exists($mapel->$newField)) {
                    Storage::delete($mapel->$newField);
                }
                $file = $request->file($oldField);
                $originalName = $file->getClientOriginalName();
                $validateData[$newField] = $file->storeAs($newField, $originalName);
            } else {
                $validateData[$newField] = $mapel->$newField;
            }
        }

        // Handle direct file fields (snake_case DB columns)
        foreach ($fileFields as $fileField) {
            if ($request->hasFile($fileField)) {
                if ($mapel->$fileField && Storage::exists($mapel->$fileField)) {
                    Storage::delete($mapel->$fileField);
                }
                $file = $request->file($fileField);
                $originalName = $file->getClientOriginalName();
                $validateData[$fileField] = $file->storeAs($fileField, $originalName);
            } else {
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
        // directories to scan for downloads (only snake_case/storage folders)
        $fileFields = [
            'kode_etik',
            'ikrar_guru',
            'tatib_guru',
            'pembiasaan_guru',
            'program_semester',
            'program_tahunan',
            'kaldik_sekolah',
            'jurnal_guru',
            'alokasi_waktu',
            'daftar_hadir_siswa',
            'daftar_nilai_siswa',
            'jadwal_pelajaran',
            'penilaian_sikap',
            'analisis_hasil_penilaian',
            'program_remedial',
            'tugas_terstruktur',
            'tugas_tidak_terstruktur',
            'dedkg',
            'ptlkg',
            'kisi_kisi_soal_kartu_soal',
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


        // Daftar direktori file yang ingin didownload (snake_case sesuai migration/storage)
        $directories = [
            'kode_etik',
            'program_semester',
            'program_tahunan',
            'kaldik_sekolah',
            'jurnal_guru',
            'alokasi_waktu',
            'daftar_hadir_siswa',
            'daftar_nilai_siswa',
            'penilaian_sikap',
            'analisis_hasil_penilaian',
            'program_remedial',
            'jadwal_pelajaran',
            'tugas_terstruktur',
            'tugas_tidak_terstruktur',
            'dedkg',
            'ptlkg',
            'ikrar_guru',
            'tatib_guru',
            'pembiasaan_guru',
            'kisi_kisi_soal_kartu_soal',
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
            $filePath = $mapel->{$dir};
            if ($filePath && Storage::exists($dir . '/' . basename($filePath))) {
                $filesAvailable = true;
                break;
            }
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
                $filePath = $mapel->{$dir};
                // cek di storage terlebih dahulu
                if ($filePath && Storage::exists($dir . '/' . basename($filePath))) {
                    $fullPath = Storage::path($dir . '/' . basename($filePath));
                    $relativePath = basename($dir) . '/' . basename($filePath);
                    $zip->addFile($fullPath, $relativePath);
                } else {
                    // cek di public path
                    if ($mapel->$dir) {
                        $publicFile = public_path($mapel->$dir); // Mengambil file dari public
                        if (file_exists($publicFile)) {
                            $zip->addFile($publicFile, basename($publicFile)); // Tambahkan file ke zip
                        } else {
                            Log::error('File tidak ditemukan: ' . $publicFile);
                        }
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
