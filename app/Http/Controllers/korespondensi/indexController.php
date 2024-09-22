<?php

namespace App\Http\Controllers\korespondensi;


use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\korespondensi\Notulensi;
use App\Models\korespondensi\NomorSurat;
use App\Models\korespondensi\SuratMasuk;
use App\Models\korespondensi\SuratKeluar;
use App\Models\korespondensi\SuratPengajuan;
use App\Models\korespondensi\SuratPeringatan;

class indexController extends Controller
{
    public function index()
    {
        $suratmasuk = SuratMasuk::all();
        $suratkeluar = SuratKeluar::all();
        $suratperingatan = SuratPeringatan::all();
        $nomorsurat = NomorSurat::all();
        $notulensi = Notulensi::all();
        $suratpengajuan = SuratPengajuan::all();

        $suratMasukBaru = SuratMasuk::where('created_at', '>=', now()->subDays(30))->get();
        $suratKeluarBaru = SuratKeluar::where('created_at', '>=', now()->subDays(30))->get();
        $suratPengajuanBaru = SuratPengajuan::where('created_at', '>=', now()->subDays(30))->get();
        $suratPeringatanBaru = SuratPeringatan::where('created_at', '>=', now()->subDays(30))->get();
        $notulensiBaru = Notulensi::where('created_at', '>=', now()->subDays(30))->get();

        // Menggabungkan semua data
        $suratBaru = $suratMasukBaru
            ->merge($suratKeluarBaru)
            ->merge($suratPengajuanBaru)
            ->merge($suratPeringatanBaru)
            ->merge($notulensiBaru);

        return view('korespondensi.index', compact('suratmasuk', 'suratkeluar', 'nomorsurat', 'suratperingatan', 'suratpengajuan', 'notulensi', 'suratBaru'));
    }

}
