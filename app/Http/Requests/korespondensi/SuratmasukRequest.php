<?php

namespace App\Http\Requests\korespondensi;

use Illuminate\Foundation\Http\FormRequest;

class SuratMasukRequest extends FormRequest
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
            'tp' => '',
            'tanggal' => '|date',
            'no_surat' => '',
            'jenis_surat' => '',
            'perihal' => '',
            'dari' => '',
            'file_surat' => '|mimes:pdf|file'
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
