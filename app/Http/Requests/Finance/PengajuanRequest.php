<?php

namespace App\Http\Requests\Finance;

use Illuminate\Foundation\Http\FormRequest;

class PengajuanRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
            'surat_id' => 'nullable|integer',
            'guru_id' => 'nullable|integer',
            'foto_lpj' => 'nullable|file|mimes:jpg,jpeg,png,pdf|max:5120',
            'tanggal_pengajuan' => 'required|date',
            'deskripsi' => 'required|string|max:255',
            'nominal' => 'required|numeric|min:0',
            'keterangan' => 'nullable|string',
        ];
    }
}
