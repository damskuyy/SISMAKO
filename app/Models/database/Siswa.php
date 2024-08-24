<?php

namespace App\Models\database;
use App\Models\database\DataKelas;
use App\Models\database\FotoSiswa;
use App\Models\database\RapotSiswa;
use App\Models\keasramaan\JamaahSiswa;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Siswa extends Model
{
    use HasFactory;

    protected $table = 'siswa';

    protected $primaryKey = 'id';

    public $incrementing = true;

    protected $fillable = [
        'tahun_pelajaran',
        'nama',
        'nisn',
        'nis',
        'tempat_tanggal_lahir',
        'tanggal_lahir',
        'jenis_kelamin',
        'agama',
        'alamat',
        'nama_ayah',
        'nama_ibu',
        'tanggal_masuk',
        'pekerjaan_ayah',
        'pekerjaan_ibu',
        'no_hp_wali',
        'diterima_di_kelas',
        'angkatan',
        'asal_sekolah',
        'alamat_asal_sekolah',
        'path_ijazah',
        'path_surat_Kelulusan',
        'path_kk',
        'path_akta_kelahiran',
        'path_surat_pernyataan_calonPesertaDidik',
        'path_surat_pernyataan_wali',
        'path_surat_pernyataan_tidak_merokok',
        'status_siswa',
    ];

    protected $dates = ['tanggal_masuk'];

    // Relasi dengan model JamaahSiswa
    public function jamaahSiswa()
    {
        return $this->hasMany(JamaahSiswa::class, 'id_siswa', 'id');
    }

    // Relasi lainnya dengan RapotSiswa
    public function rapotSiswa()
    {
        return $this->hasMany(RapotSiswa::class, 'id_siswa', 'id');
    }

    // Relasi dengan FotoSiswa
    public function fotoSiswa()
    {
        return $this->hasMany(FotoSiswa::class, 'id_siswa', 'id');
    }

    // Relasi dengan DataKelas
    public function dataKelas()
    {
        return $this->hasMany(DataKelas::class, 'id_siswa', 'id');
    }
}
