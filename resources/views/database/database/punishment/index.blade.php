@extends('layouts.app')

@section('content')
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">

    <div class="container mt-3">
        <a href="{{route('dashboard')}}" class="btn btn-secondary">Back</a>
        <a href="{{ route('punishment.create') }}" class="btn btn-primary">Tambah data Punishment</a>
    </div>

    <div class="container mt-4">
        <div class="row">
            <!-- Angkatan Filter -->
            <div class="col-lg-3">
                <div class="mb-3">
                    <label class="form-label">Angkatan</label>
                    <select class="form-control" name="angkatan" id="angkatan-select">
                        <option value="">-- Pilih Angkatan --</option>
                        @foreach($angkatanList as $angkatan)
                            <option value="{{ $angkatan }}">{{ $angkatan }}</option>
                        @endforeach
                    </select>
                </div>
            </div>
            <!-- Nama Filter -->
            <div class="col-lg-6">
                <div class="mb-3">
                    <label class="form-label">Nama</label>
                    <select class="form-control" name="id_siswa" id="nama-select">
                        <option value="">-- Pilih Nama --</option>
                        <!-- Options will be populated dynamically -->
                    </select>
                </div>
            </div>
            <div class="col-lg-3">
                <!-- Modify the export link to a button with an ID -->
                <a id="export-button" href="#" class="btn btn-secondary" style="pointer-events: none;">Export</a>
            </div>
        </div>
    </div>

    <div class="table-responsive shadow shadow-sm mt-4" style="margin-right: 20px; margin-left: 20px">
        <table class="table card-table table-vcenter text-nowrap datatable">
            <thead>
                <tr>
                    <th>No.</th>
                    <th>Tanggal</th>
                    <th>Nama</th>
                    <th>NISN</th>
                    <th>Angkatan</th>
                    <th>Jenis Pelanggaran</th>
                    <th>Kronologi</th>
                    <th>Tindak Lanjut</th>
                    <th>Pengawasan Guru</th>
                    <th>Pengurangan Point</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody id="punishment-data">
                @forelse ($dataPunishment as $data)
                    <tr>
                        <td>{{ $loop->iteration }}</td>
                        <td>{{ $data->tanggal }}</td>
                        <td>{{ $data->siswa->nama }}</td>
                        <td>{{ $data->siswa->nisn }}</td>
                        <td>{{$data->siswa->angkatan}}</td>
                        <td>{{ $data->jenis_pelanggaran }}</td>
                        <td>{{ \Illuminate\Support\Str::limit($data->kronologi, 20, '...') }}</td>
                        <td>{{ $data->tindak_lanjut }}</td>
                        <td>{{ $data->pengawasan_guru }}</td>
                        <td>{{ $data->pengurangan_point . ' Point' }}</td>
                        <td>
                            <div class="btn-list flex-nowrap">
                                <a target="_blank" class="btn" href="{{$data->path_dokumen}}">Dokumentasi</a>
                                <button class="btn rounded bg-yellow">
                                    <a href="{{ route('punishment.edit', $data->id) }}" class="text-white">
                                        <i class="bi bi-pencil-square"></i>
                                    </a>
                                </button>
                                <button type="button"
                                        class="btn btn-danger"
                                        onclick="openDeleteModal('{{ route('punishment.destroy', $data->id) }}')">
                                        <i class="bi bi-x-lg text-white"></i>
                                    </button>
                            </div>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="11" class="text-center">Tidak ada data punishment yang tersedia</td>
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
            function disabledAlert() {
                document.getElementById('alertSuccess').style.display = 'none';
            }
        </script>

    <script>
        const angkatanSelect = document.getElementById('angkatan-select');
        const namaSelect = document.getElementById('nama-select');
        const exportButton = document.getElementById('export-button');

        angkatanSelect.addEventListener('change', function() {
            const angkatan = this.value;
            const namesSelect = document.getElementById('nama-select');
            namesSelect.innerHTML = '<option value="">-- Pilih Nama --</option>';
            updateData({ angkatan });

            fetch(`/api/siswa?angkatan=${angkatan}`)
                .then(response => response.json())
                .then(data => {
                    data.forEach(siswa => {
                        const option = document.createElement('option');
                        option.value = siswa.id;
                        option.textContent = siswa.nama;
                        namesSelect.appendChild(option);
                    });
                })
                .catch(error => console.error('Error fetching names:', error));
        });

        namaSelect.addEventListener('change', function() {
            const angkatan = angkatanSelect.value;
            const id_siswa = this.value;
            updateData({ angkatan, id_siswa });

            // Enable the export button if a name is selected
            if (id_siswa) {
                exportButton.href = `{{ route('punishment.export') }}?angkatan=${angkatan}&id_siswa=${id_siswa}`;
                exportButton.style.pointerEvents = 'auto'; // Enable the button
            } else {
                exportButton.href = '#';
                exportButton.style.pointerEvents = 'none'; // Disable the button
            }
        });

        function updateData(filters) {
            const params = new URLSearchParams(filters).toString();
            fetch(`/punishment?${params}`, { headers: { 'X-Requested-With': 'XMLHttpRequest' } })
                .then(response => response.json())
                .then(data => {
                    const tbody = document.getElementById('punishment-data');
                    tbody.innerHTML = '';
                    data.data.forEach((item, index) => {
                        const row = document.createElement('tr');
                        row.innerHTML = `
                            <td>${index + 1}</td>
                            <td>${item.tanggal}</td>
                            <td>${item.siswa.nama}</td>
                            <td>${item.siswa.nisn}</td>
                            <td>${item.siswa.angkatan}</td>
                            <td>${item.jenis_pelanggaran}</td>
                            <td>${item.kronologi.length > 20 ? item.kronologi.substring(0, 20) + '...' : item.kronologi}</td>
                            <td>${item.tindak_lanjut}</td>
                            <td>${item.pengawasan_guru}</td>
                            <td>${item.pengurangan_point} Point</td>
                            <td>
                                <div class="btn-list flex-nowrap">
                                    <a target="_blank" class="btn" href="${item.path_dokumen}">Dokumentasi</a>
                                    <button class="btn rounded bg-yellow">
                                        <a href="/punishment/${item.id}/edit" class="text-white">
                                            <i class="bi bi-pencil-square"></i>
                                        </a>
                                    </button>
                                    <form action="/punishment/${item.id}" method="POST" style="display:inline;">
                                        <input type="hidden" name="_token" value="${document.querySelector('meta[name="csrf-token"]').getAttribute('content')}">
                                        <input type="hidden" name="_method" value="delete">
                                        <button class="btn btn-danger" onclick="return confirm('Are you sure?')">
                                            <i class="bi bi-x-lg text-white"></i>
                                        </button>
                                    </form>
                                </div>
                            </td>
                        `;
                        tbody.appendChild(row);
                    });
                })
                .catch(error => console.error('Error fetching data:', error));
        }
    </script>
@endsection
