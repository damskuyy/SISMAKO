@extends('layouts.app')

@section('content')
<div class="py-5">
    <div class="container xl-custom-container">
        <div class="row mb-4">
            <div class="col">
                <a href="/penilaian" class="btn btn-secondary">Back</a>
            </div>
            <div class="col text-end">
                <a href="{{ route('panitia.create') }}" class="btn btn-primary">Tambah</a>
            </div>
        </div>

        {{-- <form action="{{ route('panitia') }}" method="GET" class="mb-4">
            <div class="row">
                <div class="col-12 col-md-4 mb-2 mb-md-0">
                    <select name="tahun_ajaran" class="form-select" aria-label="Filter by Tahun Ajaran">
                        <option value="">Pilih Tahun Ajaran</option>
                        @for ($i = 0; $i < 10; $i++) @php $startYear=2022 + $i; // Starting from 2022
                            $endYear=$startYear + 1; // Next year $yearRange="{$startYear}-{$endYear}" ; // Format
                            as "YYYY-YYYY" @endphp <option value="{{ $yearRange }}" {{
                            request('tahun_ajaran')==$yearRange ? 'selected' : '' }}>
                            {{ $yearRange }}
                            </option>
                            @endfor
                    </select>

                </div>
                <div class="col-12 col-md-2">
                    <button type="submit" class="btn btn-primary">Filter</button>
                </div>
            </div>
        </form> --}}


        @if (session('success'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            {{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
        @endif

        <div class="card">
            <div class="table-responsive">
                <table class="table table-striped">
                    <thead>
                        <tr>
                            <th>Tahun Ajaran</th>
                            <th>Proker</th>
                            <th>Berita Acara</th>
                            <th>SK Panitia</th>
                            <th>Tatib Pengawas</th>
                            <th>Tatib Peserta</th>
                            <th>Surat Pemberitahuan Guru</th>
                            <th>Surat Pemberitahuan Siswa</th>
                            <th>Keterangan</th>
                            <th>Jadwal</th>
                            <th>Denah Ruangan</th>
                            <th>Denah Duduk</th>
                            <th>Daftar Nilai</th>
                            <th>Tanda Terima dan Penyerahan Soal</th>
                            <th>Daftar Hadir Panitia</th>
                            <th></th>
                            <th></th>
                            <th></th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($panitia as $item)
                        <tr>
                            <td>{{ $item->tahun_ajaran }}</td>
                            <td>{{ Str::limit(Str::afterLast($item->proker, '/'), 7, '...') }}</td>
                            <td>{{ Str::limit(Str::afterLast($item->ba, '/'), 7, '...') }}</td>
                            <td>{{ Str::limit(Str::afterLast($item->sk_panitia, '/'), 7, '...') }}</td>
                            <td>{{ Str::limit(Str::afterLast($item->tatib_pengawas, '/'), 7, '...') }}</td>
                            <td>{{ Str::limit(Str::afterLast($item->tatib_peserta, '/'), 7, '...') }}</td>
                            <td>{{ Str::limit(Str::afterLast($item->surat_pemberitahuan_guru, '/'), 18, '...') }}</td>
                            <td>{{ Str::limit(Str::afterLast($item->surat_pemberitahuan_ortu, '/'), 18, '...') }}</td>
                            <td>{{ Str::limit(Str::afterLast($item->keterangan, '/'), 7, '...') }}</td>
                            <td>{{ Str::limit(Str::afterLast($item->jadwal, '/'), 7, '...') }}</td>
                            <td>{{ Str::limit(Str::afterLast($item->denah_ruangan, '/'), 7, '...') }}</td>
                            <td>{{ Str::limit(Str::afterLast($item->denah_duduk, '/'), 7, '...') }}</td>
                            <td>{{ Str::limit(Str::afterLast($item->daftar_nilai, '/'), 7, '...') }}</td>
                            <td>{{ Str::limit(Str::afterLast($item->tanda_terima_dan_penerimaan_soal, '/'), 25, '...') }}</td>
                            <td>{{ Str::limit(Str::afterLast($item->kehadiran_panitia, '/'), 10, '...') }}</td>
                            <td>
                                <a href="{{ route('panitia.edit', $item->id) }}">
                                    <i class="fa-regular fa-pen-to-square text-white text-xl bg-yellow p-2 rounded"></i>
                                </a>
                            </td>
                            <td>
                                <a href="{{ route('panitia.download', $item->id) }}">
                                    <i class="fas fa-download text-white text-xl bg-green p-2 rounded"></i>
                                </a>
                            </td>
                            <td>
                                <a href="#" data-bs-toggle="modal" data-bs-target="#modal-danger-{{ $item->id }}">
                                    <i class="far fa-trash-alt text-white text-xl bg-red p-2 rounded"></i>
                                </a>
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="13" class="text-center">Tidak ada data panitia yang tersedia.</td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
            <div class="d-flex justify-content-center mt-4">
                {{ $panitia->links('vendor.pagination.bootstrap-5') }}
                <!-- Tambahkan ini untuk menampilkan tautan pagination -->
            </div>
        </div>
    </div>
</div>

<!-- Danger Modals -->
@foreach ($panitia as $item)
<form action="{{ route('panitia.delete', $item->id) }}" method="post">
    @csrf
    @method('DELETE')
    <div class="modal modal-blur fade" id="modal-danger-{{ $item->id }}" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-dialog modal-sm modal-dialog-centered" role="document">
            <div class="modal-content">
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                <div class="modal-status bg-danger"></div>
                <div class="modal-body text-center py-4">
                    <svg xmlns="http://www.w3.org/2000/svg" class="icon mb-2 text-danger icon-lg" width="24" height="24"
                        viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round"
                        stroke-linejoin="round">
                        <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                        <path d="M12 9v4"></path>
                        <path
                            d="M10.363 3.591l-8.106 13.534a1.914 1.914 0 0 0 1.636 2.871h16.214a1.914 1.914 0 0 0 1.636 -2.87l-8.106 -13.536a1.914 1.914 0 0 0 -3.274 0z">
                        </path>
                        <path d="M12 16h.01"></path>
                    </svg>
                    <h3>Are you sure?</h3>
                    <div class="text-secondary">Do you really want to remove this file? This action cannot be undone.
                    </div>
                </div>
                <div class="modal-footer">
                    <div class="w-100">
                        <div class="row">
                            <div class="col">
                                <a href="#" class="btn w-100" data-bs-dismiss="modal">Cancel</a>
                            </div>
                            <div class="col">
                                <button type="submit" class="btn btn-danger w-100">Delete</button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</form>
@endforeach
@endsection
