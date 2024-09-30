@extends('layouts.app')

@section('content')
<div class="py-5">
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
        <div class="container">
            <div class="col-12">
                <div class="mb-4">
                    <div class="col-12 row">
                        <div class="mb-4 col">
                            <a href="/sekolah-keasramaan/al-quran" class="btn btn-secondary">
                                Back
                            </a>
                        </div>
                        <div class="mb-4 col d-flex justify-content-end">
                            <a href="{{ route('pelatihan.create') }}" class="btn btn-primary">
                                Tambah
                            </a>
                        </div>
                    </div>
                </div>

                <!-- Form Filter -->
                <form method="GET" action="{{ route('pelatihan.index') }}" class="mb-4">
                    <div class="row">
                        <div class="col-md-3">
                            <input type="date" name="start_date" class="form-control" placeholder="Start Date">
                        </div>
                        <div class="col-md-3">
                            <input type="date" name="end_date" class="form-control" placeholder="End Date">
                        </div>
                        <div class="col-md-3">
                            <input type="text" name="search_name" class="form-control" placeholder="Search by Name">
                        </div>
                        <div class="col-md-2">
                            <button type="submit" class="btn btn-success">Filter</button>
                        </div>
                    </div>
                </form>

                <div class="card">
                    <div class="table-responsive">
                        <table class="table table-vcenter table-mobile-md card-table">
                            <thead>
                                <tr>
                                    <th>Tanggal</th>
                                    <th>Nama</th>
                                    <th>Nisn</th>
                                    <th>Surat</th>
                                    <th>Ayat</th>
                                    <th>Predikat</th>
                                    <th>Pengajar</th>
                                    <th></th>
                                    <th></th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse ($pelatihan as $item)
                                <tr>
                                    <td>{{ $item->tanggal }}</td>
                                    <td>{{ $item->siswa->nama }}</td>
                                    <td>{{ $item->siswa->nisn }}</td>
                                    <td>{{ $item->surat }}</td>
                                    <td>{{ $item->ayat }}</td>
                                    <td>{{ $item->predikat }}</td>
                                    <td>{{ $item->pengajar }}</td>
                                    <td>
                                        <a href="{{ route('pelatihan.edit', $item->id) }}">
                                            <i class="fa-regular fa-pen-to-square text-white text-xl bg-yellow p-2 rounded"></i>
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
                                    <td colspan="10" class="text-center">
                                        Tidak ada Data
                                    </td>
                                </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                    <div class="d-flex justify-content-center mt-4">
                        {{ $pelatihan->appends(request()->input())->links('vendor.pagination.bootstrap-5') }}                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
