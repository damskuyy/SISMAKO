<?php

namespace App\Http\Requests\database;

use Illuminate\Foundation\Http\FormRequest;

class SiswaRequest extends FormRequest
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
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>>
     */
    public function rules(): array
    {
        return [
            'tahun_pelajaran' => 'required',
            'nama' => 'required',
            'nisn' => 'required',
            'nis' => 'required',
            'tempat_tanggal_lahir' => 'required',
            'tanggal_lahir' => 'required',
            'jenis_kelamin' => 'required',
            'agama' => 'required',
            'alamat' => 'required',
            'tanggal_masuk' => 'required',
            'nama_ayah' => 'required',
            'nama_ibu' => 'required',
            'pekerjaan_ayah' => 'required',
            'pekerjaan_ibu' => 'required',
            'no_hp_wali' => 'required',
            'diterima_di_kelas' => 'required',
            'angkatan' => 'required',
            'asal_sekolah' => 'required',
            'alamat_asal_sekolah' => 'required',
            'status_siswa' => 'required',
            'foto_kelas10' => 'file48',
            'foto_kelas11' => 'file48',
            'foto_kelas12' => 'file48',
            'rapot_kelas7' => 'file48',
            'rapot_kelas8' => 'file48',
            'rapot_kelas9' => 'file48',
            'ijazah' => 'file|max:2048',
            'surat_kelulusan' => 'file|max:2048',
            'kk' => 'file|max:2048',
            'akta_kelahiran' => 'file|max:2048',
            'surat_pernyataan_calonPesertaDidik' => 'file|max:2048',
            'surat_pernyataan_wali' => 'file|max:2048',
            'surat_pernyataan_tidak_merokok' => 'file|max:2048',
        ];
    }
}
