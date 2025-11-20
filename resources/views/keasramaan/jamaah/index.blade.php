@extends('layouts.app')

@section('content')
    @include('database.inc.form')
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">

    <div class="container mt-3">
        <div class="row">
            <div class="col-lg-4">
                <a href="/sekolah-keasramaan" class="btn btn-secondary">
                    <i class="bi bi-arrow-left"></i> Back
                </a>
                <a href="{{ route('jamaah.create') }}" class="btn btn-primary">
                    <i class="bi bi-plus-circle"></i> Tambah Data Jamaah Siswa
                </a>
            </div>
        </div>
    </div>

    <div class="container mt-3">
        <form method="GET" action="{{ route('jamaah.index') }}">
            <div class="row">
                <div class="col-md-12 mb-3">
                    <div class="row">
                        <div class="col-md-5">
                            <label class="form-label">Tanggal Awal</label>
                            <input type="date" name="start_date" class="form-control" placeholder="Start Date" value="{{ request('start_date') }}">
                        </div>
                        <div class="col-md-5">
                            <label class="form-label">Tanggal Akhir</label>
                            <input type="date" name="end_date" class="form-control" placeholder="End Date" value="{{ request('end_date') }}">
                        </div>
                        <div class="col-md-2 d-flex align-items-end">
                            @if(request()->filled('start_date') && request()->filled('end_date') && request()->filled('kelas'))
                            <div class="text-center">
                                <label class="form-label">Export data</label>
                                <a target="_blank" href="{{ route('jamaah.exportPdf.range', [
                                    'start_date' => request('start_date'),
                                    'end_date' => request('end_date'),
                                    'kelas' => request('kelas')
                                ]) }}" class="btn btn-warning text-white">
                                    <i class="bi bi-file-earmark-pdf"></i> Export Per Minggu
                                </a>
                            </div>
                            @endif
                        </div>
                    </div>
                </div>
                <div class="col-md-3">
                    <input type="date" name="tanggal" class="form-control" placeholder="Tanggal" value="{{ request('tanggal') }}">
                </div>
                <div class="col-md-3">
                    <select name="kelas" class="form-control">
                        <option value="">Pilih Kelas</option>
                        <option value="X" {{ request('kelas') == 'X' ? 'selected' : '' }}>X</option>
                        <option value="XI" {{ request('kelas') == 'XI' ? 'selected' : '' }}>XI</option>
                        <option value="XII" {{ request('kelas') == 'XII' ? 'selected' : '' }}>XII</option>
                        <option value="XIII" {{ request('kelas') == 'XIII' ? 'selected' : '' }}>XIII</option>
                    </select>
                </div>
                <div class="col-md-3">
                    <select name="sholat" class="form-control">
                        <option value="">Pilih Sholat</option>
                        <option value="Subuh" {{ request('sholat') == 'Subuh' ? 'selected' : '' }}>Subuh</option>
                        <option value="Dzuhur" {{ request('sholat') == 'Dzuhur' ? 'selected' : '' }}>Dzuhur</option>
                        <option value="Ashar" {{ request('sholat') == 'Ashar' ? 'selected' : '' }}>Ashar</option>
                        <option value="Maghrib" {{ request('sholat') == 'Maghrib' ? 'selected' : '' }}>Maghrib</option>
                        <option value="Isya" {{ request('sholat') == 'Isya' ? 'selected' : '' }}>Isya</option>
                    </select>
                </div>
                <div class="col-md-3 d-flex align-items-end">
                    <button type="submit" class="btn btn-primary">
                        <i class="bi bi-funnel"></i> Filter
                    </button>
                    <a href="{{ route('jamaah.index') }}" class="btn btn-secondary ms-2">
                        <i class="bi bi-arrow-counterclockwise"></i> Reset
                    </a>
                    @if(request()->filled('tanggal') && request()->filled('kelas'))
                    <a href="{{ route('jamaah.exportPdf.hari', [
                        'tanggal' => request('tanggal'),
                        'kelas' => request('kelas')
                    ]) }}" class="btn btn-warning text-white ms-2">
                        <i class="bi bi-file-earmark-pdf"></i> Export Per Hari
                    </a>
                    @endif
                </div>
            </div>
        </form>
    </div>

    <div class="mt-4">
        <div class="table-responsive shadow-sm" style="margin-right: 20px; margin-left: 20px">
            <table class="table table-striped table-bordered table-hover">
                <thead>
                    <tr style="text-align: center">
                        <th>Tanggal</th>
                        <th>Kelas</th>
                        <th>Sholat</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($dataJamaahSiswa as $data)
                        <tr style="text-align: center">
                            <td>{{ \Carbon\Carbon::parse($data->tanggal)->format('d-m-Y') }}</td>
                            <td>{{ $data->kelas }}</td>
                            <td>{{ $data->sholat }}</td>
                            <td>
                                <div class="btn-list" style="justify-content: center;">
                                    <a class="btn btn-primary" href="{{ route('jamaah.exportPdf', ['tanggal' => $data->tanggal, 'kelas' => $data->kelas, 'sholat' => $data->sholat]) }}">
                                        <i class="bi bi-file-earmark-pdf"></i>
                                    </a>
                                    <a class="btn btn-warning rounded" href="{{ route('jamaah.edit', ['tanggal' => $data->tanggal, 'kelas' => $data->kelas, 'sholat' => $data->sholat, 'id' => $data->id]) }}">
                                        <i class="bi bi-pencil-square"></i>
                                    </a>
                                    <button class="btn btn-danger rounded" onclick="openDeleteModal('{{ route('jamaah.destroy', $data->id) }}')">
                                        <i class="bi bi-x-lg"></i>
                                    </button>
                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="4" class="text-center">Tidak ada data jamaah yang tersedia.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
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
