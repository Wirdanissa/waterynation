@extends('layouts.guest')

@section('title', 'Watery Nation - Belajar dan Beraksi untuk Menjaga Air')
@section('menuBeranda', 'active')

@section('content')
<style>
    /* Hero Section */
    .hero-section {
        background: linear-gradient(rgba(0, 0, 0, 0.5), rgba(0, 0, 0, 0.5)), url('{{ asset('assets/img/gambar_3.jpg') }}');
        background-size: cover;
        background-position: center;
        height: 100vh;
        display: flex;
        align-items: center;
    }

    /* Counter Style */
    .stat-box {
        background: white;
        border-radius: 100px;
        box-shadow: 0 15px 30px rgba(0,0,0,0.1);
        padding: 30px 50px;
        margin-top: -60px;
        position: relative;
        z-index: 20;
    }

    /* Team Avatar */
    .team-avatar {
        width: 140px !important;
        height: 140px !important;
        object-fit: cover !important;
        object-position: top;
        border-radius: 50% !important;
        margin: 0 auto 15px;
        border: 5px solid rgba(255,255,255,0.2);
        transition: transform 0.3s ease;
    }
    .item:hover .team-avatar {
        transform: scale(1.05);
        border-color: #ffffff;
    }

    /* Program Cards */
    .program-card {
        border: none;
        border-radius: 20px;
        transition: all 0.3s ease;
    }
    .program-card:hover {
        transform: translateY(-10px);
        box-shadow: 0 20px 40px rgba(0,0,0,0.1) !important;
    }

    /* Donatur Card Style */
    .donatur-card {
        border-radius: 35px;
        background: #ffffff;
        padding: 40px;
        border: none;
        box-shadow: 0 10px 30px rgba(0,0,0,0.05);
        transition: all 0.3s ease;
        min-height: 280px;
        display: flex;
        flex-direction: column;
        justify-content: space-between;
        position: relative;
    }
    .quote-icon {
        font-size: 3rem;
        color: #0d6efd;
        opacity: 0.15;
        position: absolute;
        top: 20px;
        left: 30px;
    }
    .donatur-pesan {
        font-style: italic;
        color: #555;
        font-size: 1.1rem;
        line-height: 1.6;
        margin-top: 30px;
        position: relative;
        z-index: 1;
    }
    .badge-nominal {
        background-color: #198754;
        color: white;
        border-radius: 50px;
        padding: 8px 18px;
        font-weight: 700;
        font-size: 0.9rem;
    }

    /* CTA Section */
    .cta-donation {
        background: linear-gradient(45deg, #0d6efd, #0099ff);
        border-radius: 30px;
        padding: 60px;
        color: white;
        position: relative;
        overflow: hidden;
    }

    /* Gallery */
    .gallery-item {
        overflow: hidden;
        border-radius: 15px;
        position: relative;
    }
    .gallery-img {
        transition: transform 0.5s ease;
    }
    .gallery-item:hover .gallery-img {
        transform: scale(1.1);
    }
</style>

{{-- Section 1: Hero --}}
<div class="container-fluid hero-section">
    <div class="container">
        <div class="row">
            <div class="col-md-7 text-start ms-md-5">
                <h1 class="fw-bold mb-4 text-light display-3">
                    Selamat Datang di <br><span class="text-info">Watery Nation</span>
                </h1>
                <p class="lead mb-5 text-light fw-light fs-5 opacity-90">
                    "Bergabunglah dalam gerakan edukasi dan kolaborasi untuk menjaga air bersih yang berkelanjutan di Indonesia."
                </p>
            </div>
        </div>
    </div>
</div>

{{-- Section 2: Statistics --}}
<div class="container">
    <div class="stat-box mx-auto">
        <div class="row text-center align-items-center">
            <div class="col-md-4 border-end">
                <div class="d-flex align-items-center justify-content-center gap-3">
                    <i class="bi bi-people-fill fs-1 text-primary"></i>
                    <div class="text-start">
                        <h3 class="fw-bold m-0">{{ number_format($relawan ?? 0) }}</h3>
                        <small class="text-muted text-uppercase fw-bold">Relawan Aktif</small>
                    </div>
                </div>
            </div>
            <div class="col-md-4 border-end my-3 my-md-0">
                <div class="d-flex align-items-center justify-content-center gap-3">
                    <i class="bi bi-patch-check-fill fs-1 text-success"></i>
                    <div class="text-start">
                        <h3 class="fw-bold m-0 text-dark">Rp{{ number_format($donasis ?? 0, 0, ',', '.') }}</h3>
                        <small class="text-muted text-uppercase fw-bold">Donasi Terverifikasi</small>
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="d-flex align-items-center justify-content-center gap-3">
                    <i class="bi bi-stars fs-1 text-warning"></i>
                    <div class="text-start">
                        <h3 class="fw-bold m-0">{{ number_format($aktivitas ?? 0) }}</h3>
                        <small class="text-muted text-uppercase fw-bold">Program Berjalan</small>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

{{-- Section 3: About --}}
<div class="py-5 mt-5">
    <div class="container text-center py-4">
        <h6 class="text-primary fw-bold text-uppercase">Siapa Kami?</h6>
        <h2 class="fw-bold mb-4">Tentang <span class="text-primary">Watery Nation</span></h2>
        <p class="text-muted mx-auto lh-lg fs-5" style="max-width: 900px;">
            WateryNation adalah organisasi yang menggerakkan generasi muda untuk peduli dan berkontribusi dalam
            pengelolaan air yang berkelanjutan. Berdiri sejak 2020, komunitas ini berkembang melalui edukasi,
            kolaborasi, dan aksi nyata untuk menjamin ketersediaan air bersih di masa depan.
        </p>
    </div>
</div>

{{-- Section 4: Programs --}}
<div class="bg-light py-5" id="programs">
    <div class="container py-4">
        <h2 class="fw-bold mb-5 text-center">Program Unggulan Kami</h2>
        <div class="row g-4">
            {{-- Program 1 --}}
            <div class="col-md-4">
                <div class="card program-card h-100 shadow-sm p-3">
                    <div class="card-body">
                        <div class="icon-box mb-3 text-primary"><i class="bi bi-geo-alt-fill fs-2"></i></div>
                        <h5 class="card-title fw-bold">Offline Action</h5>
                        <p class="card-text text-muted">Aksi langsung di lapangan mulai dari konservasi sungai hingga edukasi masyarakat desa.</p>
                        <a href="{{ route('programs.offline-action') }}" class="btn btn-link p-0 fw-bold text-decoration-none">Pelajari Selengkapnya <i class="bi bi-arrow-right"></i></a>
                    </div>
                </div>
            </div>
            {{-- Program 2 --}}
            <div class="col-md-4">
                <div class="card program-card h-100 shadow-sm p-3">
                    <div class="card-body">
                        <div class="icon-box mb-3 text-primary"><i class="bi bi-laptop fs-2"></i></div>
                        <h5 class="card-title fw-bold">Online Webinar</h5>
                        <p class="card-text text-muted">Diskusi interaktif bersama pakar lingkungan untuk memperluas wawasan secara daring.</p>
                        <a href="{{ route('programs.online-webinar') }}" class="btn btn-link p-0 fw-bold text-decoration-none">Pelajari Selengkapnya <i class="bi bi-arrow-right"></i></a>
                    </div>
                </div>
            </div>
            {{-- Program 3 --}}
            <div class="col-md-4">
                <div class="card program-card h-100 shadow-sm p-3">
                    <div class="card-body">
                        <div class="icon-box mb-3 text-primary"><i class="bi bi-book-half fs-2"></i></div>
                        <h5 class="card-title fw-bold">Modul For Kids</h5>
                        <p class="card-text text-muted">Materi edukasi interaktif yang dirancang khusus untuk menanamkan cinta lingkungan sejak dini.</p>
                        <a href="{{ route('programs.modul-development-for-kids') }}" class="btn btn-link p-0 fw-bold text-decoration-none">Pelajari Selengkapnya <i class="bi bi-arrow-right"></i></a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

{{-- Section 5: Tim --}}
<div class="bg-primary py-5">
    <div class="container py-4">
        <h2 class="fw-bold mb-5 text-center text-light">Tim di Balik Layar</h2>
        <div class="owl-carousel team-carousel text-center">
            @php
                $teams = [
                    ['Arfiana Maulina', 'Founder', 'Arfiana Maulina.png'],
                    ['Deni', 'Head of Supervisor', 'Deni.png'],
                    ['Dian', 'Supervisor', 'Dian.png'],
                    ['Agnes', 'Organization Lead', 'Agnes.png'],
                    ['Alif', 'Secretary', 'Alif.png'],
                    ['Aned', 'Treasurer', 'Aned.png'],
                ];
            @endphp
            @foreach ($teams as $team)
                <div class="item px-2">
                    <img src="{{ asset('storage/volunteer/' . $team[2]) }}" class="team-avatar shadow">
                    <h6 class="text-light fw-bold mb-0">{{ $team[0] }}</h6>
                    <small class="text-light opacity-75">{{ $team[1] }}</small>
                </div>
            @endforeach
        </div>
    </div>
</div>

{{-- Section 6: Open Recruitment --}}
<div class="py-5">
    <div class="container py-4">
        <div class="d-flex justify-content-between align-items-end mb-4">
            <div>
                <h6 class="text-primary fw-bold">Open Recruitment</h6>
                <h2 class="fw-bold">Jadi Bagian Dari Kami</h2>
            </div>
            <a href="{{ route('volunteer') }}" class="btn btn-outline-primary rounded-pill">Lihat Semua Peran</a>
        </div>
        <div class="row g-4">
            @forelse ($volunteers as $volunteer)
                <div class="col-md-4">
                    <div class="card program-card h-100 border-0 shadow-sm overflow-hidden">
                        <img src="{{ Storage::url($volunteer->image) }}" class="card-img-top" style="height: 200px; object-fit: cover;">
                        <div class="card-body">
                            <h5 class="card-title fw-bold">{{ $volunteer->title }}</h5>
                            <p class="text-muted small">{{ Str::limit(strip_tags($volunteer->description), 100) }}</p>
                            <a href="{{ route('volunteer.show', $volunteer->slug) }}" class="btn btn-primary w-100 rounded-pill">Daftar Sekarang</a>
                        </div>
                    </div>
                </div>
            @empty
                <div class="col-12 text-center text-muted py-5">Belum ada posisi volunteer yang dibuka.</div>
            @endforelse
        </div>
    </div>
</div>


{{-- Section 7: Apresiasi Donatur --}}
<div class="py-5 bg-light border-top border-bottom">
    <div class="container py-4">
        <div class="text-center mb-5">
            <h6 class="text-primary fw-bold text-uppercase">Wateriors Support</h6>
            <h2 class="fw-bold">Apresiasi Untuk <span class="text-primary">Donatur #Wateriors</span></h2>
            <p class="text-muted">Setiap kontribusi Anda sangat berarti bagi keberlanjutan air di Indonesia.</p>
        </div>

        <div class="owl-carousel donatur-carousel">
            @forelse ($latest_donations as $donasi)
                <div class="item px-2">
                    <div class="card donatur-card shadow-sm border-0" style="min-height: auto; padding: 25px;">
                        <div class="d-flex align-items-center gap-3">
                            <div class="flex-shrink-0">
                                <div class="rounded-circle border d-flex align-items-center justify-content-center" style="width: 50px; height: 50px; background: #f8f9fa;">
                                    <i class="bi bi-person-fill text-dark fs-4"></i>
                                </div>
                            </div>
                            
                            <div class="text-start">
                                <h5 class="fw-bold mb-1" style="color: #212529;">
                                    Rp{{ number_format($donasi->total_donasi, 0, ',', '.') }}
                                </h5>
                                <div class="text-muted" style="font-size: 0.95rem;">
                                    Oleh <span style="font-style: italic; color: #6c757d;">
                                        {{ $donasi->is_anonim ? '#TemanPeduli' : $donasi->nama_donatur }}
                                    </span>
                                    <span class="mx-1">•</span>
                                    <span>{{ $donasi->created_at->diffForHumans() }}</span>
                                </div>
                            </div>
                        </div>

                        @if(!empty($donasi->pesan))
                            <div class="mt-3 p-2 bg-white rounded shadow-sm border-start border-primary border-4">
                                <p class="mb-0 small text-muted" style="font-style: italic;">"{{ $donasi->pesan }}"</p>
                            </div>
                        @endif
                    </div>
                </div>
            @empty
                <div class="text-center w-100 text-muted py-4">Belum ada donasi terbaru.</div>
            @endforelse
        </div>
    </div>
</div>

{{-- Section 8: CTA Donasi --}}
<div class="py-5 bg-white">
    <div class="container">
        <div class="cta-donation shadow-lg">
            <div class="row align-items-center">
                <div class="col-lg-8 text-center text-lg-start">
                    <h2 class="fw-bold mb-3">Ingin Berkontribusi Lebih Nyata?</h2>
                    <p class="lead mb-0 opacity-90">Setiap rupiah yang Anda berikan dialokasikan sepenuhnya untuk program konservasi air dan edukasi masyarakat.</p>
                </div>
                <div class="col-lg-4 text-center text-lg-end mt-4 mt-lg-0">
                    <a href="{{ route('donasi') }}" class="btn btn-light btn-lg rounded-pill px-5 fw-bold text-primary shadow">
                        Mulai Berdonasi <i class="bi bi-heart-fill ms-2 text-danger"></i>
                    </a>
                </div>
            </div>
        </div>
    </div>
</div>

{{-- Section 9: Publikasi --}}
<div class="py-5 bg-white">
    <div class="container py-4">
        <h2 class="fw-bold mb-5 text-center">Publikasi Terbaru</h2>
        <div class="row g-3">
            @forelse ($publikasis as $publikasi)
                <div class="col-sm-6 col-md-4 col-lg-3">
                    <a href="{{ route('publikasi.show', $publikasi->slug) }}" class="text-decoration-none text-dark">
                        <div class="gallery-item shadow-sm card border-0">
                            <img src="{{ Storage::url($publikasi->image) }}" class="gallery-img card-img w-100" style="object-fit: cover; height: 250px;">
                            <div class="gallery-overlay p-3 d-flex flex-column justify-content-end" style="position:absolute; bottom:0; left:0; width:100%; height:100%; background:linear-gradient(transparent, rgba(0,0,0,0.8));">
                                <h6 class="text-white fw-bold mb-1">{{ $publikasi->title }}</h6>
                                <p class="text-white-50 small mb-0">{{ Str::limit(strip_tags($publikasi->description), 50) }}</p>
                            </div>
                        </div>
                    </a>
                </div>
            @empty
                <p class="text-center w-100 text-muted">Belum ada publikasi.</p>
            @endforelse
        </div>
    </div>
</div>
@endsection

@push('custom-script')
<script>
    $(document).ready(function(){
        // Slider Tim
        $('.team-carousel').owlCarousel({
            loop: true,
            margin: 20,
            autoplay: true,
            autoplayTimeout: 3000,
            smartSpeed: 800,
            dots: true,
            responsive: {
                0: { items: 1 },
                576: { items: 2 },
                768: { items: 3 },
                992: { items: 5 }
            }
        });

        // Slider Donatur
        $('.donatur-carousel').owlCarousel({
            loop: false, 
            margin: 20,
            autoplay: true,
            autoplayTimeout: 5000,
            smartSpeed: 1000,
            dots: true,
            nav: false,
            responsive: {
                0: { items: 1 },
                768: { items: 2 },
                1200: { items: 3 }
            }
        });
    });
</script>
@endpush