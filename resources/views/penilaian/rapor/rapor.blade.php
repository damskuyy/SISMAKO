@extends('layouts.app')

@section('content')

<div class="py-5">
    <div class="container xl-custom-container">
        <div class="d-flex justify-content-between mb-4">
            <a href="/penilaian" class="btn btn-secondary">Back</a>
            <div>
                <a href="{{ route('average') }}" class="btn btn-success mx-2">Rerata Mapel</a>
                <a href="{{ route('rapor.create') }}" class="btn btn-primary">Tambah</a>
            </div>
        </div>

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
                            @foreach (['Tahun Ajaran', 'Kelas', 'Nama', 'PAI', 'PKN', 'B.Indo', 'MTK', 'Sejindo',
                            'B.Ingg', 'SBD', 'PJOK', 'Fisika', 'Kimia', 'SimDig', 'SisKom', 'KomJar', 'ProgDas', 'DDG',
                            'IaaS', 'PaaS', 'SaaS', 'SIoT', 'SKJ', 'PKK', '', '', ''] as $header)
                            <th>{{ $header }}</th>
                            @endforeach
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($rapor as $item)
                        <tr>
                            @foreach ([
                            $item->tahun_ajaran,
                            $item->kelas,
                            $item->nama,
                            $item->muatan_nasional['pai']['nilai'] ?? 'N/A',
                            $item->muatan_nasional['pkn']['nilai'] ?? 'N/A',
                            $item->muatan_nasional['bindo']['nilai'] ?? 'N/A',
                            $item->muatan_nasional['mtk']['nilai'] ?? 'N/A',
                            $item->muatan_nasional['sejindo']['nilai'] ?? 'N/A',
                            $item->muatan_nasional['bhsAsing']['nilai'] ?? 'N/A',
                            $item->muatan_kewilayahan['sbd']['nilai'] ?? 'N/A',
                            $item->muatan_kewilayahan['pjok']['nilai'] ?? 'N/A',
                            $item->muatan_peminatan['fisika']['nilai'] ?? 'N/A',
                            $item->muatan_peminatan['kimia']['nilai'] ?? 'N/A',
                            $item->muatan_peminatan['simdig']['nilai'] ?? 'N/A',
                            $item->muatan_peminatan['siskom']['nilai'] ?? 'N/A',
                            $item->muatan_peminatan['komjar']['nilai'] ?? 'N/A',
                            $item->muatan_peminatan['progdas']['nilai'] ?? 'N/A',
                            $item->muatan_peminatan['ddg']['nilai'] ?? 'N/A',
                            $item->muatan_peminatan['iaas']['nilai'] ?? 'N/A',
                            $item->muatan_peminatan['paas']['nilai'] ?? 'N/A',
                            $item->muatan_peminatan['saas']['nilai'] ?? 'N/A',
                            $item->muatan_peminatan['siot']['nilai'] ?? 'N/A',
                            $item->muatan_peminatan['skj']['nilai'] ?? 'N/A',
                            $item->muatan_peminatan['pkk']['nilai'] ?? 'N/A',
                            ] as $value)
                            <td>{{ $value }}</td>
                            @endforeach
                            <td>
                                <a href="{{ route('rapor.edit', $item->id) }}">
                                    <i
                                        class="fa-regular fa-pen-to-square text-white text-xl bg-yellow p-2 rounded"></i>
                                </a>
                            </td>
                            <td>
                                <a href="{{ route('rapor.pdf', $item->id) }}">
                                    <i class="fa-solid fa-file-export text-white text-xl bg-green p-2 rounded"></i>
                                </a>
                            </td>
                            <td>
                                <a href="#" data-bs-toggle="modal"
                                    data-bs-target="#modal-{{ $item->id }}">
                                    <i class="far fa-trash-alt text-white text-xl bg-red p-2 rounded"></i>
                                </a>
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="25" class="text-center">Tidak ada Data</td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    {{-- Danger Modal --}}
    @foreach ($rapor as $item)
    <div class="modal fade" id="modal-{{ $item->id }}" tabindex="-1" aria-labelledby="modalLabel-{{ $item->id }}"
        aria-hidden="true">
        <div class="modal-dialog modal-sm">
            <form action="{{ route('rapor.delete', $item->id) }}" method="post">
                @csrf
                @method('DELETE')
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="modalLabel-{{ $item->id }}">Konfirmasi Penghapusan</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <p>Apakah Anda yakin ingin menghapus data ini? Tindakan ini tidak dapat dibatalkan.</p>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                        <button type="submit" class="btn btn-danger">Hapus</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
    @endforeach
</div>
@endsection
