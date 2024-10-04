<?php

namespace App\Http\Requests\korespondensi;

use Illuminate\Foundation\Http\FormRequest;

class SuratPengajuanRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'tp' => 'nullable',
            'tanggal' => 'nullable|date',
            'no_surat' => 'nullable',
            'jenis_pengajuan' => 'nullable',
            'nama_pengajuan' => 'nullable',
            'nominal' => 'nullable',
            'file_surat' => 'nullable|mimes:pdf|file'
        ];
    }
}
