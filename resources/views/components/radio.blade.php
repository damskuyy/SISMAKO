{{-- Modal --}}

<div class="modal modal-blur fade" id="modalReport1" tabindex="-1" aria-hidden="true" style="display: none;">
    <form action="{{ route('inbox.store') }}" method="POST" enctype="multipart/form-data">
        @csrf
        <div class="modal-dialog modal-lg modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Surat Masuk</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="row">

                        <div class="col-6">
                            <select id="tp-modal-1" class="form-select" name="tp">
                                <option value="Selected">Pilih Tahun Ajaran</option>
                                <option value="2022/2023">2022/2023</option>
                                <option value="2023/2024">2023/2024</option>
                                <option value="2024/2025">2024/2025</option>
                                <option value="2025/2026">2025/2026</option>
                                <option value="2026/2027">2026/2027</option>
                            </select>
                        </div>
                        @error('tp')
                            <div class="text-danger">{{ $message }}</div>
                        @enderror
                        <div class="col-6">

                            <div class="input-icon mb-2">
                                <input class="form-control " placeholder="Select a date" id="datepicker"
                                    autocomplete="false" name="tanggal">
                                @error('tanggal')
                                    <div class="text-danger">{{ $message }}</div>
                                @enderror
                                <span class="input-icon-addon">
                                    <!-- Download SVG icon from http://tabler-icons.io/i/calendar -->
                                    <svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24"
                                        viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none"
                                        stroke-linecap="round" stroke-linejoin="round">
                                        <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                                        <path
                                            d="M4 7a2 2 0 0 1 2 -2h12a2 2 0 0 1 2 2v12a2 2 0 0 1 -2 2h-12a2 2 0 0 1 -2 -2v-12z">
                                        </path>
                                        <path d="M16 3v4"></path>
                                        <path d="M8 3v4"></path>
                                        <path d="M4 11h16"></path>
                                        <path d="M11 15h1"></path>
                                        <path d="M12 15v3"></path>
                                    </svg>
                                </span>
                            </div>
                            @error('tanggal')
                                <div class="text-danger">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <div class="col-6">
                            <div class="mb-3">
                                <label class="form-label required">No. Surat</label>
                                <input type="text" class="form-control" name="no_surat"
                                    placeholder="Kolom wajib diisi">
                            </div>
                            @error('no_surat')
                                <div class="text-danger">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="col-6">
                            <div class="mb-3">
                                <label class="form-label required">Jenis Surat</label>
                                <select id="tl-modal-1" class="form-select" name="jenis_surat">
                                    <option>Pilih Jenis Surat</option>
                                    <option value="Surat Tugas">Surat Tugas</option>
                                    <option value="Surat permohonan">Surat permohonan</option>
                                    <option value="Surat Peringatan">Surat Peringatan</option>
                                    <option value="Surat Studi Banding">Surat Studi Banding</option>
                                    <option value="Surat Persetujuan">Surat Persetujuan</option>
                                    <option value="Surat Edaran">Surat Edaran</option>
                                    <option value="Surat Undangan">Surat Undangan</option>
                                    <option value="Surat Pemberitahuan">Surat Pemberitahuan</option>
                                    <option value="Surat Izin">Surat Izin</option>
                                    <option value="Lainnya">Surat Lainnya</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-6">
                            <div class="mb-3">
                                <label class="form-label required">Perihal</label>
                                <input type="text" class="form-control" name="perihal"
                                    placeholder="Kolom wajib diisi">
                            </div>
                            @error('perihal')
                                <div class="text-danger">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="col-6">
                            <div class="mb-3">
                                <label class="form-label required">dari</label>
                                <input type="text" class="form-control" name="dari"
                                    placeholder="Kolom wajib diisi">
                            </div>
                            @error('dari')
                                <div class="text-danger">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                </div>
                <div class="modal-body">
                    <div class="col-12">

                        <div class="mb-3">
                            <div class="form-label">Import File</div>
                            <input type="file" class="form-control" name="file_surat">
                        </div>
                        <div class="mb-3">
                            <label class="form-label required">Jenis Surat Lainnya</label>
                            <input type="text" id="lainnya-field-1" class="form-control" name="jenis_surat"
                                placeholder="Masukkan jenis surat lainnya" disabled>
                        </div>
                    </div>
                </div>
                <div class="modal-footer text-end">
                    <div class="d-flex">

                        <a href="#" class="btn btn-link" data-bs-dismiss="modal">Cancel</a>
                        <button type="submit" class="btn btn-primary ms-auto" data-bs-dismiss="modal">Save</button>
                    </div>
                </div>
            </div>
        </div>
    </form>
</div>

{{-- <x-component-korespondensi.modals id="modalReport2" method='POST'>
    <x-component-korespondensi.modal-header title="Surat Keluar" />

    <x-component-korespondensi.modal-body>
        <div class="row">
            <div class="col-6">

                <x-component-korespondensi.select id="tp-modal-2" label="Tahun Ajaran" name="tp" required="true">
                    <option value="Selected">Pilih Tahun Ajaran</option>
                    <option value="2022/2023">2022/2023</option>
                    <option value="2023/2024">2023/2024</option>
                    <option value="2024/2025">2024/2025</option>
                    <option value="2025/2026">2025/2026</option>
                    <option value="2026/2027">2026/2027</option>
                </x-component-korespondensi.select>
            </div>

            <div class="col-6">
                <x-component-korespondensi.input label="tanggal" name="tanggal" placeholder="Pilih Tanggal" type="date"
                    id="datepicket-icon-2">\
                    <span class="input-icon-addon">
                        <!-- Download SVG icon from http://tabler-icons.io/i/calendar -->
                        <svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24" viewBox="0 0 24 24"
                            stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round"
                            stroke-linejoin="round">
                            <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                            <path d="M4 7a2 2 0 0 1 2 -2h12a2 2 0 0 1 2 2v12a2 2 0 0 1 -2 2h-12a2 2 0 0 1 -2 -2v-12z">
                            </path>
                            <path d="M16 3v4"></path>
                            <path d="M8 3v4"></path>
                            <path d="M4 11h16"></path>
                            <path d="M11 15h1"></path>
                            <path d="M12 15v3"></path>
                        </svg>
                    </span>
                </x-component-korespondensi.input>
            </div>
        </div>
    </x-component-korespondensi.modal-body>

    <x-component-korespondensi.modal-body>
        <div class="row">
            <div class="col-6">
                <x-component-korespondensi.select id="js-modal-2" label="Jenis Surat" name="jenis_surat"
                    label="Jenis Surat" required="true">
                    <option selected>Pilih Jenis Surat</option>
                    <option value="Surat Tugas">Surat Tugas</option>
                    <option value="Surat permohonan">Surat permohonan</option>
                    <option value="Surat Peringatan">Surat Peringatan</option>
                    <option value="Surat Studi Banding">Surat Studi Banding</option>
                    <option value="Surat Persetujuan">Surat Persetujuan</option>
                    <option value="Surat Edaran">Surat Edaran</option>
                    <option value="Surat Undangan">Surat Undangan</option>
                    <option value="Surat Pemberitahuan">Surat Pemberitahuan</option>
                    <option value="Surat Izin">Surat Izin</option>
                    <option value="Lainnya">Surat Lainnya</option>
                </x-component-korespondensi.select>
            </div>
            <div class="col-6">
                <x-component-korespondensi.input type="text" label="Perihal" name="perihal"
                    placeholder="Kolom wajib diisi" />
            </div>
            <div class="col-6">
                <x-component-korespondensi.input type="text" label="Kepada" name="kepada"
                    placeholder="Kolom wajib diisi" />
            </div>
            <div class="col-6">
                <x-component-korespondensi.input type="text" label="No. Surat" name="no_surat"
                    placeholder="Kolom wajib diisi" id="no-surat2" />
            </div>
        </div>
    </x-component-korespondensi.modal-body>
    <x-component-korespondensi.modal-body>
        <div class="col-12">
            <x-component-korespondensi.input type="file" label="Import File" name="file_surat"
                placeholder="Kolom wajib diisi" />
        </div>
        <div class="col-12">
            <x-component-korespondensi.input type="text" label="Jenis Surat Lainnya" name="jenis_surat"
                placeholder="Masukkan Jenis Surat" disabled id="lainnya-field-2" />
        </div>
    </x-component-korespondensi.modal-body>
    <x-component-korespondensi.modal-footer />
</x-component-korespondensi.modals> --}}

