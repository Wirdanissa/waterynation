@extends('layouts.guest')

@section('title', 'Volunteer - Watery Nation')
@section('menuVolunteer', 'active')
@section('menuListVolunteer', 'active')

@section('content')
    {{-- Tambahkan min-height di sini agar footer tidak naik --}}
    <div class="container py-5" style="min-height: 75vh;">
        <div class="row align-items-start mb-5">
            <div class="col-md-12" style="padding: 0 40px;">
                <h3 class="fw-bold mb-4"
                    style="position: relative; display: inline-block; padding-bottom: 12px; margin-bottom: 40px;">
                    Volunteer <span class="text-primary">Watery Nation</span>
                    <span
                        style="position:absolute; left:0; bottom:0; width:85px; height:3px; background-color:#0d6efd; border-radius:2px;"></span>
                </h3>

                <div class="row g-4">
                    @forelse ($volunteers as $volunteer)
                        <div class="col-12 col-md-6 col-lg-3">
                            <a href="{{ route('volunteer.show', $volunteer->slug) }}" class="text-decoration-none text-dark">
                                <div class="card h-100 shadow-sm rounded-3">
                                    <div class="position-relative">
                                        <img src="{{ Storage::url($volunteer->image) }}"
                                            class="card-img-top rounded-top-3 object-cover"
                                            style="width: 100%; height: 200px;" alt="{{ $volunteer->title }}">
                                    </div>
                                    <div class="card-body">
                                        <h5 class="fw-bold mb-3" style="font-size:1.1rem;">
                                            {{ $volunteer->title }}
                                        </h5>
                                        <div class="mb-3">
                                            @foreach ($volunteer->positions as $item)
                                                <span style="background:#e8f0ff; color:#0d6efd; padding:4px 8px; font-size:11px; border-radius:6px; margin-right:4px; display:inline-block; margin-bottom:4px;">
                                                    {{ $item }}
                                                </span>
                                            @endforeach
                                        </div>
                                        <p class="mb-0" style="font-size:0.85rem; color:#6c757d; line-height:1.4;">
                                            {!! Str::limit(strip_tags($volunteer->description), 110) !!}
                                        </p>
                                    </div>
                                </div>
                            </a>
                        </div>
                    @empty
                        <div class="col-12">
                            <p class="text-center">Program Online Webinar belum tersedia.</p>
                        </div>
                    @endforelse
                </div>
            </div>
        </div>
    </div>
@endsection