@extends('layouts.guest')

@section('title', 'Publikasi - Watery Nation')
@section('menuPublikasi', 'active')

@section('content')
    <div class="container py-5 px-4">
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
                        <div class="card h-100 shadow-sm rounded-3">
                            <div class="position-relative">
                                <img src="{{ Storage::url($publikasi->image) }}" class="card-img-top rounded-top-3 object-cover" style="width: 100%; height: 200px;"
                                    alt="{{ $publikasi->title }}">
                                {{-- <!-- Label Event -->
                            <span class="position-absolute top-0 start-0 m-2 px-2 py-1 text-white"
                                style="background-color:#d63384; border-radius:4px; font-size:0.8rem;">
                                {{ $publikasi->type ?? 'Event' }} --}}
                                </span>
                            </div>
                            <div class="card-body">
                                <!-- Kategori kecil -->
                                <div class="d-flex flex-column gap-2 mb-3" style="font-size:0.9rem;">
                                    <div class="d-flex align-items-center gap-3">
                                        <i class="bi bi-calendar-event"></i>
                                        <span>{{ tanggal($publikasi->date) }}</span>
                                    </div>
                                    <div class="d-flex align-items-center gap-3">
                                        <i class="bi bi-person-fill"></i>
                                        <span class="badge bg-light text-danger">{{ $publikasi->author }}</span>
                                    </div>
                                </div>
                                <h5 class="card-title fw-bold mb-3">{{ $publikasi->title }}</h5>
                                <span class="text-muted mb-3" style="font-size:12px;">{!! $publikasi->description !!}</span>
                            </div>
                        </div>
                    </a>
                </div>
            @empty
                <div class="col-12">
                    <p class="text-center">Publikasi tentang organisasi belum tersedia.</p>
                </div>
            @endforelse
        </div>
    </div>
@endsection
