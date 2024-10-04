<?php

namespace App\Http\Requests\keasramaan;

use Illuminate\Foundation\Http\FormRequest;

class KunjunganRequest extends FormRequest
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
            'nama' => 'required|string|max:100',
            'asal' => 'nullable|string|max:255',
            'tujuan' => 'nullable|string|max:255',
            'keterangan' => 'required|string',
            'no_hp' => 'required|string|max:50',
            'nama_instansi' => 'nullable|string|max:100',
            'jabatan' => 'nullable|string|max:100',
            'status_kunjungan' => 'required|in:Dinas,Tamu,OrangTua/Wali,Alumni,Industri',
        ];
    }
}
