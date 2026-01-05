@extends('layouts.admin')
@section('menuVolunteerShow', 'show')
@section('menuVolunteerExpanded', 'true')
@section('menuVolunteerRegistrations', 'active')
@section('title', 'Manajemen Pendaftar | Admin WateryNation')

@section('admin-content')
<style>
    /* Custom Styling untuk Kontras Tinggi */
    .card-stats { border: none; transition: all 0.3s; }
    .card-stats:hover { transform: translateY(-5px); }
    .text-bright { color: #ffffff !important; font-weight: 600; }
    .opacity-label { color: rgba(255, 255, 255, 0.85); font-size: 0.9rem; }
    
    /* Perbaikan Tombol PDF agar Terlihat Jelas */
    .btn-pdf {
        background-color: #ff4d4d;
        color: white !important;
        border: none;
        padding: 8px 12px;
        border-radius: 8px;
        display: inline-flex;
        align-items: center;
        gap: 5px;
        font-weight: 600;
        transition: 0.2s;
        box-shadow: 0 4px 6px rgba(255, 77, 77, 0.2);
    }
    .btn-pdf:hover { background-color: #e60000; transform: scale(1.05); }

    /* Table Styling */
    .table thead th { background-color: #f8f9fa; text-transform: uppercase; font-size: 0.75rem; letter-spacing: 1px; color: #333; }
    .badge-status { padding: 8px 12px; border-radius: 6px; font-weight: 700; text-transform: uppercase; font-size: 11px; }
</style>

<div class="container-fluid">
    <div class="row mb-4">
        <div class="col-md-4">
            <div class="card card-stats shadow-sm" style="background: linear-gradient(45deg, #1e3c72, #2a5298);">
                <div class="card-body p-4">
                    <div class="d-flex justify-content-between align-items-center">
                        <div>
                            <p class="opacity-label mb-1">Total Pendaftar</p>
                            <h2 class="text-bright mb-0">{{ $volunteers->total() }}</h2>
                        </div>
                        <i class="ti ti-users text-white opacity-50" style="font-size: 3rem;"></i>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="card card-stats shadow-sm" style="background: linear-gradient(45deg, #f39c12, #e67e22);">
                <div class="card-body p-4">
                    <div class="d-flex justify-content-between align-items-center">
                        <div>
                            <p class="opacity-label mb-1">Menunggu Review</p>
                            <h2 class="text-bright mb-0">{{ $volunteers->where('status', 'Pending')->count() }}</h2>
                        </div>
                        <i class="ti ti-clock-pause text-white opacity-50" style="font-size: 3rem;"></i>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="card card-stats shadow-sm" style="background: linear-gradient(45deg, #27ae60, #2ecc71);">
                <div class="card-body p-4">
                    <div class="d-flex justify-content-between align-items-center">
                        <div>
                            <p class="opacity-label mb-1">Diterima (Accepted)</p>
                            <h2 class="text-bright mb-0">{{ $volunteers->where('status', 'accepted')->count() }}</h2>
                        </div>
                        <i class="ti ti-checkbox text-white opacity-50" style="font-size: 3rem;"></i>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="card shadow-sm border-0 rounded-4">
        <div class="card-body p-4">
            <form action="{{ route('admin.volunteer-registrasi.index') }}" method="GET" class="row g-3 mb-4">
                <div class="col-md-4">
                    <div class="input-group">
                        <span class="input-group-text bg-white border-end-0"><i class="ti ti-search"></i></span>
                        <input type="text" name="search" class="form-control border-start-0" placeholder="Cari nama atau email..." value="{{ request('search') }}">
                    </div>
                </div>
                <div class="col-md-3">
                    <select name="status" class="form-select">
                        <option value="">Semua Status</option>
                        <option value="pending" {{ request('status') == 'pending' ? 'selected' : '' }}>Pending</option>
                        <option value="accepted" {{ request('status') == 'accepted' ? 'selected' : '' }}>Accepted</option>
                    </select>
                </div>
                <div class="col-md-5 d-flex gap-2">
                    <button type="submit" class="btn btn-primary px-4">Filter</button>
                    <a href="{{ route('admin.volunteer-registrasi.index') }}" class="btn btn-light px-4">Reset</a>
                    <button type="button" class="btn btn-outline-success ms-auto" onclick="window.print()">
                        <i class="ti ti-printer me-1"></i> Print
                    </button>
                </div>
            </form>

            <div class="table-responsive">
                <table class="table table-hover align-middle">
                    <thead>
                        <tr>
                            <th class="text-center">Dokumen</th>
                            <th>Info Pendaftar</th>
                            <th>Program & Posisi</th>
                            <th class="text-center">Status</th>
                            <th class="text-center">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($volunteers as $volunter)
                            <tr>
                                <td class="text-center">
                                    @if($volunter->image)
                                        <a href="{{ asset('storage/' . $volunter->image) }}" target="_blank" class="btn-pdf">
                                            <i class="ti ti-file-type-pdf fs-5"></i>
                                            <span>CV</span>
                                        </a>
                                    @else
                                        <span class="text-muted small">No File</span>
                                    @endif
                                </td>
                                <td>
                                    <div class="fw-bold text-dark">{{ $volunter->name }}</div>
                                    <div class="text-muted small">{{ $volunter->email }}</div>
                                </td>
                                <td>
                                    <div class="text-primary fw-semibold small mb-1">{{ Str::limit($volunter->volunter->title ?? 'N/A', 35) }}</div>
                                    <span class="badge bg-light-primary text-primary" style="font-size: 10px;">{{ $volunter->position }}</span>
                                </td>
                                <td class="text-center">
                                    @if ($volunter->status == 'accepted')
                                        <span class="badge bg-success badge-status">Accepted</span>
                                    @else
                                        <span class="badge bg-warning badge-status">Pending</span>
                                    @endif
                                </td>
                                <td class="text-center">
                                    <div class="d-flex justify-content-center gap-2">
                                        @php
                                            $cleanPhone = preg_replace('/[^0-9]/', '', $volunter->phone);
                                            $phone = preg_replace('/^0/', '62', $cleanPhone);
                                            $waMsg = urlencode("Halo {$volunter->name}, kami dari Watery Nation...");
                                        @endphp
                                        <a href="https://wa.me/{{ $phone }}?text={{ $waMsg }}" target="_blank" class="btn btn-sm btn-light-success text-success border-0" title="WhatsApp">
                                            <i class="ti ti-brand-whatsapp fs-5"></i>
                                        </a>
                                        <a href="{{ route('admin.volunteer-registrasi.edit', $volunter->id) }}" class="btn btn-sm btn-light-primary text-primary border-0">
                                            <i class="ti ti-edit fs-5"></i>
                                        </a>
                                        <form action="{{ route('admin.volunteer-registrasi.destroy', $volunter->id) }}" method="POST" class="d-inline">
                                            @csrf @method('DELETE')
                                            <button type="submit" class="btn btn-sm btn-light-danger text-danger border-0" onclick="return confirm('Hapus data?')">
                                                <i class="ti ti-trash fs-5"></i>
                                            </button>
                                        </form>
                                    </div>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="5" class="text-center py-5 text-muted">Data pendaftar tidak ditemukan.</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
            <div class="mt-4">
                {{ $volunteers->appends(request()->query())->links() }}
            </div>
        </div>
    </div>
</div>
@endsection