<div class="modal modal-blur fade" id="modalReport2" tabindex="-1" aria-hidden="false" style="display: none;">
    <form action="{{ route('outbox.store') }}" method="post" enctype="multipart/form-data">
        @csrf
        <div class="modal-dialog modal-lg modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Surat Keluar</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="row">

                        <div class="col-6">

                            <select id="tp-modal-2" class="form-select" name="tp">
                                <option value="Selected">Pilih Tahun Ajaran</option>
                                <option value="2022/2023">2022/2023</option>
                                <option value="2023/2024">2023/2024</option>
                                <option value="2024/2025">2024/2025</option>
                                <option value="2025/2026">2025/2026</option>
                                <option value="2026/2027">2026/2027</option>
                            </select>
                            @error('tp')
                                <div class="text-danger">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="col-6">

                            <div class="input-icon mb-2">
                                <input class="form-control " placeholder="Select a date" id="datepicker"
                                    autocomplete="false" name="tanggal">
                                @error('tanggal')
                                    <div class="text-danger">{{ $message }}</div>
                                @enderror
                                <span class="input-icon-addon">
                                    <!-- Download SVG icon from http://tabler-icons.io/i/calendar -->
                                    <svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24"
                                        height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor"
                                        fill="none" stroke-linecap="round" stroke-linejoin="round">
                                        <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                                        <path
                                            d="M4 7a2 2 0 0 1 2 -2h12a2 2 0 0 1 2 2v12a2 2 0 0 1 -2 2h-12a2 2 0 0 1 -2 -2v-12z">
                                        </path>
                                        <path d="M16 3v4"></path>
                                        <path d="M8 3v4"></path>
                                        <path d="M4 11h16"></path>
                                        <path d="M11 15h1"></path>
                                        <path d="M12 15v3"></path>
                                    </svg>
                                </span>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <div class="col-6">
                            <div class="mb-3">
                                <label class="form-label requied">No. Surat</label>
                                <input type="text" class="form-control" id="no_surat2" name="no_surat"
                                    placeholder="Kolom wajib diisi">
                                @error('no_surat')
                                    <div class="text-danger">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                        <div class="col-6">
                            <div class="mb-3">
                                <label class="form-label required">Jenis Surat</label>
                                <select id="tl-modal-2" class="form-select" name="jenis_surat">
                                    <option>Pilih Jenis Surat</option>
                                    <option value="Surat Tugas">Surat Tugas</option>
                                    <option value="Surat permohonan">Surat permohonan</option>
                                    <option value="Surat Peringatan">Surat Peringatan</option>
                                    <option value="Surat Studi Banding">Surat Studi Banding</option>
                                    <option value="Surat Persetujuan">Surat Persetujuan</option>
                                    <option value="Surat Edaran">Surat Edaran</option>
                                    <option value="Surat Undangan">Surat Undangan</option>
                                    <option value="Surat Pemberitahuan">Surat Pemberitahuan</option>
                                    <option value="Surat Izin">Surat Izin</option>
                                    <option value="Lainnya">Surat Lainnya</option>
                                </select>
                                @error('jenis_surat')
                                    <div class="text-danger">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                        <div class="col-6">
                            <div class="mb-3">
                                <label class="form-label required">Perihal</label>
                                <input type="text" class="form-control" name="perihal"
                                    placeholder="Kolom wajib diisi">
                                @error('perihal')
                                    <div class="text-danger">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                        <div class="col-6">
                            <div class="mb-3">
                                <label class="form-label required">Ke</label>
                                <input type="text" class="form-control" name="kepada"
                                    placeholder="Kolom wajib diisi">
                                @error('kepada')
                                    <div class="text-danger">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-body">
                    <div class="col-12">
                        <div class="mb-3">
                            {{-- <div class="form-label">Import File</div>
                            <input type="file" class="form-control" name="file_surat">
                            @error('file_surat')
                                <div class="text-danger">{{ $message }}</div>
                            @enderror --}}
                            <div class="mb-3">
                                <label class="form-label required">Jenis Surat Lainnya 2</label>
                                <input type="text" id="lainnya-field-2" class="form-control" name="jenis_surat"
                                    placeholder="Masukkan jenis surat lainnya" disabled>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer text-end">
                    <div class="d-flex">
                        <a href="#" class="btn btn-link" data-bs-dismiss="modal">Cancel</a>
                        <button type="submit" class="btn btn-primary ms-auto" data-bs-dismiss="modal">Save</button>
                    </div>
                </div>
            </div>
        </div>
    </form>
