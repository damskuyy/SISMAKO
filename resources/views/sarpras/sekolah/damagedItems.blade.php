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
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            <select class="form-control" id="selectItem" required>
                                <option value="">Pilih Nama Barang</option>
                                @forelse ($schoolPurchases as $purchase)
                                    <option value="{{ $purchase->id }}">{{ $purchase->nama_barang }}</option>
                                @empty
                                    <option value="">Tidak ada data</option>
                                @endforelse
                            </select>
                            <button class="btn btn-primary mt-3" id="nextModalButton" data-bs-dismiss="modal"
                                data-bs-toggle="modal" data-bs-target="#editItemModal">Selanjutnya</button>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Confirmation modal for restore -->
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
                                <!-- method spoofing: default to POST (create); JS will set to PUT for edits -->
                                <input type="hidden" name="_method" id="_method_field" value="POST">
                                <div class="mb-3">
                                    <label for="jumlah_rusak" class="form-label">Jumlah Rusak</label>
                                    <input type="number" class="form-control" id="jumlah_rusak" name="jumlah_rusak"
                                        min="1" required>
                                    @error('jumlah_rusak')
                                        <div class="text-danger mt-2">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="mb-3">
                                    <label for="keterangan" class="form-label">Keterangan</label>
                                    <input type="text" class="form-control" id="keterangan" name="keterangan" required>
                                    @error('keterangan')
                                        <div class="text-danger mt-2">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="mb-2">
                                    <p id="item_name" class="mb-1"></p>
                                    <p id="available_items" class="mb-0 text-muted"></p>
                                </div>
                            </form>
                        </div>
                        <div class="modal-footer">
                            <button type="submit" class="btn btn-primary" id="submitForm" form="updateItemForm">Simpan</button>
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
                                        <th class="w-10">Aksi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @php
                                        $i = 1;
                                        $dataExists = false;
                                    @endphp
                                    @foreach ($schoolPurchases as $item)
                                        @if ($item->jumlah_rusak > 0)
                                            @php
                                                $dataExists = true;
                                            @endphp
                                            <tr>
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
                                                <div class="modal modal-blur fade" id="modal-delete-{{ $item->id }}"
                                                tabindex="-1" style="display: none;" aria-hidden="true">
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
                                                                                </button></div>
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

            document.querySelectorAll('.modal').forEach(function(modal) {
                modal.addEventListener('hidden.bs.modal', function() {
                    document.body.classList.remove('modal-open');
                    const backdrop = document.querySelector('.modal-backdrop');
                    if (backdrop) backdrop.remove();
                });
            });

            document.getElementById('nextModalButton').addEventListener('click', function() {
                selectedItemId = document.getElementById('selectItem').value;

                if (!selectedItemId) {
                    // No item selected — show a simple alert and don't proceed
                    alert('Pilih nama barang terlebih dahulu.');
                    return;
                }

                // Set the form action immediately so the form has a valid target
                const form = document.getElementById('updateItemForm');
                const baseUrl = window.location.protocol + '//' + window.location.host;
                form.action = `${baseUrl}/sarpras/damaged-items-school/${selectedItemId}`;
                console.log('Form action set to:', form.action);

                // Then try to fetch extra details (optional). If fetch fails, still open modal.
                fetch(`/sarpras/get-item-details/${selectedItemId}`)
                    .then(response => {
                        if (!response.ok) {
                            throw new Error('Network response was not ok');
                        }
                        return response.json();
                    })
                    .then(response => {
                        if (response.status === 'success') {
                            const data = response.data;
                            // Populate fields if the elements exist
                            const availEl = document.getElementById('available_items');
                            const nameEl = document.getElementById('item_name');
                            if (availEl) availEl.textContent = `Jumlah baik tersedia: ${data.jumlah_baik}`;
                            if (nameEl) nameEl.textContent = `Nama barang: ${data.nama_barang}`;
                        }
                    })
                    .catch(err => {
                        console.warn('Could not load item details:', err);
                    })
                    .finally(() => {
                        // Reset input fields and show modal regardless of fetch outcome
                        document.getElementById('jumlah_rusak').value = '';
                        document.getElementById('keterangan').value = '';
                        var editModal = new bootstrap.Modal(document.getElementById('editItemModal'));
                        editModal.show();
                    });
            });

            // Restore button opens confirmation modal
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
                    const baseUrl = window.location.protocol + '//' + window.location.host;
                    restoreForm.action = `${baseUrl}/sarpras/damaged-items-school/${id}`;

                    var confirmModal = new bootstrap.Modal(modalEl);
                    confirmModal.show();
                });
            });

            // Handle form submission
            document.getElementById('updateItemForm').addEventListener('submit', function(e) {
                e.preventDefault();

                const form = this;
                const formData = new FormData(form);
                const action = form.getAttribute('action');

                if (!action) {
                    console.error('Form action is not set.');
                    alert('Terjadi kesalahan: aksi form tidak ditentukan.');
                    return;
                }

                // Get the CSRF token
                const tokenEl = document.querySelector('meta[name="csrf-token"]');
                const token = tokenEl ? tokenEl.getAttribute('content') : null;

                // Log the form data for debugging
                console.log('Form action:', action);
                console.log('Form data:', Object.fromEntries(formData));

                fetch(action, {
                    method: 'POST',
                    headers: token ? { 'X-CSRF-TOKEN': token } : {},
                    body: formData
                })
                .then(response => {
                    if (response.ok) {
                        window.location.reload();
                    } else {
                        console.error('Form submission failed');
                        return response.text();
                    }
                })
                .then(text => {
                    if (text) console.error('Error details:', text);
                })
                .catch(error => {
                    console.error('Error:', error);
                    alert('Terjadi kesalahan saat mengirim data. Cek konsol untuk detail.');
                });
            });

            // Edit damaged item button handler (rows)
            document.querySelectorAll('.editDamagedBtn').forEach(function(btn) {
                btn.addEventListener('click', function() {
                    const id = this.dataset.id;
                    const jumlah = this.dataset.jumlah || '';
                    const keterangan = this.dataset.keterangan || '';
                    const form = document.getElementById('updateItemForm');
                    const baseUrl = window.location.protocol + '//' + window.location.host;

                    // set form action to the specific item and method to PUT
                    form.action = `${baseUrl}/sarpras/damaged-items-school/${id}`;
                    document.getElementById('_method_field').value = 'PUT';

                    // populate fields
                    document.getElementById('jumlah_rusak').value = jumlah;
                    document.getElementById('keterangan').value = keterangan;
                    document.getElementById('editItemModalLabel').textContent = 'Edit Barang Rusak';

                    // try to fetch item details to show available items
                    fetch(`/sarpras/get-item-details/${id}`)
                        .then(res => res.json())
                        .then(resp => {
                            if (resp.status === 'success') {
                                const data = resp.data;
                                const availEl = document.getElementById('available_items');
                                const nameEl = document.getElementById('item_name');
                                if (availEl) availEl.textContent = `Jumlah baik tersedia: ${data.jumlah_baik}`;
                                if (nameEl) nameEl.textContent = `Nama barang: ${data.nama_barang}`;
                            }
                        })
                        .catch(() => {})
                        .finally(() => {
                            var editModal = new bootstrap.Modal(document.getElementById('editItemModal'));
                            editModal.show();
                        });
                });
            });

            // Delete damaged item handler
            // document.querySelectorAll('.deleteDamagedBtn').forEach(function(btn) {
            //     btn.addEventListener('click', function() {
            //         const id = this.dataset.id;
            //         if (!confirm('Yakin ingin menghapus data barang rusak? Semua barang akan dikembalikan menjadi baik.')) return;

            //         const baseUrl = window.location.protocol + '//' + window.location.host;
            //         const action = `${baseUrl}/sarpras/damaged-items-school/${id}`;
            //         const tokenEl = document.querySelector('meta[name="csrf-token"]');
            //         const token = tokenEl ? tokenEl.getAttribute('content') : null;

            //         // Use method spoofing via _method=DELETE in FormData
            //         const fd = new FormData();
            //         fd.append('_method', 'DELETE');

            //         fetch(action, {
            //             method: 'POST',
            //             headers: token ? { 'X-CSRF-TOKEN': token } : {},
            //             body: fd
            //         })
            //         .then(res => {
            //             if (res.ok) {
            //                 window.location.reload();
            //             } else {
            //                 return res.text().then(t => Promise.reject(t));
            //             }
            //         })
            //         .catch(err => {
            //             console.error('Delete failed:', err);
            //             alert('Gagal menghapus data. Cek konsol untuk detail.');
            //         });
            //     });
            // });

            @if ($errors->any())
                var myModal = new bootstrap.Modal(document.getElementById('addItemModal'));
                myModal.show();
            @endif
        });
    </script>
@endsection
