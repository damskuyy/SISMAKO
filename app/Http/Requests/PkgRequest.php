<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class PkgRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
            'nama' => 'required|string|max:255',
            'nip' => ['nullable','regex:/^[0-9]+$/','max:50'],
            'mapel' => 'nullable|string|max:255',
            'jabatan' => 'nullable|string|max:255',
            'periode_penilaian' => 'nullable|string|max:255',

            'penilai_nama' => 'nullable|string|max:255',
            'penilai_nip' => ['nullable','regex:/^[0-9]+$/','max:50'],
            'penilai_jabatan' => 'nullable|string|max:255',

            'kompetensi_pedagogik' => 'nullable|integer|min:1|max:5',
            'kompetensi_kepribadian' => 'nullable|integer|min:1|max:5',
            'kompetensi_profesional' => 'nullable|integer|min:1|max:5',
            'kompetensi_sosial' => 'nullable|integer|min:1|max:5',
            'kompetensi_keterangan' => 'nullable|string',

            'praktik_kinerja' => 'nullable|string',
            'praktik_keterangan' => 'nullable|string',
            'perilaku_kerja' => 'nullable|string',
            'perilaku_keterangan' => 'nullable|string',
            'predikat_kinerja' => 'nullable|string',
            'predikat_keterangan' => 'nullable|string',

            'kekuatan_guru' => 'nullable|string',
            'area_peningkatan' => 'nullable|string',
            'rekomendasi_tingkat_lanjut' => 'nullable|string',
            'foto_dokumentasi_kegiatan' => 'nullable|file|image|max:5120',
        ];
    }
}
