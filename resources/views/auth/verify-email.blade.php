@extends('auth.layouts.auth')
@section('title', 'Verifikasi Email | Watery Nation')

@section('content')
    <div class="mb-4">
        <p class="text-muted lh-base">
            <span class="fw-bold text-dark fs-5 d-block mb-2">
                Terima kasih telah mendaftar!
            </span>
            Sebelum mulai, bisakah Anda memverifikasi alamat email Anda dengan mengklik tautan yang baru saja kami kirimkan?
            Jika Anda tidak menerima email tersebut, kami dengan senang hati akan mengirimkannya lagi.
        </p>
    </div>

    <div class="d-flex flex-column flex-sm-row justify-content-between">
        <!-- Kirim Ulang -->
        <form method="POST" action="{{ route('verification.send') }}" class="flex-fill me-sm-2">
            @csrf
            <button type="submit" class="btn btn-primary w-100 mt-3 mt-sm-0">
                Kirim Ulang Email Verifikasi
            </button>
        </form>

        <!-- Logout -->
        <form method="POST" action="{{ route('logout') }}" class="flex-fill">
            @csrf
            <button type="submit" class="btn btn-danger w-100 mt-3 mt-sm-0">
                Logout
            </button>
        </form>
    </div>
@endsection
