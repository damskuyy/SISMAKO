@extends('layouts.app')

@section('content')
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    <div class="container mt-4">
        <div class="d-flex justify-content-between mb-3">
            <div class="d-flex align-items-center">
                <a href="{{ route('finance') }}" class="btn btn-secondary me-3">Kembali</a>
            </div>
            <div>
                <a href="{{ route('finance.pengajuan.export') }}" class="btn btn-outline-secondary me-2">Export PDF</a>
                <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#modal-create-pengajuan">Tambah Pengajuan</button>
            </div>
        </div>
        <!-- Create Modal -->
        <div class="modal fade" id="modal-create-pengajuan" tabindex="-1" aria-hidden="true">
            <div class="modal-dialog modal-lg modal-dialog-centered">
                <div class="modal-content">
                    <form action="{{ route('finance.pengajuan.store') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <div class="modal-header">
                            <h5 class="modal-title">Tambah Pengajuan</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            <div class="mb-3">
                                <label>Nama Guru</label>
                                <select name="guru_id" class="form-control">
                                    <option value="">-- Pilih Guru --</option>
                                    @foreach($gurus as $g)
                                        <option value="{{ $g->id }}">{{ $g->nama }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="mb-3"><label>Foto Surat LPJ</label><input type="file" name="foto_lpj" class="form-control"></div>
                            <div class="mb-3"><label>Tanggal Pengajuan</label><input type="date" name="tanggal_pengajuan" class="form-control" required></div>
                            <div class="mb-3"><label>Deskripsi</label><input type="text" name="deskripsi" class="form-control" required></div>
                            <div class="mb-3"><label>Nominal</label><input type="number" name="nominal" class="form-control" required></div>
                            <div class="mb-3"><label>Keterangan</label><textarea name="keterangan" class="form-control"></textarea></div>
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
        <div class="modal fade" id="modal-edit-pengajuan" tabindex="-1" aria-hidden="true">
            <div class="modal-dialog modal-lg modal-dialog-centered">
                <div class="modal-content">
                    <form id="form-edit-pengajuan" action="#" method="POST" enctype="multipart/form-data">
                        @csrf
                        <input type="hidden" name="_method" id="edit-method" value="PUT">
                        <div class="modal-header">
                            <h5 class="modal-title">Edit Pengajuan</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            <div class="mb-3">
                                <label>Nama Guru</label>
                                <select name="guru_id" id="edit-guru" class="form-control">
                                    <option value="">-- Pilih Guru --</option>
                                    @foreach($gurus as $g)
                                        <option value="{{ $g->id }}">{{ $g->nama }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="mb-3"><label>Foto Surat LPJ (upload jika ingin mengganti)</label><input type="file" name="foto_lpj" class="form-control"></div>
                            <div id="current-lpj" class="mb-2"></div>
                            <div class="mb-3"><label>Tanggal Pengajuan</label><input type="date" name="tanggal_pengajuan" id="edit-tanggal" class="form-control" required></div>
                            <div class="mb-3"><label>Deskripsi</label><input type="text" name="deskripsi" id="edit-deskripsi" class="form-control" required></div>
                            <div class="mb-3"><label>Nominal</label><input type="number" name="nominal" id="edit-nominal" class="form-control" required></div>
                            <div class="mb-3"><label>Keterangan</label><textarea name="keterangan" id="edit-keterangan" class="form-control"></textarea></div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                            <button type="submit" class="btn btn-primary">Simpan Perubahan</button>
                        </div>
                    </form>
                </div>
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
            <thead><tr><th>No</th><th>Tanggal</th><th>Guru</th><th>Deskripsi</th><th>Nominal</th><th>Actions</th></tr></thead>
            <tbody>
                @forelse($pengajuans as $p)
                    <tr>
                        <td>{{ ($pengajuans->currentPage()-1) * $pengajuans->perPage() + $loop->iteration }}</td>
                        <td>{{ $p->tanggal_pengajuan->format('d-m-Y') }}</td>
                        <td>{{ optional($p->guru)->nama ?? '-' }}</td>
                        <td>{{ $p->deskripsi }}</td>
                        <td>{{ 'Rp ' . number_format($p->nominal,0,',','.') }}</td>
                        <td>
                            <div class="btn-list flex-nowrap">
                                @if(!empty($p->foto_lpj))
                                    <a class="btn rounded bg-success" href="{{ url($p->foto_lpj) }}" target="_blank" title="Lihat LPJ"><i class="bi bi-file-earmark-arrow-down text-white"></i></a>
                                @endif
                                <a class="btn rounded bg-yellow" href="#" onclick="openEditPengajuan(this)" title="Edit"
                                    data-id="{{ $p->id }}"
                                    data-guru="{{ $p->guru_id }}"
                                    data-tanggal="{{ $p->tanggal_pengajuan->format('Y-m-d') }}"
                                    data-deskripsi="{{ e($p->deskripsi) }}"
                                    data-nominal="{{ $p->nominal }}"
                                    data-keterangan="{{ e($p->keterangan) }}"
                                    data-foto="{{ $p->foto_lpj }}"
                                ><i class="bi bi-pencil-square text-white"></i></a>

                                <button type="button" class="btn btn-danger" onclick="openDeleteModal('{{ route('finance.pengajuan.destroy', $p->id) }}')" title="Hapus"><i class="bi bi-x-lg text-white"></i></button>
                            </div>
                        </td>
                    </tr>
                @empty
                    <tr><td colspan="6" style="text-align: center">Tidak ada data pengajuan yang tersedia.</td></tr>
                @endforelse
            </tbody>
        </table>
        </div>
        <div class="mt-3">{{ $pengajuans->links('pagination::bootstrap-5') }}</div>
    
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
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="close" onclick="disabledAlert()" style="cursor: pointer;"></button>
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
            const el = document.getElementById('alertSuccess');
            if (el) el.style.display = 'none';
        }
        function openDeleteModal(action) {
            const form = document.getElementById('deleteForm');
            if (!form) return console.error('Delete form not found');
            form.action = action;

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

        function openEditPengajuan(el) {
            const btn = el;
            const id = btn.dataset.id;
            const guru = btn.dataset.guru || '';
            const tanggal = btn.dataset.tanggal || '';
            const deskripsi = btn.dataset.deskripsi || '';
            const nominal = btn.dataset.nominal || '';
            const keterangan = btn.dataset.keterangan || '';
            const foto = btn.dataset.foto || '';

            const form = document.getElementById('form-edit-pengajuan');
            form.action = '/finance/pengajuan/' + id;
            document.getElementById('edit-guru').value = guru;
            document.getElementById('edit-tanggal').value = tanggal;
            document.getElementById('edit-deskripsi').value = deskripsi;
            document.getElementById('edit-nominal').value = nominal;
            document.getElementById('edit-keterangan').value = keterangan;
            const current = document.getElementById('current-lpj');
            if (foto) {
                current.innerHTML = '<a href="' + foto + '" target="_blank" class="btn btn-sm btn-outline-primary">Lihat LPJ saat ini</a>';
            } else {
                current.innerHTML = '';
            }

            const modalEl = document.getElementById('modal-edit-pengajuan');
            const modal = new bootstrap.Modal(modalEl);
            modal.show();
        }
    </script>
    </div>
@endsection
