<?php

namespace App\Http\Requests\penilaian;

use Illuminate\Foundation\Http\FormRequest;

class PatRequest extends FormRequest
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
            [
                'tahun_ajaran' => 'required',
                'kelas' => 'required',
                'mapel' => 'required',
                'kisi_kisi' => 'file|max:2056',
                'soal' => 'file|max:2056',
                'jawaban' => 'file|max:2056',
                'proker' => 'file|max:2056',
                'kehadiran' => 'file|max:2056',
                'ba' => 'file|max:2056',
                'sk_panitia' => 'file|max:2056',
                'tatib' => 'file|max:2056',
                'surat_pemberitahuan' => 'file|max:2056',
                'jadwal' => 'file|max:2056',
                'daftar_nilai' => 'file|max:2056',
                'tanda_terima_dan_penerimaan_soal' => 'file|max:2056',
                'kehadiran_panitia' => 'file|max:2056',
            ],
            [
                'tahun_ajaran.required' => 'Tahun ajaran harus diisi',
                'kelas.required' => 'Kelas harus diisi',
                'mapel.required' => 'Mapel harus diisi',
            ]
        ];
    }

    public function messages()
    {
        return [
            'tahun_ajaran.required' => 'Tahun ajaran harus diisi',
            'kelas.required' => 'Kelas harus diisi',
            'mapel.required' => 'Mapel harus diisi',
        ];
    }
}
