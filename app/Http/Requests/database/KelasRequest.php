<?php

namespace App\Http\Requests\database;

use Illuminate\Foundation\Http\FormRequest;

class KelasRequest extends FormRequest
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
            'id_siswa' => 'required|exists:siswa,id',
            'tahun_pelajaran' => 'required',
            'kelas' => 'nullable|in:X,XI,XII,XIII',
            'jurusan' => 'required',
            'angkatan' => 'required'
        ];
    }

    public function messages(): array
    {
        return [
            'id_siswa.required' => 'Silahkan pilih nama siswa terlebih dahulu',
            'id_siswa.exists' => 'Data siswa tidak valid',
            'angkatan.required' => 'Angkatan harus diisi',
            'tahun_pelajaran.required' => 'Tahun pelajaran harus diisi',
            'jurusan.required' => 'Jurusan harus diisi',
            'kelas.required' => 'Kelas harus dipilih',
        ];
    }
}