</div>

<div class="modal modal-blur fade" id="modalReport3" tabindex="-1" aria-hidden="true" style="display: none;">
    <form action="{{ route('sp.store') }}" method="post" enctype="multipart/form-data">
        @csrf
        <div class="modal-dialog modal-lg modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Surat Peringatan</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <div class="col-6">
                            <select id="tp-modal-3" class="form-select" name="tp">
                                <option value="Selected">Pilih Tahun Ajaran</option>
                                <option value="2022/2023">2022/2023</option>
                                <option value="2023/2024">2023/2024</option>
                                <option value="2024/2025">2024/2025</option>
                                <option value="2025/2026">2025/2026</option>
                                <option value="2026/2027">2026/2027</option>
                            </select>
                            @error('tp')
                                <div class="text-danger mt-2"> {{ $message }}</div>
                            @enderror
                        </div>
                        <div class="col-6">
                            <div class="input-icon mb-2">
                                <input class="form-control " placeholder="Select a date" name="tanggal"
                                    id="datepicker" autocomplete="false">
                                @error('tanggal')
                                    <div class="text-danger">{{ $message }}</div>
                                @enderror
                                <span class="input-icon-addon">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24"
                                        height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor"
                                        fill="none" stroke-linecap="round" stroke-linejoin="round">
                                        <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                                        <path
                                            d="M4 7a2 2 0 0 1 2 -2h12a2 2 0 0 1 2 2v12a2 2 0 0 1 -2 2h-12a2 2 0 0 1 -2 -2v-12z">
                                        </path>
                                        <path d="M16 3v4"></path>
                                        <path d="M8 3v4"></path>
                                        <path d="M4 11h16"></path>
                                        <path d="M11 15h1"></path>
                                        <path d="M12 15v3"></path>
                                    </svg>
                                </span>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-body">
                    <h3 class="text-center">Ditujukan Kepada</h3>
                    <div class="row">
                        <div class="col-6">
                            <label class="form-selectgroup-item flex-fill">
                                <input type="radio" name="subjek" value="siswa"
                                    class="form-selectgroup-input radio-inbox">
                                <div class="form-selectgroup-label d-flex align-items-center p-3">
                                    <div class="me-3">
                                        <span class="form-selectgroup-check"></span>
                                    </div>
                                    <div class="form-selectgroup-label-content d-flex align-items-center">
                                        <span class="avatar bg-success text-white me-3">S</span>
                                    </div>
                                    <div>
                                        <div class="fw-bolder fs-3">Siswa</div>
                                    </div>
                                </div>
                            </label>
                            <input type="text" class="form-control mt-3" name="siswa"
                                placeholder="Masukan Nama siswa....">

                        </div>
                        <div class="col-6">
                            <label class="form-selectgroup-item flex-fill">
                                <input type="radio" name="subjek" value="guru"
                                    class="form-selectgroup-input radio-inbox">
                                <div class="form-selectgroup-label d-flex align-items-center p-3">
                                    <div class="me-3">
                                        <span class="form-selectgroup-check"></span>
                                    </div>
                                    <div class="form-selectgroup-label-content d-flex align-items-center">
                                        <span class="avatar bg-info text-white me-3">G</span>
                                    </div>
                                    <div>
                                        <div class="fw-bolder fs-3">Guru</div>
                                    </div>
                                </div>
                            </label>
                            <input type="text" class="form-control mt-3" name="guru"
                                placeholder="Masukan nama guru....">
                        </div>
                    </div>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <div class="col-6">
                            <div class="mb-3">
                                <label class="form-label required">No. Surat</label>
                                <input type="text" class="form-control" id="no_surat3" name="no_surat"
                                    placeholder="Kolom wajib diisi">
                                @error('no_surat')
                                    <div class="text-danger">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                        <div class="col-6">
                            <div class="mb-3">
                                <label class="form-label required">Alasan</label>
                                <input type="text" class="form-control" name="alasan"
                                    placeholder="Kolom wajib diisi">
                                @error('alasan')
                                    <div class="text-danger">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                        <div class="col-6">
                            <div class="mb-3">
                                <label class="form-label required">Surat Peringatan ke</label>
                                <select id="tp" class="form-select" name="sp">
                                    <option selected>-- Pilih Surat Peringatan --</option>
                                    <option value="sp1">1 (Satu)</option>
                                    <option value="sp2">2 (Dua)</option>
                                    <option value="sp3">3 (Tiga)</option>
                                </select>
                                @error('sp')
                                    <div class="text-danger">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                        <div class="col-12">
                            <div class="mb-3">
                                <label class="form-label">Keterangan <span class="form-label-description">max.
                                        150</span></label>
                                <textarea class="form-control" name="keterangan" rows="6" placeholder="Isi Keterangan.."></textarea>
                                @error('keterangan')
                                    <div class="text-danger">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-body">
                    <div class="col-12">
                        <div class="mb-3">
                            <div class="form-label">Import File</div>
                            <input type="file" class="form-control" name="file_surat">
                            @error('file_surat')
                                <div class="text-danger">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                </div>
                <div class="modal-footer text-end">
                    <div class="d-flex">
                        <a href="#" class="btn btn-link" data-bs-dismiss="modal">Cancel</a>
                        <button type="submit" class="btn btn-primary ms-auto">Save</button>
                    </div>
                </div>
            </div>
        </div>
    </form>
