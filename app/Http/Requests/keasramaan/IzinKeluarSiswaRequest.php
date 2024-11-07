<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class IzinKeluarSiswaRequest extends FormRequest
{
    public function authorize()
    {
        return true; 
    }

    public function rules()
    {
        return [
            'tanggal' => 'required|date',
            'guru_id' => 'required|exists:guru,id',
            'siswa_id' => 'required|exists:siswa,id',
            'alasan' => 'required|string',
            'waktu_keluar' => 'required|date_format:H:i:s',
            'waktu_kembali' => 'required|date_format:H:i:s',
        ];
    }

    public function messages()
    {
        return [
            // 'tanggal.required' => 'Tanggal diperlukan.',
            // 'guru_id.required' => 'ID guru diperlukan.',
            // 'guru_id.exists' => 'ID guru tidak valid.',
            // 'siswa_id.required' => 'ID siswa diperlukan.',
            // 'siswa_id.exists' => 'ID siswa tidak valid.',
            // 'alasan.required' => 'Alasan diperlukan.',
            // 'waktu_keluar.required' => 'Waktu keluar diperlukan.',
            // 'waktu_keluar.date_format' => 'Format waktu keluar harus HH:MM:SS.',
            // 'waktu_kembali.required' => 'Waktu kembali diperlukan.',
            // 'waktu_kembali.date_format' => 'Format waktu kembali harus HH:MM:SS.',
        ];
    }
}
