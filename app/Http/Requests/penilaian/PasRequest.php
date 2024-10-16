<?php

namespace App\Http\Requests\penilaian;

use Illuminate\Foundation\Http\FormRequest;

class PasRequest extends FormRequest
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
            'tahun_ajaran' => 'required|string',
            'kelas' => 'nullable|string',
            'mapel' => 'nullable|string',
            'kisi_kisi' => 'nullable|file|max:2056',
            'soal' => 'nullable|file|max:2056',
            'jawaban' => 'nullable|file|max:2056',
            'proker' => 'nullable|file|max:2056',
            'kehadiran' => 'nullable|file|max:2056',
            'ba' => 'nullable|file|max:2056',
            'sk_panitia' => 'nullable|file|max:2056',
            'tatib_pengawas' => 'nullable|file|max:2056',
            'tatib_peserta' => 'nullable|file|max:2056',
            'keterangan' => 'nullable|file|max:2056',
            'surat_pemberitahuan_guru' => 'nullable|file|max:2056',
            'surat_pemberitahuan_ortu' => 'nullable|file|max:2056',
            'jadwal' => 'nullable|file|max:2056',
            'daftar_nilai' => 'nullable|file|max:2056',
            'tanda_terima_dan_penerimaan_soal' => 'nullable|file|max:2056',
            'denah_ruangan' => 'nullable|file|max:2056',
            'denah_duduk' => 'nullable|file|max:2056',
            'kehadiran_panitia' => 'nullable|file|max:2056',
        ];
    }

    public function messages()
    {
        return [
            'tahun_ajaran.required' => 'Tahun ajaran harus diisi',
        ];
    }
}
