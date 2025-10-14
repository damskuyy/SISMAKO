@extends('layouts.app')

@section('content')
    <!-- Button to Open Modal -->
    <div class="container my-5">
        <div class="row">
            <div class="col-md-4">
                <button class="btn btn-primary btn-lg w-100 d-flex align-items-center justify-content-center gap-2 shadow" 
                    data-bs-toggle="modal" data-bs-target="#dateNisnModal" style="font-size:1.15rem;">
                    <i class="bi bi-bar-chart-line-fill" style="font-size:1.5rem;"></i>
                    Cek Progres Kemajuan Siswa
                </button>
            </div>
        </div>
    </div>

    <!-- Modal HTML -->
    <div class="modal fade" id="dateNisnModal" tabindex="-1" aria-labelledby="dateNisnModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="dateNisnModalLabel">Masukkan Detail Siswa</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form id="progresSiswaForm" action="{{ route('progres.hasil') }}" method="POST">
                        @csrf
                        <div class="mb-3">
                            <label for="nisn" class="form-label">NISN</label>
                            <input type="text" class="form-control" id="nisn" name="nisn" required>
                        </div>
                        <div class="mb-3">
                            <label for="start_date" class="form-label">Start Date</label>
                            <input type="date" class="form-control" id="start_date" name="start_date" required>
                        </div>
                        <div class="mb-3">
                            <label for="end_date" class="form-label">End Date</label>
                            <input type="date" class="form-control" id="end_date" name="end_date" required>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                            <button type="submit" class="btn btn-primary">Submit</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <div class="container my-5">
        <div class="card shadow">
            <div class="card-header bg-primary text-white">
                <b>Progres Kemajuan Siswa</b>
            </div>
            <div class="card-body">
                @if(isset($data))
                    <div class="mb-3">
                        <b>Nama:</b> {{ $data['nama'] ?? '-' }}<br>
                        <b>NISN:</b> {{ $data['nisn'] ?? '-' }}<br>
                        <b>Tahun Pelajaran:</b> {{ $data['tahun_pelajaran'] ?? '-' }}
                    </div>
                @endif
                <div class="table-responsive">
                    <table class="table table-bordered table-striped">
                        <thead>
                            <tr>
                                <th>Tanggal</th>
                                <th>Materi</th>
                                <th>Jenis</th>
                            </tr>
                        </thead>
                        <tbody>
                            @if(isset($data))
                                @forelse($data['akhlak'] as $item)
                                    <tr>
                                        <td>{{ $item->tanggal }}</td>
                                        <td>{{ $item->materi }}</td>
                                        <td>{{ $item->type }}</td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="3" class="text-center">Tidak ada data progres.</td>
                                    </tr>
                                @endforelse
                            @else
                                <tr>
                                    <td colspan="3" class="text-center">Silahkan Klik Tombol Cek Diatas.</td>
                                </tr>
                            @endif
                        </tbody>
                    </table>
                </div>
                @if(isset($data))
                    <div class="d-flex justify-content-center mt-4">
                        {{ $data['akhlak']->links('vendor.pagination.bootstrap-5') }}
                    </div>
                @endif
            </div>
        </div>
    </div>
@endsection

<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css">


