@extends('layouts.app')

@section('content')
    <meta name="csrf-token" content="{{ csrf_token() }}">
    @include('layouts.livewire.header')

    <!-- Tambahkan Tombol "Tambah" di sini -->
    <div class="container custom-container my-3">
        <div class="row row-cards">
            <div class="col-12">
                <div class="mb-3">
                    <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#addItemModal">Tambah
                    </button>
                </div>
            </div>

            <!-- Modal untuk Pilih Barang -->
            <div class="modal modal-blur fade" id="addItemModal" tabindex="-1" aria-labelledby="addItemModalLabel"
                aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="addItemModalLabel">Pilih Barang</h5>
                            <button type="button" class="btn-close modal-close-btn" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            <select class="form-control" id="selectItem" required>
                                <option value="">Pilih Nama Barang</option>
                                @foreach ($dormPurchases as $purchase)
                                    <option value="{{ $purchase->id }}">{{ $purchase->nama_barang }}</option>
                                @endforeach
                            </select>
                            <button class="btn btn-primary mt-3" id="nextModalButton" data-bs-dismiss="modal"
                                data-bs-toggle="modal" data-bs-target="#editItemModal">Selanjutnya</button>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Modal untuk Edit Barang -->
            <div class="modal modal-blur fade" id="editItemModal" tabindex="-1" aria-labelledby="editItemModalLabel"
                aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="editItemModalLabel">Tambah Barang Rusak</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            <form id="updateItemForm" method="POST">
                                @csrf
                                <!-- method spoof field is toggled by JS: empty for create (POST), 'PUT' for edit -->
                                <input type="hidden" name="_method" id="_method_field" value="PUT">
                                <div class="mb-3">
                                    <label for="jumlah_rusak" class="form-label">Jumlah Rusak</label>
                                    <input type="number" class="form-control" id="jumlah_rusak" name="jumlah_rusak" required>
                                </div>
                                <div class="mb-3">
                                    <label for="keterangan" class="form-label">Keterangan</label>
                                    <textarea class="form-control" id="keterangan" name="keterangan" rows="3"></textarea>
                                </div>
                                <div class="info-container mb-3">
                                    <p class="mb-1">Nama barang: <strong id="itemName">-</strong></p>
                                    <p class="mb-3">Jumlah baik tersedia: <strong id="availableCount">-</strong></p>
                                </div>
                                <button type="submit" class="btn btn-primary ms-auto">Simpan</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Confirmation modal for restore (match school style) -->
            <div class="modal modal-blur fade" id="confirmRestoreModal" tabindex="-1" aria-hidden="true">
                <div class="modal-dialog modal-sm modal-dialog-centered" role="document">
                    <div class="modal-content">
                        <div class="modal-status bg-danger"></div>
                        <div class="modal-body text-center py-4">
                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="currentColor" class="icon mb-2 text-danger icon-lg mx-auto icon-tabler-alert-triangle">
                                <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                                <path d="M12 1.67c.955 0 1.845 .467 2.39 1.247l.105 .16l8.114 13.548a2.914 2.914 0 0 1 -2.307 4.363l-.195 .008h-16.225a2.914 2.914 0 0 1 -2.582 -4.2l.099 -.185l8.11 -13.538a2.914 2.914 0 0 1 2.491 -1.403zm.01 13.33l-.127 .007a1 1 0 0 0 0 1.986l.117 .007l.127 -.007a1 1 0 0 0 0 -1.986l-.117 -.007zm-.01 -7a1 1 0 0 0 -.993 .883l-.007 .117v4l.007 .117a1 1 0 0 0 1.986 0l.007 -.117v-4l-.007 -.117a1 1 0 0 0 -.993 -.883z" />
                            </svg>
                            <h3 id="confirmRestoreTitle">Apakah Anda Yakin?</h3>
                            <div class="text-secondary" id="confirmRestoreText">Mengembalikan barang rusak akan menambah jumlah barang baik dan mengosongkan jumlah rusak.</div>
                        </div>
                        <div class="modal-footer">
                            <div class="w-100">
                                <div class="row">
                                    <div class="col"><button type="button" class="btn w-100" data-bs-dismiss="modal">Batal</button></div>
                                    <div class="col">
                                        <form id="restoreForm" method="POST" class="w-100">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-danger w-100">Kembalikan</button>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-12">
                <div class="card" style="height: 60vh;">
                    <div class="card-body card-body-scrollable card-body-scrollable-shadow p-0 rounded">
                        <style>
                            .table-responsive {
                                position: relative;
                                height: 59vh;
                                overflow-y: auto;
                            }

                            .table-responsive thead th {
                                position: sticky;
                                top: 0;
                                z-index: 1;
                                background: white;
                            }

                            .table-responsive tbody tr:nth-child(odd) {
                                background-color: #f9f9f9;
                            }

                            .table th,
                            .table td {
                                white-space: nowrap;
                            }

                            .table th.w-4,
                            .table td.w-4 {
                                width: 4%;
                            }

                            .table th.w-10,
                            .table td.w-10 {
                                width: 15%;
                            }

                            .table th.w-20,
                            .table td.w-20 {
                                width: 30%;
                            }

                            .table th.w-15,
                            .table td.w-15 {
                                width: 20%;
                            }
                        </style>
                        <div class="table-responsive">
                            <table class="table table-vcenter card-table">
                                <thead>
                                    <tr>
                                        <th class="w-4">No</th>
                                        <th class="w-10">Tanggal Pembelian</th>
                                        <th class="w-15">Nama Barang</th>
                                        <th class="w-10">Kode Barang</th>
                                        <th class="w-10">Jumlah</th>
                                        <th class="w-10">Status</th>
                                        <th class="w-20">Keterangan</th>
                                        <th class="w-15">Aksi</th>
                                    </tr>
                                </thead>
                                @php
                                    $i = 1;
                                    $dataExists = false;
                                @endphp
                                @foreach ($dormPurchases as $item)
                                    @if ($item->jumlah_rusak > 0)
                                        @php
                                            $dataExists = true;
                                        @endphp
                                        <tr data-row-id="{{ $item->id }}">
                                            <td>{{ $i++ }}</td>
                                            <td>{{ $item->tanggal_pembelian }}</td>
                                            <td>{{ $item->nama_barang }}</td>
                                            <td>{{ $item->kode }}</td>
                                            <td>{{ $item->jumlah_rusak }}</td>
                                            <td>
                                                <span class="badge bg-red text-red-fg">Rusak</span>
                                            </td>
                                            <td>{{ $item->keterangan }}</td>
                                            <td>
                                                <div class="btn-group">
                                                    <!-- Edit button -->
                                                    <button type="button" 
                                                        class="btn btn-icon btn-success editDamagedBtn"
                                                        data-id="{{ $item->id }}" 
                                                        data-jumlah="{{ $item->jumlah_rusak }}"
                                                        data-keterangan="{{ $item->keterangan }}"
                                                        data-name="{{ $item->nama_barang }}"
                                                        data-available="{{ $item->jumlah_baik }}"
                                                        title="Edit barang rusak">
                                                        <!-- Download SVG icon from http://tabler-icons.io/i/edit -->
                                                        <svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                                                            <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                                                            <path d="M7 7h-1a2 2 0 0 0 -2 2v9a2 2 0 0 0 2 2h9a2 2 0 0 0 2 -2v-1"></path>
                                                            <path d="M20.385 6.585a2.1 2.1 0 0 0 -2.97 -2.97l-8.415 8.385v3h3l8.385 -8.415z"></path>
                                                            <path d="M16 5l3 3"></path>
                                                        </svg>
                                                    </button>
                                                    <!-- Restore button (opens confirmation modal) -->
                                                    <button type="button" class="btn btn-icon btn-primary ms-2 restoreBtn"
                                                        data-id="{{ $item->id }}"
                                                        data-name="{{ $item->nama_barang }}"
                                                        data-jumlah="{{ $item->jumlah_rusak }}"
                                                        title="Kembalikan ke kondisi baik">
                                                        <!-- Refresh icon -->
                                                        <svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                                                            <path stroke="none" d="M0 0h24v24H0z" fill="none"/>
                                                            <path d="M20 11a8.1 8.1 0 0 0 -15.5 -2m-.5 -4v4h4" />
                                                            <path d="M4 13a8.1 8.1 0 0 0 15.5 2m.5 4v-4h-4" />
                                                        </svg>
                                                    </button>
                                                </div>
                                            </td>
                                            <div class="modal modal-blur fade" id="modal-delete-{{ $item->id }}" tabindex="-1" style="display: none;" aria-hidden="true">
                                                <div class="modal-dialog modal-sm modal-dialog-centered" role="document">
                                                    <form action="{{ route('school-purchases.destroy', $item->id) }}"
                                                        method="post">
                                                        @csrf
                                                        @method('delete')
                                                        <div class="modal-content">
                                                            <button type="button" class="btn-close"
                                                                data-bs-dismiss="modal" aria-label="Close"></button>
                                                            <div class="modal-status bg-danger"></div>
                                                            <div class="modal-body text-center py-4">
                                                                <!-- Download SVG icon from http://tabler-icons.io/i/alert-triangle -->
                                                                <svg xmlns="http://www.w3.org/2000/svg" width="24"
                                                                    height="24" viewBox="0 0 24 24"
                                                                    fill="currentColor"
                                                                    class="icon mb-2 text-danger icon-lg mx-auto icon-tabler-alert-triangle">
                                                                    <path stroke="none" d="M0 0h24v24H0z"
                                                                        fill="none" />
                                                                    <path
                                                                        d="M12 1.67c.955 0 1.845 .467 2.39 1.247l.105 .16l8.114 13.548a2.914 2.914 0 0 1 -2.307 4.363l-.195 .008h-16.225a2.914 2.914 0 0 1 -2.582 -4.2l.099 -.185l8.11 -13.538a2.914 2.914 0 0 1 2.491 -1.403zm.01 13.33l-.127 .007a1 1 0 0 0 0 1.986l.117 .007l.127 -.007a1 1 0 0 0 0 -1.986l-.117 -.007zm-.01 -7a1 1 0 0 0 -.993 .883l-.007 .117v4l.007 .117a1 1 0 0 0 1.986 0l.007 -.117v-4l-.007 -.117a1 1 0 0 0 -.993 -.883z" />
                                                                </svg>
                                                                <h3>Apakah Anda Yakin?</h3>
                                                                <div class="text-secondary">Apakah Anda
                                                                    benar-benar ingin menghapus data ini?
                                                                    Apa
                                                                    yang telah Anda lakukan tidak dapat
                                                                    dibatalkan.</div>
                                                            </div>
                                                            <div class="modal-footer">
                                                                <div class="w-100">
                                                                    <div class="row">
                                                                        <div class="col"><a href="#"
                                                                                class="btn w-100" data-bs-dismiss="modal">
                                                                                Batal
                                                                            </a></div>
                                                                        <div class="col"> <button type="submit"
                                                                                class="btn btn-danger w-100"
                                                                                data-bs-dismiss="modal">
                                                                                Hapus
                                                                            </button>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </form>
                                                </div>
                                            </div>
                                        </tr>
                                    @endif
                                @endforeach
                                @if (!$dataExists)
                                    <tr>
                                        <td colspan="8" class="text-center">Tidak ada data sarpras rusak tersedia.</td>
                                    </tr>
                                @endif
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    @session('success')
        <div class="alert alert-important alert-success alert-dismissible position-absolute bottom-0 end-0 me-3" role="alert">
            <div class="d-flex">
                <div>
                    <!-- Download SVG icon from http://tabler-icons.io/i/check -->
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
            <a class="btn-close" data-bs-dismiss="alert" aria-label="close"></a>
        </div>
    @endsession

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            var selectedItemId;

            // Handle modal cleanup when hidden
            document.querySelectorAll('.modal').forEach(function(modal) {
                modal.addEventListener('hidden.bs.modal', function() {
                    document.body.classList.remove('modal-open');
                    const backdrop = document.querySelector('.modal-backdrop');
                    if (backdrop) backdrop.remove();
                });
            });

            document.getElementById('nextModalButton').addEventListener('click', function() {
                selectedItemId = document.getElementById('selectItem').value;

                if (selectedItemId) {
                    fetch(`/sarpras/get-dorm-item-details/${selectedItemId}`)
                        .then(response => response.json())
                        .then(resp => {
                            var data = resp.data || resp;

                            // prepare modal for creating damaged record for selected item
                            var form = document.getElementById('updateItemForm');
                            // Update item details display
                            document.getElementById('itemName').textContent = data.nama_barang || '-';
                            document.getElementById('availableCount').textContent = data.jumlah_baik || '0';
                            document.getElementById('jumlah_rusak').value = '';
                            document.getElementById('keterangan').value = data.keterangan || '';
                            form.action = `${window.location.origin}/sarpras/damaged-items-dorm/${selectedItemId}`;
                            // for create, ensure method spoof is cleared so the request becomes POST
                            var methodField = document.getElementById('_method_field');
                            if (methodField) methodField.value = '';
                            form.method = 'POST';

                            var editModal = new bootstrap.Modal(document.getElementById(
                                'editItemModal'));
                            editModal.show();
                        })
                        .catch(err => console.error('Failed to load item details:', err));
                }
            });

            // Restore button opens confirmation modal (school-style)
            document.querySelectorAll('.restoreBtn').forEach(function(btn) {
                btn.addEventListener('click', function() {
                    const id = this.dataset.id;
                    const name = this.dataset.name || 'barang ini';
                    const modalEl = document.getElementById('confirmRestoreModal');
                    const titleEl = document.getElementById('confirmRestoreTitle');
                    const textEl = document.getElementById('confirmRestoreText');
                    const restoreForm = document.getElementById('restoreForm');

                    // Update modal text
                    titleEl.textContent = 'Apakah Anda Yakin?';
                    textEl.textContent = `Yakin ingin mengembalikan ${name} ke kondisi baik? Jumlah rusak akan dikembalikan ke stok barang baik.`;

                    // Set form action to DELETE route
                    restoreForm.action = `${window.location.origin}/sarpras/damaged-items-dorm/${id}`;

                    var confirmModal = new bootstrap.Modal(modalEl);
                    confirmModal.show();
                });
            });

            // Edit damaged item buttons (existing damaged rows)
            document.querySelectorAll('.editDamagedBtn').forEach(function(btn) {
                btn.addEventListener('click', function() {
                    var id = this.dataset.id;
                    var jumlah = this.dataset.jumlah;
                    var keterangan = this.dataset.keterangan || '';

                    var form = document.getElementById('updateItemForm');
                    form.action = `${window.location.origin}/sarpras/damaged-items-dorm/${id}`;
                    // for edit, set method spoof to PUT
                    var methodField = document.getElementById('_method_field');
                    if (methodField) methodField.value = 'PUT';
                    form.method = 'POST';

                    // populate simple fields from data- attributes
                    document.getElementById('jumlah_rusak').value = jumlah;
                    document.getElementById('keterangan').value = keterangan;
                    // Set modal title to Edit
                    var titleEl = document.getElementById('editItemModalLabel');
                    if (titleEl) titleEl.textContent = 'Edit Barang Rusak';

                    // Populate item info if available on button
                    var name = this.dataset.name || '-';
                    var available = this.dataset.available || '-';
                    var itemNameEl = document.getElementById('itemName');
                    var availableEl = document.getElementById('availableCount');
                    if (itemNameEl) itemNameEl.textContent = name;
                    if (availableEl) availableEl.textContent = available;

                    var editModal = new bootstrap.Modal(document.getElementById('editItemModal'));
                    editModal.show();
                });
            });

            // Restore handled via form submit (match school view) — no AJAX notification

            // Handle close button clicks
            document.querySelectorAll('.modal-close-btn').forEach(function(btn) {
                btn.addEventListener('click', function() {
                    const modal = this.closest('.modal');
                    const bsModal = bootstrap.Modal.getInstance(modal);
                    if (bsModal) {
                        bsModal.hide();
                        // Ensure cleanup
                        setTimeout(() => {
                            document.body.classList.remove('modal-open');
                            const backdrop = document.querySelector('.modal-backdrop');
                            if (backdrop) backdrop.remove();
                        }, 100);
                    }
                });
            });

            @if ($errors->any())
                var myModal = new bootstrap.Modal(document.getElementById('addItemModal'));
                myModal.show();
            @endif
        });
    </script>
@endsection
