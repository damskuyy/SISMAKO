<?php


namespace App\Http\Requests\administrasi;


use Illuminate\Foundation\Http\FormRequest;


class MapelRequest extends FormRequest
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
            'tahun_ajaran' => 'required',
            'kelas' => 'required',
            'mapel' => 'required',
            'kategori_kurikulum' => 'required',
            'CapaianPembelajaran' => 'nullable|file|max:2048',
            'TPATP' => 'nullable|file|max:2048',
            'KKTP' => 'nullable|file|max:2048',
            'KodeEtikGuru' => 'nullable|file|max:2048',
            'IkrarGuru' => 'nullable|file|max:2048',
            'TatibGuru' => 'nullable|file|max:2048',
            'PembiasaanGuru' => 'nullable|file|max:2048',
            'Kaldik' => 'nullable|file|max:2048',
            'AlokasiWaktu' => 'nullable|file|max:2048',
            'Prota' => 'nullable|file|max:2048',
            'Prosem' => 'nullable|file|max:2048',
            'JurnalAgendaGuru' => 'nullable|file|max:2048',
            'DaftarHadirSiswa' => 'nullable|file|max:2048',
            'DaftarNilaiSiswa' => 'nullable|file|max:2048',
            'PSS' => 'nullable|file|max:2048',
            'AnalisisHasilPenilaian' => 'nullable|file|max:2048',
            'PRP' => 'nullable|file|max:2048',
            'JadwalMengajarGuru' => 'nullable|file|max:2048',
            'TugasTerstruktur' => 'nullable|file|max:2048',
            'TugasTidakTerstruktur' => 'nullable|file|max:2048',
            'rpp_1' => 'nullable|file|max:2048',
            'pendukung_rpp_1' => 'nullable|file|max:2048',
            'rpp_2' => 'nullable|file|max:2048',
            'pendukung_rpp_2' => 'nullable|file|max:2048',
            'rpp_3' => 'nullable|file|max:2048',
            'pendukung_rpp_3' => 'nullable|file|max:2048',
            'rpp_4' => 'nullable|file|max:2048',
            'pendukung_rpp_4' => 'nullable|file|max:2048',
            'rpp_5' => 'nullable|file|max:2048',
            'pendukung_rpp_5' => 'nullable|file|max:2048',
            'rpp_6' => 'nullable|file|max:2048',
            'pendukung_rpp_6' => 'nullable|file|max:2048',
            'rpp_7' => 'nullable|file|max:2048',
            'pendukung_rpp_7' => 'nullable|file|max:2048',
            'rpp_8' => 'nullable|file|max:2048',
            'pendukung_rpp_8' => 'nullable|file|max:2048',
            'rpp_9' => 'nullable|file|max:2048',
            'pendukung_rpp_9' => 'nullable|file|max:2048',
            'rpp_10' => 'nullable|file|max:2048',
            'pendukung_rpp_10' => 'nullable|file|max:2048',
            'rpp_11' => 'nullable|file|max:2048',
            'pendukung_rpp_11' => 'nullable|file|max:2048',
            'rpp_12' => 'nullable|file|max:2048',
            'pendukung_rpp_12' => 'nullable|file|max:2048',
            'rpp_13' => 'nullable|file|max:2048',
            'pendukung_rpp_13' => 'nullable|file|max:2048',
        ];
    }
}
