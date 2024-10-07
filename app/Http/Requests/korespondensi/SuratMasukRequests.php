<?php

namespace App\Http\Requests\korespondensi;

use Illuminate\Foundation\Http\FormRequest;

class SuratMasukRequests extends FormRequest
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
            'jenis_surat' => 'nullable',
            'perihal' => 'nullable',
            'dari' => 'nullable',
            'file_surat' => 'nullable|mimes:pdf|file|max:2048'
        ];
    }

    public function messages(): array
    {
        return [
            'tp'=> 'Kolom ini wajib diisi',
            'tanggal'=> 'Kolom ini wajib diisi',
            'no_surat'=> 'Kolom ini wajib diisi',
            'jenis_surat'=> 'Kolom ini wajib diisi',
            'perihal'=> 'Kolom ini wajib diisi',
            'dari'=> 'Kolom ini wajib diisi',
            'file_surat'=> 'Wajib upload file',
        ];
    }
};
