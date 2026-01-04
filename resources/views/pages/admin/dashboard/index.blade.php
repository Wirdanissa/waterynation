@extends('layouts.admin')
@section('menuDashboard', 'active')
@section('title', 'Dashboard | Admin WateryNation')

@section('admin-content')
    {{-- Header & Welcome --}}
    <div class="bg-white rounded-3 p-4 mb-4 d-flex flex-column flex-md-row align-items-md-center justify-content-md-between shadow-sm border-0">
        <div>
            <h1 class="text-xl lg:text-2xl font-bold text-dark mb-1">Dashboard Overview</h1>
            <p class="text-sm text-muted mb-0">Selamat datang kembali, <strong>{{ Auth::user()->name }}</strong>!</p>
        </div>
        <div class="mt-3 mt-md-0">
            <span class="badge bg-light text-dark border p-2">
                <i class="bi bi-clock-history me-1"></i> Terakhir Update: {{ date('H:i') }}
            </span>
        </div>
    </div>

    {{-- Insight Stats Cards --}}
    <div class="row g-4 mb-4">
        <div class="col-12 col-sm-6 col-xl-3">
            <div class="card border-0 shadow-sm h-100">
                <div class="card-body text-center">
                    <div class="bg-primary text-white rounded-circle d-inline-flex align-items-center justify-content-center mb-3" style="width: 60px; height: 60px;">
                        <i class="bi bi-wallet2 fs-3"></i>
                    </div>
                    <h6 class="text-muted fw-normal">Total Donasi Sukses</h6>
                    <h3 class="fw-bold mb-0 text-primary">Rp {{ number_format($totalDonasi ?? 0, 0, ',', '.') }}</h3>
                </div>
            </div>
        </div>

        <div class="col-12 col-sm-6 col-xl-3">
            <div class="card border-0 shadow-sm h-100">
                <div class="card-body text-center">
                    <div class="bg-success text-white rounded-circle d-inline-flex align-items-center justify-content-center mb-3" style="width: 60px; height: 60px;">
                        <i class="bi bi-kanban fs-3"></i>
                    </div>
                    <h6 class="text-muted fw-normal">Program Terdaftar</h6>
                    <h3 class="fw-bold mb-0 text-success">{{ $countProgram ?? 0 }}</h3>
                </div>
            </div>
        </div>

        <div class="col-12 col-sm-6 col-xl-3">
            <div class="card border-0 shadow-sm h-100">
                <div class="card-body text-center">
                    <div class="bg-info text-white rounded-circle d-inline-flex align-items-center justify-content-center mb-3" style="width: 60px; height: 60px;">
                        <i class="bi bi-people fs-3"></i>
                    </div>
                    <h6 class="text-muted fw-normal">Pendaftar Relawan</h6>
                    <h3 class="fw-bold mb-0 text-info">{{ $countVolunteerReg ?? 0 }}</h3>
                </div>
            </div>
        </div>

        <div class="col-12 col-sm-6 col-xl-3">
            <div class="card border-0 shadow-sm h-100">
                <div class="card-body text-center">
                    <div class="bg-warning text-white rounded-circle d-inline-flex align-items-center justify-content-center mb-3" style="width: 60px; height: 60px;">
                        <i class="bi bi-journal-text fs-3"></i>
                    </div>
                    <h6 class="text-muted fw-normal">Total Publikasi</h6>
                    <h3 class="fw-bold mb-0 text-warning">{{ $countPublikasi ?? 0 }}</h3>
                </div>
            </div>
        </div>
    </div>

    <div class="row g-4">
        {{-- Quick Actions --}}
        <div class="col-lg-4">
            <div class="card border-0 shadow-sm h-100">
                <div class="card-header bg-white border-0 pt-4 px-4 text-center">
                    <h5 class="fw-bold">Aksi Cepat</h5>
                </div>
                <div class="card-body px-4 pb-4">
                    <div class="d-grid gap-2">
                        <a href="{{ route('admin.publikasi.create') }}" class="btn btn-outline-primary text-start p-3">
                            <i class="bi bi-plus-circle me-2"></i> Buat Artikel Baru
                        </a>
                        <a href="{{ route('admin.programs.create') }}" class="btn btn-outline-primary text-start p-3">
                            <i class="bi bi-calendar-plus me-2"></i> Tambah Program
                        </a>
                        <a href="{{ route('admin.donasi.index') }}" class="btn btn-outline-success text-start p-3">
                            <i class="bi bi-check2-circle me-2"></i> Kelola Donasi
                        </a>
                    </div>
                </div>
            </div>
        </div>

        {{-- Log Aktivitas Singkat --}}
        <div class="col-lg-8">
            <div class="card border-0 shadow-sm h-100">
                <div class="card-header bg-white border-0 d-flex justify-content-between align-items-center pt-4 px-4">
                    <h5 class="fw-bold">Akses Data Terakhir</h5>
                </div>
                <div class="card-body p-4 text-center">
                    <div class="table-responsive">
                        <table class="table table-hover align-middle">
                            <thead class="table-light">
                                <tr>
                                    <th>Kategori Data</th>
                                    <th>Status</th>
                                    <th>Link</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td>Pendaftaran Program</td>
                                    <td><span class="badge bg-info">Cek Pendaftar</span></td>
                                    <td><a href="{{ route('admin.program-registrasi.index') }}" class="btn btn-sm btn-dark px-3">Buka</a></td>
                                </tr>
                                <tr>
                                    <td>Pendaftaran Volunteer</td>
                                    <td><span class="badge bg-primary">Cek Relawan</span></td>
                                    <td><a href="{{ route('admin.volunteer-registrasi.index') }}" class="btn btn-sm btn-dark px-3">Buka</a></td>
                                </tr>
                                <tr>
                                    <td>Manajemen User</td>
                                    <td><span class="badge bg-secondary">Daftar Pengguna</span></td>
                                    <td><a href="{{ route('admin.user.index') }}" class="btn btn-sm btn-dark px-3">Buka</a></td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection