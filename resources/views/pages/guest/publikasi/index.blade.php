@extends('layouts.guest')

@section('title', 'Publikasi - Watery Nation')
@section('menuPublikasi', 'active')

@section('content')
    {{-- Tambahkan min-vh-100 agar konten menarik footer ke bawah meskipun data kosong --}}
    <div class="container py-5 px-4" style="min-height: 80vh;"> 
        <div class="row align-items-start mb-3">
            <div class="col-md-12">
                <h2 class="fw-bold mb-4"
                    style="position: relative; display: inline-block; padding-bottom: 12px; margin-bottom: 40px;">
                    Publikasi <span class="text-primary">Watery Nation</span>
                    <span
                        style="position:absolute; left:0; bottom:0; width:85px; height:3px; background-color:#0d6efd; border-radius:2px;"></span>
                </h2>
            </div>
        </div>

        <div class="row g-4">
            @forelse ($publikasis as $publikasi)
                <div class="col-12 col-md-6 col-lg-3">
                    <a href="{{ route('publikasi.show', $publikasi->slug) }}" class="text-decoration-none text-dark">
                        <div class="card h-100 shadow-sm rounded-3 border-0"> {{-- Tambah border-0 untuk tampilan lebih bersih --}}
                            <div class="position-relative overflow-hidden rounded-top-3">
                                <img src="{{ Storage::url($publikasi->image) }}" 
                                     class="card-img-top object-cover" 
                                     style="width: 100%; height: 200px; object-fit: cover;" {{-- Pastikan object-fit: cover --}}
                                     alt="{{ $publikasi->title }}">
                            </div>
                            <div class="card-body d-flex flex-column">
                                <div class="d-flex flex-column gap-2 mb-3" style="font-size:0.9rem;">
                                    <div class="d-flex align-items-center gap-2">
                                        <i class="bi bi-calendar-event text-primary"></i>
                                        <span class="text-muted">{{ tanggal($publikasi->date) }}</span>
                                    </div>
                                    <div class="d-flex align-items-center gap-2">
                                        <i class="bi bi-person-circle text-primary"></i>
                                        <span class="badge bg-light text-danger border">{{ $author ?? 'Admin' }}</span>
                                    </div>
                                </div>
                                <h5 class="card-title fw-bold mb-3 text-truncate-2">{{ $publikasi->title }}</h5>
                                
                                {{-- Gunakan Str::limit untuk mencegah deskripsi yang terlalu panjang merusak layout --}}
                                <div class="text-muted small mb-0">
                                    {!! Str::limit(strip_tags($publikasi->description), 100) !!}
                                </div>
                            </div>
                        </div>
                    </a>
                </div>
            @empty
                <div class="col-12 my-5 py-5 text-center">
                    <div class="mb-3">
                        <i class="bi bi-journal-x text-muted" style="font-size: 4rem;"></i>
                    </div>
                    <h5 class="text-muted">Publikasi tentang organisasi belum tersedia.</h5>
                    <a href="/" class="btn btn-primary mt-3 rounded-pill px-4">Kembali ke Beranda</a>
                </div>
            @endforelse
        </div>
    </div>
@endsection