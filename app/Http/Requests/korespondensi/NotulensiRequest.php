<?php

namespace App\Http\Requests\korespondensi;

use Illuminate\Foundation\Http\FormRequest;

class NotulensiRequest extends FormRequest
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
            'tp' => 'nullable',
            'tanggal' => 'nullable|date',
            'waktu' => 'nullable',
            'daring' => 'nullable',
            'materi' => 'nullable',
            'peserta' => 'nullable',
            'pemateri' => 'nullable',
            'hasil' => 'nullable',
            'file_surat' => 'nullable|file',
            'file_dokumentasi' => 'nullable|mimes:jpg,jpeg,png|file'
        ];
    }

    public function messages(): array
    {
        return [
            'tp' => 'Kolom ini wajib diisi',
            'tanggal' => 'Kolom ini wajib diisi',
            'waktu' => 'Kolom ini wajib diisi',
            'daring' => 'Kolom ini wajib diisi',
            'materi' => 'Kolom ini wajib diisi',
            'peserta' => 'Kolom ini wajib diisi',
            'pemateri' => 'Kolom ini wajib diisi',
            'hasil' => 'Kolom ini wajib diisi',
            'file_surat' => 'Wajib upload file surat',
            'file_surat.mimes' => 'File surat harus berupa PDF',
            'file_dokumentasi.mimes' => 'File dokumentasi harus berupa JPG, JPEG, atau PNG',
        ];
    }
}
