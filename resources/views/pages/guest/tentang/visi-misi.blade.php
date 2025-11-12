@extends('layouts.guest')

@section('title', 'Visi Misi Organisasi - Watery Nation')
@section('menuTentang', 'active')
@section('menuVisiMisi', 'active')

@section('content')
    <div class="container py-5 my-md-5">
        <div class="row align-items-center mb-5">
            <div class="col-md-6 mb-5 mb-md-0" style="padding: 0 50px;">
                <img src="{{ asset('assets/img/gambar_3.jpg') }}" alt="Visi Watery Nation" class="img-fluid rounded shadow">
            </div>

            <div class="col-md-6 px-4">
                <h2 class="fw-bold mb-4"
                    style="position: relative; display: inline-block; padding-bottom: 10px; margin-bottom: 25px;">
                    Visi <span class="text-primary">Watery Nation</span>
                    <span
                        style="position:absolute; left:0; bottom:0; width:70px; height:3px; background-color:#0d6efd; border-radius:2px;"></span>
                </h2>
                <p style="font-size: 1.05rem; color: #333; line-height: 1.8; margin-bottom: 0;">
                    {!! $visiMisi->visi !!}
                </p>
            </div>
        </div>

        <div class="row align-items-center">
            <div class="col-md-6 order-md-2 mb-5 mb-md-0" style="padding: 0 50px;">
                <img src="{{ asset('assets/img/gambar_3.jpg') }}" alt="Misi Watery Nation" class="img-fluid rounded shadow">
            </div>

            <div class="col-md-6 px-4">
                <h2 class="fw-bold mb-4"
                    style="position: relative; display: inline-block; padding-bottom: 10px; margin-bottom: 25px;">
                    Misi <span class="text-primary">Watery Nation</span>
                    <span
                        style="position:absolute; left:0; bottom:0; width:70px; height:3px; background-color:#0d6efd; border-radius:2px;"></span>
                </h2>
                <p style="font-size: 1.05rem; color: #333; line-height: 1.8; margin-bottom: 0;">
                    {!! $visiMisi->misi !!}
                </p>
            </div>
        </div>
    </div>
@endsection
