@extends('layouts.guest')

@section('title', 'Watery Nation - Belajar dan Beraksi untuk Menjaga Air')
@section('menuBeranda', 'active')

@section('content')
    <div class="container-fluid bg-light py-5">
        <div class="row justify-content-center align-items-center">
            <div class="col-md-8 text-center">
                <img src="{{ asset('assets/img/icon.png') }}" alt="Watery Nation Logo" width="100"
                    class="mb-4 rounded-circle shadow-sm">
                <h1 class="fw-bold mb-3 text-primary fs-2 fs-md-2">
                    Selamat Datang di Watery Nation
                </h1>
                <p class="lead mb-4 text-secondary fs-6 fs-md-5">
                    Bergabunglah dalam gerakan edukasi dan kolaborasi untuk menjaga air bersih yang berkelanjutan di
                    Indonesia.
                </p>
                <div class="d-flex justify-content-center gap-3 flex-wrap">
                    <a href="#" class="btn btn-primary btn-md btn-md-lg shadow-sm">Jelajahi Artikel</a>
                    <a href="#" class="btn btn-outline-primary btn-md btn-md-lg">Ikut Program</a>
                </div>
            </div>
        </div>
    </div>
@endsection
