@extends('layouts.guest')

@section('title', $programs->title . ' - Watery Nation')
@section('menuProgram', 'active')
@section($activeMenu, 'active')

@section('content')
<div class="bg-light py-5 mb-5 border-bottom shadow-sm" style="background: linear-gradient(135deg, #f8f9fa 0%, #e9ecef 100%);">
    <div class="container px-4">
        <div class="row align-items-center">
            <div class="col-lg-8">
                <nav aria-label="breadcrumb" class="mb-3">
                    <a href="{{ $backRoute }}" class="text-decoration-none small fw-bold text-primary">
                        <i class="bi bi-chevron-left"></i> KEMBALI KE LIST PROGRAM
                    </a>
                </nav>
                <span class="badge bg-primary-subtle text-primary px-3 py-2 rounded-pill mb-3 fw-bold text-uppercase" style="letter-spacing: 1px;">
                    {{ $programs->category }}
                </span>
                <h1 class="display-5 fw-extra-bold text-dark mb-3">{{ $programs->title }}</h1>
                <div class="d-flex flex-wrap gap-4 text-secondary">
                    <div class="d-flex align-items-center"><i class="bi bi-calendar3 me-2 text-primary fs-5"></i> {{ tanggal($programs->start_date) }}</div>
                    <div class="d-flex align-items-center"><i class="bi bi-geo-alt-fill me-2 text-danger fs-5"></i> {{ $programs->lokasi }}</div>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="container px-4">
    @if(session('success'))
    <div class="alert alert-success alert-dismissible fade show rounded-4 mb-4 border-0 shadow-sm p-4" role="alert">
        <div class="d-flex align-items-center">
            <i class="bi bi-check-circle-fill fs-4 me-3"></i>
            <div>
                <strong class="d-block">Berhasil!</strong>
                {{ session('success') }}
            </div>
        </div>
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
    @endif

    @if($errors->any())
    <div class="alert alert-danger rounded-4 mb-4 border-0 shadow-sm p-4">
        <ul class="mb-0">
            @foreach($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
    @endif

    <div class="row g-5">
        <div class="col-lg-8">
            <div class="position-relative mb-5 shadow-lg rounded-5 overflow-hidden border-0 group-hover">
                @if ($programs->category === 'Modul Development For Kids' && $programs->link_url)
                    @php
                        $url = $programs->link_url;
                        $videoId = "";
                        if (preg_match('%(?:youtube(?:-nocookie)?\.com/(?:[^/]+/.+/|(?:v|e(?:mbed)?)/|.*[?&]v=)|youtu\.be/)([^"&?/ ]{11})%i', $url, $match)) {
                            $videoId = $match[1];
                        }
                        $embedUrl = $videoId ? "https://www.youtube.com/embed/" . $videoId : $url;
                    @endphp
                    <div class="ratio ratio-16x9">
                        <iframe src="{{ $embedUrl }}" frameborder="0" allowfullscreen></iframe>
                    </div>
                @else
                    <img src="{{ Storage::url($programs->image) }}" class="w-100 img-zoom" style="max-height: 550px; object-fit: cover;">
                @endif
            </div>

            <div class="card border-0 shadow-sm rounded-4 mb-5">
                <div class="card-body p-4 p-md-5">
                    <h4 class="fw-bold mb-4 border-bottom pb-3">Tentang Program</h4>
                    <div class="description-text" style="font-size: 1.1rem; line-height: 1.9; color: #444;">
                        {!! $programs->description !!}
                    </div>
                </div>
            </div>
        </div>

        <div class="col-lg-4">
            <div class="sticky-top" style="top: 100px; z-index: 10;">
                @if ($programs->category !== 'Modul Development For Kids')
                <div class="card border-0 shadow-lg rounded-4 overflow-hidden mb-5 bg-dark text-white p-2">
                    <div class="card-body p-4">
                        <h5 class="fw-bold mb-2">Tertarik Bergabung?</h5>
                        <p class="small opacity-75 mb-4">Segera daftarkan diri Anda sebelum kuota penuh atau waktu pendaftaran berakhir.</p>
                        @auth
                            <button class="btn btn-primary w-100 py-3 rounded-3 fw-bold btn-glow" data-bs-toggle="modal" data-bs-target="#modalDaftar">
                                Daftar Sekarang <i class="bi bi-arrow-right ms-2"></i>
                            </button>
                        @else
                            <a href="{{ route('login') }}?redirect={{ url()->current() }}" class="btn btn-primary w-100 py-3 rounded-3 fw-bold">
                                Login untuk Daftar
                            </a>
                        @endauth
                    </div>
                </div>
                @endif

                <div class="d-flex align-items-center justify-content-between mb-4">
                    <h5 class="fw-bold m-0">Program Serupa</h5>
                    <div class="h-1px bg-primary flex-grow-1 ms-3 opacity-25"></div>
                </div>

                @forelse ($rekomendasi as $lain)
                <a href="{{ route('programs.show', $lain->slug) }}" class="text-decoration-none">
                    <div class="card border-0 shadow-sm mb-3 card-hover-simple overflow-hidden rounded-3">
                        <div class="row g-0 align-items-center">
                            <div class="col-4 position-relative">
                                <img src="{{ Storage::url($lain->image) }}" class="img-fluid h-100 object-fit-cover" style="min-height: 90px; width: 100%;">
                            </div>
                            <div class="col-8">
                                <div class="card-body p-3">
                                    <h6 class="fw-bold text-dark mb-1 small text-truncate-2">{{ $lain->title }}</h6>
                                    <p class="text-muted mb-0" style="font-size: 0.7rem;">
                                        <i class="bi bi-calendar-check me-1"></i> {{ tanggal($lain->start_date) }}
                                    </p>
                                </div>
                            </div>
                        </div>
                    </div>
                </a>
                @empty
                    <p class="text-muted small italic text-center py-4">Belum ada rekomendasi lainnya.</p>
                @endforelse
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="modalDaftar" tabindex="-1">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content border-0 shadow-2xl rounded-5 overflow-hidden">
            <div class="modal-header bg-primary text-white p-4 border-0">
                <div>
                    <h5 class="modal-title fw-bold mb-0">Registrasi Program</h5>
                    <small class="opacity-75">Silahkan lengkapi data pendaftaran Anda.</small>
                </div>
                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"></button>
            </div>
            <form action="{{ route('program-registrasi-user.store') }}" method="POST">
                @csrf
                <input type="hidden" name="program_id" value="{{ $programs->id }}">
                <div class="modal-body p-4 p-md-5">
                    <div class="form-floating mb-3">
                        <input type="text" name="name" class="form-control border-0 bg-light" id="fn" value="{{ auth()->user()->name ?? '' }}" placeholder="Nama" readonly>
                        <label for="fn">Nama Lengkap</label>
                    </div>
                    <div class="form-floating mb-3">
                        <input type="email" name="email" class="form-control border-0 bg-light" id="fe" value="{{ auth()->user()->email ?? '' }}" placeholder="Email" readonly>
                        <label for="fe">Alamat Email</label>
                    </div>
                    <div class="form-floating mb-4">
                        <input type="text" name="phone" class="form-control border-bottom border-0 rounded-0 px-0 @error('phone') is-invalid @enderror" id="fp" value="{{ old('phone', auth()->user()->phone ?? '') }}" placeholder="WhatsApp" required>
                        <label for="fp" class="px-0">Nomor Telepon / WhatsApp</label>
                        @error('phone')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                    <button type="submit" class="btn btn-primary w-100 py-3 rounded-pill fw-bold shadow">Kirim Sekarang</button>
                </div>
            </form>
        </div>
    </div>
</div>

<style>
    @import url('https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;600;700;800&display=swap');
    body { font-family: 'Plus Jakarta Sans', sans-serif; }
    .fw-extra-bold { font-weight: 800; }
    .h-1px { height: 1px; }
    .img-zoom { transition: transform 0.5s cubic-bezier(0.4, 0, 0.2, 1); }
    .group-hover:hover .img-zoom { transform: scale(1.03); }
    .card-hover-simple { transition: all 0.3s ease; border: 1px solid transparent !important; }
    .card-hover-simple:hover { transform: translateX(5px); border-color: var(--bs-primary) !important; box-shadow: 0 10px 20px rgba(0,0,0,0.05) !important; }
    .text-truncate-2 { display: -webkit-box; -webkit-line-clamp: 2; -webkit-box-orient: vertical; overflow: hidden; }
    .btn-glow:hover { box-shadow: 0 0 20px rgba(var(--bs-primary-rgb), 0.4); }
    ::-webkit-scrollbar { width: 8px; }
    ::-webkit-scrollbar-track { background: #f1f1f1; }
    ::-webkit-scrollbar-thumb { background: #ccc; border-radius: 10px; }
    .description-text img { max-width: 100%; border-radius: 1.5rem; margin: 1.5rem 0; }
</style>
@endsection