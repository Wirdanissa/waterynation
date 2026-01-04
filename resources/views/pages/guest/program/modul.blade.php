@extends('layouts.guest')

@section('title', 'Modul Development For Kids - Watery Nation')
@section('menuProgram', 'active')
@section('menuModulDevelopmentForKids', 'active')

@section('content')
<style>
    /* Gradient Background untuk Judul */
    .section-title {
        position: relative;
        display: inline-block;
        padding-bottom: 15px;
    }
    .section-title::after {
        content: '';
        position: absolute;
        left: 0;
        bottom: 0;
        width: 60px;
        height: 4px;
        background: linear-gradient(90deg, #0d6efd, #0dcaf0);
        border-radius: 10px;
    }

    /* Card Styling yang Luar Biasa */
    .program-card {
        border: none;
        border-radius: 20px;
        transition: all 0.4s cubic-bezier(0.175, 0.885, 0.32, 1.275);
        background: #fff;
        overflow: hidden;
    }

    .program-card:hover {
        transform: translateY(-12px);
        box-shadow: 0 20px 40px rgba(0, 0, 0, 0.12) !important;
    }

    /* Overlay Efek pada Gambar/Video */
    .media-container {
        position: relative;
        overflow: hidden;
        border-radius: 20px 20px 0 0;
    }

    /* Badge Kategori */
    .category-badge {
        position: absolute;
        top: 15px;
        left: 15px;
        background: rgba(13, 110, 253, 0.85);
        backdrop-filter: blur(5px);
        color: white;
        padding: 5px 15px;
        border-radius: 50px;
        font-size: 0.75rem;
        font-weight: 600;
        z-index: 10;
    }

    /* Memastikan Judul Rapi */
    .clamp-title {
        display: -webkit-box;
        -webkit-line-clamp: 2;
        -webkit-box-orient: vertical;
        overflow: hidden;
        min-height: 3.2em;
        line-height: 1.6;
        color: #2d3436;
    }

    /* Tombol Lihat Video yang Futuristik */
    .btn-video {
        background: linear-gradient(45deg, #0d6efd, #004db3);
        color: white;
        border: none;
        padding: 12px;
        border-radius: 12px;
        font-weight: 600;
        transition: all 0.3s ease;
        display: flex;
        align-items: center;
        justify-content: center;
        gap: 10px;
    }

    .btn-video:hover {
        background: linear-gradient(45deg, #004db3, #0d6efd);
        color: white;
        box-shadow: 0 8px 15px rgba(13, 110, 253, 0.3);
        transform: scale(1.02);
    }

    /* Animasi Ikon Play */
    .btn-video i {
        font-size: 1.2rem;
        transition: transform 0.3s ease;
    }

    .btn-video:hover i {
        transform: translateX(3px) scale(1.2);
    }
</style>

<div class="container py-5">
    <div class="row mb-5 text-center text-md-start">
        <div class="col-12 px-4">
            <h3 class="fw-bold section-title mb-2">
                Modul Development For <span class="text-primary">Kids</span>
            </h3>
            <p class="text-muted mt-3">Eksplorasi video pembelajaran interaktif untuk masa depan yang lebih hijau.</p>
        </div>
    </div>

    <div class="row g-4 justify-content-center">
        @forelse ($modulDevelopmentForKids as $programs)
            <div class="col-12 col-md-6 col-lg-4 d-flex">
                <div class="card program-card shadow-sm w-100 d-flex flex-column">
                    
                    <div class="media-container">
                        <span class="category-badge shadow-sm">Video Modul</span>
                        
                        @if($programs->youtube_url)
                            @php
                                $videoId = "";
                                if (preg_match('/(?:youtube\.com\/(?:[^\/]+\/.+\/|(?:v|e(?:mbed)?)\/|.*[?&]v=)|youtu\.be\/)([^"&?\/\s]{11})/', $programs->youtube_url, $match)) {
                                    $videoId = $match[1];
                                }
                            @endphp
                            
                            @if($videoId)
                                <div class="ratio ratio-16x9">
                                    <iframe src="https://www.youtube.com/embed/{{ $videoId }}?rel=0" 
                                            title="YouTube video player" frameborder="0" 
                                            allowfullscreen></iframe>
                                </div>
                            @else
                                <img src="{{ Storage::url($programs->image) }}" class="card-img-top" style="height: 220px; object-fit: cover;">
                            @endif
                        @else
                            <img src="{{ Storage::url($programs->image) }}" class="card-img-top" style="height: 220px; object-fit: cover;">
                        @endif
                    </div>

                    <div class="card-body d-flex flex-column p-4">
                        <a href="{{ route('programs.show', $programs->slug) }}" class="text-decoration-none">
                            <h5 class="card-title fw-bold clamp-title mb-3">{{ $programs->title }}</h5>
                        </a>
                        
                        <div class="d-flex flex-column gap-2 mb-4" style="font-size:0.85rem;">
                            <div class="d-flex align-items-center gap-2 text-secondary">
                                <i class="bi bi-calendar-check text-primary"></i>
                                <span>Rilis: {{ \Carbon\Carbon::parse($programs->start_date)->format('d M Y') }}</span>
                            </div>
                            <div class="d-flex align-items-center gap-2 text-secondary">
                                <i class="bi bi-play-circle-fill text-danger"></i>
                                <span>Media: {{ $programs->lokasi }}</span>
                            </div>
                        </div>

                        {{-- Tombol Lihat Video yang Sejajar --}}
                        <div class="mt-auto">
                            <a href="{{ route('programs.show', $programs->slug) }}" class="btn btn-video w-100 shadow-sm">
                                <i class="bi bi-play-fill"></i> Lihat Video Pembelajaran
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        @empty
            <div class="col-12 py-5 text-center">
                <div class="opacity-50 mb-3">
                    <i class="bi bi-film" style="font-size: 4rem;"></i>
                </div>
                <h5 class="text-muted">Ops! Belum ada video modul saat ini.</h5>
            </div>
        @endforelse
    </div>
</div>
@endsection