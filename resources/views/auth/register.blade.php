@extends('auth.layouts.auth')
@section('title', 'Register | Watery Nation')
@section('content')

    <form id="formAuthentication" class="mb-3" action="{{ route('register') }}" method="POST">
        @csrf
        <div class="mb-3">
            <label for="name" class="form-label">Nama</label>
            <div class="input-group">
                <span class="input-group-text">
                    <i class="bi bi-person-circle"></i>
                </span>
                <input type="name" class="form-control border-primary @error('name') is-invalid @enderror" id="name"
                    name="name" placeholder="Masukkan alamat name anda" autofocus>
                @error('name')
                    <div class="invalid-feedback">
                        {{ $message }}
                    </div>
                @enderror
            </div>
        </div>
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
        <div class="mb-3">
            <label class="form-label" for="password">Password</label>
            <div class="input-group">
                <span class="input-group-text">
                    <i class="bi bi-lock-fill"></i>
                </span>
                <input type="password" class="form-control border-primary @error('password') is-invalid @enderror"
                    id="password" name="password"
                    placeholder="&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;   " autofocus>
                @error('password')
                    <div class="invalid-feedback">
                        {{ $message }}
                    </div>
                @enderror
            </div>
        </div>
        <div class="mb-3">
            <label class="form-label" for="password_confirmation">Password Konfirmasi</label>
            <div class="input-group">
                <span class="input-group-text">
                    <i class="bi bi-lock-fill"></i>
                </span>
                <input type="password" class="form-control border-primary @error('password') is-invalid @enderror"
                    id="password_confirmation" name="password_confirmation"
                    placeholder="&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;" autofocus>
                @error('password')
                    <div class="invalid-feedback">
                        {{ $message }}
                    </div>
                @enderror
            </div>
        </div>
        <div class="mb-3">
            <button class="btn btn-primary d-grid w-100" type="submit" id="loginBtn">Daftar</button>
        </div>
        <p class="text-center mt-4">Sudah punya akun?
            <a href="/login" class="fw-semibold text-primary text-decoration-underline-hover">Login di sini</a>
        </p>
    </form>

@endsection
