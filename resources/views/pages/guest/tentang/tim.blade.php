@extends('layouts.guest')

@section('title', 'Tim Organisasi - Watery Nation')
@section('menuTentang', 'active')
@section('menuTim', 'active')

@section('content')
<style>
    .team-section {
        padding: 60px 0;
    }
    .img-profile-circle {
        border-radius: 50%;
        object-fit: cover;
        box-shadow: 0 10px 25px rgba(0,0,0,0.1);
        margin-bottom: 20px;
        background-color: #f0f0f0;
    }
    .founder-img { width: 320px; height: 320px; }
    .expert-img { width: 180px; height: 180px; }
    .genz-img { width: 160px; height: 160px; }

    .label-role {
        color: #14b8a6; 
        font-weight: 700;
        text-transform: capitalize;
        margin-bottom: 5px;
        display: block;
    }
    .name-text {
        font-weight: 800;
        font-size: 2rem;
        color: #000;
        line-height: 1.2;
    }
    .sub-name-text {
        font-weight: 800;
        font-size: 1.5rem;
        margin-top: 10px;
        color: #000;
    }
    .description-text {
        color: #444;
        line-height: 1.7;
        font-size: 1rem;
        text-align: justify;
    }
    .section-divider {
        font-style: italic;
        color: #14b8a6;
        font-weight: 700;
        font-size: 1.25rem;
        margin-bottom: 40px;
    }
    .title-large {
        font-weight: 800;
        font-size: 2.8rem;
        color: #004d66;
    }
    .role-text {
        font-weight: 700;
        color: #555;
    }
</style>

<div class="container py-5">
    
    <div class="row align-items-center mb-5 team-section">
        <div class="col-md-5 text-center">
            <img src="{{ asset('storage/volunteer/Arfiana Maulina.png') }}" class="img-profile-circle founder-img" alt="Arfiana Maulina">
        </div>
        <div class="col-md-7 px-md-5">
            <span class="label-role">Founder</span>
            <h1 class="name-text mb-3">Arfiana Maulina Fatimah</h1>
            <p class="description-text">
                Highly experienced in Marketing, driving million viewers, and leads to multi-channel and partnerships in Indonesia, Singapore, USA, Philippines, and the UK. A content creator for career & education who works in the start-up industries and freshman in Bina Nusantara University majoring Marketing Communications. 
                She already appears on several media especially known for <strong>'Magang di 6 Tempat Bersamaan'</strong>. Arfiana started Watery Nation (former Thirst project Indonesia) <strong>since 16 years old</strong> to raise awareness about environment and empower women participation in leadership for the SDGs 6.
            </p>
        </div>
    </div>

    <hr class="my-5" style="opacity: 0.1;">

    <div class="text-center mb-5">
        <h2 class="title-large mb-1">Meet our Team</h2>
        <p class="section-divider">Guided by our beloved experts</p>
        
        <div class="row g-5 justify-content-center mt-3">
            <div class="col-md-4">
                <img src="{{ asset('storage/volunteer/Deni.png') }}" class="img-profile-circle expert-img" alt="Deni">
                <h3 class="sub-name-text mb-1">Deni</h3>
                <p class="role-text">The Head of Supervisor</p>
            </div>
            <div class="col-md-4">
                <img src="{{ asset('storage/volunteer/Dian.png') }}" class="img-profile-circle expert-img" alt="Dian">
                <h3 class="sub-name-text mb-1">Dian</h3>
                <p class="role-text">Supervisor</p>
            </div>
        </div>
    </div>

    <div class="text-center mt-5 pt-5 pb-5" style="background-color: #f8fbfb; border-radius: 40px;">
        <p class="section-divider">Pureblood as Gen Zs</p>
        
        <div class="row g-4 justify-content-center px-3">
            <div class="col-6 col-md-4 col-lg-3">
                <img src="{{ asset('storage/volunteer/Agnes.png') }}" class="img-profile-circle genz-img" alt="Agnes">
                <h4 class="sub-name-text mb-1">Agnes</h4>
                <p class="role-text small">Organization Lead</p>
            </div>
            <div class="col-6 col-md-4 col-lg-3">
                <img src="{{ asset('storage/volunteer/Alif.png') }}" class="img-profile-circle genz-img" alt="Alif">
                <h4 class="sub-name-text mb-1">Alif</h4>
                <p class="role-text small">Secretary</p>
            </div>
            <div class="col-6 col-md-4 col-lg-3">
                <img src="{{ asset('storage/volunteer/Aned.png') }}" class="img-profile-circle genz-img" alt="Aned">
                <h4 class="sub-name-text mb-1">Aned</h4>
                <p class="role-text small">Treasurer</p>
            </div>
        </div>
    </div>

</div>
@endsection
