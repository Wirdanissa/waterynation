@extends('auth.layouts.auth')
@section('title', 'Login | Watery Nation')
@section('content')

    @if (session('success'))
        <div class="alert alert-success alert-dismissible fade show border-0 shadow-sm mb-4" role="alert">
            <div class="d-flex">
                <i class="bi bi-check-circle-fill me-2"></i>
                <div>
                    {{ session('success') }}
                </div>
            </div>
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif

    @if (session('status'))
        <div class="alert alert-primary alert-dismissible fade show border-0 shadow-sm mb-4" role="alert">
            <i class="bi bi-info-circle-fill me-2"></i>
            {{ session('status') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif

    <form id="formAuthentication" class="mb-3" action="{{ route('login') }}" method="POST">
        @csrf
        
        <div class="mb-3">
            <label for="email" class="form-label">Email</label>
            <div class="input-group">
                <span class="input-group-text">
                    <i class="bi bi-envelope-fill"></i>
                </span>
                <input type="email" class="form-control border-primary @error('email') is-invalid @enderror"
                    id="email" name="email" value="{{ old('email') }}" placeholder="Masukkan alamat email anda" autofocus required>
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
                <a href="{{ route('password.request') }}" class="text-primary text-decoration-none">
                    <small class="fw-bold">Lupa Password?</small>
                </a>
            </div>
            <div class="input-group">
                <span class="input-group-text">
                    <i class="bi bi-lock-fill"></i>
                </span>
                <input type="password" class="form-control border-primary @error('password') is-invalid @enderror"
                    id="password" name="password"
                    placeholder="&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;" required>
                
                <button class="btn btn-outline-primary" type="button" id="togglePassword">
                    <i class="bi bi-eye-slash" id="iconPassword"></i>
                </button>

                @error('password')
                    <div class="invalid-feedback">
                        {{ $message }}
                    </div>
                @enderror
            </div>
        </div>

        <div class="mb-3">
            <div class="form-check">
                <input class="form-check-input" type="checkbox" name="remember" id="remember" />
                <label class="form-check-label" for="remember">Ingat saya</label>
            </div>
        </div>

        <div class="mb-3">
            <button class="btn btn-primary d-grid w-100 py-2 fw-bold" type="submit" id="loginBtn">Masuk</button>
        </div>

        <p class="text-center mt-4">Belum punya akun?
            <a href="{{ route('register') }}" class="fw-semibold text-primary text-decoration-underline-hover">Daftar di sini</a>
        </p>
    </form>

    <script>
        // Logika Show/Hide Password
        const togglePassword = document.querySelector('#togglePassword');
        const passwordInput = document.querySelector('#password');
        const iconPassword = document.querySelector('#iconPassword');

        togglePassword.addEventListener('click', function () {
            // Toggle tipe input
            const type = passwordInput.getAttribute('type') === 'password' ? 'text' : 'password';
            passwordInput.setAttribute('type', type);
            
            // Toggle ikon mata
            iconPassword.classList.toggle('bi-eye');
            iconPassword.classList.toggle('bi-eye-slash');
        });
    </script>

@endsection