@extends('auth.layouts.auth')
@section('title', 'Login | Watery Nation')
@section('content')

    <form id="formAuthentication" class="mb-3" action="{{ route('login') }}" method="POST">
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
        <div class="mb-3">
            <div class="d-flex justify-content-between">
                <label class="form-label" for="password">Password</label>
                <a href="{{ route('password.request') }}" class="text-dark" id="forgotPasswordLink">
                    <small>Lupa Password?</small>
                </a>
            </div>
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
            <div class="form-check">
                <input class="form-check-input" type="checkbox" id="remember" />
                <label class="form-check-label" for="remember-me">Ingat saya</label>
            </div>
        </div>
        <div class="mb-3">
            <button class="btn btn-primary d-grid w-100" type="submit" id="loginBtn">Masuk</button>
        </div>
        <p class="text-center mt-4">Belum punya akun?
            <a href="/register" class="fw-semibold text-primary text-decoration-underline-hover">Daftar di sini</a>
        </p>
    </form>

@endsection
