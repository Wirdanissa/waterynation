@extends('layouts.app')

@section('title', 'Watery Nation - Belajar dan Beraksi untuk Menjaga Air')

@section('content')
    <div class="container-fluid bg-light py-5 min-vh-100">
        <div class="row justify-content-center align-items-center">
            <div class="col-md-8 text-center">
                <img src="{{ asset('assets/img/icon.png') }}" alt="Watery Nation Logo" width="100"
                    class="mb-4 rounded-circle shadow-sm">
                <h1 class="fw-bold mb-3 text-primary">Selamat Datang di Watery Nation</h1>
                <p class="lead mb-4 text-secondary">
                    Bergabunglah dalam gerakan edukasi dan kolaborasi untuk menjaga air bersih yang berkelanjutan di
                    Indonesia.
                </p>
                <div class="d-flex justify-content-center gap-3">
                    <a href="" class="btn btn-primary btn-lg shadow-sm">Jelajahi Artikel</a>
                    <a href="" class="btn btn-outline-primary btn-lg">Ikut Program</a>
                </div>
            </div>
        </div>
    </div>
@endsection
