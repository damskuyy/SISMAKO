@extends('layouts.app')

@section('content')

<div class="py-5">
    <div class="container">
        <div class="d-flex justify-content-between mb-4">
            <a href="/penilaian" class="btn btn-secondary">Back</a>
            <div>
                <a href="{{ route('rasrama.create') }}" class="btn btn-primary">Tambah</a>
            </div>
        </div>
        <form method="GET" action="{{ route('rasrama') }}" class="mb-4">
            <div class="row">
                <div class="col-12 col-sm-6 col-md-4 col-lg-3 mb-2">
                    <input type="text" name="nama" class="form-control" value="{{ request('nama') }}"
                        placeholder="Search by Name">
                </div>
                <div class="col-12 col-sm-6 col-md-4 col-lg-3 mb-2">
                    <input type="text" name="kelas" class="form-control" value="{{ request('kelas') }}"
                        placeholder="Search by Kelas">
                </div>
                <div class="col-12 col-md-4 col-lg-2 mb-2">
                    <button type="submit" class="btn btn-success">Filter</button>
                </div>
            </div>
        </form>
        @if (session('success'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            <div class="d-flex align-items-center">
                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="none" stroke="currentColor"
                    stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="me-2">
                    <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                    <path d="M5 12l5 5l10 -10"></path>
                </svg>
                <div>{{ session('success') }}</div>
            </div>
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
        @endif

        <div class="card">
            <div class="table-responsive">
                <table class="table table-striped">
                    <thead>
                        <tr>
                            <th>Tahun Ajaran</th>
                            <th>Kelas</th>
                            <th>Semester</th>
                            <th>Nama</th>
                            <th>Edit</th>
                            <th>PDF</th>
                            <th>Hapus</th>
                        </tr>
                    </thead>
                                        <tbody>
                        @forelse ($rasrama as $item)
                        <tr>
                            <td>{{ $item->tahun_ajaran }}</td>
                            <td>{{ $item->kelas }}</td>
                            <td>{{ $item->semester }}</td>
                            <td>{{ $item->nama }}</td>
                            <td>
                                <a href="{{ route('rasrama.edit', $item->id) }}">
                                    <i class="fa-regular fa-pen-to-square text-white text-xl bg-yellow p-2 rounded"></i>
                                </a>
                            </td>
                            <td>
                                <a href="{{ route('rasrama.pdf', $item->id) }}">
                                    <i class="fa-solid fa-file-export text-white text-xl bg-green p-2 rounded"></i>
                                </a>
                            </td>
                            <td>
                                <a href="#" data-bs-toggle="modal" data-bs-target="#modal-danger-{{ $item->id }}">
                                    <i class="far fa-trash-alt text-white text-xl bg-red p-2 rounded"></i>
                                </a>
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="7" class="text-center">Tidak ada data rapor asrama yang tersedia.</td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
            <div class="d-flex justify-content-center mt-4">
                {{ $rasrama->appends(request()->input())->links('vendor.pagination.bootstrap-5') }}
            </div>
        </div>
    </div>

    {{-- Danger Modal --}}
    @foreach ($rasrama as $item)
    <form action="{{ route('rasrama.delete', $item->id) }}" method="post">
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
                            undone.</div>
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
</div>
@endsection
