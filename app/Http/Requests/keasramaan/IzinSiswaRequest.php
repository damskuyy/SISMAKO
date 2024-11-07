<?php

namespace App\Http\Requests\keasramaan;

use Illuminate\Foundation\Http\FormRequest;

class IzinSiswaRequest extends FormRequest
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
            'guru_id' => 'required|exists:guru,id',
            'siswa_id' => 'required|exists:siswa,id',
            'alasan' => 'required|string',
            'tanggal_keluar' => 'required',
            'tanggal_kembali' => 'required',
        ];
    }
}
