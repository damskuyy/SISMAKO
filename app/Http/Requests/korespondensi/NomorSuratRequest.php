<?php

namespace App\Http\Requests\korespondensi;

use Illuminate\Foundation\Http\FormRequest;

class NomorSuratRequest extends FormRequest
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
            'keperluan' => 'nullable',
            'file_surat' => 'nullable|mimes:pdf|file|max:2048'
        ];
    }

    public function messages(): array
    {
        return [
            'tp.required'=> 'Kolom ini wajib diisi',
            'tanggal.required'=> 'Kolom ini wajib diisi',
            'no_surat.required'=> 'Kolom ini wajib diisi',
            'keperluan.required'=> 'Kolom ini wajib diisi',
            'file_surat.required'=> 'Wajib upload file',
        ];
    }
}
