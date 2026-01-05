@extends('layouts.guest')

@section('title', $volunteers->title . ' - Watery Nation')
@section('menuVolunteer', 'active')
@section('menuListVolunteer', 'active')

@section('content')
    <div class="container py-5 px-4">
        <div class="row justify-content-between">
            <div class="col-lg-8 mb-5">
                <div class="d-flex justify-content-between align-items-center mb-4">
                    <a href="{{ route('volunteer') }}" class="btn btn-outline-primary rounded-pill px-4">
                        <i class="bi bi-arrow-left"></i> Kembali
                    </a>
                </div>

                <div class="mb-4">
                    <img src="{{ Storage::url($volunteers->image) }}" alt="{{ $volunteers->title }}"
                        class="img-fluid rounded-4 shadow-sm w-100" style="height: 450px; object-fit: cover;">
                </div>

                <div class="mb-4">
                    <h2 class="fw-bold mb-3 text-dark">{{ $volunteers->title }}</h2>
                    <div class="d-flex flex-wrap gap-2 align-items-center mb-3">
                        <span class="text-muted small"><i class="bi bi-people-fill me-1"></i> Posisi:</span>
                        @foreach ($volunteers->positions as $item)
                            <span class="badge bg-light text-primary border border-primary-subtle px-3 py-2 rounded-pill" style="font-size: 13px;">
                                {{ $item }}
                            </span>
                        @endforeach
                    </div>
                </div>

                <hr class="my-4 opacity-10">

                <div class="article-content text-dark mb-5" style="font-size:1.05rem; line-height:1.8;">
                    {!! $volunteers->description !!}
                </div>

                @auth
                    <button class="btn btn-primary btn-lg w-100 rounded-4 py-3 shadow-sm mb-4" data-bs-toggle="modal"
                        data-bs-target="#modalDaftar">
                        Daftar Menjadi Volunteer
                    </button>
                @else
                    <a href="{{ route('login') }}?redirect={{ url()->current() }}"
                        class="btn btn-primary btn-lg w-100 rounded-4 py-3 shadow-sm mb-4">
                        Login untuk Mendaftar
                    </a>
                @endauth
            </div>

            <div class="col-lg-4 ps-lg-5">
                <div class="sticky-top" style="top: 100px;">
                    <h5 class="fw-bold mb-4">Lowongan Lainnya</h5>
                    @forelse ($rekomendasi as $lain)
                        <a href="{{ route('volunteer.show', $lain->slug) }}" class="text-decoration-none group">
                            <div class="card mb-3 border-0 shadow-sm rounded-4 overflow-hidden transition-all" 
                                 style="transition: 0.3s;" onmouseover="this.style.transform='translateY(-5px)';" onmouseout="this.style.transform='translateY(0)';">
                                <div class="row g-0">
                                    <div class="col-4">
                                        <img src="{{ Storage::url($lain->image) }}"
                                            class="img-fluid h-100 w-100 object-fit-cover"
                                            alt="{{ $lain->title }}">
                                    </div>
                                    <div class="col-8">
                                        <div class="card-body py-2 px-3">
                                            <h6 class="fw-bold text-dark mb-1" style="font-size:0.9rem;">{{ Str::limit($lain->title, 45) }}</h6>
                                            <p class="text-muted small mb-0">{{ Str::limit(strip_tags($lain->description), 40) }}</p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </a>
                    @empty
                        <p class="text-muted small">Belum ada volunteer lainnya.</p>
                    @endforelse
                </div>
            </div>
        </div>
    </div>

    <div class="modal fade" id="modalDaftar" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-lg">
            <div class="modal-content border-0 rounded-4 shadow">
                <div class="modal-header border-0 pb-0">
                    <h5 class="fw-bold px-2 pt-2">Form Pendaftaran Volunteer</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>

                <form action="{{ route('volunteer-registrasi.store') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <input type="hidden" name="volunter_id" value="{{ $volunteers->id }}">
                    <div class="modal-body p-4">
                        <div class="row g-3">
                            <div class="col-md-6">
                                <label class="form-label fw-semibold">Nama Lengkap</label>
                                <input type="text" name="name" class="form-control bg-light" value="{{ auth()->user()->name ?? '' }}" readonly>
                            </div>
                            <div class="col-md-6">
                                <label class="form-label fw-semibold">Email</label>
                                <input type="email" name="email" class="form-control bg-light" value="{{ auth()->user()->email ?? '' }}" readonly>
                            </div>
                            <div class="col-md-6">
                                <label class="form-label fw-semibold">No. WhatsApp</label>
                                <input type="text" name="phone" class="form-control" placeholder="Contoh: 08123456789" required>
                            </div>
                            <div class="col-md-6">
                                <label class="form-label fw-semibold">Posisi yang Dilamar</label>
                                <select name="position" class="form-select" required>
                                    <option value="" selected disabled>Pilih Posisi</option>
                                    @foreach ($volunteers->positions as $pos)
                                        <option value="{{ $pos }}">{{ $pos }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="col-md-6">
                                <label class="form-label fw-semibold">Username Instagram</label>
                                <input type="text" name="instagram" class="form-control" placeholder="@username">
                            </div>
                            <div class="col-md-6">
                                <label class="form-label fw-semibold">Link LinkedIn</label>
                                <input type="text" name="linkedin" class="form-control" placeholder="linkedin.com/in/username">
                            </div>
                            <div class="col-12 mt-4">
                                <div class="p-3 border rounded-3 bg-light">
                                    <label class="form-label fw-bold mb-1">Upload CV / Portofolio (PDF)</label>
                                    <p class="text-muted small mb-3">Harap unggah file dalam format PDF dengan ukuran maksimal 10MB.</p>
                                    <input type="file" name="image" class="form-control" accept="application/pdf" required>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer border-0 p-4 pt-0">
                        <button type="submit" class="btn btn-primary w-100 py-3 rounded-3 fw-bold">Kirim Pendaftaran</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection