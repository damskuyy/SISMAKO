@extends('layouts.app')

@section('content')
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    <div class="container mt-4">
        <div class="d-flex justify-content-between mb-3">
            <div class="d-flex align-items-center">
                <a href="{{ route('finance') }}" class="btn btn-secondary me-3">Kembali</a>
            </div>
            <div>
                <a href="{{ route('finance.pengeluaran.export') }}" class="btn btn-outline-secondary me-2">Export PDF</a>
                <button type="button" class="btn btn-primary" onclick="new bootstrap.Modal(document.getElementById('modal-create-pengeluaran')).show()">Tambah Pengeluaran</button>
            </div>
        </div>
        <form method="GET" class="mb-3">
            <div class="row g-2">
                <div class="col-md-3"><input type="date" name="tanggal" class="form-control" value="{{ request('tanggal') }}"></div>
                <div class="col-md-2"><button class="btn btn-secondary">Filter</button></div>
            </div>
        </form>
        <div class="table-responsive">
        <table class="table table-striped table-hover align-middle">
            <thead><tr><th>No</th><th>Tanggal</th><th>Jenis</th><th>Nama</th><th>Nominal</th><th>Actions</th></tr></thead>
            <tbody>
                @forelse($pengeluarans as $p)
                    <tr>
                        <td>{{ ($pengeluarans->currentPage()-1) * $pengeluarans->perPage() + $loop->iteration }}</td>
                        <td>{{ $p->tanggal_pengeluaran->format('d-m-Y') }}</td>
                        <td>{{ $p->jenis }}</td>
                        <td>{{ $p->nama }}</td>
                        <td>{{ 'Rp ' . number_format($p->nominal,0,',','.') }}</td>
                        <td>
                            <div class="btn-list flex-nowrap">
                                <a class="btn rounded bg-yellow" href="#" onclick="openEditPengeluaran(this)" title="Edit"
                                    data-id="{{ $p->id }}"
                                    data-tanggal="{{ $p->tanggal_pengeluaran->format('Y-m-d') }}"
                                    data-jenis="{{ $p->jenis }}"
                                    data-nama="{{ $p->nama }}"
                                    data-nominal="{{ $p->nominal }}"
                                    data-keterangan="{{ e($p->keterangan) }}"
                                    data-sarpras_type="{{ $p->sarpras_type }}"
                                ><i class="bi bi-pencil-square text-white"></i></a>

                                <button type="button" class="btn btn-danger" onclick="openDeleteModal('{{ route('finance.pengeluaran.destroy', $p->id) }}')" title="Hapus"><i class="bi bi-x-lg text-white"></i></button>
                            </div>
                        </td>
                    </tr>
                @empty
                    <tr><td colspan="6" style="text-align: center">Tidak ada data pengeluaran yang tersedia.</td></tr>
                @endforelse
            </tbody>
        </table>
        </div>
        <div class="mt-3">{{ $pengeluarans->links('pagination::bootstrap-5') }}</div>
    </div>
    
    <!-- Create Modal -->
    <div class="modal fade" id="modal-create-pengeluaran" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-lg modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Tambah Pengeluaran</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form id="form-create-pengeluaran" method="POST" action="{{ route('finance.pengeluaran.store') }}">
                    @csrf
                    <div class="modal-body">
                        <div class="row g-3">
                            <div class="col-md-6">
                                <label class="form-label">Tanggal Pengeluaran</label>
                                <input type="date" name="tanggal_pengeluaran" class="form-control" required>
                            </div>
                            <div class="col-md-6">
                                <label class="form-label">Jenis</label>
                                <input type="text" name="jenis" class="form-control" required>
                            </div>
                            <div class="col-md-6">
                                <label class="form-label">Nama / Deskripsi</label>
                                <input type="text" name="nama" class="form-control" required value="{{ old('nama') }}">
                                @error('nama') <div class="text-danger small">{{ $message }}</div> @enderror
                            </div>
                            <div class="col-md-6">
                                <label class="form-label">Nominal</label>
                                <input type="number" name="nominal" class="form-control" id="create-pengeluaran-nominal" required step="1" min="0" value="{{ old('nominal') }}">
                                @error('nominal') <div class="text-danger small">{{ $message }}</div> @enderror
                            </div>
                            <div class="col-md-12">
                                <label class="form-label">Keterangan</label>
                                <textarea name="keterangan" class="form-control"></textarea>
                            </div>
                            <!-- Removed 'Ambil dari Sarpras' per request -->
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                        <button type="submit" class="btn btn-primary">Simpan</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <!-- Edit Modal -->
    <div class="modal fade" id="modal-edit-pengeluaran" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-lg modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Edit Pengeluaran</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form id="form-edit-pengeluaran" method="POST">
                    @csrf
                    @method('PUT')
                    <div class="modal-body">
                        <div class="row g-3">
                            <div class="col-md-6">
                                <label class="form-label">Tanggal Pengeluaran</label>
                                <input type="date" name="tanggal_pengeluaran" id="edit-pengeluaran-tanggal" class="form-control" required>
                            </div>
                            <div class="col-md-6">
                                <label class="form-label">Jenis</label>
                                <input type="text" name="jenis" id="edit-pengeluaran-jenis" class="form-control" required>
                            </div>
                            <div class="col-md-6">
                                <label class="form-label">Nama / Deskripsi</label>
                                <input type="text" name="nama" id="edit-pengeluaran-nama" class="form-control" required>
                                @error('nama') <div class="text-danger small">{{ $message }}</div> @enderror
                            </div>
                            <div class="col-md-6">
                                <label class="form-label">Nominal</label>
                                <input type="number" name="nominal" id="edit-pengeluaran-nominal" class="form-control" required step="1" min="0">
                                @error('nominal') <div class="text-danger small">{{ $message }}</div> @enderror
                            </div>
                            <div class="col-md-12">
                                <label class="form-label">Keterangan</label>
                                <textarea name="keterangan" id="edit-pengeluaran-keterangan" class="form-control"></textarea>
                            </div>
                            <!-- Removed 'Ambil dari Sarpras' from edit modal -->
                            <input type="hidden" name="id" id="edit-pengeluaran-id" />
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                        <button type="submit" class="btn btn-primary">Perbarui</button>
                    </div>
                </form>
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

    <script>
        function openEditPengeluaran(el) {
            const btn = el;
            const id = btn.dataset.id;
            const tanggal = btn.dataset.tanggal || '';
            const jenis = btn.dataset.jenis || '';
            const nama = btn.dataset.nama || '';
            const nominal = btn.dataset.nominal || '';
            const keterangan = btn.dataset.keterangan || '';
                const form = document.getElementById('form-edit-pengeluaran');
                form.action = '/finance/pengeluaran/' + id;
                document.getElementById('edit-pengeluaran-id').value = id;
                document.getElementById('edit-pengeluaran-tanggal').value = tanggal;
                document.getElementById('edit-pengeluaran-jenis').value = jenis;
                document.getElementById('edit-pengeluaran-nama').value = nama;
                document.getElementById('edit-pengeluaran-nominal').value = nominal;
                document.getElementById('edit-pengeluaran-keterangan').value = keterangan;

            const modalEl = document.getElementById('modal-edit-pengeluaran');
            const modal = new bootstrap.Modal(modalEl);
            modal.show();
        }
    </script>
    @if ($errors->any())
    <script>
        document.addEventListener('DOMContentLoaded', function(){
            @if(old('id') || old('tanggal_pengeluaran'))
                // reopen edit modal if id present
                @if(old('id'))
                    try {
                        document.getElementById('form-edit-pengeluaran').action = '/finance/pengeluaran/{{ old('id') }}';
                        document.getElementById('edit-pengeluaran-id').value = {!! json_encode(old('id')) !!};
                        document.getElementById('edit-pengeluaran-tanggal').value = {!! json_encode(old('tanggal_pengeluaran')) !!};
                        document.getElementById('edit-pengeluaran-jenis').value = {!! json_encode(old('jenis')) !!};
                        document.getElementById('edit-pengeluaran-nama').value = {!! json_encode(old('nama')) !!};
                        document.getElementById('edit-pengeluaran-nominal').value = {!! json_encode(old('nominal')) !!};
                        document.getElementById('edit-pengeluaran-keterangan').value = {!! json_encode(old('keterangan')) !!};
                        new bootstrap.Modal(document.getElementById('modal-edit-pengeluaran')).show();
                    } catch(e){ console.error(e); }
                @else
                    // reopen create modal
                    try {
                        document.getElementById('create-pengeluaran-nominal').value = {!! json_encode(old('nominal')) !!};
                        var t = {!! json_encode(old('tanggal_pengeluaran')) !!}; if (t) document.getElementsByName('tanggal_pengeluaran')[0].value = t;
                        var j = {!! json_encode(old('jenis')) !!}; if (j) document.getElementsByName('jenis')[0].value = j;
                        var n = {!! json_encode(old('nama')) !!}; if (n) document.getElementsByName('nama')[0].value = n;
                        var k = {!! json_encode(old('keterangan')) !!}; if (k) document.getElementsByName('keterangan')[0].value = k;
                        new bootstrap.Modal(document.getElementById('modal-create-pengeluaran')).show();
                    } catch(e){ console.error(e); }
                @endif
            @endif
        });
    </script>
    @endif
@endsection
