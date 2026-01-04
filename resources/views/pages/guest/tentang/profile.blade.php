@extends('layouts.guest')

@section('title', 'Profil Organisasi - Watery Nation')
@section('menuTentang', 'active')
@section('menuProfile', 'active')

@section('content')
<link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@300;400;600;800&display=swap" rel="stylesheet">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">

<style>
    body { font-family: 'Plus Jakarta Sans', sans-serif; color: #2d3436; background-color: #ffffff; }
    :root { --wn-teal: #008080; --wn-dark: #0a2647; }
    
    .section-spacing { padding: 80px 0; }
    .text-teal { color: var(--wn-teal); }
    
    /* Hero Section */
    .hero-container {
        background: linear-gradient(180deg, #f0f9f9 0%, #ffffff 100%);
        padding: 100px 0 60px 0;
    }
    .hero-badge {
        background: rgba(0, 128, 128, 0.1);
        color: var(--wn-teal);
        padding: 10px 24px;
        border-radius: 50px;
        font-weight: 700;
        font-size: 0.85rem;
        display: inline-block;
        margin-bottom: 25px;
    }

    /* Legality Card */
    .legal-card {
        background: #ffffff;
        border-radius: 40px;
        padding: 50px;
        box-shadow: 0 20px 60px rgba(0,0,0,0.05);
        border: 1px solid rgba(0,0,0,0.02);
    }

    /* Impact Cards */
    .impact-box {
        border-radius: 30px;
        padding: 40px;
        background: #fff;
        border: 1px solid #eee;
        transition: 0.4s;
        height: 100%;
    }
    .impact-box:hover {
        transform: translateY(-12px);
        box-shadow: 0 25px 50px rgba(0,0,0,0.1);
        border-color: var(--wn-teal);
    }
    .icon-circle {
        width: 60px; height: 60px;
        background: var(--wn-teal);
        color: white;
        border-radius: 18px;
        display: flex; align-items: center; justify-content: center;
        font-size: 1.5rem;
        margin-bottom: 25px;
    }

    /* Sponsor Section */
    .partner-section {
        padding: 60px 0;
        background: #fafafa;
        border-top: 1px solid #f0f0f0;
        border-bottom: 1px solid #f0f0f0;
    }
    .sponsor-banner {
        width: 100%;
        max-width: 1000px;
        height: auto;
        mix-blend-mode: multiply; 
        filter: grayscale(10%);
        transition: 0.5s;
    }

    /* Footer CTA & Buttons */
    .cta-banner {
        background: var(--wn-dark);
        border-radius: 40px;
        padding: 80px 40px;
        color: white;
        text-align: center;
        margin-bottom: 80px;
    }
    .btn-wn {
        background: var(--wn-teal);
        color: white;
        padding: 16px 35px;
        border-radius: 50px;
        font-weight: 700;
        text-decoration: none;
        display: inline-block;
        transition: 0.3s;
        border: 2px solid var(--wn-teal);
    }
    .btn-wn:hover { background: #006666; border-color: #006666; color: white; transform: translateY(-3px); }
    
    .btn-outline-wn {
        background: transparent;
        color: white;
        padding: 16px 35px;
        border-radius: 50px;
        font-weight: 700;
        text-decoration: none;
        display: inline-block;
        transition: 0.3s;
        border: 2px solid rgba(255,255,255,0.3);
    }
    .btn-outline-wn:hover { background: white; color: var(--wn-dark); border-color: white; transform: translateY(-3px); }
</style>

<section class="hero-container">
    <div class="container">
        <div class="row align-items-center">
            <div class="col-lg-6">
                <span class="hero-badge text-uppercase">Pioneering Water Sustainability</span>
                <h1 class="display-3 fw-bold mb-4" style="letter-spacing: -2px;">Water, Wealth, and <span class="text-teal">Global Impact.</span></h1>
                <p class="lead text-muted mb-5">Dimulai dari mimpi di tahun 2020, Watery Nation kini bertransformasi menjadi katalisator perubahan global bagi masa depan air yang berkelanjutan.</p>
                <div class="d-flex gap-4">
                    <div><h3 class="fw-bold mb-0">2020</h3><small class="text-muted">FOUNDED</small></div>
                    <div class="vr"></div>
                    <div><h3 class="fw-bold mb-0">50+</h3><small class="text-muted">ADVOCATES</small></div>
                </div>
            </div>
            <div class="col-lg-6 mt-5 mt-lg-0">
                <img src="{{ asset('storage/organisasi/activity.png') }}" class="img-fluid rounded-5 shadow-lg" alt="Activity">
            </div>
        </div>
    </div>
</section>

<section class="section-spacing">
    <div class="container">
        <div class="legal-card">
            <div class="row align-items-center">
                <div class="col-lg-7">
                    <h2 class="fw-bold mb-4">Corporate Integrity & <br><span class="text-teal">Official Legality</span></h2>
                    <p class="text-muted fs-5 mb-4">Kami menjaga kepercayaan investor melalui transparansi penuh dan legalitas hukum yang resmi diakui di Indonesia.</p>
                    <div class="d-flex align-items-center">
                        <i class="fas fa-check-circle text-teal me-2"></i>
                        <span class="fw-bold">Entity Berbadan Hukum Resmi</span>
                    </div>
                </div>
                <div class="col-lg-5 text-center mt-4 mt-lg-0">
                    <img src="{{ asset('storage/organisasi/legal.png') }}" class="img-fluid rounded-4 shadow-sm" style="max-height: 300px;">
                </div>
            </div>
        </div>
    </div>
</section>

<section class="section-spacing bg-light">
    <div class="container text-center mb-5">
        <h2 class="fw-bold">Our Core <span class="text-teal">Movements</span></h2>
    </div>
    <div class="container">
        <div class="row g-4">
            <div class="col-md-4">
                <div class="impact-box">
                    <div class="icon-circle"><i class="fas fa-fist-raised"></i></div>
                    <h4 class="fw-bold">Waterior</h4>
                    <p class="text-muted small">Program volunteering 2 bulan untuk melatih advokat air masa depan melalui riset dan edukasi.</p>
                    <img src="{{ asset('storage/organisasi/buletin.png') }}" class="img-fluid rounded-3 mt-3 shadow-sm">
                </div>
            </div>
            <div class="col-md-4">
                <div class="impact-box">
                    <div class="icon-circle"><i class="fas fa-leaf"></i></div>
                    <h4 class="fw-bold">BackToLerak</h4>
                    <p class="text-muted small">Kampanye deterjen alami berbasis kearifan lokal untuk mengurangi limbah kimia air.</p>
                    <img src="{{ asset('storage/organisasi/lerak2.png') }}" class="img-fluid rounded-3 mt-3 shadow-sm">
                </div>
            </div>
            <div class="col-md-4">
                <div class="impact-box">
                    <div class="icon-circle"><i class="fas fa-handshake"></i></div>
                    <h4 class="fw-bold">CSR Global</h4>
                    <p class="text-muted small">Kolaborasi strategis dengan mitra korporasi internasional untuk dampak skala besar.</p>
                    <img src="{{ asset('storage/organisasi/csr.png') }}" class="img-fluid rounded-3 mt-3 shadow-sm">
                </div>
            </div>
        </div>
    </div>
</section>

<section class="partner-section">
    <div class="container text-center">
        <p class="small fw-bold text-muted text-uppercase mb-4" style="letter-spacing: 3px;">Our lovely journey has been accompanied by</p>
        <img src="{{ asset('storage/organisasi/sponsor.png') }}" class="sponsor-banner" alt="Watery Nation Partners">
    </div>
</section>

<section class="container mt-5">
    <div class="cta-banner shadow-lg">
        <h2 class="display-5 fw-bold mb-4">Ready to Amplify Our <br>Impact Together?</h2>
        <p class="fs-5 mb-5 opacity-75">"Sounds great, right, to accompany our watery steps?"</p>
        
        <div class="d-flex flex-wrap justify-content-center gap-3">
            <a href="mailto:hi@waterynation.org" class="btn-wn">
                <i class="fas fa-paper-plane me-2"></i> Connect via hi@waterynation.org
            </a>
            <a href="https://www.canva.com/design/DAGy3dGFMkQ/ktjurvAgQgbKgCeyIQd6DQ/edit" target="_blank" class="btn-outline-wn">
                <i class="fas fa-briefcase me-2"></i> Lihat Portofolio Lengkap
            </a>
        </div>

        <div class="mt-5">
            <h5 class="fw-bold mb-0">Happy WateryNation, Happy Wateriors!</h5>
            <p class="small opacity-50 mt-2 text-uppercase" style="letter-spacing: 2px;">Professionalism • Integrity • Sustainability</p>
        </div>
    </div>
</section>

@endsection