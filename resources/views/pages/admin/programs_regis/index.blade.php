@extends('layouts.admin')

@section('title', 'Pendaftar Program | Admin Dangau Studio')
@section('menuProgramShow', 'show')
@section('menuProgramExpanded', 'true')
@section('menuProgramRegistrations', 'active')

@section('admin-content')

    <div class="card w-100">
        <div class="card-body p-4">
            <div class="nav d-flex flex-column flex-md-row mb-3 align-items-md-center">
                <h5 class="mb-3 fw-bold me-md-auto">Pendaftar Program</h5>
            </div>

            <div class="table-responsive" data-simplebar>
                <table class="table table-bordered align-middle text-nowrap text-center">
                    <thead class="table-primary text-center">
                        <tr>
                            <th scope="col">Nama Peserta</th>
                            <th scope="col">Email</th>
                            <th scope="col">Program</th>
                            <th scope="col">Tanggal Daftar</th>
                            <th scope="col">Status</th>
                            <th scope="col">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($programsRegistrasi as $registrasi)
                            <tr>
                                <td>{{ $registrasi->nama_peserta }}</td>
                                <td>{{ $registrasi->email }}</td>
                                <td>
                                    {{ $registrasi->programs ? $registrasi->programs->title : '-' }}
                                </td>
                                <td>{{ tanggal($registrasi->created_at) }}</td>
                                <td>
                                    @if ($registrasi->status == 'Diterima')
                                        <span class="badge bg-light-success text-success rounded-pill px-3 py-2 fs-3">
                                            Diterima
                                        </span>
                                    @elseif ($registrasi->status == 'Ditolak')
                                        <span class="badge bg-light-danger text-danger rounded-pill px-3 py-2 fs-3">
                                            Ditolak
                                        </span>
                                    @else
                                        <span class="badge bg-light-secondary text-muted rounded-pill px-3 py-2 fs-3">
                                            Pending
                                        </span>
                                    @endif
                                </td>
                                <td>
                                    <a href="{{ route('admin.program.registrations.show', $registrasi->id) }}"
                                        class="btn btn-info btn-sm">
                                        <i class="ti ti-eye"></i>
                                    </a>
                                    <form action="{{ route('admin.program.registrations.destroy', $registrasi->id) }}"
                                        method="POST" class="d-inline"
                                        onsubmit="return confirm('Yakin ingin menghapus pendaftar ini?')">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-danger btn-sm">
                                            <i class="ti ti-trash"></i>
                                        </button>
                                    </form>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="6" class="text-center pt-4">Belum ada pendaftar program</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>

                <div class="d-flex justify-content-center mt-3">
                    {{ $programsRegistrasi->links() }}
                </div>
            </div>
        </div>
    </div>
@endsection
