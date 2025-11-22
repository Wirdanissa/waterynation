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
                            <th scope="col">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($programsRegistrasi as $registrasi)
                            <tr>
                                <td>{{ $registrasi->name }}</td>
                                <td>{{ $registrasi->email }}</td>
                                <td>
                                    {{ $registrasi->program ? $registrasi->program->title : '-' }}
                                </td>
                                <td>{{ tanggal($registrasi->created_at) }}</td>
                                <td>
                                    {{-- <a href="{{ route('admin.program-registrasi.show', $registrasi->id) }}"
                                        class="btn btn-info btn-sm">
                                        <i class="ti ti-eye"></i>
                                    </a> --}}
                                    <form action="{{ route('admin.program-registrasi.destroy', $registrasi->id) }}"
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