</div>

<div class="modal modal-blur fade" id="modalReport4" tabindex="-1" aria-hidden="true" style="display: none;">
    <form action="{{ route('no_surat.store') }}" method="post" enctype="multipart/form-data">
        @csrf
        @method('POST')
        <div class="modal-dialog modal-lg modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Nomor Surat</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="row">

                        <div class="col-6">

                            <select id="tp-modal-4" class="form-select" name="tp">
                                <option value="Selected">Pilih Tahun Ajaran</option>
                                <option value="2022/2023">2022/2023</option>
                                <option value="2023/2024">2023/2024</option>
                                <option value="2024/2025">2024/2025</option>
                                <option value="2025/2026">2025/2026</option>
                                <option value="2026/2027">2026/2027</option>
                            </select>
                            @error('tp')
                                <div class="text-danger">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="col-6">
                            <div class="input-icon mb-2">
                                <input class="form-control " placeholder="Select a date" name="tanggal"
                                    id="datepicker" autocomplete="false">
                                @error('tanggal')
                                    <div class="text-danger">{{ $message }}</div>
                                @enderror
                                <span class="input-icon-addon">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24"
                                        height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor"
                                        fill="none" stroke-linecap="round" stroke-linejoin="round">
                                        <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                                        <path
                                            d="M4 7a2 2 0 0 1 2 -2h12a2 2 0 0 1 2 2v12a2 2 0 0 1 -2 2h-12a2 2 0 0 1 -2 -2v-12z">
                                        </path>
                                        <path d="M16 3v4"></path>
                                        <path d="M8 3v4"></path>
                                        <path d="M4 11h16"></path>
                                        <path d="M11 15h1"></path>
                                        <path d="M12 15v3"></path>
                                    </svg>
                                </span>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <div class="col-6">
                            <div class="mb-3">
                                <label class="form-label required">No. Surat</label>
                                <input type="text" class="form-control" id="no_surat4" name="no_surat"
                                    placeholder="Kolom wajib diisi">
                                @error('no_surat')
                                    <div class="text-danger">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                        <div class="col-6">
                            <div class="mb-3">
                                <label class="form-label required">Keperluan</label>
                                <input type="text" class="form-control" name="keperluan"
                                    placeholder="Kolom wajib diisi">
                                @error('keperluan')
                                    <div class="text-danger">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                        <div class="col-12">
                            <div class="mb-3">
                                <div class="form-label">Import File</div>
                                <input type="file" class="form-control" name="file_surat">
                                @error('file_surat')
                                    <div class="text-danger">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer text-end">
                    <div class="d-flex">
                        <a href="#" class="btn btn-link" data-bs-dismiss="modal">Cancel</a>
                        <button type="submit" class="btn btn-primary ms-auto" data-bs-dismiss="modal">Save</button>
                    </div>
                </div>
            </div>
        </div>
    </form>
</div>

<div class="modal modal-blur fade" id="modalReport5" tabindex="-1" aria-hidden="true" style="display: none;">
    <form action="{{ route('notulensi.store') }}" method="post" enctype="multipart/form-data">
        @csrf
        <div class="modal-dialog modal-lg modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Notulensi</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body p-3 ">
                    <div class="row ">
                        <div class="col-6">
                            <select id="tp-modal-4" class="form-select" name="tp">
                                <option value="Selected">Pilih Tahun Ajaran</option>
                                <option value="2022/2023">2022/2023</option>
                                <option value="2023/2024">2023/2024</option>
                                <option value="2024/2025">2024/2025</option>
                                <option value="2025/2026">2025/2026</option>
                                <option value="2026/2027">2026/2027</option>
                            </select>
                        </div>
                        @error('tp')
                            <div class="text-danger">{{ $message }}</div>
                        @enderror
                        <div class="col-6">
                            <div class="input-icon mb-2">
                                <input class="form-control " placeholder="Select a date" id="datepicker"
                                    autocomplete="false" name="tanggal">
                                @error('tanggal')
                                    <div class="text-danger">{{ $message }}</div>
                                @enderror
                                <span class="input-icon-addon">
                                    <!-- Download SVG icon from http://tabler-icons.io/i/calendar -->
                                    <svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24"
                                        height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor"
                                        fill="none" stroke-linecap="round" stroke-linejoin="round">
                                        <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                                        <path
                                            d="M4 7a2 2 0 0 1 2 -2h12a2 2 0 0 1 2 2v12a2 2 0 0 1 -2 2h-12a2 2 0 0 1 -2 -2v-12z">
                                        </path>
                                        <path d="M16 3v4"></path>
                                        <path d="M8 3v4"></path>
                                        <path d="M4 11h16"></path>
                                        <path d="M11 15h1"></path>
                                        <path d="M12 15v3"></path>
                                    </svg>
                                </span>
                            </div>
                        </div>
                        <div class="col-6">
                            <input type="text" id="time-input" class="form-control" placeholder="00:00"
                                autocomplete="off" name="waktu">
                            @error('waktu')
                                <div class="text-danger">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="col-6">
                            <div class="mb-3">
                                <select class="form-select" name="daring">
                                    <option value="" selected>Off/On</option>
                                    <option value="Offline">Offline</option>
                                    <option value="Online">Online</option>
                                </select>
                                @error('daring')
                                    <div class="text-danger">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <div class="col-6">
                            <div class="mb-3">
                                <label class="form-label required">Materi</label>
                                <input type="text" class="form-control" name="materi"
                                    placeholder="Kolom wajib diisi">
                                @error('materi')
                                    <div class="text-danger">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                        <div class="col-6">
                            <div class="mb-3">
                                <label class="form-label required">Pemateri</label>
                                <input type="text" class="form-control" name="pemateri"
                                    placeholder="Kolom wajib diisi">
                                @error('hasil')
                                    <div class="text-danger">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                        <div class="col-12">
                            <div class="mb-3">
                                <label class="form-label required">Peserta</label>
                                <textarea rows="5" class="form-control" placeholder="Here can be your description" name="peserta"></textarea>
                                @error('peserta')
                                    <div class="text-danger">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                        <div class="col-12">
                            <div class="mb-3">
                                <label class="form-label required">Hasil</label>
                                <textarea rows="5" class="form-control" placeholder="Here can be your description" name="hasil"></textarea>
                                @error('hasil')
                                    <div class="text-danger">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                    </div>
                    <div class="row">

                        <div class="col-12">
                            <div class="mb-3">
                                <div class="form-label">Import File</div>
                                <input type="file" class="form-control" name="file_surat">
                                @error('file_surat')
                                    <div class="text-danger">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                        <div class="col-12">
                            <div class="mb-3">
                                <div class="form-label">Import dokumentasi</div>
                                <input type="file" class="form-control" name="file_dokumentasi">
                                @error('file_dokumentasi')
                                    <div class="text-danger">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer text-end">
                    <div class="d-flex">
                        <a href="#" class="btn btn-link" data-bs-dismiss="modal">Cancel</a>
                        <button type="submit" class="btn btn-primary ms-auto" data-bs-dismiss="modal">Save</button>
                    </div>
                </div>
            </div>
        </div>
    </form>
