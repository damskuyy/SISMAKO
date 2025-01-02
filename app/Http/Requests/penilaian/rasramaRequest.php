<?php

namespace App\Http\Requests\penilaian;

use Illuminate\Foundation\Http\FormRequest;

class rasramaRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
        // return false;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'tahun_ajaran' => 'required|string|size:9',
            // 'kelas' => 'required|string|max:5',
            'siswa_id' => 'required|string|max:40', // memastikan siswa_id ada di tabel siswa
            'semester' => 'required|string|max:10',
            'released' => 'nullable|string',
            'wname' => 'nullable|string|max:100',
            'keterangan' => 'nullable|string|max:18',
            'tahfidz' => 'nullable|array',
            'tahsin' => 'nullable|array',
            'ubudiyyah' => 'nullable|array', // memastikan ubudiyyah_id ada di tabel jamaah
            'amaliyyah' => 'nullable|array',
            'mapel' => 'nullable|array',
            'data_siswa' => 'nullable|array',
            'pengembangan_diri' => 'nullable|array',
            'sertifikat' => 'nullable|array',
        ];
    }
}
