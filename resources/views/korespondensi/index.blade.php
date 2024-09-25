@extends('layouts.app')

@section('content')
    @include('korespondensi.inc.form')
    <div class="container-xl my-3">
        <div class="row row-cards">
            <div class="col-lg">
                <div class="card">
                    <div class="card-header">
                        Korespondensi
                    </div>
                    <div class="card-body">

                        <div class="row g-5 align-items-center mx-auto  ">
                            <div class="col-md-6 col-lg-4 ">
                                <label
                                    class="form-selectgroup-item flex-fill bg-primary-subtle border border-primary-subtle rounded-3">
                                    <div class="card-stamp">
                                        <div class="card-stamp-icon bg-info">
                                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                                viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
                                                stroke-linecap="round" stroke-linejoin="round"
                                                class="icon icon-tabler icon-tabler-mail-down">
                                                <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                                                <path
                                                    d="M12 19h-7a2 2 0 0 1 -2 -2v-10a2 2 0 0 1 2 -2h14a2 2 0 0 1 2 2v5.5" />
                                                <path d="M19 16v6" />
                                                <path d="M22 19l-3 3l-3 -3" />
                                                <path d="M3 7l9 6l9 -6" />
                                            </svg>
                                        </div>
                                    </div>
                                    <input type="radio" name="inbox" value="1" id="radioInbox1"
                                        class="form-selectgroup-input radio-inbox" data-target-view="#view1"
                                        data-target-report="#modalReport1">
                                    <div class="form-selectgroup-label d-flex align-items-center p-3 ">
                                        <div class="form-selectgroup-label-content d-flex align-items-center">
                                            <span class="avatar bg-info text-white me-3">
                                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                                    viewBox="0 0 24 24" fill="none" stroke="currentColor"
                                                    stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                                                    class="icon icon-tabler icon-tabler-mail-down">
                                                    <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                                                    <path
                                                        d="M12 19h-7a2 2 0 0 1 -2 -2v-10a2 2 0 0 1 2 -2h14a2 2 0 0 1 2 2v5.5" />
                                                    <path d="M19 16v6" />
                                                    <path d="M22 19l-3 3l-3 -3" />
                                                    <path d="M3 7l9 6l9 -6" />
                                                </svg>
                                            </span>
                                            <div>
                                                <div class="fw-bolder fs-3">Surat Masuk</div>
                                            </div>
                                        </div>
                                    </div>
                                </label>
                            </div>
                            <div class="col-md-6 col-lg-4 ">
                                <label
                                    class="form-selectgroup-item flex-fill bg-primary-subtle border border-primary-subtle rounded-3">
                                    <div class="card-stamp">
                                        <div class="card-stamp-icon bg-info">
                                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                                viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
                                                stroke-linecap="round" stroke-linejoin="round"
                                                class="icon icon-tabler icons-tabler-outline icon-tabler-mail-up">
                                                <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                                                <path
                                                    d="M12 19h-7a2 2 0 0 1 -2 -2v-10a2 2 0 0 1 2 -2h14a2 2 0 0 1 2 2v5.5" />
                                                <path d="M19 22v-6" />
                                                <path d="M22 19l-3 -3l-3 3" />
                                                <path d="M3 7l9 6l9 -6" />
                                            </svg>
                                        </div>
                                    </div>
                                    <input type="radio" name="inbox" value="2" id="radioInbox2"
                                        class="form-selectgroup-input radio-inbox" data-target-view="#view2"
                                        data-target-report="#modalReport2">
                                    <div class="form-selectgroup-label d-flex align-items-center p-3">
                                        <div class="form-selectgroup-label-content d-flex align-items-center">
                                            <span class="avatar bg-info text-white me-3"><svg
                                                    xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                                    viewBox="0 0 24 24" fill="none" stroke="currentColor"
                                                    stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                                                    class="icon icon-tabler icons-tabler-outline icon-tabler-mail-up">
                                                    <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                                                    <path
                                                        d="M12 19h-7a2 2 0 0 1 -2 -2v-10a2 2 0 0 1 2 -2h14a2 2 0 0 1 2 2v5.5" />
                                                    <path d="M19 22v-6" />
                                                    <path d="M22 19l-3 -3l-3 3" />
                                                    <path d="M3 7l9 6l9 -6" />
                                                </svg></span>
                                        </div>
                                        <div>
                                            <div class="fw-bolder fs-3">Surat Keluar</div>
                                        </div>
                                    </div>
                                </label>
                            </div>

                            <div class="col-md-6 col-lg-4 ">
                                <label
                                    class="form-selectgroup-item flex-fill bg-danger-subtle border border-danger-subtle rounded-3">
                                    <div class="card-stamp">
                                        <div class="card-stamp-icon bg-danger">
                                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                                viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
                                                stroke-linecap="round" stroke-linejoin="round"
                                                class="icon icon-tabler icons-tabler-outline icon-tabler-alert-triangle">
                                                <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                                                <path d="M12 9v4" />
                                                <path
                                                    d="M10.363 3.591l-8.106 13.534a1.914 1.914 0 0 0 1.636 2.871h16.214a1.914 1.914 0 0 0 1.636 -2.87l-8.106 -13.536a1.914 1.914 0 0 0 -3.274 0z" />
                                                <path d="M12 16h.01" />
                                            </svg>
                                        </div>
                                    </div>
                                    <input type="radio" name="inbox" value="3" id="radioInbox3"
                                        class="form-selectgroup-input radio-inbox" data-target-view="#view3"
                                        data-target-report="#modalReport3">
                                    <div class="form-selectgroup-label d-flex align-items-center p-3">
                                        <div class="form-selectgroup-label-content d-flex align-items-center">
                                            <span class="avatar bg-danger text-white me-5"><svg
                                                    xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                                    viewBox="0 0 24 24" fill="none" stroke="currentColor"
                                                    stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                                                    class="icon icon-tabler icons-tabler-outline icon-tabler-alert-triangle">
                                                    <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                                                    <path d="M12 9v4" />
                                                    <path
                                                        d="M10.363 3.591l-8.106 13.534a1.914 1.914 0 0 0 1.636 2.871h16.214a1.914 1.914 0 0 0 1.636 -2.87l-8.106 -13.536a1.914 1.914 0 0 0 -3.274 0z" />
                                                    <path d="M12 16h.01" />
                                                </svg></span>
                                        </div>
                                        <div>
                                            <div class="fw-bolder  text-danger fs-3">Surat Peringatan</div>
                                        </div>
                                    </div>
                                </label>
                            </div>

                            <div class="col-md-6 col-lg-4 ">
                                <label
                                    class="form-selectgroup-item flex-fill bg-warning-subtle border border-warning-subtle rounded-3">
                                    <div class="card-stamp">
                                        <div class="card-stamp-icon bg-yellow">
                                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                                viewBox="0 0 24 24" fill="none" stroke="currentColor"
                                                stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                                                class="icon icon-tabler icons-tabler-outline icon-tabler-list-numbers">
                                                <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                                                <path d="M11 6h9" />
                                                <path d="M11 12h9" />
                                                <path d="M12 18h8" />
                                                <path d="M4 16a2 2 0 1 1 4 0c0 .591 -.5 1 -1 1.5l-3 2.5h4" />
                                                <path d="M6 10v-6l-2 2" />
                                            </svg>
                                        </div>
                                    </div>
                                    <input type="radio" name="inbox" value="4" id="radioInbox4"
                                        class="form-selectgroup-input radio-inbox" data-target-view="#view4"
                                        data-target-report="#modalReport4">
                                    <div class="form-selectgroup-label d-flex align-items-center p-3">
                                        <div class="form-selectgroup-label-content d-flex align-items-center">
                                            <span class="avatar bg-yellow  text-white me-5"><svg
                                                    xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                                    viewBox="0 0 24 24" fill="none" stroke="currentColor"
                                                    stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                                                    class="icon icon-tabler icons-tabler-outline icon-tabler-list-numbers">
                                                    <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                                                    <path d="M11 6h9" />
                                                    <path d="M11 12h9" />
                                                    <path d="M12 18h8" />
                                                    <path d="M4 16a2 2 0 1 1 4 0c0 .591 -.5 1 -1 1.5l-3 2.5h4" />
                                                    <path d="M6 10v-6l-2 2" />
                                                </svg></span>
                                        </div>
                                        <div>
                                            <div class="fw-bolder text-warning fs-3">Nomor Surat</div>
                                        </div>
                                    </div>
                                </label>
                            </div>
                            <div class="col-md-6 col-lg-4 ">
                                <label
                                    class="form-selectgroup-item flex-fill bg-warning-subtle border border-warning-subtle rounded-3">
                                    <div class="card-stamp">
                                        <div class="card-stamp-icon bg-warning">
                                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                                viewBox="0 0 24 24" fill="none" stroke="currentColor"
                                                stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                                                class="icon icon-tabler icons-tabler-outline icon-tabler-calendar-check">
                                                <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                                                <path
                                                    d="M11.5 21h-5.5a2 2 0 0 1 -2 -2v-12a2 2 0 0 1 2 -2h12a2 2 0 0 1 2 2v6" />
                                                <path d="M16 3v4" />
                                                <path d="M8 3v4" />
                                                <path d="M4 11h16" />
                                                <path d="M15 19l2 2l4 -4" />
                                            </svg>
                                        </div>
                                    </div>
                                    <input type="radio" name="inbox" value="5" id="radioInbox5"
                                        class="form-selectgroup-input radio-inbox" data-target-view="#view5"
                                        data-target-report="#modalReport5">
                                    <div class="form-selectgroup-label d-flex align-items-center p-3">
                                        <div class="form-selectgroup-label-content d-flex align-items-center">
                                            <span class="avatar bg-warning text-white me-5"><svg
                                                    xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                                    viewBox="0 0 24 24" fill="none" stroke="currentColor"
                                                    stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                                                    class="icon icon-tabler icons-tabler-outline icon-tabler-calendar-check">
                                                    <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                                                    <path
                                                        d="M11.5 21h-5.5a2 2 0 0 1 -2 -2v-12a2 2 0 0 1 2 -2h12a2 2 0 0 1 2 2v6" />
                                                    <path d="M16 3v4" />
                                                    <path d="M8 3v4" />
                                                    <path d="M4 11h16" />
                                                    <path d="M15 19l2 2l4 -4" />
                                                </svg></span>
                                        </div>
                                        <div>
                                            <div class="fw-bolder text-warning fs-3">Notulensi Rapat & Pelatihan Guru
                                            </div>
                                        </div>
                                    </div>
                                </label>
                            </div>
                            <div class="col-md-6 col-lg-4 ">
                                <label
                                    class="form-selectgroup-item flex-fill bg-success-subtle border border-success-subtle rounded-3">
                                    <div class="card-stamp">
                                        <div class="card-stamp-icon bg-success">
                                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                                viewBox="0 0 24 24" fill="none" stroke="currentColor"
                                                stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                                                class="icon icon-tabler icons-tabler-outline icon-tabler-clipboard-text">
                                                <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                                                <path
                                                    d="M9 5h-2a2 2 0 0 0 -2 2v12a2 2 0 0 0 2 2h10a2 2 0 0 0 2 -2v-12a2 2 0 0 0 -2 -2h-2" />
                                                <path
                                                    d="M9 3m0 2a2 2 0 0 1 2 -2h2a2 2 0 0 1 2 2v0a2 2 0 0 1 -2 2h-2a2 2 0 0 1 -2 -2z" />
                                                <path d="M9 12h6" />
                                                <path d="M9 16h6" />
                                            </svg>
                                        </div>
                                    </div>
                                    <input type="radio" name="inbox" value="6" id="radioInbox6"
                                        class="form-selectgroup-input radio-inbox" data-target-view="#view6"
                                        data-target-report="#modalReport6">
                                    <div class="form-selectgroup-label d-flex align-items-center p-3">
                                        <div class="form-selectgroup-label-content d-flex align-items-center">
                                            <span class="avatar bg-success text-white me-5"><svg
                                                    xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                                    viewBox="0 0 24 24" fill="none" stroke="currentColor"
                                                    stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                                                    class="icon icon-tabler icons-tabler-outline icon-tabler-clipboard-text">
                                                    <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                                                    <path
                                                        d="M9 5h-2a2 2 0 0 0 -2 2v12a2 2 0 0 0 2 2h10a2 2 0 0 0 2 -2v-12a2 2 0 0 0 -2 -2h-2" />
                                                    <path
                                                        d="M9 3m0 2a2 2 0 0 1 2 -2h2a2 2 0 0 1 2 2v0a2 2 0 0 1 -2 2h-2a2 2 0 0 1 -2 -2z" />
                                                    <path d="M9 12h6" />
                                                    <path d="M9 16h6" />
                                                </svg></span>
                                        </div>
                                        <div>
                                            <div class="fw-bolder text-success fs-3">Surat Pengajuan</div>
                                        </div>
                                    </div>
                                </label>
                            </div>
                        </div>
                    </div>
                    <div class="card-footer ">
                        {{-- <div class="col-md-6 col-lg-4 mb-3 d-flex ">

                                <select id="tp" class="form-select me-3" onchange="showInputField()">
                                    <option value="Selected">Pilih Tahun Ajaran</option>
                                    <option value="2022/2023">2022/2023</option>
                                    <option value="2023/2024">2023/2024</option>
                                    <option value="2024/2025">2024/2025</option>
                                    <option value="2025/2026">2025/2026</option>
                                    <option value="2026/2027">2026/2027</option>
                                </select>

                                <select id="js" class="form-select me-3" onchange="showInputField()">
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
                                </select>
                            </div> --}}
                        <div class="text-end">
                            <button type="button" class="btn" id='btnView' data-bs-toggle="modal">
                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                    viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
                                    stroke-linecap="round" stroke-linejoin="round"
                                    class="icon icon-tabler icons-tabler-outline icon-tabler-table-export">
                                    <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                                    <path d="M12.5 21h-7.5a2 2 0 0 1 -2 -2v-14a2 2 0 0 1 2 -2h14a2 2 0 0 1 2 2v7.5" />
                                    <path d="M3 10h18" />
                                    <path d="M10 3v18" />
                                    <path d="M16 19h6" />
                                    <path d="M19 16l3 3l-3 3" />
                                </svg>
                                View
                            </button>
                            <button id="submitButton" class="btn btn-primary" data-bs-toggle="modal"
                                disabled>Input</button>
                        </div>
                    </div>
                </div>
            </div>
            <!-- Tambahkan card lainnya di sini jika diperlukan -->
        </div>
    </div>



    <div class="container-view1 container-xl" id="view1" hidden>

        <div class="col-12">
            <div class="card">
                <div class="table-responsive p-3">
                    <table class="table card-table table-vcenter text-nowrap datatable" style="width: 100%"
                        id="myTable1">
                        <thead>
                            <tr>
                                <th>Tahun ajaran</th>
                                <th>Tanggal</th>
                                <th>No. surat</th>
                                <th>Jenis Surat</th>
                                <th>Perihal</th>
                                <th>dari</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($suratmasuk as $item)
                                <tr>
                                    <td>{{ $item->tp }}</td>
                                    <td>{{ $item->tanggal }}</td>
                                    <td>{{ $item->no_surat }}</td>
                                    <td>{{ Str::limit($item->jenis_surat, 15) }}</td>
                                    <td>{{ Str::limit($item->perihal, 15) }}</td>
                                    <td>{{ Str::limit($item->dari, 15) }}</td>
                                    <td>
                                        <div class="btn-group">
                                            <form action="{{ route('inbox.download', $item->id) }}"
                                                method="POST">
                                                @csrf
                                                @method('GET')
                                                <button type="submit"
                                                    class="btn btn-icon btn-sm btn-outline-primary"
                                                    role="button">
                                                    <svg xmlns="http://www.w3.org/2000/svg" width="24"
                                                        height="24" viewBox="0 0 24 24" fill="none"
                                                        stroke="currentColor" stroke-width="1.5"
                                                        stroke-linecap="round" stroke-linejoin="round"
                                                        class="icon icon-tabler icons-tabler-outline icon-tabler-download">
                                                        <path stroke="none" d="M0 0h24v24H0z"
                                                            fill="none" />
                                                        <path d="M4 17v2a2 2 0 0 0 2 2h12a2 2 0 0 0 2 -2v-2" />
                                                        <path d="M7 11l5 5l5 -5" />
                                                        <path d="M12 4l0 12" />
                                                    </svg>
                                                </button>
                                            </form>
                                            <button type="button"
                                                class="btn btn-icon btn-sm btn-outline-success" role="button"
                                                data-bs-target="#modalUpdate1{{ $item->id }}"
                                                data-bs-toggle="modal" data-bs-dismiss="modal">
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
                                            </button>
                                            <form action="{{ route('inbox.destroy', $item->id) }}"
                                                method="POST">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit"
                                                    class="btn btn-icon btn-sm btn-outline-danger"
                                                    role="button">
                                                    <svg xmlns="http://www.w3.org/2000/svg" width="24"
                                                        height="24" viewBox="0 0 24 24" fill="none"
                                                        stroke="currentColor" stroke-width="2"
                                                        stroke-linecap="round" stroke-linejoin="round"
                                                        class="icon icon-tabler icons-tabler-outline icon-tabler-trash">
                                                        <path stroke="none" d="M0 0h24v24H0z"
                                                            fill="none" />
                                                        <path d="M4 7l16 0" />
                                                        <path d="M10 11l0 6" />
                                                        <path d="M14 11l0 6" />
                                                        <path
                                                            d="M5 7l1 12a2 2 0 0 0 2 2h8a2 2 0 0 0 2 -2l1 -12" />
                                                        <path d="M9 7v-3a1 1 0 0 1 1 -1h4a1 1 0 0 1 1 1v3" />
                                                    </svg>
                                                </button>
                                            </form>
                                        </div>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
            <div class="card-footer justify-content-between">
                <form action="{{ route('pdf', ['model' => 'suratmasuk']) }}" id="filterdate">
                    <div class="row d-flex justify-content-between w-100">
                        <div class="col-8 d-flex g-2">
                            <div class="col-4 me-2">
                                <div class="input-icon mb-2">
                                    <input class="form-control" placeholder="Select a start date" id="datepicker-1"
                                        name="start_date">
                                    @error('start_date')
                                        <div class="text-danger">{{ $message }}</div>
                                    @enderror
                                    <span class="input-icon-addon">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24"
                                            height="24" viewBox="0 0 24 24" stroke-width="2"
                                            stroke="currentColor" fill="none" stroke-linecap="round"
                                            stroke-linejoin="round">
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
                            <div class="col-4">
                                <div class="input-icon mb-2 me-2">
                                    <input class="form-control" placeholder="Select an end date" id="datepicker-2"
                                        name="end_date">
                                    @error('end_date')
                                        <div class="text-danger">{{ $message }}</div>
                                    @enderror
                                    <span class="input-icon-addon">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24"
                                            height="24" viewBox="0 0 24 24" stroke-width="2"
                                            stroke="currentColor" fill="none" stroke-linecap="round"
                                            stroke-linejoin="round">
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
                            <div class="col-2  align-items-end">

                                <button type="submit" class="btn btn-primary">Cetak Laporan</button>

                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <div class="container-view2 container-xl" id="view2" hidden>

        <div class="col-12">
            <div class="card">
                <div class="table-responsive p-3">
                    <table class="table card-table table-vcenter text-nowrap datatable"
                        style="width: 100%" id="myTable2">
                        <thead>
                            <tr>
                                <th>Tahun ajaran</th>
                                {{-- <th>Tanggal</th> --}}
                                <th>No. surat</th>
                                <th>Jenis Surat</th>
                                <th>Perihal</th>
                                <th>Kepada</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($suratkeluar as $item)
                                <tr>
                                    <td>{{ $item->tp }}</td>
                                    {{-- <td>{{ $item->tanggal }}</td> --}}
                                    <td>{{ $item->no_surat }}</td>
                                    <td>{{ Str::limit($item->jenis_surat, 15) }}</td>
                                    <td>{{ Str::limit($item->perihal, 15) }}</td>
                                    <td>{{ Str::limit($item->kepada, 15) }}</td>
                                    <td>
                                        <div class="btn-group">
                                            <form action="{{ route('inbox.download', $item->id) }}"
                                                method="POST">
                                                @csrf
                                                @method('GET')
                                                <button type="submit"
                                                    class="btn btn-icon btn-sm btn-outline-primary"
                                                    role="button">
                                                    <svg xmlns="http://www.w3.org/2000/svg" width="24"
                                                        height="24" viewBox="0 0 24 24" fill="none"
                                                        stroke="currentColor" stroke-width="1.5"
                                                        stroke-linecap="round" stroke-linejoin="round"
                                                        class="icon icon-tabler icons-tabler-outline icon-tabler-download">
                                                        <path stroke="none" d="M0 0h24v24H0z"
                                                            fill="none" />
                                                        <path
                                                            d="M4 17v2a2 2 0 0 0 2 2h12a2 2 0 0 0 2 -2v-2" />
                                                        <path d="M7 11l5 5l5 -5" />
                                                        <path d="M12 4l0 12" />
                                                    </svg>
                                                </button>
                                            </form>
                                            <button type="button"
                                                class="btn btn-icon btn-sm btn-outline-success"
                                                role="button"
                                                data-bs-target="#modalUpdate2{{ $item->id }}"
                                                data-bs-toggle="modal" data-bs-dismiss="modal">
                                                <svg xmlns="http://www.w3.org/2000/svg" width="24"
                                                    height="24" viewBox="0 0 24 24" fill="none"
                                                    stroke="currentColor" stroke-width="2"
                                                    stroke-linecap="round" stroke-linejoin="round"
                                                    class="icon icon-tabler icons-tabler-outline icon-tabler-edit">
                                                    <path stroke="none" d="M0 0h24v24H0z"
                                                        fill="none" />
                                                    <path
                                                        d="M7 7h-1a2 2 0 0 0 -2 2v9a2 2 0 0 0 2 2h9a2 2 0 0 0 2 -2v-1" />
                                                    <path
                                                        d="M20.385 6.585a2.1 2.1 0 0 0 -2.97 -2.97l-8.415 8.385v3h3l8.385 -8.415z" />
                                                    <path d="M16 5l3 3" />
                                                </svg>
                                            </button>
                                            <form action="{{ route('inbox.destroy', $item->id) }}"
                                                method="POST">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit"
                                                    class="btn btn-icon btn-sm btn-outline-danger"
                                                    role="button">
                                                    <svg xmlns="http://www.w3.org/2000/svg" width="24"
                                                        height="24" viewBox="0 0 24 24" fill="none"
                                                        stroke="currentColor" stroke-width="2"
                                                        stroke-linecap="round" stroke-linejoin="round"
                                                        class="icon icon-tabler icons-tabler-outline icon-tabler-trash">
                                                        <path stroke="none" d="M0 0h24v24H0z"
                                                            fill="none" />
                                                        <path d="M4 7l16 0" />
                                                        <path d="M10 11l0 6" />
                                                        <path d="M14 11l0 6" />
                                                        <path
                                                            d="M5 7l1 12a2 2 0 0 0 2 2h8a2 2 0 0 0 2 -2l1 -12" />
                                                        <path
                                                            d="M9 7v-3a1 1 0 0 1 1 -1h4a1 1 0 0 1 1 1v3" />
                                                    </svg>
                                                </button>
                                            </form>
                                        </div>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
            <div class="card-footer justify-content-between">
                <form action="{{ route('pdf', ['model' => 'suratkeluar']) }}" id="filterdate">
                    <div class="row d-flex justify-content-between w-100">
                        <div class="col-8 d-flex g-2">
                            <div class="col-4 me-2">
                                <div class="input-icon mb-2">
                                    <input class="form-control" placeholder="Select a start date" id="datepicker-1"
                                        name="start_date">
                                    @error('start_date')
                                        <div class="text-danger">{{ $message }}</div>
                                    @enderror
                                    <span class="input-icon-addon">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24"
                                            height="24" viewBox="0 0 24 24" stroke-width="2"
                                            stroke="currentColor" fill="none" stroke-linecap="round"
                                            stroke-linejoin="round">
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
                            <div class="col-4">
                                <div class="input-icon mb-2 me-2">
                                    <input class="form-control" placeholder="Select an end date" id="datepicker-2"
                                        name="end_date">
                                    @error('end_date')
                                        <div class="text-danger">{{ $message }}</div>
                                    @enderror
                                    <span class="input-icon-addon">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24"
                                            height="24" viewBox="0 0 24 24" stroke-width="2"
                                            stroke="currentColor" fill="none" stroke-linecap="round"
                                            stroke-linejoin="round">
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
                            <div class="col-2  align-items-end">

                                <button type="submit" class="btn btn-primary">Cetak Laporan</button>

                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <div class="container-view3 container-xl" id="view3" hidden>

        <div class="col-12">
            <div class="card">
                <div class="table-responsive p-3">
                    <table class="table card-table table-vcenter text-nowrap datatable"
                        style="width: 100%" id="myTable3">
                        <thead>
                            <tr>
                                <th>Tahun ajaran</th>
                                <th>Tanggal</th>
                                <th>No. Surat</th>
                                <th>subjek</th>
                                <th>Siswa</th>
                                <th>Guru</th>
                                <th>sp</th>
                                <th>alasan</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($suratperingatan as $item)
                                <tr>
                                    <td>{{ $item->tp }}</td>
                                    <td>{{ $item->tanggal }}</td>
                                    <td>{{ $item->no_surat }}</td>
                                    <td>{{ Str::limit($item->subjek, 15) }}</td>
                                    <td>{{ Str::limit($item->siswa, 15) }}</td>
                                    <td>{{ Str::limit($item->guru, 15) }}</td>
                                    <td>{{ Str::limit($item->sp, 15) }}</td>
                                    <td>{{ Str::limit($item->alasan, 15) }}</td>
                                    <td>
                                        <div class="btn-group">
                                            <form action="{{ route('sp.download', $item->id) }}"
                                                method="POST">
                                                @csrf
                                                @method('GET')
                                                <button type="submit"
                                                    class="btn btn-icon btn-sm btn-outline-primary"
                                                    role="button">
                                                    <svg xmlns="http://www.w3.org/2000/svg" width="24"
                                                        height="24" viewBox="0 0 24 24" fill="none"
                                                        stroke="currentColor" stroke-width="1.5"
                                                        stroke-linecap="round" stroke-linejoin="round"
                                                        class="icon icon-tabler icons-tabler-outline icon-tabler-download">
                                                        <path stroke="none" d="M0 0h24v24H0z"
                                                            fill="none" />
                                                        <path
                                                            d="M4 17v2a2 2 0 0 0 2 2h12a2 2 0 0 0 2 -2v-2" />
                                                        <path d="M7 11l5 5l5 -5" />
                                                        <path d="M12 4l0 12" />
                                                    </svg>
                                                </button>
                                            </form>
                                            <button type="button"
                                                class="btn btn-icon btn-sm btn-outline-success"
                                                role="button"
                                                data-bs-target="#modalUpdate2{{ $item->id }}"
                                                data-bs-toggle="modal" data-bs-dismiss="modal">
                                                <svg xmlns="http://www.w3.org/2000/svg" width="24"
                                                    height="24" viewBox="0 0 24 24" fill="none"
                                                    stroke="currentColor" stroke-width="2"
                                                    stroke-linecap="round" stroke-linejoin="round"
                                                    class="icon icon-tabler icons-tabler-outline icon-tabler-edit">
                                                    <path stroke="none" d="M0 0h24v24H0z"
                                                        fill="none" />
                                                    <path
                                                        d="M7 7h-1a2 2 0 0 0 -2 2v9a2 2 0 0 0 2 2h9a2 2 0 0 0 2 -2v-1" />
                                                    <path
                                                        d="M20.385 6.585a2.1 2.1 0 0 0 -2.97 -2.97l-8.415 8.385v3h3l8.385 -8.415z" />
                                                    <path d="M16 5l3 3" />
                                                </svg>
                                            </button>
                                            <form action="{{ route('sp.destroy', $item->id) }}"
                                                method="POST">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit"
                                                    class="btn btn-icon btn-sm btn-outline-danger"
                                                    role="button">
                                                    <svg xmlns="http://www.w3.org/2000/svg" width="24"
                                                        height="24" viewBox="0 0 24 24" fill="none"
                                                        stroke="currentColor" stroke-width="2"
                                                        stroke-linecap="round" stroke-linejoin="round"
                                                        class="icon icon-tabler icons-tabler-outline icon-tabler-trash">
                                                        <path stroke="none" d="M0 0h24v24H0z"
                                                            fill="none" />
                                                        <path d="M4 7l16 0" />
                                                        <path d="M10 11l0 6" />
                                                        <path d="M14 11l0 6" />
                                                        <path
                                                            d="M5 7l1 12a2 2 0 0 0 2 2h8a2 2 0 0 0 2 -2l1 -12" />
                                                        <path
                                                            d="M9 7v-3a1 1 0 0 1 1 -1h4a1 1 0 0 1 1 1v3" />
                                                    </svg>
                                                </button>
                                            </form>
                                        </div>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
            <div class="card-footer justify-content-between">
                <form action="{{ route('pdf', ['model' => 'suratperingatan']) }}" id="filterdate">
                    <div class="row d-flex justify-content-between w-100">
                        <div class="col-8 d-flex g-2">
                            <div class="col-4 me-2">
                                <div class="input-icon mb-2">
                                    <input class="form-control" placeholder="Select a start date"
                                        id="datepicker-1" name="start_date">
                                    @error('start_date')
                                        <div class="text-danger">{{ $message }}</div>
                                    @enderror
                                    <span class="input-icon-addon">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24"
                                            height="24" viewBox="0 0 24 24" stroke-width="2"
                                            stroke="currentColor" fill="none" stroke-linecap="round"
                                            stroke-linejoin="round">
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
                            <div class="col-4">
                                <div class="input-icon mb-2 me-2">
                                    <input class="form-control" placeholder="Select an end date" id="datepicker-2"
                                        name="end_date">
                                    @error('end_date')
                                        <div class="text-danger">{{ $message }}</div>
                                    @enderror
                                    <span class="input-icon-addon">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24"
                                            height="24" viewBox="0 0 24 24" stroke-width="2"
                                            stroke="currentColor" fill="none" stroke-linecap="round"
                                            stroke-linejoin="round">
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
                            <div class="col-2">
                                <select name="subjek" id="subjekFilter" class="form-control me-2">
                                    <option selected>Pilih subjek</option>
                                    <option value="siswa">siswa</option>
                                    <option value="guru">guru</option>
                                </select>
                            </div>
                            <div class="col-2 align-items-end">

                                <button type="submit" class="btn btn-primary">Cetak Laporan</button>

                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <div class="container-view4 container-xl" id="view4" hidden>

        <div class="col-12">
            <div class="card">
                <div class="table-responsive p-3">
                    <table class="table card-table table-vcenter text-nowrap datatable"
                        style="width: 100%" id="myTable4">
                        <thead>
                            <tr>
                                <th>Tahun ajaran</th>
                                <th>Tanggal</th>
                                <th>No. surat</th>
                                <th>keperluan</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($nomorsurat as $item)
                                <tr>
                                    <td>{{ $item->tp }}</td>
                                    <td>{{ $item->tanggal }}</td>
                                    <td>{{ $item->no_surat }}</td>
                                    <td>{{ Str::limit($item->keperluan, 15) }}</td>
                                    <td>
                                        <div class="btn-group">
                                            <form action="{{ route('inbox.download', $item->id) }}"
                                                method="POST">
                                                @csrf
                                                @method('GET')
                                                <button type="submit"
                                                    class="btn btn-icon btn-sm btn-outline-primary"
                                                    role="button">
                                                    <svg xmlns="http://www.w3.org/2000/svg"
                                                        width="24" height="24"
                                                        viewBox="0 0 24 24" fill="none"
                                                        stroke="currentColor" stroke-width="1.5"
                                                        stroke-linecap="round" stroke-linejoin="round"
                                                        class="icon icon-tabler icons-tabler-outline icon-tabler-download">
                                                        <path stroke="none" d="M0 0h24v24H0z"
                                                            fill="none" />
                                                        <path
                                                            d="M4 17v2a2 2 0 0 0 2 2h12a2 2 0 0 0 2 -2v-2" />
                                                        <path d="M7 11l5 5l5 -5" />
                                                        <path d="M12 4l0 12" />
                                                    </svg>
                                                </button>
                                            </form>
                                            <button type="button"
                                                class="btn btn-icon btn-sm btn-outline-success"
                                                role="button"
                                                data-bs-target="#modalUpdate4{{ $item->id }}"
                                                data-bs-toggle="modal" data-bs-dismiss="modal">
                                                <svg xmlns="http://www.w3.org/2000/svg" width="24"
                                                    height="24" viewBox="0 0 24 24" fill="none"
                                                    stroke="currentColor" stroke-width="2"
                                                    stroke-linecap="round" stroke-linejoin="round"
                                                    class="icon icon-tabler icons-tabler-outline icon-tabler-edit">
                                                    <path stroke="none" d="M0 0h24v24H0z"
                                                        fill="none" />
                                                    <path
                                                        d="M7 7h-1a2 2 0 0 0 -2 2v9a2 2 0 0 0 2 2h9a2 2 0 0 0 2 -2v-1" />
                                                    <path
                                                        d="M20.385 6.585a2.1 2.1 0 0 0 -2.97 -2.97l-8.415 8.385v3h3l8.385 -8.415z" />
                                                    <path d="M16 5l3 3" />
                                                </svg>
                                            </button>
                                            <form action="{{ route('inbox.destroy', $item->id) }}"
                                                method="POST">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit"
                                                    class="btn btn-icon btn-sm btn-outline-danger"
                                                    role="button">
                                                    <svg xmlns="http://www.w3.org/2000/svg"
                                                        width="24" height="24"
                                                        viewBox="0 0 24 24" fill="none"
                                                        stroke="currentColor" stroke-width="2"
                                                        stroke-linecap="round" stroke-linejoin="round"
                                                        class="icon icon-tabler icons-tabler-outline icon-tabler-trash">
                                                        <path stroke="none" d="M0 0h24v24H0z"
                                                            fill="none" />
                                                        <path d="M4 7l16 0" />
                                                        <path d="M10 11l0 6" />
                                                        <path d="M14 11l0 6" />
                                                        <path
                                                            d="M5 7l1 12a2 2 0 0 0 2 2h8a2 2 0 0 0 2 -2l1 -12" />
                                                        <path
                                                            d="M9 7v-3a1 1 0 0 1 1 -1h4a1 1 0 0 1 1 1v3" />
                                                    </svg>
                                                </button>
                                            </form>
                                        </div>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
        <div class="card-footer justify-content-between">
            <form action="{{ route('pdf', ['model' => 'nomorsurat']) }}" id="filterdate">
                <div class="row d-flex justify-content-between w-100">
                    <div class="col-8 d-flex g-2">
                        <div class="col-4 me-2">
                            <div class="input-icon mb-2">
                                <input class="form-control" placeholder="Select a start date"
                                    id="datepicker-1" name="start_date">
                                @error('start_date')
                                    <div class="text-danger">{{ $message }}</div>
                                @enderror
                                <span class="input-icon-addon">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24"
                                        height="24" viewBox="0 0 24 24" stroke-width="2"
                                        stroke="currentColor" fill="none" stroke-linecap="round"
                                        stroke-linejoin="round">
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
                        <div class="col-4">
                            <div class="input-icon mb-2 me-2">
                                <input class="form-control" placeholder="Select an end date" id="datepicker-2"
                                    name="end_date">
                                @error('end_date')
                                    <div class="text-danger">{{ $message }}</div>
                                @enderror
                                <span class="input-icon-addon">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24"
                                        height="24" viewBox="0 0 24 24" stroke-width="2"
                                        stroke="currentColor" fill="none" stroke-linecap="round"
                                        stroke-linejoin="round">
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
                        <div class="col-2  align-items-end">

                            <button type="submit" class="btn btn-primary">Cetak Laporan</button>

                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>
    <div class="container-view5 container-xl" id="view5" hidden>
        <div class="col-12">
            <div class="card">
                <div class="table-responsive p-3">
                    <table class="table card-table table-vcenter text-nowrap datatable"
                        style="width: 100%" id="myTable5">
                        <thead>
                            <tr>
                                <th>Tahun ajaran</th>
                                <th>Tanggal</th>
                                <th>No. Surat</th>

                                <th>status</th>
                                <th>materi</th>
                                <th>peserta</th>
                                <th>hasil</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($notulensi as $item)
                                <tr>
                                    <td>{{ $item->tp }}</td>
                                    <td>{{ $item->tanggal }}</td>
                                    <td>{{ $item->no_surat }}</td>
                                    <td>{{ $item->daring }}</td>
                                    <td>{{ Str::limit($item->materi, 15) }}</td>
                                    <td>{{ Str::limit($item->peserta, 15) }}</td>
                                    <td>{{ Str::limit($item->hasil, 15) }}</td>
                                    <td>
                                        <div class="btn-group">
                                            <form action="{{ route('notulensi.download', $item->id) }}"
                                                method="POST">
                                                @csrf
                                                @method('GET')
                                                <button type="submit"
                                                    class="btn btn-icon btn-sm btn-outline-primary"
                                                    role="button">
                                                    <svg xmlns="http://www.w3.org/2000/svg"
                                                        width="24" height="24"
                                                        viewBox="0 0 24 24" fill="none"
                                                        stroke="currentColor" stroke-width="1.5"
                                                        stroke-linecap="round" stroke-linejoin="round"
                                                        class="icon icon-tabler icons-tabler-outline icon-tabler-download">
                                                        <path stroke="none" d="M0 0h24v24H0z"
                                                            fill="none" />
                                                        <path
                                                            d="M4 17v2a2 2 0 0 0 2 2h12a2 2 0 0 0 2 -2v-2" />
                                                        <path d="M7 11l5 5l5 -5" />
                                                        <path d="M12 4l0 12" />
                                                    </svg>
                                                </button>
                                            </form>
                                            <form
                                                action="{{ route('notulensi.download_dokumentasi', $item->id) }}"
                                                method="POST">
                                                @csrf
                                                @method('GET')
                                                <button type="submit"
                                                    class="btn btn-icon btn-sm btn-outline-primary"
                                                    role="button">
                                                    <svg xmlns="http://www.w3.org/2000/svg"
                                                        width="24" height="24"
                                                        viewBox="0 0 24 24" fill="none"
                                                        stroke="currentColor" stroke-width="2"
                                                        stroke-linecap="round" stroke-linejoin="round"
                                                        class="icon icon-tabler icons-tabler-outline icon-tabler-camera">
                                                        <path stroke="none" d="M0 0h24v24H0z"
                                                            fill="none" />
                                                        <path
                                                            d="M5 7h1a2 2 0 0 0 2 -2a1 1 0 0 1 1 -1h6a1 1 0 0 1 1 1a2 2 0 0 0 2 2h1a2 2 0 0 1 2 2v9a2 2 0 0 1 -2 2h-14a2 2 0 0 1 -2 -2v-9a2 2 0 0 1 2 -2" />
                                                        <path d="M9 13a3 3 0 1 0 6 0a3 3 0 0 0 -6 0" />
                                                    </svg>
                                                </button>
                                            </form>
                                            <button type="button"
                                                class="btn btn-icon btn-sm btn-outline-success"
                                                role="button"
                                                data-bs-target="#modalUpdate5{{ $item->id }}"
                                                data-bs-toggle="modal" data-bs-dismiss="modal">
                                                <svg xmlns="http://www.w3.org/2000/svg" width="24"
                                                    height="24" viewBox="0 0 24 24" fill="none"
                                                    stroke="currentColor" stroke-width="2"
                                                    stroke-linecap="round" stroke-linejoin="round"
                                                    class="icon icon-tabler icons-tabler-outline icon-tabler-edit">
                                                    <path stroke="none" d="M0 0h24v24H0z"
                                                        fill="none" />
                                                    <path
                                                        d="M7 7h-1a2 2 0 0 0 -2 2v9a2 2 0 0 0 2 2h9a2 2 0 0 0 2 -2v-1" />
                                                    <path
                                                        d="M20.385 6.585a2.1 2.1 0 0 0 -2.97 -2.97l-8.415 8.385v3h3l8.385 -8.415z" />
                                                    <path d="M16 5l3 3" />
                                                </svg>
                                            </button>
                                            <form action="{{ route('inbox.destroy', $item->id) }}"
                                                method="POST">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit"
                                                    class="btn btn-icon btn-sm btn-outline-danger"
                                                    role="button">
                                                    <svg xmlns="http://www.w3.org/2000/svg"
                                                        width="24" height="24"
                                                        viewBox="0 0 24 24" fill="none"
                                                        stroke="currentColor" stroke-width="2"
                                                        stroke-linecap="round" stroke-linejoin="round"
                                                        class="icon icon-tabler icons-tabler-outline icon-tabler-trash">
                                                        <path stroke="none" d="M0 0h24v24H0z"
                                                            fill="none" />
                                                        <path d="M4 7l16 0" />
                                                        <path d="M10 11l0 6" />
                                                        <path d="M14 11l0 6" />
                                                        <path
                                                            d="M5 7l1 12a2 2 0 0 0 2 2h8a2 2 0 0 0 2 -2l1 -12" />
                                                        <path
                                                            d="M9 7v-3a1 1 0 0 1 1 -1h4a1 1 0 0 1 1 1v3" />
                                                    </svg>
                                                </button>
                                            </form>
                                        </div>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
        <div class="card-footer justify-content-between">
            <form action="{{ route('pdf', ['model' => 'notulensi']) }}" id="filterdate">
                <div class="row d-flex justify-content-between w-100">
                    <div class="col-8 d-flex g-2">
                        <div class="col-4 me-2">
                            <div class="input-icon mb-2">
                                <input class="form-control" placeholder="Select a start date"
                                    id="datepicker-1" name="start_date">
                                @error('start_date')
                                    <div class="text-danger">{{ $message }}</div>
                                @enderror
                                <span class="input-icon-addon">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24"
                                        height="24" viewBox="0 0 24 24" stroke-width="2"
                                        stroke="currentColor" fill="none" stroke-linecap="round"
                                        stroke-linejoin="round">
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
                        <div class="col-4">
                            <div class="input-icon mb-2 me-2">
                                <input class="form-control" placeholder="Select an end date" id="datepicker-2"
                                    name="end_date">
                                @error('end_date')
                                    <div class="text-danger">{{ $message }}</div>
                                @enderror
                                <span class="input-icon-addon">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24"
                                        height="24" viewBox="0 0 24 24" stroke-width="2"
                                        stroke="currentColor" fill="none" stroke-linecap="round"
                                        stroke-linejoin="round">
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
                        <div class="col-2  align-items-end">

                            <button type="submit" class="btn btn-primary">Cetak Laporan</button>

                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>
    <div class="container-view6 container-xl" id="view6" hidden>

        <div class="col-12">
            <div class="card">
                <div class="table-responsive p-3">
                    <table class="table card-table table-vcenter text-nowrap datatable"
                        style="width: 100%" id="myTable6">
                        <thead>
                            <tr>
                                <th>Tahun ajaran</th>
                                {{-- <th>Tanggal</th> --}}
                                <th>No. surat</th>
                                <th>Jenis Pengajuan</th>
                                <th>Nama Pengajuan</th>
                                <th>Nominal</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($suratpengajuan as $item)
                                <tr>
                                    <td>{{ $item->tp }}</td>
                                    {{-- <td>{{ $item->tanggal }}</td> --}}
                                    <td>{{ $item->no_surat }}</td>
                                    <td>{{ Str::limit($item->jenis_pengajuan, 15) }}</td>
                                    <td>{{ Str::limit($item->nama_pengajuan, 15) }}</td>
                                    <td>{{ $item->nominal }}</td>
                                    <td>
                                        <div class="btn-group">
                                            <form action="{{ route('inbox.download', $item->id) }}"
                                                method="POST">
                                                @csrf
                                                @method('GET')
                                                <button type="submit"
                                                    class="btn btn-icon btn-sm btn-outline-primary"
                                                    role="button">
                                                    <svg xmlns="http://www.w3.org/2000/svg"
                                                        width="24" height="24"
                                                        viewBox="0 0 24 24" fill="none"
                                                        stroke="currentColor" stroke-width="1.5"
                                                        stroke-linecap="round" stroke-linejoin="round"
                                                        class="icon icon-tabler icons-tabler-outline icon-tabler-download">
                                                        <path stroke="none" d="M0 0h24v24H0z"
                                                            fill="none" />
                                                        <path
                                                            d="M4 17v2a2 2 0 0 0 2 2h12a2 2 0 0 0 2 -2v-2" />
                                                        <path d="M7 11l5 5l5 -5" />
                                                        <path d="M12 4l0 12" />
                                                    </svg>
                                                </button>
                                            </form>
                                            <button type="button"
                                                class="btn btn-icon btn-sm btn-outline-success"
                                                role="button"
                                                data-bs-target="#modalUpdate6{{ $item->id }}"
                                                data-bs-toggle="modal" data-bs-dismiss="modal">
                                                <svg xmlns="http://www.w3.org/2000/svg" width="24"
                                                    height="24" viewBox="0 0 24 24" fill="none"
                                                    stroke="currentColor" stroke-width="2"
                                                    stroke-linecap="round" stroke-linejoin="round"
                                                    class="icon icon-tabler icons-tabler-outline icon-tabler-edit">
                                                    <path stroke="none" d="M0 0h24v24H0z"
                                                        fill="none" />
                                                    <path
                                                        d="M7 7h-1a2 2 0 0 0 -2 2v9a2 2 0 0 0 2 2h9a2 2 0 0 0 2 -2v-1" />
                                                    <path
                                                        d="M20.385 6.585a2.1 2.1 0 0 0 -2.97 -2.97l-8.415 8.385v3h3l8.385 -8.415z" />
                                                    <path d="M16 5l3 3" />
                                                </svg>
                                            </button>
                                            <form action="{{ route('inbox.destroy', $item->id) }}"
                                                method="POST">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit"
                                                    class="btn btn-icon btn-sm btn-outline-danger"
                                                    role="button">
                                                    <svg xmlns="http://www.w3.org/2000/svg"
                                                        width="24" height="24"
                                                        viewBox="0 0 24 24" fill="none"
                                                        stroke="currentColor" stroke-width="2"
                                                        stroke-linecap="round" stroke-linejoin="round"
                                                        class="icon icon-tabler icons-tabler-outline icon-tabler-trash">
                                                        <path stroke="none" d="M0 0h24v24H0z"
                                                            fill="none" />
                                                        <path d="M4 7l16 0" />
                                                        <path d="M10 11l0 6" />
                                                        <path d="M14 11l0 6" />
                                                        <path
                                                            d="M5 7l1 12a2 2 0 0 0 2 2h8a2 2 0 0 0 2 -2l1 -12" />
                                                        <path
                                                            d="M9 7v-3a1 1 0 0 1 1 -1h4a1 1 0 0 1 1 1v3" />
                                                    </svg>
                                                </button>
                                            </form>
                                        </div>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
        <div class="card-footer justify-content-between">
            <form action="{{ route('pdf', ['model' => 'suratpengajuan']) }}" id="filterdate">
                <div class="row d-flex justify-content-between w-100">
                    <div class="col-8 d-flex g-2">
                        <div class="col-4 me-2">
                            <div class="input-icon mb-2">
                                <input class="form-control" placeholder="Select a start date"
                                    id="datepicker-1" name="start_date">
                                @error('start_date')
                                    <div class="text-danger">{{ $message }}</div>
                                @enderror
                                <span class="input-icon-addon">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24"
                                        height="24" viewBox="0 0 24 24" stroke-width="2"
                                        stroke="currentColor" fill="none" stroke-linecap="round"
                                        stroke-linejoin="round">
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
                        <div class="col-4">
                            <div class="input-icon mb-2 me-2">
                                <input class="form-control" placeholder="Select an end date" id="datepicker-2"
                                    name="end_date">
                                @error('end_date')
                                    <div class="text-danger">{{ $message }}</div>
                                @enderror
                                <span class="input-icon-addon">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24"
                                        height="24" viewBox="0 0 24 24" stroke-width="2"
                                        stroke="currentColor" fill="none" stroke-linecap="round"
                                        stroke-linejoin="round">
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
                        <div class="col-2  align-items-end">

                            <button type="submit" class="btn btn-primary">Cetak Laporan</button>

                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
    </div>

    @include('components.radio')


    <script src="{{ asset('dist/js/tabler.min.js') }}"></script>
    <script src="{{ asset('dist/js/demo.min.js') }}" defer></script>
    <script src="{{ asset('dist/libs/litepicker/dist/litepicker.js') }}" defer></script>
    <script src="{{ asset('./dist/libs/tinymce/tinymce.min.js?1720208459') }}" defer=""></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/5.3.0/js/bootstrap.bundle.min.js"></script>
    <script src="https://cdn.datatables.net/2.0.8/js/dataTables.js"></script>
    <script src="https://cdn.datatables.net/2.0.8/js/dataTables.bootstrap5.js"></script>



    <script>
        $(document).ready(function() {
            // Initialize input mask
            $("#time-input").inputmask("99:99-99:99", {
                placeholder: "HH:MM-HH:MM",
                separator: "-",
                hourFormat: "24"
            });
        });
    </script>

    <script>
        $(document).ready(function() {
            // Initialize input mask when the modal is shown
            $('#updateModal').on('shown.bs.modal', function() {
                $("#time-input").inputmask("99:99-99:99", {
                    placeholder: "HH:MM-HH:MM",
                    separator: "-",
                    hourFormat: "24"
                });
            });
        });

        // format rupiah
        $(document).ready(function() {
            $('#nominal').inputmask('decimal', {
                'alias': 'numeric',
                'groupSeparator': '.',
                'autoGroup': true,
                'digits': 0,
                'radixPoint': ',',
                'digitsOptional': false,
                'prefix': 'Rp. ',
                'placeholder': '0',
                'removeMaskOnSubmit': true
            });
        });
    </script>


    {{-- <script>
        document.addEventListener('DOMContentLoaded', function() {
            let tableIds = ['myTable1', 'myTable2', 'myTable3', 'myTable4', 'myTable5', 'myTable6'];

            // Initialize tables when modal is shown
            $('#view1, #view2, #view3, #view4, #view5, #view6').on('shown.bs.modal',
                function() {
                    tableIds.forEach(function(id) {
                        let tableElement = document.getElementById(id);
                        if (tableElement && !$.fn.DataTable.isDataTable(tableElement)) {
                            new DataTable(tableElement); // Initialize DataTable for each table
                        }
                    });
                });
        });
    </script> --}}
@endsection
