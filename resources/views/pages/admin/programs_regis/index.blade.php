@extends('layouts.admin')

@section('title', 'Pendaftar Program | Admin WateryNation')
@section('menuProgramShow', 'show')
@section('menuProgramExpanded', 'true')
@section('menuProgramRegistrations', 'active')

@section('admin-content')
    <div class="row mb-4">
        <div class="col-md-4 mb-3 mb-md-0">
            <div class="card border-start border-4 shadow-sm h-100" style="border-color: #0d6efd !important;">
                <div class="card-body">
                    <div class="d-flex align-items-center">
                        <div>
                            <p class="text-uppercase fw-bold text-muted mb-1 small" style="letter-spacing: 1px;">Total Pendaftar</p>
                            <h2 class="mb-0 fw-bolder text-dark">{{ number_format($stats['total']) }}</h2>
                        </div>
                        <div class="ms-auto p-3 rounded" style="background-color: #e7f1ff;">
                            <i class="ti ti-users fs-7 text-primary"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-md-4 mb-3 mb-md-0">
            <div class="card border-start border-4 shadow-sm h-100" style="border-color: #001f3f !important;">
                <div class="card-body">
                    <div class="d-flex align-items-center">
                        <div>
                            <p class="text-uppercase fw-bold text-muted mb-1 small" style="letter-spacing: 1px;">Program Online</p>
                            <h2 class="mb-0 fw-bolder" style="color: #001f3f;">{{ number_format($stats['online']) }}</h2>
                        </div>
                        <div class="ms-auto p-3 rounded" style="background-color: #d1d9e6;">
                            <i class="ti ti-device-laptop fs-7" style="color: #001f3f;"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-md-4">
            <div class="card border-start border-4 shadow-sm h-100" style="border-color: #fd7e14 !important;">
                <div class="card-body">
                    <div class="d-flex align-items-center">
                        <div>
                            <p class="text-uppercase fw-bold text-muted mb-1 small" style="letter-spacing: 1px;">Program Offline</p>
                            <h2 class="mb-0 fw-bolder" style="color: #a0522d;">{{ number_format($stats['offline']) }}</h2>
                        </div>
                        <div class="ms-auto p-3 rounded" style="background-color: #fff4e6;">
                            <i class="ti ti-map-pin fs-7" style="color: #fd7e14;"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="card w-100 shadow-sm">
        <div class="card-body p-4">
            <div class="d-flex flex-column flex-md-row mb-4 align-items-md-center justify-content-between gap-3">
                <h5 class="fw-bold mb-0">List Pendaftar Program</h5>
                
                <div class="d-flex flex-column flex-md-row gap-2">
                    <form action="{{ route('admin.program-registrasi.index') }}" method="GET" class="d-flex gap-2">
                        <select name="program_id" class="form-select form-select-sm" style="min-width: 200px;">
                            <option value="">-- Semua Program --</option>
                            @foreach($programs as $program)
                                <option value="{{ $program->id }}" {{ request('program_id') == $program->id ? 'selected' : '' }}>
                                    {{ $program->title }}
                                </option>
                            @endforeach
                        </select>
                        <button type="submit" class="btn btn-primary btn-sm px-3">
                            <i class="ti ti-filter"></i> Filter
                        </button>
                    </form>

                    <a href="{{ route('admin.program-registrasi.export', ['program_id' => request('program_id')]) }}" class="btn btn-success btn-sm px-3">
                        <i class="ti ti-file-spreadsheet"></i> Export Excel
                    </a>
                </div>
            </div>

            <div class="table-responsive">
                <table class="table table-hover align-middle">
                    <thead class="table-light">
                        <tr>
                            <th class="text-center">Nama Peserta</th>
                            <th>Email</th>
                            <th>WhatsApp</th>
                            <th>Program</th>
                            <th class="text-center">Tanggal Daftar</th>
                            <th class="text-center">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($programsRegistrasi as $registrasi)
                            <tr>
                                <td class="text-center fw-bold text-dark">{{ $registrasi->name }}</td>
                                <td>{{ $registrasi->email }}</td>
                                <td>
                                    <a href="https://wa.me/{{ preg_replace('/[^0-9]/', '', $registrasi->phone) }}" target="_blank" class="badge bg-light-success text-success text-decoration-none border border-success px-2 py-2">
                                        <i class="ti ti-brand-whatsapp"></i> {{ $registrasi->phone }}
                                    </a>
                                </td>
                                <td>
                                    <span class="badge bg-light-info text-info border border-info px-2">
                                        {{ $registrasi->program ? $registrasi->program->title : '-' }}
                                    </span>
                                </td>
                                <td class="text-center text-muted">{{ $registrasi->created_at->format('d M Y, H:i') }}</td>
                                <td class="text-center">
                                    <form action="{{ route('admin.program-registrasi.destroy', $registrasi->id) }}"
                                        method="POST" class="d-inline"
                                        onsubmit="return confirm('Hapus pendaftar ini?')">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-outline-danger btn-sm">
                                            <i class="ti ti-trash"></i>
                                        </button>
                                    </form>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="6" class="text-center py-5 text-muted fw-bold">Data pendaftar tidak ditemukan.</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>

                <div class="d-flex flex-column flex-md-row justify-content-between align-items-center mt-4">
                    <p class="mb-0 text-muted small">Menampilkan {{ $programsRegistrasi->count() }} dari {{ $stats['total'] }} pendaftar</p>
                    <div>
                        {{ $programsRegistrasi->appends(request()->input())->links() }}
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection