<?php

namespace App\Http\Requests\korespondensi;

use Illuminate\Foundation\Http\FormRequest;

class SuratPeringatanRequest extends FormRequest
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
            'subjek' => 'nullable',
            'no_surat' => 'nullable',
            'alasan' => 'nullable',
            'sp' => 'nullable',
            'keterangan' => 'nullable',
            'file_surat' => 'nullable|mimes:pdf|file',
            'siswa' => 'nullable',
            'guru' => 'nullable',
        ];
    }

    public function messages(): array
    {
        return [
            'tp'=> 'Kolom ini wajib diisi',
            'tanggal'=> 'Kolom ini wajib diisi',
            'subjek'=> 'Kolom ini wajib diisi',
            'no_surat'=> 'Kolom ini wajib diisi',
            'alasan'=> 'Kolom ini wajib diisi',
            'sp'=> 'Kolom ini wajib diisi',
            'file_surat'=> 'Wajib upload file',
        ];
    }
}