</div>

<div class="modal modal-blur fade" id="modalReport6" tabindex="-1" aria-hidden="true" style="display: none;">
    <form action="{{ route('pengajuan.store') }}" method="post" enctype="multipart/form-data">
        @csrf

        <div class="modal-dialog modal-lg modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Surat Pengajuan</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="row">

                        <div class="col-6">

                            <select id="tp-modal-6" class="form-select" name="tp">
                                <option value="Selected">Pilih Tahun Ajaran</option>
                                <option value="2022/2023">2022/2023</option>
                                <option value="2023/2024">2023/2024</option>
                                <option value="2024/2025">2024/2025</option>
                                <option value="2025/2026">2025/2026</option>
                                <option value="2026/2027">2026/2027</option>
                            </select>
                            @error('tp')
                                <div class="text-danger">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="col-6">
                            <div class="input-icon mb-2">
                                <input class="form-control " placeholder="Select a date" id="datepicker"
                                    autocomplete="false" name="tanggal">
                                @error('tanggal')
                                    <div class="text-danger">{{ $message }}</div>
                                @enderror
                                <span class="input-icon-addon">
                                    <!-- Download SVG icon from http://tabler-icons.io/i/calendar -->
                                    <svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24"
                                        height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor"
                                        fill="none" stroke-linecap="round" stroke-linejoin="round">
                                        <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                                        <path
                                            d="M4 7a2 2 0 0 1 2 -2h12a2 2 0 0 1 2 2v12a2 2 0 0 1 -2 2h-12a2 2 0 0 1 -2 -2v-12z">
                                        </path>
                                        <path d="M16 3v4"></path>
                                        <path d="M8 3v4"></path>
                                        <path d="M4 11h16"></path>
                                        <path d="M11 15h1"></path>
                                        <path d="M12 15v3"></path>
                                    </svg>
                                </span>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <div class="col-6">
                            <div class="mb-3">
                                <label class="form-label required">No. Surat</label>
                                <input type="text" class="form-control" id="no_surat5" name="no_surat"
                                    placeholder="Kolom wajib diisi">
                                @error('no_surat')
                                    <div class="text-danger">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                        <div class="col-6">
                            <div class="mb-3">
                                <label class="form-label required">Jenis Pengajuan</label>
                                <input type="text" class="form-control" name="jenis_pengajuan"
                                    placeholder="Kolom wajib diisi">
                                @error('jenis_pengajuan')
                                    <div class="text-danger">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                        <div class="col-6">
                            <div class="mb-3">
                                <label class="form-label required">Nama Pengajuan</label>
                                <input type="text" class="form-control" name="nama_pengajuan"
                                    placeholder="Kolom wajib diisi">
                                @error('nama_pengajuan')
                                    <div class="text-danger">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                        <div class="col-6">
                            <div class="mb-3">
                                <label class="form-label required">Nominal</label>
                                <input type="text" id="nominal" class="form-control nominal" name="nominal"
                                    placeholder="Kolom wajib diisi">
                                @error('nominal')
                                    <div class="text-danger">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                        <div class="col-12">
                            <div class="mb-3">
                                <div class="form-label">Import LPJ</div>
                                <input type="file" class="form-control" name="file_surat">
                                @error('file_surat')
                                    <div class="text-danger">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer text-end">
                    <div class="d-flex">
                        <a href="#" class="btn btn-link" data-bs-dismiss="modal">Cancel</a>
                        <button type="submit" id="submitPengajuan" class="btn btn-primary ms-auto"
                            data-bs-dismiss="modal">Save</button>
                    </div>
                </div>
            </div>
        </div>
    </form>
</div>

{{-- Modal view --}}

{{-- modal update --}}

<script>
    $(document).ready(function() {
        // Initialize input mask
        $("#time-input").inputmask("99:99");

        // Initialize DataTable (apply this to your table element if needed)
        // $('#your-table-id').DataTable();
    });
</script>


