@extends('layouts.guest')

@section('title', 'Visi Misi Organisasi - Watery Nation')
@section('menuTentang', 'active')
@section('menuVisiMisi', 'active')

@section('content')
<div class="container py-5 my-md-5">

    {{-- Bagian Visi --}}
    <div class="row align-items-center mb-5">
        <div class="col-md-6 mb-5 mb-md-0" style="padding: 0 50px;">
            <div class="position-relative">
                <img src="{{ asset('assets/img/gambar_3.jpg') }}"
                     alt="Visi Watery Nation"
                     class="img-fluid rounded shadow">
                <span class="badge bg-primary position-absolute top-0 start-0 m-3 px-3 py-2">
                    Visi
                </span>
            </div>
        </div>

        <div class="col-md-6 px-4">
            <h3 class="fw-bold mb-4"
                style="position: relative; display: inline-block; padding-bottom: 10px; margin-bottom: 25px;">
                Visi <span class="text-primary">Watery Nation</span>
                <span
                    style="position:absolute; left:0; bottom:0; width:70px; height:3px;
                           background-color:#0d6efd; border-radius:2px;"></span>
            </h3>

            @php
                $visiDefault = 'To ensure every community has access to clean and safe water
                                while fostering a culture of sustainability and self-reliance.';
            @endphp

            <p style="font-size: 1.05rem; color: #333; line-height: 1.9; margin-bottom: 0;">
                {!! $visiMisi->visi ?? nl2br(e($visiDefault)) !!}
            </p>
        </div>
    </div>

    {{-- Divider dekoratif --}}
    <div class="row mb-5">
        <div class="col-12 d-flex justify-content-center">
            <span style="width: 120px; height: 4px; background: linear-gradient(90deg,#0d6efd,#20c997);
                         border-radius: 10px;"></span>
        </div>
    </div>

    {{-- Bagian Misi --}}
    <div class="row align-items-center">
        <div class="col-md-6 order-md-2 mb-5 mb-md-0" style="padding: 0 50px;">
            <div class="position-relative">
                <img src="{{ asset('assets/img/gambar_3.jpg') }}"
                     alt="Misi Watery Nation"
                     class="img-fluid rounded shadow">
                <span class="badge bg-success position-absolute top-0 start-0 m-3 px-3 py-2">
                    Misi
                </span>
            </div>
        </div>

        <div class="col-md-6 px-4">
            <h3 class="fw-bold mb-4"
                style="position: relative; display: inline-block; padding-bottom: 10px; margin-bottom: 25px;">
                Misi <span class="text-primary">Watery Nation</span>
                <span
                    style="position:absolute; left:0; bottom:0; width:70px; height:3px;
                           background-color:#0d6efd; border-radius:2px;"></span>
            </h3>

            @php
                $misiDefault = [
                    'Educating communities to build awareness and knowledge about water conservation.',
                    'Empowering individuals to implement sustainable and independent solutions for water challenges.',
                    'Supporting communities in creating long-term strategies for sustainable water resource management.',
                ];
            @endphp

            @if(!empty($visiMisi) && !empty($visiMisi->misi))
                {{-- Jika misi disimpan sebagai HTML di DB --}}
                <div style="font-size: 1.05rem; color: #333; line-height: 1.9;">
                    {!! $visiMisi->misi !!}
                </div>
            @else
                {{-- Fallback misi dalam bentuk list yang rapi --}}
                <ul class="list-unstyled mb-0" style="font-size: 1.05rem; color: #333; line-height: 1.9;">
                    @foreach ($misiDefault as $point)
                        <li class="d-flex mb-2">
                            <span class="me-2 text-success">
                                <i class="bi bi-check-circle-fill"></i>
                            </span>
                            <span>{{ $point }}</span>
                        </li>
                    @endforeach
                </ul>
            @endif
        </div>
    </div>
</div>
@endsection
