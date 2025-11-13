@extends('layouts.guest')

@section('title', 'Profil Organisasi - Watery Nation')
@section('menuTentang', 'active')
@section('menuProfile', 'active')

@section('content')
    <div class="container py-5">
        <div class="row align-items-start mb-5">
            <div class="col-md-12" style="padding: 0 40px;">
                <h2 class="fw-bold mb-4"
                    style="position: relative; display: inline-block; padding-bottom: 12px; margin-bottom: 40px;">
                    Tentang <span class="text-primary">Watery Nation</span>
                    <span
                        style="position:absolute; left:0; bottom:0; width:85px; height:3px; background-color:#0d6efd; border-radius:2px;"></span>
                </h2>

                <div class="fs-6" style="color:#333; line-height:1.9;">
                    {!! $tentang->about ?? 'Informasi tentang organisasi belum tersedia.' !!}
                </div>
            </div>
        </div>

        <div class="text-center mb-5" style="margin-bottom: 120px;">
            <h2 class="fw-bold mb-4"
                style="position: relative; display: inline-block; padding-bottom: 12px; margin-bottom: 40px;">
                Core <span class="text-primary">Values</span>
                <span
                    style="position:absolute; left:0; bottom:0; width:95px; height:3px; background-color:#0d6efd; border-radius:2px;"></span>
            </h2>

            <div class="fs-6" style="max-width:900px; margin:auto; text-align:justify; color:#444; line-height:1.9;">
                {!! $tentang->core_values ?? 'Belum ada data Core Values.' !!}
            </div>
        </div>

        <div class="text-center" style="margin-bottom: 80px;">
            <h2 class="fw-bold mb-4"
                style="position: relative; display: inline-block; padding-bottom: 12px; margin-bottom: 40px;">
                Focus <span class="text-primary">Areas</span>
                <span
                    style="position:absolute; left:0; bottom:0; width:95px; height:3px; background-color:#0d6efd; border-radius:2px;"></span>
            </h2>

            <div class="fs-6" style="max-width:900px; margin:auto; text-align:justify; color:#444; line-height:1.9;">
                {!! $tentang->focus_areas ?? 'Belum ada data Focus Areas.' !!}
            </div>
        </div>

    </div>
@endsection
