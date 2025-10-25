@extends('layouts.app')

@section('content')
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">

    <div class="container mt-3">
        <div class="row">
            <div class="col-lg-4">
                <a href="{{route('pkl')}}" class="btn btn-secondary">Back</a>
                <a href="{{ route('pkl.siswa.create') }}" class="btn btn-primary">Tambah Data Siswa</a>
            </div>
        </div>
    </div>

    <div class="container mt-4">
        <form action="{{ route('pkl.siswa.index') }}" method="GET" id="filterForm">
            <div class="row">
                <div class="col-lg-4">
                    <select name="filter_perusahaan" class="form-control" onchange="document.getElementById('filterForm').submit();">
                        <option value="">Semua Perusahaan</option>
                        @foreach ($perusahaanList as $perusahaan)
                            <option value="{{ $perusahaan }}" {{ request('filter_perusahaan') == $perusahaan ? 'selected' : '' }}>{{ $perusahaan }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="col-lg-4">
                    <button type="submit" class="btn btn-primary">Filter</button>
                </div>
            </div>
        </form>
    </div>

    <div class="mt-4">
        <div class="table-responsive shadow shadow-sm" style="margin-right: 20px; margin-left: 20px">
            <table class="table card-table table-vcenter text-nowrap datatable">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Nama</th>
                        <th>Nomor NISN</th>
                        <th>Perusahaan Tempat PKL</th>
                        <th></th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($dataPklSiswa as $data)
                        <tr>
                            <td>{{$loop->iteration}}</td>
                            <td>{{$data->nama}}</td>
                            <td>{{$data->nisn}}</td>
                            <td>{{ $data->tempat_pkl }}</td>
                            <td>
                                <div class="btn-list flex-nowrap">
                                    <button class="btn rounded bg-success"><a href="{{route('file.siswa.sekolah', $data->id)}}"><i class="bi bi-box-arrow-right text-white"></i></a></button>
                                    <button class="btn rounded bg-yellow"><a href="{{ route('pkl.siswa.edit', $data->id) }}"><i class="bi bi-pencil-square text-white"></i></a></button>
                                    <button type="button" class="btn btn-danger"
                                        onclick="openDeleteModal('{{ route('pkl.siswa.destroy', $data->id) }}')">
                                        <i class="bi bi-x-lg text-white"></i>
                                    </button>
                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="7" style="text-align: center">Tidak ada data siswa PKL yang tersedia.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
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
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="close" onclick="disabledAlert()"
                    style="cursor: pointer;"></button>
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
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"
                        onclick="disabledModalDelete()"></button>
                    <div class="modal-status bg-danger"></div>
                    <div class="modal-body text-center py-4">
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none"
                            stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                            class="icon mb-2 text-danger icon-lg">
                            <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                            <path d="M12 9v4"></path>
                            <path
                                d="M10.363 3.591l-8.106 13.534a1.914 1.914 0 0 0 1.636 2.871h16.214a1.914 1.914 0 0 0 1.636 -2.87l-8.106 -13.536a1.914 1.914 0 0 0 -3.274 0z">
                            </path>
                            <path d="M12 16h.01"></path>
                        </svg>
                        <h3>Are you sure?</h3>
                        <div class="text-secondary">Apakah kamu yakin ingin menghapus data ini? Data ini akan dihapus secara
                            permanen dan tidak bisa dikembalikan.</div>
                    </div>
                    <div class="modal-footer">
                        <div class="w-100">
                            <div class="row">
                                <div class="col">
                                    <button type="button" class="btn w-100" data-bs-dismiss="modal"
                                        onclick="disabledModalDelete()">Cancel</button>
                                </div>
                                <div class="col">
                                    <button type="button" class="btn btn-danger w-100" onclick="submitDeleteForm()">Delete
                                        Data</button>
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

            // Add these functions to your existing script section
            function openUpgradeModal(action) {
                const form = document.getElementById('upgradeForm');
                if (!form) return console.error('Upgrade form not found');
                form.action = action;

                // show bootstrap modal
                const modalEl = document.getElementById('modal-upgrade');
                const modal = new bootstrap.Modal(modalEl);
                modal.show();
            }

            function submitUpgradeForm() {
                const form = document.getElementById('upgradeForm');
                if (!form || !form.action) {
                    return console.error('Upgrade form action not set.');
                }
                form.submit();
            }

            function disabledModalUpgrade() {
                const modalEl = document.getElementById('modal-upgrade');
                const instance = bootstrap.Modal.getInstance(modalEl);
                if (instance) instance.hide();
            }
        </script>

    <script>
        function disabledAlert() {
            document.getElementById('alertSuccess').style.display = 'none';
        }
    </script>
    </div>
@endsection
