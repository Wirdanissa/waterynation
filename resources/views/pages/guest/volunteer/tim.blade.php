@extends('layouts.guest')

@section('title', 'Volunteer - Watery Nation')
@section('menuVolunteer', 'active')
@section('menuTimVolunteer', 'active')

@section('content')
    {{-- Tambahkan min-height di sini --}}
    <div class="container py-5" style="min-height: 75vh;">

        <div class="row mb-5">
            <div class="col-12 px-4">
                <h3 class="fw-bold mb-4 position-relative d-inline-block" style="padding-bottom:12px;">
                    Tim Volunteer <span class="text-primary">Watery Nation</span>
                    <span style="position:absolute; left:0; bottom:0; width:85px; height:3px; background-color:#0d6efd; border-radius:2px;"></span>
                </h3>
                <p>Berkenalan dengan tim volunteer yang mendukung misi Watery Nation.</p>
            </div>
        </div>

        <div class="row g-4">
            @forelse ($volunteers as $volunteer)
                <div class="col-12 col-sm-6 col-md-4 col-lg-3 mb-4">
                    <div class="card h-100 shadow-sm rounded-3 p-3">
                        <div class="mx-auto rounded-circle overflow-hidden shadow-lg mt-3" style="width:150px; height:150px;">
                            <img src="{{ Storage::url($volunteer->image) }}" class="w-100 h-100" style="object-fit:cover;" alt="{{ $volunteer->name ?? '-' }}">
                        </div>
                        <div class="card-body pt-3">
                            <h5 class="fw-bold mb-3 text-center">{{ $volunteer->name ?? '-' }}</h5>
                            <div class="d-flex flex-column justify-content-center align-items-center mb-3 text-muted" style="font-size:0.9rem;">
                                <span>{{ $volunteer->position ?? '-' }} | {{ $volunteer->volunter->title ?? '-' }}</span>
                            </div>
                            <p class="mb-0 text-center text-primary small">
                                <i class="bi bi-linkedin me-2"></i>{{ $volunteer->linkedin ?? 'Tidak ada' }}
                            </p>
                        </div>
                    </div>
                </div>
            @empty
                <div class="col-12">
                    <p class="text-center">Tim volunteer belum tersedia.</p>
                </div>
            @endforelse
        </div>
    </div>
@endsection