@extends('layouts.app')

@section('content')
    <div class="py-5">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="container">
                <div class="col-12">
                    <div class="mb-4">
                        <div class="col-12 row">
                            <div class="mb-4 col">
                                <a href="/sekolah-keasramaan" class="btn btn-secondary">
                                    Back
                                </a>

                            </div>
                            <div class="mb-4 col d-flex justify-content-end">
                                <a href="{{ route('catatan.grooming.create') }}" class="btn btn-primary">
                                    Tambah
                                </a>
                            </div>
                            {{-- <form method="GET" action="{{ route('lab.index') }}" class="mb-4">
                            <div class="row">
                                <div class="col-12 col-md-2 mb-2 mb-md-0">
                                    <input type="date" name="start_date" class="form-control" placeholder="Start Date">
                                </div>
                                <div class="col-12 col-md-2 mb-2 mb-md-0">
                                    <input type="date" name="end_date" class="form-control" placeholder="End Date">
                                </div>
                                <div class="col-12 col-md-2 mb-2 mb-md-0">
                                    <input type="text" name="search_guru" class="form-control"
                                        placeholder="Search Guru">
                                </div>
                                <div class="col-12 col-md-2 mb-2 mb-md-0">
                                    <input type="text" name="search_kelas" class="form-control"
                                        placeholder="Search Kelas">
                                </div>
                                <div class="col-12 col-md-2 mb-2 mb-md-0">
                                    <input type="text" name="search_siswa" class="form-control"
                                        placeholder="Search Siswa">
                                </div>
                                <div class="col-12 col-md-2">
                                    <button type="submit" class="btn btn-success">Filter</button>
                                </div>
                            </div>
                        </form> --}}
                            @if (session('success'))
                                <div class="alert alert-important alert-success alert-dismissible" role="alert">
                                    <div class="d-flex">
                                        <div>
                                            <!-- Download SVG icon from http://tabler-icons.io/i/check -->
                                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                                viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
                                                stroke-linecap="round" stroke-linejoin="round" class="icon alert-icon">
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
                            @endif
                        </div>
                    </div>

                    <div class="table-responsive">
                        <table class="table table-striped">
                            <thead>
                                <tr>
                                    <th>Tanggal</th>
                                    <th>Kelas</th>
                                    <th>Siswa</th>
                                    <th>Catatan</th>
                                    <th>Nama Guru Piket</th>
                                    <th></th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($catatanGrooming as $data)
                                    <tr>
                                        <td>{{ $data->tanggal ?? 'N/A' }}</td>
                                        <td>{{ $data->siswa->dataKelas[0]->kelas }}</td>
                                        <td>{{ $data->siswa->nama ?? 'N/A' }}</td>
                                        <td>{{ $data->catatan }}</td>
                                        <td>{{ $data->guruPiket->nama }}</td>
                                        <td>
                                            <a href="{{ route('catatan.grooming.edit', $data->id) }}" class="">
                                                <i class="far fa-pencil-alt text-white text-xl bg-blue p-2 rounded"></i>
                                            </a>
                                            <a href="#" class="" data-bs-toggle="modal"
                                                data-bs-target="#modal-danger-{{ $data->id }}">
                                                <i class="far fa-trash-alt text-white text-xl bg-red p-2 rounded"></i>
                                            </a>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                    <div class="d-flex justify-content-center mt-4">
                        {{ $catatanGrooming->appends(request()->input())->links('vendor.pagination.bootstrap-5') }} </div>
                </div>
            </div>
        </div>
    </div>

    @foreach ($catatanGrooming as $item)
        <form action="{{ route('catatan.grooming.delete', $item->id) }}" method="post">
            @csrf
            @method('DELETE')
            <div class="modal modal-blur fade" id="modal-danger-{{ $item->id }}" tabindex="-1" role="dialog"
                aria-hidden="true">
                <div class="modal-dialog modal-sm modal-dialog-centered" role="document">
                    <div class="modal-content">
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        <div class="modal-status bg-danger"></div>
                        <div class="modal-body text-center py-4">
                            <svg xmlns="http://www.w3.org/2000/svg" class="icon mb-2 text-danger icon-lg" width="24"
                                height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none"
                                stroke-linecap="round" stroke-linejoin="round">
                                <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                                <path d="M12 9v4"></path>
                                <path
                                    d="M10.363 3.591l-8.106 13.534a1.914 1.914 0 0 0 1.636 2.871h16.214a1.914 1.914 0 0 0 1.636 -2.87l-8.106 -13.536a1.914 1.914 0 0 0 -3.274 0z">
                                </path>
                                <path d="M12 16h.01"></path>
                            </svg>
                            <h3>Are you sure?</h3>
                            <div class="text-secondary">Do you really want to remove this file? This action cannot be
                                undone.
                            </div>
                        </div>
                        <div class="modal-footer">
                            <div class="w-100">
                                <div class="row">
                                    <div class="col">
                                        <a href="#" class="btn w-100" data-bs-dismiss="modal">Cancel</a>
                                    </div>
                                    <div class="col">
                                        <button type="submit" class="btn btn-danger w-100">Delete</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </form>
    @endforeach
@endsection
