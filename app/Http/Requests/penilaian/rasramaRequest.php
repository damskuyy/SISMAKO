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
            'kelas' => 'required|string|max:50',
            'nama' => 'required|string|max:100',
            'semester' => 'required|string|max:10',
            'nik' => 'nullable|string|max:50',
            'released' => 'nullable|string',
            'wname' => 'nullable|string|max:100',
            'keterangan' => 'nullable|string|max:18',
            'tahfidz' => 'nullable|array',
            'tahsin' => 'nullable|array',
            'ubudiyyah' => 'nullable|array',
            'ubudiyyah.*.hadir' => 'nullable|integer',
            'ubudiyyah.*.total' => 'nullable|integer',
            'ubudiyyah.*.jenis' => 'nullable|string',
            'ubudiyyah.*.deskripsi_sholat' => 'nullable|string',
            'ubudiyyah.*.deskripsi_kegiatan' => 'nullable|string',
            'amaliyyah' => 'nullable|array',
            'mapel' => 'nullable|array',
            'data_siswa' => 'nullable|array',
            'pengembangan_diri' => 'nullable|array',
            'sertifikat' => 'nullable|array',
        ];
    }
}