<script>
    document.addEventListener('DOMContentLoaded', function() {
        const modals = document.querySelectorAll('[id^="modalUpdate"]');

        function hideModal(modal) {
            const modalInstance = bootstrap.Modal.getInstance(modal);
            if (modalInstance) {
                modalInstance.hide();
                modal.addEventListener('hidden.bs.modal', removeBackdrop, {
                    once: true
                });
            }
        }

        function removeBackdrop() {
            const backdrops = document.querySelectorAll('.modal-backdrop');
            if (backdrops.length > 0) {
                backdrops.forEach(backdrop => backdrop.remove());
            }
            document.body.classList.remove('modal-open');
            document.body.style.paddingRight = '';
        }

        function resetAllModals() {
            modals.forEach(modal => hideModal(modal));
        }

        modals.forEach(modal => {
            modal.addEventListener('hidden.bs.modal', removeBackdrop);
        });

        const radioButtons = document.querySelectorAll('.radio-inbox');
        const submitButton = document.getElementById('submitButton');
        const viewContainers = document.querySelectorAll('#view1, #view2, #view3, #view4, #view5, #view6');
        const tableIds = ['myTable1', 'myTable2', 'myTable3', 'myTable4', 'myTable5', 'myTable6'];

        function checkSelection() {
            const radioChecked = Array.from(radioButtons).some(radio => radio.checked);
            submitButton.disabled = !radioChecked;
        }

        function handleSelectChange(selectId, inputId) {
            const selectElement = document.getElementById(selectId);
            const inputElement = document.getElementById(inputId);

            if (selectElement && inputElement) {
                function updateInputState() {
                    inputElement.disabled = (selectElement.value !== 'Lainnya');
                }

                selectElement.addEventListener('change', updateInputState);
                updateInputState();
            } else {
                console.error(`Select or input element not found for IDs: ${selectId}, ${inputId}`);
            }
        }

        handleSelectChange('tl-modal-1', 'lainnya-field-1');
        handleSelectChange('tl-modal-2', 'lainnya-field-2');
        handleSelectChange('tl-update-1', 'lainnya-update-1');
        handleSelectChange('tl-update-2', 'lainnya-update-2');

        function hideAllContainers() {
            viewContainers.forEach(container => container.hidden = true);
        }

        radioButtons.forEach(radioButton => {
            radioButton.addEventListener('change', function() {
                checkSelection();
                hideAllContainers();

                if (this.checked) {
                    const dataTargetView = this.getAttribute('data-target-view');
                    const targetView = document.querySelector(dataTargetView);
                    if (targetView) {
                        targetView.hidden = false;
                        initializeDataTables(); // Inisialisasi DataTable jika perlu
                    }
                    const dataTargetReport = this.getAttribute('data-target-report');
                    submitButton.setAttribute('data-bs-target', dataTargetReport);
                    toggleInputFields(this.value);
                }
            });
        });

        function initializeDataTables() {
            tableIds.forEach(id => {
                const tableElement = document.getElementById(id);
                if (tableElement && !$.fn.DataTable.isDataTable(tableElement)) {
                    $(tableElement).DataTable(); // Pastikan untuk menggunakan jQuery di sini
                }
            });
        }

        function toggleInputFields(selectedValue) {
            const siswaInput = document.querySelector('input[name="siswa"]');
            const guruInput = document.querySelector('input[name="guru"]');

            siswaInput.disabled = selectedValue !== 'siswa';
            guruInput.disabled = selectedValue !== 'guru';

            if (selectedValue === 'siswa') {
                guruInput.value = '';
            } else if (selectedValue === 'guru') {
                siswaInput.value = '';
            }
        }

        // Menggunakan Litepicker untuk field tanggal
        document.querySelectorAll('[id^="datepicker"]').forEach(datepicker => {
            new Litepicker({
                element: datepicker,
                format: 'YYYY-MM-DD',
                buttonText: {
                    previousMonth: `<svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M15 6l-6 6l6 6" /></svg>`,
                    nextMonth: `<svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M9 6l6 6l-6 6" /></svg>`,
                },
            });
        });

        // Menghapus penggunaan datepicker jQuery karena Litepicker digunakan
        document.getElementById('filterButton').addEventListener('click', function() {
            document.getElementById('hiddenStartDate').value = document.getElementById(
                'datepicker-icon-1').value;
            document.getElementById('hiddenEndDate').value = document.getElementById(
                'datepicker-icon-2').value;
        });
    });
</script>
