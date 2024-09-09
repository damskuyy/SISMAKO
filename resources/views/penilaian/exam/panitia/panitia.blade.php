@extends('layouts.app')

@section('content')
    <div class="py-5">
        <div class="container custom-container">
            <div class="row mb-4">
                <div class="col">
                    <a href="/penilaian" class="btn btn-secondary">Back</a>
                </div>
                <div class="col text-end">
                    <a href="{{ route('panitia.create') }}" class="btn btn-primary">Tambah</a>
                </div>
            </div>

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
                                <th>Kelas</th>
                                <th>Mapel</th>
                                <th>Proker</th>
                                <th>Berita Acara</th>
                                <th>SK Panitia</th>
                                <th>Tatib</th>
                                <th>Surat Pemberitahuan</th>
                                <th>Jadwal</th>
                                <th>Denah</th>
                                <th>Daftar Hadir Panitia</th>
                                <th>Tanda Terima dan Penyerahan Soal</th>
                                <th></th>
                                <th></th>
                                <th></th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($panitia as $item)
                                <tr>
                                    <td>{{ $item->tahun_ajaran }}</td>
                                    <td>{{ $item->kelas }}</td>
                                    <td>{{ $item->mapel }}</td>
                                    <td>{{ Str::limit(Str::afterLast($item->proker, '/'), 10, '...') }}</td>
                                    <td>{{ Str::limit(Str::afterLast($item->ba, '/'), 10, '...') }}</td>
                                    <td>{{ Str::limit(Str::afterLast($item->sk_panitia, '/'), 10, '...') }}</td>
                                    <td>{{ Str::limit(Str::afterLast($item->tatib, '/'), 10, '...') }}</td>
                                    <td>{{ Str::limit(Str::afterLast($item->surat_pemberitahuan, '/'), 10, '...') }}</td>
                                    <td>{{ Str::limit(Str::afterLast($item->jadwal, '/'), 10, '...') }}</td>
                                    <td>{{ Str::limit(Str::afterLast($item->denah, '/'), 10, '...') }}</td>
                                    <td>{{ Str::limit(Str::afterLast($item->kehadiran_panitia, '/'), 10, '...') }}</td>
                                    <td>{{ Str::limit(Str::afterLast($item->tanda_terima_dan_penerimaan_soal, '/'), 10, '...') }}</td>
                                    <td>
                                        <a href="{{ route('panitia.edit', $item->id) }}" class="btn btn-warning btn-sm">
                                            <i class="fas fa-edit"></i>
                                        </a>
                                    </td>
                                    <td>
                                        <a href="{{ route('panitia.download', $item->id) }}" class="btn btn-success btn-sm">
                                            <i class="fas fa-download"></i>
                                        </a>
                                    </td>
                                    <td>
                                        <button type="button" class="btn btn-danger btn-sm" data-bs-toggle="modal"
                                            data-bs-target="#modal-danger-{{ $item->id }}">
                                            <i class="fas fa-trash-alt"></i>
                                        </button>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="15" class="text-center">Tidak ada Data</td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

    <!-- Danger Modals -->
    @foreach ($panitia as $item)
        <div class="modal fade" id="modal-danger-{{ $item->id }}" tabindex="-1"
            aria-labelledby="modal-danger-label-{{ $item->id }}" aria-hidden="true">
            <div class="modal-dialog modal-sm modal-dialog-centered">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="modal-danger-label-{{ $item->id }}">Confirm Delete</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body text-center">
                        <i class="fas fa-exclamation-triangle fa-3x text-danger mb-3"></i>
                        <h4>Are you sure?</h4>
                        <p class="text-secondary">Do you really want to remove this file? This action cannot be undone.</p>
                    </div>
                    <div class="modal-footer">
                        <form action="{{ route('panitia.delete', $item->id) }}" method="POST">
                            @csrf
                            @method('DELETE')
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                            <button type="submit" class="btn btn-danger">Delete</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    @endforeach
@endsection
