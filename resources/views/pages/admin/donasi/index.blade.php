@extends('layouts.admin')
@section('menuDonasi', 'active')
@section('title', 'Manajemen Donasi | Admin WateryNation')

@section('admin-content')
<style>
    :root {
        --primary-light: #eef2ff;
        --primary-soft: #6366f1;
        --success-soft: #dcfce7;
        --success-text: #15803d;
        --danger-soft: #fee2e2;
        --danger-text: #b91c1c;
        --warning-soft: #fef9c3;
        --warning-text: #a16207;
    }

    .main-content { background-color: #f8fafc; min-height: 100vh; }
    
    /* Card Stats Style */
    .stat-card {
        border: none;
        border-radius: 20px;
        transition: transform 0.3s ease;
        background: #ffffff;
    }
    .stat-card:hover { transform: translateY(-5px); }
    
    .icon-shape-stats {
        width: 56px; height: 56px;
        display: flex; align-items: center; justify-content: center;
        border-radius: 16px;
    }

    /* Table Style */
    .table-container {
        background: #ffffff;
        border-radius: 24px;
        box-shadow: 0 10px 15px -3px rgba(0, 0, 0, 0.05);
        overflow: hidden;
    }
    .table thead th {
        background-color: #f1f5f9;
        text-transform: uppercase;
        font-size: 0.75rem;
        letter-spacing: 0.05em;
        color: #64748b;
        border: none;
        padding: 1.5rem 1rem;
    }
    .table tbody td { padding: 1.2rem 1rem; border-color: #f1f5f9; }

    /* Badge Custom */
    .badge-soft {
        font-weight: 600; padding: 0.5em 1.2em; border-radius: 10px;
    }
    .badge-pending { background: var(--warning-soft); color: var(--warning-text); }
    .badge-success { background: var(--success-soft); color: var(--success-text); }
    .badge-danger { background: var(--danger-soft); color: var(--danger-text); }

    .btn-action {
        width: 38px; height: 38px; border-radius: 12px;
        display: inline-flex; align-items: center; justify-content: center;
        transition: all 0.2s;
    }
</style>

<div class="container-fluid py-4 main-content">
    <div class="row align-items-center mb-4">
        <div class="col-md-7">
            <h2 class="fw-bold text-dark mb-1">Manajemen Donasi</h2>
            <p class="text-secondary">Kelola kontribusi untuk WateryNation dengan transparan.</p>
        </div>
        <div class="col-md-5 d-flex justify-content-md-end">
            <form action="{{ route('admin.donasi.index') }}" method="GET" class="d-flex gap-2">
                <input type="month" name="month" class="form-control border-0 shadow-sm rounded-3" value="{{ $selectedMonth }}">
                <button type="submit" class="btn btn-primary shadow-sm rounded-3 px-4">
                    <i class="bi bi-filter"></i>
                </button>
            </form>
        </div>
    </div>

    <div class="row g-4 mb-5">
        <div class="col-md-6">
            <div class="card stat-card shadow-sm p-3">
                <div class="d-flex align-items-center">
                    <div class="icon-shape-stats bg-primary-subtle text-primary me-3">
                        <i class="bi bi-people-fill fs-3 text-primary"></i>
                    </div>
                    <div>
                        <h6 class="text-secondary mb-1">Total Donatur</h6>
                        <h3 class="fw-bold mb-0 text-dark">{{ number_format($totalDonatur) }} <small class="fs-6 fw-normal">Orang</small></h3>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-6">
            <div class="card stat-card shadow-sm p-3">
                <div class="d-flex align-items-center">
                    <div class="icon-shape-stats bg-success-subtle text-success me-3">
                        <i class="bi bi-wallet2 fs-3 text-success"></i>
                    </div>
                    <div>
                        <h6 class="text-secondary mb-1">Dana Terkumpul</h6>
                        <h3 class="fw-bold mb-0 text-dark">Rp{{ number_format($totalDana, 0, ',', '.') }}</h3>
                    </div>
                </div>
            </div>
        </div>
    </div>

    @if(session('success'))
        <div class="alert alert-success border-0 rounded-4 shadow-sm d-flex align-items-center mb-4" role="alert">
            <i class="bi bi-check-circle-fill me-2 fs-5"></i>
            <div>{{ session('success') }}</div>
        </div>
    @endif

    <div class="table-container border-0">
        <div class="table-responsive">
            <table class="table align-middle mb-0">
                <thead>
                    <tr>
                        <th class="ps-4">Donatur</th>
                        <th>Tanggal</th>
                        <th>Nominal</th>
                        <th class="text-center">Status</th>
                        <th class="text-center">Bukti</th>
                        <th class="text-end pe-4">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($donations as $donasi)
                    <tr>
                        <td class="ps-4">
                            <div class="d-flex align-items-center">
                                <div class="avatar-sm me-3 bg-light rounded-circle d-flex align-items-center justify-content-center text-primary fw-bold" style="width: 40px; height: 40px;">
                                    {{ substr($donasi->name, 0, 1) }}
                                </div>
                                <div>
                                    <div class="fw-bold text-dark">{{ $donasi->name }}</div>
                                    <div class="small text-muted">{{ $donasi->email }}</div>
                                </div>
                            </div>
                        </td>
                        <td>{{ \Carbon\Carbon::parse($donasi->tanggal_donasi)->format('d M Y') }}</td>
                        <td><span class="fw-bold text-dark">Rp{{ number_format($donasi->total_donasi, 0, ',', '.') }}</span></td>
                        <td class="text-center">
                            @if($donasi->status == 'pending')
                                <span class="badge-soft badge-pending">Pending</span>
                            @elseif($donasi->status == 'success')
                                <span class="badge-soft badge-success">Verified</span>
                            @else
                                <span class="badge-soft badge-danger">Rejected</span>
                            @endif
                        </td>
                        <td class="text-center">
                            <a href="{{ asset('storage/' . $donasi->bukti_transfer) }}" target="_blank" class="btn btn-light btn-sm rounded-pill px-3">
                                <i class="bi bi-image me-1"></i> Lihat
                            </a>
                        </td>
                        <td class="text-end pe-4">
                            @if($donasi->status == 'pending')
                            <div class="d-flex justify-content-end gap-2">
                                <form action="{{ route('admin.donasi.verify', $donasi->id) }}" method="POST">
                                    @csrf @method('PATCH')
                                    <button class="btn btn-action btn-outline-success shadow-sm" title="Terima">
                                        <i class="bi bi-check-lg"></i>
                                    </button>
                                </form>
                                <form action="{{ route('admin.donasi.reject', $donasi->id) }}" method="POST">
                                    @csrf @method('PATCH')
                                    <button class="btn btn-action btn-outline-danger shadow-sm" onclick="return confirm('Tolak donasi ini?')" title="Tolak">
                                        <i class="bi bi-x-lg"></i>
                                    </button>
                                </form>
                            </div>
                            @else
                                <span class="text-muted small">Terselesaikan</span>
                            @endif
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="6" class="text-center py-5">
                            <img src="https://illustrations.popsy.co/blue/no-messages.svg" alt="Empty" style="width: 150px;">
                            <p class="text-muted mt-3">Tidak ada data donasi masuk.</p>
                        </td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
        <div class="p-4 d-flex justify-content-between align-items-center">
            <span class="small text-muted">Menampilkan {{ $donations->count() }} data</span>
            {{ $donations->links() }}
        </div>
    </div>
</div>
@endsection