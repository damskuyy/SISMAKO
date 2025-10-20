@extends('layouts.app')

@section('content')
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    <div class="container mt-3">
        <a href="{{ route('dashboard') }}" class="btn btn-secondary">Back</a>
        <a href="{{ route('siswa.create') }}" class="btn btn-primary">Tambah data Siswa</a>
        <form method="GET" action="{{ route('siswa.index') }}" class="mt-3 d-flex row items-center" style="gap: 5px">
            <div class="col-lg-4 col-12">
                <div class="form-group">
                    <label for="angkatan">Filter Angkatan:</label>
                    <select id="angkatan" name="angkatan" class="form-control mt-1" onchange="this.form.submit()">
                        <option value="">Semua</option>
                        @foreach ($angkatanData as $data)
                            <option value="{{ $data->angkatan }}"
                                {{ $angkatanFilter == $data->angkatan ? 'selected' : '' }}>
                                {{ $data->angkatan }}
                            </option>
                        @endforeach
                    </select>
                </div>
            </div>
        </form>
    </div>
    <div class="mt-4">
        <div class="table-responsive" style="margin-right: 20px; margin-left: 20px">
            <table class="table card-table table-vcenter text-nowrap datatable">
                <thead>
                    <tr>
                        <th>No.</th>
                        <th>Nama</th>
                        <th>Tahun Pelajaran</th>
                        <th>Jenis kelamin</th>
                        <th>Tanggal Lahir</th>
                        <th>Nisn</th>
                        <th>Nis</th>
                        <th>Angkatan</th>
                        <th>Asal Sekolah</th>
                        <th>Status</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($siswa as $data)
                        <tr>
                            <td>{{ $siswa->firstItem() + $loop->index }}</td>
                            <td>{{ $data->nama }}</td>
                            <td>{{ $data->tahun_pelajaran }}</td>
                            <td>{{ $data->jenis_kelamin }}</td>
                            <td>{{ $data->tanggal_lahir }}</td>
                            <td>{{ $data->nisn }}</td>
                            <td>{{ $data->nis }}</td>
                            <td>{{ $data->angkatan }}</td>
                            <td>{{ $data->asal_sekolah }}</td>
                            <td>{{ $data->status_siswa }}</td>
                            <td>
                                <div class="btn-list flex-nowrap">
                                    <button class="btn"><a target="_blank"
                                            href="{{ route('siswa.exportPdf', $data->id) }}"
                                            style="text-decoration: none">Export</a></button>
                                    <button class="btn rounded bg-success"><a
                                            href="{{ route('file.siswa', $data->nama) }}"><i
                                                class="bi bi-box-arrow-right text-white"></i></a></button>
                                    <button class="btn rounded bg-yellow"><a href="{{ route('siswa.edit', $data->id) }}"><i
                                                class="bi bi-pencil-square text-white"></i></a></button>
                                    <button type="button"
                                        class="btn btn-danger"
                                        onclick="openDeleteModal('{{ route('siswa.destroy', $data->id) }}')">
                                        <i class="bi bi-x-lg text-white"></i>
                                    </button>
                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="13" class="text-center">Tidak ada data siswa yang tersedia.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
        <div class="d-flex justify-content-center mt-4">
            {{ $siswa->appends(request()->except('page'))->links('vendor.pagination.bootstrap-5') }}
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

<!-- single hidden delete form used by modal -->
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
