@extends('layouts.guest')

@section('title', 'Donasi - Belajar dan Beraksi untuk Menjaga Air')
@section('menuDonasi', 'active')

@section('content')
    <div class="container py-5">

        @if (session('success'))
            <div class="alert alert-success">{{ session('success') }}</div>
        @endif

        <div class="card shadow mb-4 border-0">
            <div class="card-body">
                <h3 class="fw-bold mb-3">Donasi</h3>
                <p class="text-muted text-dark">
                    Donasi ini digunakan untuk mendukung kegiatan operasional, program lingkungan, edukasi air bersih, dan
                    aksi sosial Watery Nation.
                </p>
            </div>
        </div>


        <div class="row justify-content-center">

            <div class="col-lg-5">
                <div class="card shadow mb-4 border-0">
                    <div class="card-body text-center">
                        <h4 class="fw-bold mb-3">Scan QRIS</h4>
                        <img src="{{ Storage::url($organisasi->qris_image) }}" style="max-width: 280px"
                            class="img-fluid rounded mb-3">
                        <h5 class="fw-bold">{{ $organisasi->qris_name }}</h5>
                        <p class="text-muted">{{ $organisasi->qris_info }}</p>
                        <div class="row mt-3 g-2">
                            <div class="col-6">
                                <button onclick="copyText('{{ $organisasi->qris_info }}')"
                                    class="btn btn-outline-primary w-100">
                                    Salin Informasi
                                </button>
                            </div>

                            <div class="col-6">
                                <a href="{{ Storage::url($organisasi->qris_image) }}" download="qris-donasi.png"
                                    class="btn btn-primary w-100">
                                    <i class="bi bi-download"></i> Download QR
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-lg-7">
                <div class="card shadow border-0">
                    <div class="card-body">

                        <h4 class="fw-bold mb-3">Form Donasi</h4>

                        <form action="{{ route('donasi.store') }}" method="POST" enctype="multipart/form-data">
                            @csrf

                            <div class="mb-3">
                                <label class="form-label">Nama Lengkap</label>
                                <input type="text" name="name" class="form-control"
                                    value="{{ old('name', auth()->user()->name ?? '') }}">

                                @error('name')
                                    <div class="text-danger small">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="mb-3">
                                <label class="form-label">Email</label>
                                <input type="email" name="email" class="form-control"
                                    value="{{ old('email', auth()->user()->email ?? '') }}">

                                @error('email')
                                    <div class="text-danger small">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="mb-3">
                                <label class="form-label">Tanggal Donasi</label>
                                <input type="date" name="tanggal_donasi" class="form-control"
                                    value="{{ old('tanggal_donasi') }}">
                                @error('tanggal_donasi')
                                    <div class="text-danger small">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="mb-3">
                                <label class="form-label">Total Donasi (Rp)</label>
                                <input type="number" name="total_donasi" class="form-control"
                                    value="{{ old('total_donasi') }}">
                                @error('total_donasi')
                                    <div class="text-danger small">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="mb-3">
                                <label class="form-label">Bukti Transfer</label>
                                <input type="file" name="bukti_transfer" class="form-control">
                                @error('bukti_transfer')
                                    <div class="text-danger small">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="mb-3">
                                <label class="form-label">Keterangan (Opsional)</label>
                                <input type="text" name="keterangan" class="form-control"
                                    value="{{ old('keterangan') }}">
                            </div>

                            <div class="mb-3 form-check">
                                <input type="checkbox" name="show_name" class="form-check-input" id="showName"
                                    value="1" {{ old('show_name', true) ? 'checked' : '' }}>
                                <label class="form-check-label" for="showName">Tampilkan nama saya</label>
                            </div>

                            <button class="btn btn-primary w-100 mt-2">Kirim Donasi</button>

                        </form>

                    </div>
                </div>
            </div>

        </div>
    </div>

    <script>
        function copyText(text) {
            navigator.clipboard.writeText(text);
            alert('Informasi disalin!');
        }
    </script>
@endsection
