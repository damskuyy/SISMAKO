<?php

namespace App\Http\Controllers\database;

use Dompdf\Dompdf;
use Dompdf\Options;
use Illuminate\Http\Request;
use App\Models\database\Siswa;
use App\Models\database\DataKelas;
use Illuminate\Support\Facades\View;
use App\Http\Controllers\Controller;
use App\Http\Requests\database\KelasRequest;

class DataKelasController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $tahunPelajaranFilter = $request->query('tahun_pelajaran', '');
        $kelasFilter = $request->query('kelas', '');
        $angkatanFilter = $request->query('angkatan', '');

        $query = DataKelas::query();

        if ($tahunPelajaranFilter) {
            $query->where('tahun_pelajaran', $tahunPelajaranFilter);
        }

        if ($kelasFilter) {
            $query->where('kelas', $kelasFilter);
        }

        if ($angkatanFilter) {
            $query->where('angkatan', $angkatanFilter);
        }

        // Tambahkan kondisi untuk mengecualikan kelas "Lulus"
        $query->where('kelas', '!=', 'Lulus');

        // Order by 'no_urut'
        $dataKelas = $query->with('siswa')->get();

        // Get unique values for the filter dropdowns
        $availableTahunPelajaran = DataKelas::select('tahun_pelajaran')->distinct()->pluck('tahun_pelajaran');
        $availableKelas = DataKelas::select('kelas')->distinct()->pluck('kelas');
        $availableAngkatan = DataKelas::select('angkatan')->distinct()->pluck('angkatan');

        return view('database.database.kelas.index', compact(
            'dataKelas',
            'tahunPelajaranFilter',
            'kelasFilter',
            'angkatanFilter',
            'availableTahunPelajaran',
            'availableKelas',
            'availableAngkatan'
        ));
    }

    public function upgrade()
    {
        $kelasMapping = [
            'X' => 'XI',
            'XI' => 'XII',
            'XII' => 'XIII',
            'XIII' => 'Lulus'
        ];

        $dataKelas = DataKelas::all();

        foreach ($dataKelas as $data) {
            if (isset($kelasMapping[$data->kelas])) {
                $data->kelas = $kelasMapping[$data->kelas];
                $data->save();
            }
        }

        return redirect()->route('kelas.index')->with('success', 'Semua kelas berhasil dinaikkan.');
    }
    public function exportPdf(Request $request)
    {
        // Define filters from request
        $tahunPelajaranFilter = $request->query('tahun_pelajaran', '');
        $kelasFilter = $request->query('kelas', '');
        $angkatanFilter = $request->query('angkatan', '');

        // Start query with relationship to siswa
        $query = DataKelas::with('siswa');

        // Apply filters if they exist
        if ($tahunPelajaranFilter) {
            $query->where('tahun_pelajaran', $tahunPelajaranFilter);
        }
        if ($kelasFilter) {
            $query->where('kelas', $kelasFilter);
        }
        if ($angkatanFilter) {
            $query->where('angkatan', $angkatanFilter);
        }

        // Exclude 'Lulus' class like in index
        $query->where('kelas', '!=', 'Lulus');

        // Get data
        $dataKelas = $query->get();

        // Generate PDF
        $html = View::make('database.template.dataKelas', compact('dataKelas'))->render();

        $options = new Options();
        $options->set('isRemoteEnabled', true);
        $options->set('isHtml5ParserEnabled', true);

        $dompdf = new Dompdf($options);
        $dompdf->loadHtml($html);
        $dompdf->setPaper('A4', 'landscape');
        $dompdf->render();

        return $dompdf->stream('data_kelas.pdf');
    }
    /**
     * Show the form for creating a new resource.
     */
    public function create(Request $request)
    {
        $mutasiFilter = $request->query('angkatan', ''); // Default empty filter

        // Fetch distinct angkatan values from Siswa model
        $angkatan = Siswa::distinct()->pluck('angkatan');

        // Get the selected angkatan from the request or default to an empty string
        $defaultAngkatan = $request->angkatan;

        // Fetch names for the selected angkatan if available
        $names = $defaultAngkatan ? Siswa::where('angkatan', $defaultAngkatan)->get(['id', 'nama', 'angkatan']) : collect();

        return view('database.database.kelas.add', compact('angkatan', 'names'));
    }

    public function edit($id)
    {
        $kelas = DataKelas::findOrFail($id);
        $angkatan = Siswa::distinct()->pluck('angkatan');
        $names = Siswa::where('angkatan', $kelas->angkatan)->get(['id', 'nama', 'angkatan']);
        $dataKelas = DataKelas::with('siswa')->where('id', $id)->first(); // Also for a single record
        return view('database.database.kelas.edit', compact('kelas', 'angkatan', 'names', 'dataKelas'));
    }

    public function getSiswaByAngkatan(Request $request)
    {
        $angkatan = $request->query('angkatan');

        if ($angkatan) {
            $siswa = Siswa::where('angkatan', $angkatan)->get(['id', 'nama']);
        } else {
            $siswa = collect();
        }

        return response()->json($siswa);
    }

    public function getSiswaByKelas(Request $request) {
        $kelas = $request->query('kelas');
        if ($kelas) {
            $siswa = DataKelas::where('kelas', $kelas)->select('id_siswa')->with(['siswa:id,nama'])->get();
        } else {
            $siswa = collect();
        }

        return response()->json($siswa);

    }

    public function getSiswaLulusByAngkatan(Request $request)
    {
        $angkatan = $request->query('angkatan');

        if ($angkatan) {
            $siswaLulus = DataKelas::where('angkatan', $angkatan)
                ->where('kelas', 'Lulus')
                ->with('siswa:id,nama')
                ->get()
                ->pluck('siswa');
        } else {
            $siswaLulus = collect();
            // dd($siswaLulus);
        }

        return response()->json($siswaLulus);
    }


    /**
     * Store a newly created resource in storage.
     */
    public function store(KelasRequest $request)
    {

        $validatedData = $request->validated();

        DataKelas::create($validatedData);

        return redirect()->route('kelas.index')->with('success', 'Data berhasil di tambahkan');
    }


    /**
     * Display the specified resource.
     */
    public function show(DataKelas $dataKelas)
    {
        return response()->json($dataKelas);
    }

    /**
     * Show the form for editing the specified resource.
     */


    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            'id_siswa' => 'required',
            'angkatan' => 'required',
            'tahun_pelajaran' => 'required',
            'jurusan' => 'required',
            'kelas' => 'required',
        ]);

        $kelas = DataKelas::findOrFail($id);
        $kelas->update($request->all());

        return redirect()->route('kelas.index')->with('success', 'Data berhasil di update');
    }


    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $kelas = DataKelas::findOrFail($id);
        $kelas->delete();

        return redirect()->route('kelas.index')->with('success', 'Data berhasil di hapus');
    }

}
