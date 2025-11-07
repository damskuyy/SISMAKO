@extends('layouts.app')


@section('content')
    <div class="px-5 py-4">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="d-flex justify-content-between p-4">
                <div>
                    <a href="/administrasi" class="btn btn-primary">Kembali</a>
                    <a href="{{ route('mapel.create') }}" class="btn btn-success">Tambah</a>
                </div>
            </div>
            <div class="d-flex justify-content-center mb-3">
                <a href="{{ route('mapel.index') }}" class="btn btn-secondary">Reset Filters</a>
            </div>
            <form method="GET" action="{{ route('mapel.index') }}" class="mb-3">
                <div class="row justify-content-center">
                    <div class="col-lg-3 col-md-4 col-sm-6 mb-3">
                        <div class="form-group">
                            <label for="tahun_ajaran">Tahun Ajaran:</label>
                            <select id="tahun_ajaran" name="tahun_ajaran" class="form-control"
                                onchange="this.form.submit()">
                                <option value="">Semua</option>
                                @foreach ($tahunAjaranOptions as $option)
                                    <option value="{{ $option }}"
                                        {{ $tahunAjaranFilter == $option ? 'selected' : '' }}>
                                        {{ $option }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="col-lg-3 col-md-4 col-sm-6 mb-3">
                        <div class="form-group">
                            <label for="kelas">Kelas:</label>
                            <select id="kelas" name="kelas" class="form-control" onchange="this.form.submit()">
                                <option value="">Semua</option>
                                @foreach ($kelasOptions as $option)
                                    <option value="{{ $option }}" {{ $kelasFilter == $option ? 'selected' : '' }}>
                                        {{ $option }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="col-lg-3 col-md-4 col-sm-6 mb-3">
                        <div class="form-group">
                            <label for="mapel">Mapel:</label>
                            <select id="mapel" name="mapel" class="form-control" onchange="this.form.submit()">
                                <option value="">Semua</option>
                                @foreach ($mapelOptions as $option)
                                    <option value="{{ $option }}" {{ $mapelFilter == $option ? 'selected' : '' }}>
                                        {{ $option }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                </div>
            </form>
            <div class="col">
                <div class="row row-cards">
                    <div class="col-12">
                        <div class="card">
                            <div class="card-header d-flex justify-content-between align-items-center">
                                <h1 class="card-title">Daftar Mata Pelajaran</h1>
                            </div>
                            <div class="table-responsive">
                                <table class="table card-table table-vcenter text-nowrap text-center">
                                    <thead>
                                        <tr>
                                            <th>No</th>
                                            <th>Tahun Ajaran</th>
                                            <th>Kelas</th>
                                            <th>Mapel</th>
                                            <th>Kategori Kurikulum</th>
                                            <th>Capaian Pembelajaran</th>
                                            <th>Tujuan Pembelajaran & Alur Tujuan Pembelajaran (TP. ATP)</th>
                                            <th>Kriteria Ketuntasan Tujuan Pembelajaran (KKTP)</th>
                                            {{-- <th>RPP</th>
                                            <th>Pendukung RPP</th> --}}
                                            {{-- <th>Kode Etik Guru</th>
                                            <th>Ikrar Guru</th>
                                            <th>Tata Tertib Guru</th>
                                            <th>Pembiasaan Guru</th>
                                            <th>Kalender Pendidikan (KALDIK)</th>
                                            <th>Alokasi Waktu</th>
                                            <th>Program Tahunan (PROTA)</th>
                                            <th>Program Semester (PROSEM)</th>
                                            <th>Jurnal Agenda Guru</th>
                                            <th>Daftar Hadir Siswa</th>
                                            <th>Daftar Nilai Siswa</th>
                                            <th>Penilaian Sikap & Spiritual (PS. S)</th>
                                            <th>Analisis Hasil Penilaian</th>
                                            <th>Program Remedial & Pengayaan (PR. P)</th>
                                            <th>Jadwal Mengajar Guru</th>
                                            <th>Tugas Terstruktur</th>
                                            <th>Tugas Tidak Terstruktur</th>
                                            <th>Daftar Evaluasi Diri Kerja Guru (DEDKG)</th>
                                            <th>Program Tindak Lanjut Kerja Guru (PTLKG)</th> --}}
                                            <th>Aksi</th> 
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @forelse ($mapels as $item)
                                            <tr>
                                                <td>{{ $loop->iteration }}</td>
                                                <td>{{ $item->tahun_ajaran }}</td>
                                                <td>{{ $item->kelas }}</td>
                                                <td>{{ $item->mapel }}</td>
                                                <td>{{ $item->kategori_kurikulum }}</td>
                                                <td>{{ Str::limit($item->capaian_pembelajaran, 20, '...') }}</td>
                                                <td>{{ Str::limit($item->tp_atp, 50, '...') }}</td>
                                                <td>{{ Str::limit($item->kktp, 40, '...') }}</td>
                                                {{-- @for ($i = 1; $i <= 13; $i++)
                                                    <td>{{ Str::limit($item->{'rpp_' . $i}, 10, '...') }}</td>
                                                    <td>{{ Str::limit($item->{'pendukung_rpp_' . $i}, 10, '...') }}</td>
                                                @endfor --}}
                                                {{-- <td>{{ Str::limit($item->kode_etik, 10, '...') }}</td>
                                                <td>{{ Str::limit($item->ikrar_guru, 10, '...') }}</td>
                                                <td>{{ Str::limit($item->tatib_guru, 10, '...') }}</td>
                                                <td>{{ Str::limit($item->pembiasaan_guru, 10, '...') }}</td>
                                                <td>{{ Str::limit($item->kaldik_sekolah, 10, '...') }}</td>
                                                <td>{{ Str::limit($item->alokasi_waktu, 10, '...') }}</td>
                                                <td>{{ Str::limit($item->program_tahunan, 10, '...') }}</td>
                                                <td>{{ Str::limit($item->program_semester, 10, '...') }}</td>
                                                <td>{{ Str::limit($item->jurnal_guru, 10, '...') }}</td>
                                                <td>{{ Str::limit($item->daftar_hadir_siswa, 10, '...') }}</td>
                                                <td>{{ Str::limit($item->daftar_nilai_siswa, 10, '...') }}</td>
                                                <td>{{ Str::limit($item->penilaian_sikap, 10, '...') }}</td>
                                                <td>{{ Str::limit($item->analisis_hasil_penilaian, 10, '...') }}</td>
                                                <td>{{ Str::limit($item->program_remedial, 10, '...') }}</td>
                                                <td>{{ Str::limit($item->jadwal_pelajaran, 10, '...') }}</td>
                                                <td>{{ Str::limit($item->tugas_terstruktur, 10, '...') }}</td>
                                                <td>{{ Str::limit($item->tugas_tidak_terstruktur, 10, '...') }}</td>
                                                <td>{{ Str::limit($item->dedkg, 10, '...') }}</td>
                                                <td>{{ Str::limit($item->ptlkg, 10, '...') }}</td> --}}
                                                <td>
                                                    <a href="{{ route('mapel.download', $item->id) }}">
                                                        <i
                                                            class="fas fa-download text-white text-xl bg-blue p-2 rounded-lg"></i>
                                                    </a>
                                                    <a href="{{ route('mapel.edit', $item->id) }}">
                                                        <i
                                                            class="fa-regular fa-pen-to-square text-white text-xl bg-yellow p-2 rounded-lg"></i>
                                                    </a>
                                                    <button type="button"
                                                        class="far fa-trash-alt text-white text-xl bg-red p-2 rounded-lg"
                                                        onclick="openDeleteModal('{{ route('mapel.destroy', $item->id) }}')">
                                                    </button>
                                                </td>
                                            </tr>
                                        @empty
                                            <tr>
                                                <td colspan="11" class="text-center">Tidak ada data mapel yang tersedia</td>
                                            </tr>
                                        @endforelse
                                    </tbody>
                                </table>
                            </div>
                            <div class="card-footer">
                                {{ $mapels->links() }}
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    @if (session('success'))
    <div class="alert alert-success alert-dismissible position-fixed" role="alert" id="alertSuccess"
        style="bottom:20px; right:20px; z-index:1080; min-width:240px;">
        <div class="d-flex">
            <div>
                <svg xmlns="http://www.w3.org/2000/svg" class="icon alert-icon" width="24" height="24"
                    viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round"
                    stroke-linejoin="round">
                    <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                    <path d="M5 12l5 5l10 -10"></path>
                </svg>
            </div>
            <div>
                {{ session('success') }}
            </div>
        </div>
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="close"
            onclick="disabledAlert()" style="cursor: pointer;"></button>
    </div>
    @endif

    <form id="deleteForm" method="POST" style="display:none;">
        @csrf
        @method('DELETE')
    </form>

    <!-- modal (standard bootstrap markup) -->
    <div class="modal modal-blur fade" id="modal-danger" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-sm modal-dialog-centered" role="document">
            <div class="modal-content">
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close" onclick="disabledModalDelete()"></button>
                <div class="modal-status bg-danger"></div>
                <div class="modal-body text-center py-4">
                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none"
                        stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                        class="icon mb-2 text-danger icon-lg">
                        <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                        <path d="M12 9v4"></path>
                        <path d="M10.363 3.591l-8.106 13.534a1.914 1.914 0 0 0 1.636 2.871h16.214a1.914 1.914 0 0 0 1.636 -2.87l-8.106 -13.536a1.914 1.914 0 0 0 -3.274 0z"></path>
                        <path d="M12 16h.01"></path>
                    </svg>
                    <h3>Are you sure?</h3>
                    <div class="text-secondary">Apakah kamu yakin ingin menghapus data ini? Data ini akan dihapus secara permanen dan tidak bisa dikembalikan.</div>
                </div>
                <div class="modal-footer">
                    <div class="w-100">
                        <div class="row">
                            <div class="col">
                                <button type="button" class="btn w-100" data-bs-dismiss="modal" onclick="disabledModalDelete()">Cancel</button>
                            </div>
                            <div class="col">
                                <button type="button" class="btn btn-danger w-100" onclick="submitDeleteForm()">Delete Data</button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script>
        function disabledAlert() {
            document.getElementById('alertSuccess').style.display = 'none';
        }
        function openDeleteModal(action) {
            const form = document.getElementById('deleteForm');
            if (!form) return console.error('Delete form not found');
            form.action = action;

            // show bootstrap modal
            const modalEl = document.getElementById('modal-danger');
            const modal = new bootstrap.Modal(modalEl);
            modal.show();
        }

        function submitDeleteForm() {
            const form = document.getElementById('deleteForm');
            if (!form || !form.action) {
                return console.error('Delete form action not set.');
            }
            form.submit();
        }

        function disabledModalDelete() {
            const modalEl = document.getElementById('modal-danger');
            const instance = bootstrap.Modal.getInstance(modalEl);
            if (instance) instance.hide();
        }
    </script>
@endsection
