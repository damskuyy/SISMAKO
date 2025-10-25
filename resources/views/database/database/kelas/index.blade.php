@extends('layouts.app')

@section('content')
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">

    <div class="container mt-3">
        <div class="row">
            <div class="col-lg-4">
                <a href="{{route('dashboard')}}" class="btn btn-secondary">Back</a>
                <a href="{{ route('kelas.create') }}" class="btn btn-primary">Tambah Data Kelas</a>
            </div>
            <form method="GET" action="{{ route('kelas.index') }}" class="mt-3 d-flex" style="gap: 20px">
                <div class="col-lg-3">
                    <div class="form-group">
                        <label for="tahun_pelajaran">Filter Tahun Pelajaran:</label>
                        <select id="tahun_pelajaran" name="tahun_pelajaran" class="form-control" onchange="this.form.submit()">
                            <option value="">Semua</option>
                            @foreach($availableTahunPelajaran as $tahun)
                                <option value="{{ $tahun }}" {{ $tahunPelajaranFilter == $tahun ? 'selected' : '' }}>{{ $tahun }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
                <div class="col-lg-3">
                    <div class="form-group">
                        <label for="kelas">Filter Kelas:</label>
                        <select id="kelas" name="kelas" class="form-control" onchange="this.form.submit()">
                            <option value="">Semua</option>
                            @foreach($availableKelas as $kelas)
                            @if($kelas != 'Lulus') <!-- Mengecualikan kelas "Lulus" -->
                            <option value="{{ $kelas }}" {{ $kelasFilter == $kelas ? 'selected' : '' }}>{{ $kelas }}</option>
                            @endif                            
                            @endforeach
                        </select>
                    </div>
                </div>
                <div class="col-lg-3">
                    <div class="form-group">
                        <label for="angkatan">Filter Angkatan:</label>
                        <select id="angkatan" name="angkatan" class="form-control" onchange="this.form.submit()">
                            <option value="">Semua</option>
                            @foreach($availableAngkatan as $angkatan)
                                <option value="{{ $angkatan }}" {{ $angkatanFilter == $angkatan ? 'selected' : '' }}>{{ $angkatan }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
                <!-- Export button -->
                <div class="col-lg-3" style="margin-top: 20px">
                    <a href="{{ route('kelas.export', ['tahun_pelajaran' => $tahunPelajaranFilter, 'kelas' => $kelasFilter, 'angkatan' => $angkatanFilter]) }}" class="btn btn-primary">Export</a>
                    <button type="button"
                        class="btn btn-success"
                        onclick="openUpgradeModal('{{ route('kelas.upgrade') }}')">
                        <i class="text-white">Naik kelas</i>
                    </button>
                    {{-- <a href="{{ route('kelas.upgrade') }}" class="btn btn-success" onclick="return confirm('Are you sure?')">Naik Kelas</a> --}}
                </div>
            </form>
        </div>
    </div>
    <div class="mt-4">
        <div class="table-responsive shadow shadow-sm" style="margin-right: 20px; margin-left: 20px">
            <table class="table card-table table-vcenter text-nowrap datatable">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Nama</th>
                        <th>Tahun Pelajaran</th>
                        <th>Kelas</th>
                        <th>Jurusan</th>
                        <th>Angkatan</th>
                        <th></th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($dataKelas as $data)
                        <tr>
                            <td>{{ $loop->iteration }}</td>
                            <td>{{ $data->siswa->nama ?? 'Tidak ada data' }}</td>
                            <td>{{ $data->tahun_pelajaran }}</td>
                            <td>{{ $data->kelas }}</td>
                            <td>{{ $data->jurusan }}</td>
                            <td>{{ $data->angkatan }}</td>
                            <td>
                                <div class="btn-list flex-nowrap">
                                    <button class="btn rounded bg-yellow"><a href="{{ route('kelas.edit', $data->id) }}"><i class="bi bi-pencil-square text-white"></i></a></button>
                                    <button type="button"
                                        class="btn btn-danger"
                                        onclick="openDeleteModal('{{ route('kelas.destroy', $data->id) }}')">
                                        <i class="bi bi-x-lg text-white"></i>
                                    </button>
                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="7" style="text-align: center">Tidak ada data kelas yang tersedia.</td>
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

        <!-- After existing delete modal -->
        <div class="modal modal-blur fade" id="modal-upgrade" tabindex="-1" aria-hidden="true">
            <div class="modal-dialog modal-sm modal-dialog-centered" role="document">
                <div class="modal-content">
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close" onclick="disabledModalUpgrade()"></button>
                    <div class="modal-status bg-success"></div>
                    <div class="modal-body text-center py-4">
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none"
                            stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                            class="icon mb-2 text-success icon-lg">
                            <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                            <path d="M9 11l3 3l8 -8"></path>
                            <path d="M20 12v6a2 2 0 0 1 -2 2h-12a2 2 0 0 1 -2 -2v-12a2 2 0 0 1 2 -2h9"></path>
                        </svg>
                        <h3>Konfirmasi Naik Kelas</h3>
                        <div class="text-secondary">Apakah Anda yakin ingin menaikkan kelas untuk semua siswa? Proses ini tidak dapat dibatalkan.</div>
                    </div>
                    <div class="modal-footer">
                        <div class="w-100">
                            <div class="row">
                                <div class="col">
                                    <button type="button" class="btn w-100" data-bs-dismiss="modal" onclick="disabledModalUpgrade()">Batal</button>
                                </div>
                                <div class="col">
                                    <button type="button" class="btn btn-success w-100" onclick="submitUpgradeForm()">Naik Kelas</button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Add upgrade form -->
        <form id="upgradeForm" method="POST" style="display:none;">
            @csrf
            @method('POST')
        </form>

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
