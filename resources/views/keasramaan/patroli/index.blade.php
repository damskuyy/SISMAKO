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
                <a href="{{ route('patroli.asrama.create') }}" class="btn btn-primary">
                    <i class="bi bi-plus-circle"></i> Tambah Data Patroli
                </a>
            </div>
        </div>
    </div>

    <div class="container mt-3">
        <form method="GET" action="{{ route('patroli.asrama.index') }}">
            <div class="row">
                <div class="col-md-4 ">
                    <input type="date" name="tanggal" class="form-control" placeholder="Tanggal" value="{{ request('tanggal') }}">
                </div>
                <div class="col-md-4 ">
                    <select name="status_patroli" class="form-control">
                        <option value="">Pilih Status Patroli</option>
                        <option value="kebersihan" {{ request('status_patroli') == 'kebersihan' ? 'selected' : '' }}>Kebersihan</option>
                        <option value="keamanan" {{ request('status_patroli') == 'keamanan' ? 'selected' : '' }}>Keamanan</option>
                        <option value="kamar asrama" {{ request('status_patroli') == 'kamar asrama' ? 'selected' : '' }}>Kamar Asrama</option>
                    </select>
                </div>
                <div class="col-md-4 d-flex align-items-end">
                    <button type="submit" class="btn btn-primary me-2">
                        <i class="bi bi-funnel"></i> Filter
                    </button>
                    <a href="{{ route('patroli.asrama.index') }}" class="btn btn-secondary">
                        <i class="bi bi-arrow-counterclockwise"></i> Reset
                    </a>
                </div>
            </div>
        </form>
    </div>

    <div class="mt-4">
        <div class="table-responsive shadow-sm" style="margin-right: 20px; margin-left: 20px">
            <table class="table table-striped table-bordered table-hover">
                <thead>
                    <tr style="text-align: center">
                        <th>No.</th>
                        <th>Tanggal Patroli</th>
                        <th>Nama Petugas / Tim</th>
                        <th>Status Patroli</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($patroliAsrama as $data)
                        <tr style="text-align: center">
                            <td>{{ $loop->iteration }}</td>
                            <td>{{ \Carbon\Carbon::parse($data->tanggal_patroli)->format('d-m-Y') }}</td>
                            <td>{{ $data->nama_patroli ?? '-' }}</td>
                            <td>{{ $data->status_patroli }}</td>
                            <td>
                                <div class="btn-list" style="justify-content: center;">
                                    <a class="btn btn-primary" href="{{ $data->dokumentasi }}" id="downloadButton" download onclick="checkDokumentasi(event, '{{ $data->dokumentasi }}')">
                                        <i class="bi bi-download"></i> Dokumentasi
                                    </a>
                                    <a class="btn btn-warning rounded" href="{{ route('patroli.asrama.edit', $data->id) }}">
                                        <i class="bi bi-pencil-square"></i>
                                    </a>
                                    <button class="btn btn-danger rounded" onclick="openDeleteModal('{{ route('patroli.asrama.destroy', $data->id) }}')">
                                        <i class="bi bi-x-lg"></i>
                                    </button>
                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="6" class="text-center">Tidak ada data patroli yang tersedia.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        <div class="alert alert-danger alert-dismissible position-fixed bottom-0 end-0 mb-3 me-3" role="alert" id="dokumentasiPathUrl" style="display: none;">
            <div class="d-flex align-items-center">
                <i class="bi bi-exclamation-circle me-2"></i>
                <div>Dokumentasi tidak tersedia.</div>
                <button type="button" class="btn-close ms-auto" data-bs-dismiss="alert" aria-label="Close" onclick="disabledAlertDokumentasiPathUrl()"></button>
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
