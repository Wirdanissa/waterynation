@extends('layouts.guest')

@section('title', 'Offline Webinar - Watery Nation')
@section('menuProgram', 'active')
@section('menuOnlineWebinar', 'active')

@section('content')
    <div class="container py-5">
        <div class="row align-items-start mb-5">
            <div class="col-md-12" style="padding: 0 40px;">
                <h3 class="fw-bold mb-4"
                    style="position: relative; display: inline-block; padding-bottom: 12px; margin-bottom: 40px;">
                    Online Webinar <span class="text-primary">Watery Nation</span>
                    <span
                        style="position:absolute; left:0; bottom:0; width:85px; height:3px; background-color:#0d6efd; border-radius:2px;"></span>
                </h3>

                <div class="row g-4">
                    @forelse ($onlineWebinar as $publikasi)
                        <div class="col-12 col-md-6 col-lg-3">
                            <a href="{{ route('programs.show', $publikasi->slug) }}"
                                class="text-decoration-none text-dark">
                                <div class="card h-100 shadow-sm rounded-3">
                                    <div class="position-relative border-bottom border-3">
                                        <img src="{{ Storage::url($publikasi->image) }}"
                                            class="card-img-top rounded-top-3 object-cover"
                                            style="width: 100%; height: 200px;" alt="{{ $publikasi->title }}">
                                    </div>
                                    <div class="card-body">
                                        <h5 class="card-title fw-bold mb-3">{{ $publikasi->title }}</h5>
                                        <!-- Kategori kecil -->
                                        <div class="d-flex flex-column gap-2 mb-3" style="font-size:0.9rem;">
                                            <div class="d-flex align-items-center gap-3 text-muted" style="font-size:12px;">
                                                <i class="bi bi-calendar-event"></i>
                                                <span>{{ tanggal($publikasi->start_date) }} |
                                                    {{ tanggal($publikasi->end_date) }}</span>
                                            </div>
                                            <div class="d-flex align-items-center gap-3 text-muted" style="font-size:12px;">
                                                <i class="bi bi-geo-alt-fill"></i>
                                                <span>{{ $publikasi->lokasi }}</span>
                                            </div>
                                        </div>
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
