@extends('layouts.guest')

@section('title', 'Volunteer - Watery Nation')
@section('menuVolunteer', 'active')
@section('menuListVolunteer', 'active')

@section('content')
    <div class="container py-5 px-4">

        <div class="row justify-content-between">
            <div class="col-lg-8 mb-5">
                <div class="d-flex justify-content-between align-items-center mb-4">
                    <a href="{{ route('volunteer') }}" class="btn btn-primary rounded-pill px-4">
                        <i class="bi bi-arrow-left"></i> Kembali
                    </a>
                </div>

                <!-- Gambar Utama -->
                <div class="mb-4">
                    <img src="{{ Storage::url($volunteers->image) }}" alt="{{ $volunteers->title }}"
                        class="img-fluid rounded-4 shadow-sm w-100" style="height: 500px; object-fit: fill;">
                </div>

                <!-- Judul & Info Publikasi -->
                <div class="mb-4">
                    <h3 class="fw-bold mb-3" style="position: relative; display: inline-block; padding-bottom: 10px;">
                        {{ $volunteers->title }}
                        <span
                            style="position:absolute; left:0; bottom:0; width:100%; height:3px; background-color:#0d6efd; border-radius:2px;"></span>
                    </h3>
                    <div class="text-muted mb-3" style="font-size:0.9rem;">
                        <i class="bi bi-calendar-event"></i>
                        {{ tanggal($volunteers->start_date) }} |
                        <i class="bi bi-person-fill"></i> {{ $volunteers->lokasi }}
                    </div>
                </div>

                <!-- Isi Publikasi -->
                <div class="text-muted" style="font-size:0.95rem; line-height:1.7;">
                    {!! $volunteers->description !!}
                </div>

                <!-- Tombol Daftar Sekarang -->
                @if ($volunteers->category !== 'Modul Development For Kids')
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
                    <h5 class="modal-title">Form Pendaftaran Volunteer</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>

                <form action="{{ route('volunteer-registrasi.store') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <input type="hidden" name="volunter_id" value="{{ $volunteers->id }}">
                    <div class="modal-body">
                        <div class="row">
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label class="form-label">Nama Lengkap</label>
                                    <input type="text" name="name"
                                        class="form-control @error('name') is-invalid @enderror"
                                        value="{{ old('name') }}" required>
                                    @error('name')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="mb-3">
                                    <label class="form-label">Email</label>
                                    <input type="email" name="email"
                                        class="form-control @error('email') is-invalid @enderror"
                                        value="{{ old('email') }}" required>
                                    @error('email')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="mb-3">
                                    <label class="form-label">No. Telepon</label>
                                    <input type="text" name="phone"
                                        class="form-control @error('phone') is-invalid @enderror"
                                        value="{{ old('phone') }}" required>
                                    @error('phone')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>

                            </div>

                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label class="form-label">Instagram</label>
                                    <input type="text" name="instagram"
                                        class="form-control @error('instagram') is-invalid @enderror"
                                        value="{{ old('instagram') }}">
                                    @error('instagram')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>

                                <div class="mb-3">
                                    <label class="form-label">LinkedIn</label>
                                    <input type="text" name="linkedin"
                                        class="form-control @error('linkedin') is-invalid @enderror"
                                        value="{{ old('linkedin') }}">
                                    @error('linkedin')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="mb-3">
                                    <label class="form-label">Posisi</label>
                                    <select name="position" class="form-control @error('position') is-invalid @enderror"
                                        required>
                                        <option value="">-- Pilih Posisi --</option>
                                        @foreach ($volunteers->positions as $pos)
                                            <option value="{{ $pos }}" @selected(old('position') == $pos)>
                                                {{ $pos }}
                                            </option>
                                        @endforeach
                                    </select>
                                    @error('position')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                            <div class="mb-3">
                                <label class="form-label">Upload Foto</label>
                                <input type="file" name="image"
                                    class="form-control @error('image') is-invalid @enderror" accept="image/*" required>
                                @error('image')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

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
