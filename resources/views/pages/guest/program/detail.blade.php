@extends('layouts.guest')

@section('title', $programs->title . ' - Watery Nation')
@section('menuProgram', 'active')
@section($activeMenu, 'active')

@section('content')
    <div class="container py-5 px-4">

        <div class="row justify-content-between">
            <div class="col-lg-8 mb-5">
                <div class="d-flex justify-content-between align-items-center mb-4">
                    <a href="{{ $backRoute }}" class="btn btn-primary rounded-pill px-4">
                        <i class="bi bi-arrow-left"></i> Kembali
                    </a>
                </div>

                <!-- Gambar Utama -->
                <div class="mb-4">
                    @if ($programs->category === 'Modul Development For Kids' && $programs->link_url)
                        {{-- Tampilkan video YouTube --}}
                        <iframe src="{{ $programs->link_url }}" class="w-100 rounded-4 shadow-sm" style="height: 500px;"
                            frameborder="0" allowfullscreen>
                        </iframe>
                    @else
                        {{-- Tampilkan foto --}}
                        <img src="{{ Storage::url($programs->image) }}" alt="{{ $programs->title }}"
                            class="img-fluid rounded-4 shadow-sm w-100" style="height: 500px; object-fit: fill;">
                    @endif
                </div>

                <!-- Judul & Info Publikasi -->
                <div class="mb-4">
                    <h3 class="fw-bold mb-3" style="position: relative; display: inline-block; padding-bottom: 10px;">
                        {{ $programs->title }}
                        <span
                            style="position:absolute; left:0; bottom:0; width:100%; height:3px; background-color:#0d6efd; border-radius:2px;"></span>
                    </h3>
                    <div class="text-muted mb-3" style="font-size:0.9rem;">
                        <i class="bi bi-calendar-event"></i>
                        {{ tanggal($programs->start_date) }} |
                        <i class="bi bi-person-fill"></i> {{ $programs->lokasi }}
                    </div>
                </div>

                <!-- Isi Publikasi -->
                <div class="text-muted" style="font-size:0.95rem; line-height:1.7;">
                    {!! $programs->description !!}
                </div>

                <!-- Tombol Daftar Sekarang -->
                @if ($programs->category !== 'Modul Development For Kids')
                    @auth
                        <button class="btn btn-primary w-100 rounded-3 px-4 py-2 mb-4" data-bs-toggle="modal"
                            data-bs-target="#modalDaftar">
                            Daftar Sekarang
                        </button>
                    @else
                        <a href="{{ route('login') }}?redirect={{ url()->current() }}"
                            class="btn btn-primary w-100 rounded-3 px-4 py-2 mb-4">
                            Login untuk Daftar
                        </a>
                    @endauth
                @endif

            </div>

            <div class="col-lg-4">
                <h5 class="fw-bold mb-3">Publikasi Lainnya</h5>

                @forelse ($rekomendasi as $lain)
                    <a href="{{ route('publikasi.show', $lain->slug) }}" class="text-decoration-none text-dark">
                        <div class="card mb-3 pt-2 border-0 shadow-sm rounded-3 overflow-hidden"
                            style="transition: transform 0.3s;" onmouseover="this.style.transform='scale(1.02)';"
                            onmouseout="this.style.transform='scale(1)';">
                            <div class="row g-0">
                                <div class="col-4 d-flex align-items-center justify-content-center bg-light">
                                    <img src="{{ Storage::url($lain->image) }}"
                                        class="img-fluid h-100 w-100 object-fit-cover rounded-start"
                                        alt="{{ $lain->title }}">
                                </div>
                                <div class="col-8">
                                    <div class="card-body py-2 px-3">
                                        <h6 class="fw-bold mb-3" style="font-size:0.9rem;">
                                            {{ Str::limit($lain->title, 50) }}</h6>
                                        <div class="text-muted mb-2" style="font-size:0.9rem;">
                                            <i class="bi bi-calendar-event"></i>
                                            {{ tanggal($lain->date) }} |
                                            <i class="bi bi-person-fill"></i> {{ $lain->author }}
                                        </div>
                                        <span class="text-muted" style="font-size:12px;">{!! Str::limit($lain->description, 50) !!}</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </a>
                @empty
                    <p class="text-muted">Belum ada publikasi lainnya.</p>
                @endforelse
            </div>
        </div>

    </div>

    <!-- Modal Form Registrasi -->
    <div class="modal fade" id="modalDaftar" tabindex="-1">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">

                <div class="modal-header">
                    <h5 class="modal-title">Form Registrasi Program</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>

                <form action="{{ route('program-registrasi.store') }}" method="POST">
                    @csrf

                    <input type="hidden" name="program_id" value="{{ $programs->id }}">

                    <div class="modal-body">

                        {{-- NAMA --}}
                        <div class="mb-3">
                            <label class="form-label">Nama Lengkap</label>

                            <input type="text" name="name" class="form-control @error('name') is-invalid @enderror"
                                value="{{ old('name', auth()->user()->name ?? '') }}"
                                @if (auth()->check()) readonly @endif required>

                            @error('name')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        {{-- EMAIL --}}
                        <div class="mb-3">
                            <label class="form-label">Email</label>

                            <input type="email" name="email" class="form-control @error('email') is-invalid @enderror"
                                value="{{ old('email', auth()->user()->email ?? '') }}"
                                @if (auth()->check()) readonly @endif required>

                            @error('email')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        {{-- PHONE (editable kalau user belum punya phone) --}}
                        <div class="mb-3">
                            <label class="form-label">No. Telepon</label>

                            <input type="text" name="phone" class="form-control @error('phone') is-invalid @enderror"
                                value="{{ old('phone', auth()->user()->phone ?? '') }}"
                                @if (auth()->check() && auth()->user()->phone) readonly @endif required>

                            @error('phone')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                    </div>

                    <div class="modal-footer">
                        <button type="submit" class="btn btn-primary">Kirim Pendaftaran</button>
                    </div>
                </form>

            </div>
        </div>
    </div>
@endsection
