@extends('layouts.app')

@section('content')
    <div class="container mt-4">
        <div class="d-flex justify-content-between mb-3">
            <div>
                <a href="{{ route('pkg.create') }}" class="btn btn-primary">Tambah PKG</a>
            </div>
            <div>
                <a href="{{ route('pkg.export') }}" class="btn btn-outline-secondary">Export PDF</a>
            </div>
        </div>

        <div class="table-responsive">
            <table class="table table-striped table-hover align-middle">
                <thead class="table-primary">
                    <tr style="text-align: center">
                        <th>No</th>
                        <th>Nama</th>
                        <th>NIP</th>
                        <th>Praktik Kinerja</th>
                        <th>Perilaku Kerja</th>
                        <th>Predikat Kinerja</th>
                        <th>Status Pengiriman</th>
                        <th style="width:140px;text-align:center">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($pkgs as $pkg)
                        <tr style="text-align: center">
                            <td>{{ ($pkgs->currentPage()-1) * $pkgs->perPage() + $loop->iteration }}</td>
                            <td>{{ $pkg->nama }}</td>
                            <td>{{ $pkg->nip }}</td>
                            <td>{{ $pkg->praktik_kinerja ?? '-' }}</td>
                            <td>{{ $pkg->perilaku_kerja ?? '-' }}</td>
                            <td>
                                @php
                                    $pred = strtolower(trim($pkg->predikat_kinerja ?? ''));
                                    $color = '#6c757d'; // default gray
                                    $label = $pkg->predikat_kinerja ?? '-';
                                    if($pred === 'sangat baik') { $color = '#28a745'; }
                                    elseif($pred === 'baik') { $color = '#17a2b8'; }
                                    elseif(str_contains($pred, 'butuh')) { $color = '#ffc107'; }
                                    elseif($pred === 'kurang') { $color = '#dc3545'; }
                                    elseif($pred === 'sangat kurang') { $color = '#343a40'; }
                                    elseif($pred === 'penilaian belum selesai') { $color = '#6c757d'; }
                                @endphp
                                <span style="display:inline-block; min-width:110px; padding:6px 16px; border-radius:8px; font-weight:600; color:#fff; background:{{ $color }}; text-align:center;">{{ ucwords($label) }}</span>
                            </td>
                            <td>{{ $pkg->status_pengiriman ?? 'Belum Dikirim' }}</td>
                            <td>
                                <div class="btn-group">
                                    <div class="col-6 col-sm-4 col-md-2 col-xl-auto me-2">
                                        <a href="{{ route('pkg.edit', $pkg->id) }}"
                                            class="btn w-100 btn-icon btn-success">
                                            <svg xmlns="http://www.w3.org/2000/svg" width="24"
                                                height="24" viewBox="0 0 24 24" fill="none"
                                                stroke="currentColor" stroke-width="2"
                                                stroke-linecap="round" stroke-linejoin="round"
                                                class="icon icon-tabler icons-tabler-outline icon-tabler-edit">
                                                <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                                                <path
                                                    d="M7 7h-1a2 2 0 0 0 -2 2v9a2 2 0 0 0 2 2h9a2 2 0 0 0 2 -2v-1" />
                                                <path
                                                    d="M20.385 6.585a2.1 2.1 0 0 0 -2.97 -2.97l-8.415 8.385v3h3l8.385 -8.415z" />
                                                <path d="M16 5l3 3" />
                                            </svg>
                                        </a>
                                    </div>
                                    <div class="col-6 col-sm-4 col-md-2 col-xl-auto me-2">
                                        <button type="button" class="btn w-100 btn-icon btn-danger" onclick="openDeleteModal('{{ route('pkg.destroy', $pkg->id) }}')" title="Hapus">
                                            <svg xmlns="http://www.w3.org/2000/svg" width="24"
                                                height="24" viewBox="0 0 24 24" fill="none"
                                                stroke="currentColor" stroke-width="2"
                                                stroke-linecap="round" stroke-linejoin="round"
                                                class="icon icon-tabler icons-tabler-outline icon-tabler-trash">
                                                <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                                                <path d="M4 7l16 0" />
                                                <path d="M10 11l0 6" />
                                                <path d="M14 11l0 6" />
                                                <path d="M5 7l1 12a2 2 0 0 0 2 2h8a2 2 0 0 0 2 -2l1 -12" />
                                                <path d="M9 7v-3a1 1 0 0 1 1 -1h4a1 1 0 0 1 1 1v3" />
                                            </svg>
                                        </button>
                                    </div>
                                    <div class="col-6 col-sm-4 col-md-2 col-xl-auto me-2">
                                        <a href="{{ route('pkg.exportSingle', $pkg->id) }}"
                                            class="btn w-100 btn-icon btn-primary">
                                            <svg xmlns="http://www.w3.org/2000/svg" width="24"
                                                height="24" viewBox="0 0 24 24" fill="none"
                                                stroke="currentColor" stroke-width="2"
                                                stroke-linecap="round" stroke-linejoin="round"
                                                class="icon icon-tabler icons-tabler-outline icon-tabler-download">
                                                <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                                                <path d="M4 17v2a2 2 0 0 0 2 2h12a2 2 0 0 0 2 -2v-2" />
                                                <path d="M7 11l5 5l5 -5" />
                                                <path d="M12 4l0 12" />
                                            </svg>
                                        </a>
                                    </div>
                                </div>
                            </td>
                            {{-- <td>
                                <div class="d-flex gap-2">
                                    <a class="btn btn-sm" style="background:#28a745; color:#fff; min-width:40px;" href="{{ route('pkg.edit', $pkg->id) }}" title="Edit">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" viewBox="0 0 24 24"><path d="M12 20h9"/><path d="M16.5 3.5a2.121 2.121 0 0 1 3 3L7 19l-4 1 1-4 12.5-12.5z"/></svg>
                                    </a>
                                    <button type="button" class="btn btn-sm" style="background:#dc3545; color:#fff; min-width:40px;" onclick="openDeleteModal('{{ route('pkg.destroy', $pkg->id) }}')" title="Hapus">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" viewBox="0 0 24 24"><polyline points="3 6 5 6 21 6"/><path d="M19 6v14a2 2 0 0 1-2 2H7a2 2 0 0 1-2-2V6m3 0V4a2 2 0 0 1 2-2h2a2 2 0 0 1 2 2v2"/></svg>
                                    </button>
                                    <a class="btn btn-sm" style="background:#007bff; color:#fff; min-width:40px;" href="{{ route('pkg.exportSingle', $pkg->id) }}" target="_blank" title="Download PDF">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" viewBox="0 0 24 24"><path d="M21 15v4a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2v-4"/><polyline points="7 10 12 15 17 10"/><line x1="12" y1="15" x2="12" y2="3"/></svg>
                                    </a>
                                </div>
                            </td> --}}
                        </tr>
                    @empty
                        <tr><td colspan="12" class="text-center">Tidak ada data PKG yang tersedia.</td></tr>
                    @endforelse
                </tbody>
            </table>
        </div>
        <div class="mt-3">{{ $pkgs->links('pagination::bootstrap-5') }}</div>
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
