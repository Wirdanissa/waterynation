@extends('layouts.guest')

@section('title', 'Volunteer - Watery Nation')
@section('menuVolunteer', 'active')
@section('menuApaKataMereka', 'active')

@section('content')
<style>
    /* Efek Hover untuk Kartu Testimoni */
    .testimonial-card {
        transition: all 0.3s ease;
        border: 1px solid #f0f0f0;
    }
    .testimonial-card:hover {
        transform: translateY(-10px);
        box-shadow: 0 15px 30px rgba(0,0,0,0.1) !important;
        border-color: #0d6efd;
    }
    .img-profile {
        width: 70px;
        height: 70px;
        object-fit: cover;
        border: 3px solid #eef2f7;
    }
    .quote-icon {
        font-size: 2rem;
        color: #0d6efd;
        opacity: 0.2;
        position: absolute;
        right: 20px;
        top: 20px;
    }
</style>

<div class="container py-5">
    <div class="row align-items-start mb-5">
        <div class="col-md-12" style="padding: 0 40px;">
            <h3 class="fw-bold mb-4 position-relative d-inline-block"
                style="padding-bottom:12px; margin-bottom:40px;">
                Testimoni <span class="text-primary">Volunteer</span>
                <span style="position:absolute; left:0; bottom:0; width:85px; height:3px;
                             background-color:#0d6efd; border-radius:2px;"></span>
            </h3>

            <div class="row g-4">
                <div class="col-md-6">
                    <div class="card h-100 shadow-sm p-4 testimonial-card" style="border-radius: 20px; position: relative;">
                        <i class="fas fa-quote-right quote-icon"></i>
                        <div class="card-body">
                            <div class="d-flex align-items-center mb-4">
                                <img src="https://images.unsplash.com/photo-1494790108377-be9c29b29330?q=80&w=150&h=150&auto=format&fit=crop" 
                                     alt="Haifa Shofa Triani" 
                                     class="rounded-circle me-3 img-profile">
                                <div>
                                    <h5 class="mb-0 fw-bold">Haifa Shofa Triani</h5>
                                    <small class="text-primary fw-bold">Copywriter</small>
                                </div>
                            </div>
                            <p class="text-muted lh-lg" style="font-size: 0.95rem; font-style: italic;">
                                "Pengalaman yang paling aku ingat selama menjadi Waterior adalah ketika melakukan riset sebelum nulis konten. Waktu baca-baca mengenai isu air, aku jadi tau banyak hal bahwa yang paling penting yang selama ini aku lewatkan. Aku jadi paham bahwa ternyata nggak semua orang mendapatkan air bersih yang selama ini aku dapatkan secara 'cuma-cuma'."
                            </p>
                        </div>
                    </div>
                </div>

                <div class="col-md-6">
                    <div class="card h-100 shadow-sm p-4 testimonial-card" style="border-radius: 20px; position: relative;">
                        <i class="fas fa-quote-right quote-icon"></i>
                        <div class="card-body">
                            <div class="d-flex align-items-center mb-4">
                                <img src="https://images.unsplash.com/photo-1438761681033-6461ffad8d80?q=80&w=150&h=150&auto=format&fit=crop" 
                                     alt="Aamira Kalila Elza" 
                                     class="rounded-circle me-3 img-profile">
                                <div>
                                    <h5 class="mb-0 fw-bold">Aamira Kalila Elza</h5>
                                    <small class="text-primary fw-bold">R&D Isu WASH</small>
                                </div>
                            </div>
                            <p class="text-muted lh-lg" style="font-size: 0.95rem; font-style: italic;">
                                "Menjadi Waterior bisa menjadi batu pijakan untuk mempersiapkan diri menghadapi dunia kerja yang lebih profesional. Ada banyak sekali pengalaman berharga yang bermanfaat untuk perjalanan selanjutnya."
                            </p>
                        </div>
                    </div>
                </div>
            </div>
            </div>
    </div>
</div>
@endsection