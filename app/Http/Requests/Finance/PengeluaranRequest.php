<?php

namespace App\Http\Requests\Finance;

use Illuminate\Foundation\Http\FormRequest;

class PengeluaranRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
            'tanggal_pengeluaran' => 'required|date',
            'jenis' => 'required|string|max:100',
            'nama' => 'required|string|max:255',
            'nominal' => 'required|numeric|min:0',
            'keterangan' => 'nullable|string',
            'sarpras_id' => 'nullable|integer',
            'sarpras_type' => 'nullable|string',
        ];
    }
}
