<?php

namespace App\Http\Requests\database;

use Illuminate\Foundation\Http\FormRequest;

class TendikRequest extends FormRequest
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
            'nama' => 'required',
            'no_nik' => 'required',
            'no_gtk' => 'required',
            'no_nuptk' => 'required',
            'tempat_tanggal_lahir' => 'required',
            'tanggal_lahir' => 'required',
            'jenis_kelamin' => 'required',
            'agama' => 'required',
            'alamat' => 'required',
            'status_kepegawaian' => 'required',
            'no_rekening' => 'required',
            'posisi' => 'required',
            'email' => 'required',
            'pendidikan_terakhir' => 'required',
            'tanggal_masuk' => 'required',
            'no_hp' => 'nullable',
            'foto' => 'file|max:2048',
            'foto_ktp' => 'file|max:2048',
            'foto_surat_keterangan_mengajar' => 'file|max:2048',
            'ijazah_smp' => 'file|max:2048',
            'ijazah_sma' => 'file|max:2048',
        ];
    }
}
