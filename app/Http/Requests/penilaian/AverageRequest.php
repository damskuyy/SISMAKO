<?php

namespace App\Http\Requests\penilaian;

use Illuminate\Foundation\Http\FormRequest;

class AverageRequest extends FormRequest
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
            'kelas' => 'required|string',
            'semester' => 'required|string',
            'pai' => 'nullable|numeric|min:0|max:100',
            'pkn' => 'nullable|numeric|min:0|max:100',
            'indo' => 'nullable|numeric|min:0|max:100',
            'mtk' => 'nullable|numeric|min:0|max:100',
            'sejindo' => 'nullable|numeric|min:0|max:100',
            'bhs_asing' => 'nullable|numeric|min:0|max:100',
            'sbd' => 'nullable|numeric|min:0|max:100',
            'pjok' => 'nullable|numeric|min:0|max:100',
            'simkom' => 'nullable|numeric|min:0|max:100',
            'jk' => 'nullable|numeric|min:0|max:100',
            'sk' => 'nullable|numeric|min:0|max:100',
            'penyusunan' => 'nullable|numeric|min:0|max:100',
            'analisis' => 'nullable|numeric|min:0|max:100',
        ];
    }

    public function messages()
    {
        return [
            'tahun_ajaran.required' => 'Tahun ajaran harus diisi',
            'kelas.required' => 'Kelas harus diisi',
            'semester.required' => 'Semester harus diisi',
        ];
    }
}
