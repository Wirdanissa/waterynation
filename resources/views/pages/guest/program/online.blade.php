@extends('layouts.guest')

@section('title', 'Offline Webinar - Watery Nation')
@section('menuProgram', 'active')
@section('menuOnlineWebinar', 'active')

@section('content')
    <div class="container py-5">
        <div class="row mb-5">
            <div class="col-12 px-4">
                <div class="mb-5">
                    <h3 class="fw-bold d-inline-block position-relative pb-3">
                        Online Webinar <span class="text-primary">Watery Nation</span>
                        <span style="position:absolute; left:0; bottom:0; width:60px; height:4px; background-color:#0d6efd; border-radius:10px;"></span>
                    </h3>
                </div>

                <div class="row g-4">
                    @forelse ($onlineWebinar as $publikasi)
                        <div class="col-12 col-md-6 col-lg-3">
                            <a href="{{ route('programs.show', $publikasi->slug) }}" class="text-decoration-none group">
                                <div class="card h-100 border-0 shadow-sm rounded-4 transition-all" style="transition: transform 0.2s ease; overflow: hidden;">
                                    <div class="position-relative overflow-hidden">
                                        <img src="{{ Storage::url($publikasi->image) }}" 
                                             class="card-img-top" 
                                             style="height: 200px; object-fit: cover; transition: transform 0.3s ease;" 
                                             alt="{{ $publikasi->title }}"
                                             onmouseover="this.style.transform='scale(1.05)'"
                                             onmouseout="this.style.transform='scale(1)'">
                                    </div>
                                    
                                    <div class="card-body d-flex flex-column">
                                        <h5 class="card-title fw-bold text-dark mb-3" style="font-size: 1.1rem; line-height: 1.4;">
                                            {{ $publikasi->title }}
                                        </h5>
                                        
                                        <div class="mt-auto">
                                            <div class="d-flex align-items-center gap-2 text-muted mb-2" style="font-size: 0.85rem;">
                                                <i class="bi bi-calendar-event text-primary"></i>
                                                <span>{{ tanggal($publikasi->start_date) }}</span>
                                            </div>
                                            <div class="d-flex align-items-center gap-2 text-muted" style="font-size: 0.85rem;">
                                                <i class="bi bi-geo-alt-fill text-danger"></i>
                                                <span class="text-truncate">{{ $publikasi->lokasi }}</span>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </a>
                        </div>
                    @empty
                        <div class="col-12 py-5">
                            <div class="text-center">
                                <i class="bi bi-calendar-x text-muted" style="font-size: 3rem;"></i>
                                <p class="mt-3 text-muted">Program Online Webinar belum tersedia saat ini.</p>
                            </div>
                        </div>
                    @endforelse
                </div>
            </div>
        </div>
    </div>

    <style>
        /* Menambahkan efek elevasi saat kartu di-hover */
        .card:hover {
            transform: translateY(-8px);
            box-shadow: 0 10px 20px rgba(0,0,0,0.1) !important;
        }
    </style>
@endsection