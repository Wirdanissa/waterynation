@extends('layouts.guest')

@section('title', 'Volunteer - Watery Nation')
@section('menuVolunteer', 'active')
@section('menuListVolunteer', 'active')

@section('content')
<style>
    .card-volunteer {
        transition: all 0.3s ease;
        border: none;
        overflow: hidden;
    }
    .card-volunteer:hover {
        transform: translateY(-10px);
        box-shadow: 0 15px 30px rgba(0,0,0,0.1) !important;
    }
    .volunteer-img-container {
        overflow: hidden;
    }
    .card-volunteer:hover .card-img-top {
        transform: scale(1.05);
    }
    .card-img-top {
        transition: transform 0.5s ease;
        object-fit: cover;
    }
    .badge-position {
        background: #f0f7ff;
        color: #0d6efd;
        padding: 5px 12px;
        font-size: 11px;
        font-weight: 500;
        border-radius: 50px;
        transition: 0.3s;
    }
    .card-volunteer:hover .badge-position {
        background: #0d6efd;
        color: #fff;
    }
    .line-underline {
        width: 60px;
        height: 4px;
        background: #0d6efd;
        border-radius: 10px;
        margin-top: 10px;
    }
</style>

<div class="container py-5" style="min-height: 80vh;">
    <div class="row mb-5">
        <div class="col-lg-8 mx-auto text-center">
            <h2 class="fw-bold mb-2">Volunteer <span class="text-primary">Watery Nation</span></h2>
            <div class="line-underline mx-auto"></div>
            <p class="text-muted mt-3">Mari bergabung bersama kami dalam menjaga keberlanjutan sumber daya air untuk masa depan yang lebih baik.</p>
        </div>
    </div>

    <div class="row g-4 justify-content-center">
        @forelse ($volunteers as $volunteer)
            <div class="col-12 col-md-6 col-lg-4 col-xl-3">
                <a href="{{ route('volunteer.show', $volunteer->slug) }}" class="text-decoration-none">
                    <div class="card h-100 shadow-sm card-volunteer rounded-4">
                        <div class="volunteer-img-container">
                            <img src="{{ Storage::url($volunteer->image) }}" 
                                 class="card-img-top" 
                                 style="height: 220px;" 
                                 alt="{{ $volunteer->title }}">
                        </div>
                        <div class="card-body p-4">
                            <h5 class="fw-bold text-dark mb-3 line-clamp-2" style="height: 2.8rem; overflow: hidden;">
                                {{ $volunteer->title }}
                            </h5>
                            
                            <div class="mb-3 d-flex flex-wrap gap-1">
                                @foreach (array_slice($volunteer->positions, 0, 3) as $item)
                                    <span class="badge-position">
                                        {{ $item }}
                                    </span>
                                @endforeach
                                @if(count($volunteer->positions) > 3)
                                    <span class="badge-position">+{{ count($volunteer->positions) - 3 }} Lainnya</span>
                                @endif
                            </div>

                            <p class="text-muted mb-0" style="font-size: 0.875rem; line-height: 1.6;">
                                {{ Str::limit(strip_tags($volunteer->description), 95) }}
                            </p>
                        </div>
                        <div class="card-footer bg-transparent border-0 p-4 pt-0">
                            <hr class="my-3 opacity-10">
                            <div class="d-flex justify-content-between align-items-center">
                                <span class="text-primary fw-semibold small">Lihat Detail</span>
                                <i class="bi bi-arrow-right text-primary"></i>
                            </div>
                        </div>
                    </div>
                </a>
            </div>
        @empty
            <div class="col-12 text-center py-5">
                <div class="mb-3">
                    <i class="bi bi-clipboard-x text-muted" style="font-size: 3rem;"></i>
                </div>
                <h5 class="text-muted">Maaf, saat ini belum ada lowongan volunteer yang tersedia.</h5>
                <a href="{{ url('/') }}" class="btn btn-primary mt-3 rounded-pill px-4">Kembali ke Beranda</a>
            </div>
        @endforelse
    </div>
</div>
@endsection