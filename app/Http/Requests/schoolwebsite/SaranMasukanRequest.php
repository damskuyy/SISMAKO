<?php

namespace App\Http\Requests\schoolwebsite;

use Illuminate\Foundation\Http\FormRequest;

class SaranMasukanRequest extends FormRequest
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
            "nama" => "required",
            "email" => "required",
            "status" => "required",
            "pesan" => "required"
        ];
    }

    public function messages()
    {
        return [
            "nama.required" => "Nama Satuan harus diisi",
            "email.required" => "Email harus diisi",
            "status.required" => "Status harus diisi",
            "pesan.required" => "Pesan harus diisi",
        ];
    }
}
