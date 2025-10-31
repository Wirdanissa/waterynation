@extends('auth.layouts.auth')
@section('title', 'Reset Password | Watery Nation')
@section('content')

    <form action="{{ route('password.store') }}" method="post">
        @csrf
        <div class="mb-3">
            <label for="email" class="form-label">Email</label>
            <div class="input-group">
                <span class="input-group-text">
                    <i class="bi bi-envelope-fill"></i>
                </span>
                <input type="email" class="form-control border-primary @error('email') is-invalid @enderror" id="email"
                    name="email" placeholder="Masukkan alamat email anda" autofocus required value="{{ old('email') }}">
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
                    placeholder="&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;" autofocus
                    required>
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
                    placeholder="&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;" autofocus
                    required>
                @error('password')
                    <div class="invalid-feedback">
                        {{ $message }}
                    </div>
                @enderror
            </div>
        </div>
        <label class="flex items-center mt-2 text-sm text-gray-600" for="showPassword">
            <input type="checkbox" wire:model="showPassword" class="mr-2" id="showPassword">
            Tampilkan Password
        </label>

        <div class="mb-3">
            <button class="btn btn-primary d-grid w-100" type="submit" id="resetPasswordBtn">Reset Password</button>
        </div>
    </form>

@endsection
@push('custom-script')
    <script>
        document.getElementById('showPassword').addEventListener('change', function() {
            const passwordInput = document.getElementById('password');
            const passwordConfirmationInput = document.getElementById('password_confirmation');

            if (this.checked) {
                passwordInput.type = 'text'; // Show the password
                passwordConfirmationInput.type = 'text'; // Show the password confirmation
            } else {
                passwordInput.type = 'password'; // Hide the password
                passwordConfirmationInput.type = 'password'; // Hide the password confirmation
            }
        });
    </script>
@endpush
