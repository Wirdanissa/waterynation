@extends('layouts.guest')

@section('title', 'Donasi - Watery Nation')
@section('menuDonasi', 'active')

@section('content')
<div class="container py-5">
    @if (session('success'))
        <div class="alert alert-success border-0 shadow-sm alert-dismissible fade show" role="alert">
            <i class="bi bi-check-circle-fill me-2"></i> {{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        </div>
    @endif

    <div class="row g-4">
        <div class="col-lg-5">
            <div class="card border-0 shadow-sm mb-4">
                <div class="card-body p-4 text-center">
                    <h4 class="fw-bold text-primary mb-3">Dukung Aksi Kami</h4>
                    <p class="text-muted small">Scan QRIS di bawah ini untuk berdonasi.</p>
                    
                    <div class="bg-light p-3 rounded-4 mb-3 d-inline-block border">
                        <img src="{{ asset('storage/organisasi/qris/qris.jpg') }}" 
                             alt="QRIS Donasi" 
                             class="img-fluid rounded-3" 
                             style="max-width: 250px; height: auto;">
                    </div>
                    
                    <h5 class="fw-bold mb-1">{{ $organisasi->qris_name ?? 'Watery Nation Foundation' }}</h5>
                    <span class="badge bg-primary-subtle text-primary px-3 py-2 mb-4">Semua Pembayaran Digital</span>

                    <div class="d-grid gap-2">
                        <a href="{{ asset('storage/organisasi/qris/qris.jpg') }}" download class="btn btn-outline-primary">
                            <i class="bi bi-download me-2"></i>Simpan QR Code
                        </a>
                    </div>
                </div>
            </div>

            <div class="card border-0 shadow-sm">
                <div class="card-header bg-white py-3">
                    <h5 class="fw-bold mb-0"><i class="bi bi-people-fill me-2 text-primary"></i>Donatur Terbaru</h5>
                </div>
                <div class="card-body p-0">
                    <div class="list-group list-group-flush" style="max-height: 400px; overflow-y: auto;">
                        {{-- STATUS DONASI USER LOGIN --}}
                        @foreach($myPendingDonations as $myDonation)
                            <div class="list-group-item {{ $myDonation->status == 'rejected' ? 'bg-danger-subtle border-start border-danger' : 'bg-warning-subtle border-start border-warning' }} py-3 border-4">
                                <div class="d-flex justify-content-between align-items-center">
                                    <h6 class="mb-0 fw-bold">{{ $myDonation->name }}</h6>
                                    <span class="badge {{ $myDonation->status == 'rejected' ? 'bg-danger' : 'bg-warning text-dark' }}">
                                        {{ $myDonation->status == 'rejected' ? 'Ditolak' : 'Menunggu Verifikasi' }}
                                    </span>
                                </div>
                                <div class="fw-bold mt-1">Rp{{ number_format($myDonation->total_donasi, 0, ',', '.') }}</div>
                                
                                @if($myDonation->status == 'rejected')
                                    <div class="mt-2 small text-danger">
                                        donasi anda tertolak, pastikan bukti trf yang anda input adalah benar.<br>
                                        jika terjadi kesalahan, silakan konfirmasi melalui WA berikut :<br>
                                        <a href="https://wa.me/6281119388881" target="_blank" class="fw-bold text-danger">081119388881</a>
                                    </div>
                                @endif
                            </div>
                        @endforeach

                        {{-- DONASI TERVERIFIKASI --}}
                        @forelse($donaturVerified as $item)
                            <div class="list-group-item py-3">
                                <div class="d-flex justify-content-between align-items-center">
                                    <h6 class="mb-0 fw-bold">
                                        {{ $item->show_name ? $item->name : 'Waterior (Anonim)' }}
                                    </h6>
                                    <small class="text-muted small">{{ \Carbon\Carbon::parse($item->tanggal_donasi)->diffForHumans() }}</small>
                                </div>
                                <div class="text-primary fw-semibold">Rp{{ number_format($item->total_donasi, 0, ',', '.') }}</div>
                            </div>
                        @empty
                            <div class="p-4 text-center text-muted">Belum ada donasi terverifikasi.</div>
                        @endforelse
                    </div>
                </div>
            </div>
        </div>

        <div class="col-lg-7">
            <div class="card border-0 shadow-sm h-100">
                <div class="card-body p-4 p-md-5">
                    <h3 class="fw-bold mb-4">Konfirmasi Donasi</h3>
                    <form action="{{ route('donasi.store') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <label class="form-label small fw-bold">Nama Lengkap</label>
                                <input type="text" name="name" class="form-control" value="{{ Auth::user()->name ?? '' }}" required shadow-sm>
                            </div>
                            <div class="col-md-6 mb-3">
                                <label class="form-label small fw-bold">Email</label>
                                <input type="email" name="email" class="form-control" value="{{ Auth::user()->email ?? '' }}" required>
                            </div>
                            <div class="col-md-6 mb-3">
                                <label class="form-label small fw-bold">Jumlah Donasi (Rp)</label>
                                <input type="number" name="total_donasi" class="form-control" required placeholder="Contoh: 50000">
                            </div>
                            <div class="col-md-6 mb-3">
                                <label class="form-label small fw-bold">Tanggal Transfer</label>
                                <input type="date" name="tanggal_donasi" class="form-control" value="{{ date('Y-m-d') }}" required>
                            </div>
                            <div class="col-12 mb-3">
                                <label class="form-label small fw-bold">Bukti Transfer</label>
                                <input type="file" name="bukti_transfer" class="form-control" required>
                                <div class="form-text small text-muted">Format: JPG, PNG (Maks. 2MB)</div>
                            </div>
                            <div class="col-12 mb-3">
                                <label class="form-label small fw-bold">Pesan (Opsional)</label>
                                <textarea name="keterangan" rows="3" class="form-control"></textarea>
                            </div>
                            <div class="col-12 mb-4">
                                <div class="form-check form-switch p-3 bg-light rounded border">
                                    <input class="form-check-input ms-0 me-3" type="checkbox" name="show_name" id="showName" value="1" checked>
                                    <label class="form-check-label fw-semibold" for="showName">Tampilkan nama saya di daftar publik</label>
                                </div>
                            </div>
                            <div class="col-12">
                                <button type="submit" class="btn btn-primary btn-lg w-100 fw-bold">Kirim Konfirmasi</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection