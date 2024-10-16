<?php

namespace App\Http\Controllers\schoolwebsite;

use App\Http\Controllers\Controller;
use App\Http\Requests\schoolwebsite\SaranMasukanRequest;
use App\Models\schoolwebsite\SaranMasukan;
use Illuminate\Http\Request;

class SaranMasukanController extends Controller
{
    public function create()
    {
        return view('schoolwebsite.saranmasukan.create', compact('SaranMasukan.create'));
    }
    public function store(SaranMasukanRequest $request)
    {
        SaranMasukan::create($request->validated());
        return redirect("/smktibazma/saran/masukan/add")->with("success", "Berhasil disimpan");
    }
}
