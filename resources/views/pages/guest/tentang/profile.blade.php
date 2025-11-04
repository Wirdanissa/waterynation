@extends('layouts.guest')

@section('title', 'Watery Nation - Belajar dan Beraksi untuk Menjaga Air')
@section('menuTentang', 'active')
@section('menuProfile', 'active')

@section('content')
    <div class="container-fluid bg-light vh-100 d-flex align-items-center"
        style="background-image: url('{{ asset('assets/img/gambar_3.jpg') }}'); background-size: cover; background-position: center;">
        <div class="container">
            <div class="row">
                <div class="col-md-6 text-start ms-md-5">
                    <h1 class="fw-bold mb-4 text-light display-4">
                        Selamat Datang di Watery Nation
                    </h1>
                    <p class="lead mb-4 text-light fw-medium fst-italic fs-6 fw-light">
                        " Bergabunglah dalam gerakan edukasi dan kolaborasi untuk menjaga air bersih yang berkelanjutan di
                        Indonesia. "
                    </p>
                    <div class="d-flex justify-content-start gap-3 flex-wrap">
                        <a href="#" class="btn btn-primary btn-md shadow-sm px-4">Donasi</a>
                        <a href="#" class="btn btn-light btn-md shadow-sm px-4">Ikut Program</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
