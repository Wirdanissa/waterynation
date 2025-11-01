@extends('auth.layouts.auth')
@section('title', 'Lupa Sandi | Watery Nation')
@section('content')
    <div class="mb-3">
        <p class="text-muted lh-base" style="font-size: 0.95rem;">
            <span class="fw-bold text-dark d-block mb-1">Lupa Kata Sandi?</span>
            Tidak masalah! Cukup berikan alamat email Anda dan kami akan mengirimkan tautan untuk mereset kata sandi Anda.
        </p>
    </div>

    <form action="{{ route('password.email') }}" method="POST">
        @csrf
        <div class="mb-3">
            <label for="email" class="form-label">Email</label>
            <div class="input-group">
                <span class="input-group-text">
                    <i class="bi bi-envelope-fill"></i>
                </span>
                <input type="email" class="form-control border-primary @error('email') is-invalid @enderror"
                    id="email" name="email" placeholder="Masukkan alamat email anda" autofocus>
                @error('email')
                    <div class="invalid-feedback">
                        {{ $message }}
                    </div>
                @enderror
            </div>
        </div>
        <button type="submit" class="btn btn-primary d-grid w-100">
            Kirim Tautan Reset Kata Sandi
        </button>
    </form>
@endsection
