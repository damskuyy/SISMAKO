<?php

namespace App\Http\Controllers\keasramaan;

use App\Http\Controllers\Controller;
use App\Models\keasramaan\Kunjungan;

class DinasController extends Controller
{
    public function index()
    {
        $dinas = Kunjungan::where('status_kunjungan', operator: 'Dinas')->paginate(10);
        return view('keasramaan.kunjungan.dinas.dinas', compact('dinas'));
    }

    public function create()
    {
        return view('keasramaan.kunjungan.dinas.create');
    }



    public function edit()
    {
        return view('keasramaan.kunjungan.dinas.edit');
    }

}
