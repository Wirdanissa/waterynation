@extends('auth.layouts.auth')
@section('title', 'Register | Watery Nation')
@section('content')

    <form id="formAuthentication" class="mb-3" action="{{ route('register') }}" method="POST">
        @csrf
        
        <div class="mb-3">
            <label for="name" class="form-label">Nama Lengkap</label>
            <div class="input-group">
                <span class="input-group-text">
                    <i class="bi bi-person-circle"></i>
                </span>
                <input type="text" class="form-control border-primary @error('name') is-invalid @enderror" id="name"
                    name="name" value="{{ old('name') }}" placeholder="Masukkan nama lengkap anda" autofocus>
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
                    id="email" name="email" value="{{ old('email') }}" placeholder="Masukkan alamat email anda">
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
                    placeholder="&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;">
                <button class="btn btn-outline-primary" type="button" id="togglePassword">
                    <i class="bi bi-eye-slash" id="iconPassword"></i>
                </button>
                @error('password')
                    <div class="invalid-feedback">
                        {{ $message }}
                    </div>
                @enderror
            </div>
            
            <div class="mt-2 small" id="password-requirements">
                <div id="req-length" class="text-muted"><i class="bi bi-circle me-1"></i> Minimal 8 Karakter</div>
                <div id="req-mixed" class="text-muted"><i class="bi bi-circle me-1"></i> Huruf Besar & Kecil</div>
                <div id="req-number" class="text-muted"><i class="bi bi-circle me-1"></i> Mengandung Angka</div>
                <div id="req-symbol" class="text-muted"><i class="bi bi-circle me-1"></i> Mengandung Simbol</div>
            </div>
        </div>

        <div class="mb-3">
            <label class="form-label" for="password_confirmation">Konfirmasi Password</label>
            <div class="input-group">
                <span class="input-group-text">
                    <i class="bi bi-lock-fill"></i>
                </span>
                <input type="password" class="form-control border-primary"
                    id="password_confirmation" name="password_confirmation"
                    placeholder="&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;">
                <button class="btn btn-outline-primary" type="button" id="toggleConfirmPassword">
                    <i class="bi bi-eye-slash" id="iconConfirmPassword"></i>
                </button>
            </div>
        </div>

        <div class="mb-3">
            <button class="btn btn-primary d-grid w-100" type="submit" id="registerBtn">Daftar Sekarang</button>
        </div>

        <p class="text-center mt-4">Sudah punya akun?
            <a href="{{ route('login') }}" class="fw-semibold text-primary text-decoration-underline-hover">Login di sini</a>
        </p>
    </form>

    <script>
        // 1. Logika Show/Hide Password
        function setupPasswordToggle(buttonId, inputId, iconId) {
            const button = document.getElementById(buttonId);
            const input = document.getElementById(inputId);
            const icon = document.getElementById(iconId);

            button.addEventListener('click', function() {
                const type = input.getAttribute('type') === 'password' ? 'text' : 'password';
                input.setAttribute('type', type);
                
                // Toggle Icon
                icon.classList.toggle('bi-eye');
                icon.classList.toggle('bi-eye-slash');
            });
        }

        setupPasswordToggle('togglePassword', 'password', 'iconPassword');
        setupPasswordToggle('toggleConfirmPassword', 'password_confirmation', 'iconConfirmPassword');

        // 2. Logika Validasi Real-time
        const passwordInput = document.getElementById('password');
        const reqLength = document.getElementById('req-length');
        const reqMixed = document.getElementById('req-mixed');
        const reqNumber = document.getElementById('req-number');
        const reqSymbol = document.getElementById('req-symbol');

        passwordInput.addEventListener('input', function() {
            const val = this.value;
            updateStatus(reqLength, val.length >= 8);
            updateStatus(reqMixed, /[a-z]/.test(val) && /[A-Z]/.test(val));
            updateStatus(reqNumber, /\d/.test(val));
            updateStatus(reqSymbol, /[^A-Za-z0-9]/.test(val));
        });

        function updateStatus(element, condition) {
            if (condition) {
                element.classList.remove('text-muted');
                element.classList.add('text-success', 'fw-bold');
                element.querySelector('i').className = 'bi bi-check-circle-fill me-1';
            } else {
                element.classList.remove('text-success', 'fw-bold');
                element.classList.add('text-muted');
                element.querySelector('i').className = 'bi bi-circle me-1';
            }
        }
    </script>

@endsection