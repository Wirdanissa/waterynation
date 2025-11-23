@extends('layouts.guest')

@section('title', 'Watery Nation - Belajar dan Beraksi untuk Menjaga Air')
@section('menuBeranda', 'active')

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
                        <a href="{{ route('donasi') }}" class="btn btn-primary btn-md shadow-sm px-4">Donasi</a>
                        <a href="#programs" class="btn btn-light btn-md shadow-sm px-4">Ikut Program</a>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- STAT COUNTER ala GIKo -->
    <div class="container">
        <div class="bg-white shadow rounded-pill py-4 px-5 mx-auto d-flex justify-content-center"
            style="margin-top: -40px; position: relative; z-index: 20; max-width: 1000px;">

            <div class="row w-100 text-center">

                <!-- Relawan -->
                <div class="col-md-4 d-flex flex-column align-items-center">
                    <div class="d-flex align-items-center gap-3">
                        <i class="bi bi-people fs-1 text-primary"></i>
                        <div class="text-start">
                            <h4 class="fw-bold m-0">300.672</h4>
                            <small class="text-muted">Relawan</small>
                        </div>
                    </div>
                </div>

                <!-- Donasi Terkumpul -->
                <div class="col-md-4 d-flex flex-column align-items-center my-3 my-md-0">
                    <div class="d-flex align-items-center gap-3">
                        <i class="bi bi-heart-fill fs-1 text-primary"></i>
                        <div class="text-start">
                            <h4 class="fw-bold m-0">Rp 1.000.000+</h4>
                            <small class="text-muted">Donasi Terkumpul</small>
                        </div>
                    </div>
                </div>

                <!-- Aktivitas -->
                <div class="col-md-4 d-flex flex-column align-items-center">
                    <div class="d-flex align-items-center gap-3">
                        <i class="bi bi-activity fs-1 text-primary"></i>
                        <div class="text-start">
                            <h4 class="fw-bold m-0">12.691</h4>
                            <small class="text-muted">Aktivitas</small>
                        </div>
                    </div>
                </div>

            </div>

        </div>
    </div>

    <!-- ABOUT US -->
    <div class="py-5">
        <div class="container">
            <h3 class="fw-bold mb-2 text-center" style="padding-bottom: 12px; margin-bottom: 40px;">
                Tentang <span class="text-primary">Watery Nation</span>
            </h3>
            <p class="text-center mx-auto lh-base" style="max-width: 900px;">
                WateryNation adalah organisasi yang menggerakkan generasi muda untuk peduli dan berkontribusi dalam
                pengelolaan air yang berkelanjutan. Berdiri sejak 2020, komunitas ini berkembang melalui edukasi,
                kolaborasi, dan program relawan seperti Waterior serta kampanye #BacktoLerak. Hingga kini, lebih dari 20.000
                peserta dan 1.200 relawan telah terlibat dalam berbagai kegiatan dan aksi lingkungan.
            </p>
        </div>
    </div>

    <!-- PROGRAM / EVENT -->
    <div class="bg-primary py-5" id="programs">
        <div class="container">
            <h3 class="fw-bold mb-4 text-center text-light" style="padding-bottom: 12px; margin-bottom: 40px;">
                Program dan Kegiatan
            </h3>

            <div class="row g-4">
                <!-- Offline Action -->
                <div class="col-md-4">
                    <div class="card h-100 shadow-sm">
                        {{-- <img src="https://via.placeholder.com/400x250" class="card-img-top" alt="Offline Action"> --}}
                        <div class="card-body">
                            <h5 class="card-title text-dark fw-bold">Offline Action</h5>
                            <p class="card-text">Kegiatan langsung di lapangan yang melibatkan aksi sosial, edukasi, atau
                                kolaborasi komunitas.</p>
                            <a href="{{ route('programs.offline-action') }}" class="btn btn-primary btn-sm">Selengkapnya</a>
                        </div>
                    </div>
                </div>

                <!-- Online Webinar -->
                <div class="col-md-4">
                    <div class="card h-100 shadow-sm">
                        {{-- <img src="https://via.placeholder.com/400x250" class="card-img-top" alt="Online Webinar"> --}}
                        <div class="card-body">
                            <h5 class="card-title text-dark fw-bold">Online Webinar</h5>
                            <p class="card-text">Sesi pembelajaran daring yang membahas berbagai topik pengembangan diri dan
                                lingkungan sosial.</p>
                            <a href="{{ route('programs.online-webinar') }}" class="btn btn-primary btn-sm">Selengkapnya</a>
                        </div>
                    </div>
                </div>

                <!-- Modul Development For Kids -->
                <div class="col-md-4">
                    <div class="card h-100 shadow-sm">
                        {{-- <img src="https://via.placeholder.com/400x250" class="card-img-top"
                            alt="Modul Development For Kids"> --}}
                        <div class="card-body">
                            <h5 class="card-title text-dark fw-bold">Modul Development For Kids</h5>
                            <p class="card-text">Penyusunan materi edukatif ramah anak untuk mendukung pembelajaran kreatif
                                dan interaktif.</p>
                            <a href="{{ route('programs.modul-development-for-kids') }}"
                                class="btn btn-primary btn-sm">Selengkapnya</a>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>

    <!-- AJAK JADI VOLUNTEER -->
    <div class="py-5 text-center">
        <div class="container">
            <h3 class="fw-bold mb-2 text-center" style="padding-bottom: 12px; margin-bottom: 40px;">
                Bergabung Menjadi <span class="text-primary">Volunteer</span>
            </h3>
            <p class="mx-auto mb-4" style="max-width: 700px;">
                Jadilah bagian dari tim yang bergerak, berkontribusi, dan membawa perubahan positif.
                Pilih peran sesuai minatmu dan mulai beraksi!
            </p>

            <div class="row justify-content-center g-4">

                @forelse ($volunteers as $volunteer)
                    <div class="col-md-4">
                        <a href="{{ route('volunteer.show', $volunteer->slug) }}" class="text-decoration-none text-dark">
                            <div class="card h-100 shadow-sm border-0">
                                <img src="{{ Storage::url($volunteer->image) }}" class="card-img-top"
                                    style="height: 180px; object-fit: cover;" alt="">
                                <div class="card-body">
                                    <h5 class="card-title fw-semibold">{{ $volunteer->title }}</h5>
                                    <p class="card-text small text-muted">
                                        {{ Str::limit(strip_tags($volunteer->description), 110) }}
                                    </p>
                                </div>
                            </div>
                        </a>
                    </div>
                @empty
                    <p class="text-center">Posisi volunteer belum tersedia.</p>
                @endforelse

                <div class="col-md-4">
                    <div class="card h-100 shadow-sm border-0">
                        <img src="{{ asset('assets/img/gambar_3.jpg') }}" class="card-img-top"
                            style="height: 180px; object-fit: cover;" alt="">
                        <div class="card-body">
                            <h5 class="card-title fw-semibold">Hehehey</h5>
                            <p class="card-text small text-muted">
                                Mendesain visual kampanye, publikasi, dan media sosial organisasi.
                            </p>
                        </div>
                    </div>
                </div>

                <div class="col-md-4">
                    <div class="card h-100 shadow-sm border-0">
                        <img src="{{ asset('assets/img/gambar_1.jpg') }}" class="card-img-top"
                            style="height: 180px; object-fit: cover;" alt="">
                        <div class="card-body">
                            <h5 class="card-title fw-semibold">Event Coordinator</h5>
                            <p class="card-text small text-muted">
                                Mengelola kegiatan, webinar, dan kolaborasi komunitas.
                            </p>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>

    <!-- TIM INTI / CORE TEAM -->
    <div class="bg-primary py-5">
        <div class="container">
            <h3 class="fw-bold mb-4 text-center text-light">Tim Watery Nation</h3>

            <div class="owl-carousel team-carousel">

                <div class="item">
                    <div class="text-center">
                        <img src="{{ asset('assets/img/founder.jpg') }}" class="rounded-circle mb-3"
                            style="width:200px; height:200px; object-fit:cover;">
                        <h6 class="text-white mb-1">Arfiana Maulina</h6>
                        <p class="text-light mb-0 small">Founder</p>
                    </div>
                </div>

                <div class="item">
                    <div class="text-center">
                        <img src="{{ asset('assets/img/gambar_2.jpg') }}" class="rounded-circle mb-3"
                            style="width:200px; height:200px; object-fit:cover;">
                        <h6 class="text-white mb-1">John Smith</h6>
                        <p class="text-light mb-0 small">CTO</p>
                    </div>
                </div>

                <div class="item">
                    <div class="text-center">
                        <img src="{{ asset('assets/img/gambar_3.jpg') }}" class="rounded-circle mb-3"
                            style="width:200px; height:200px; object-fit:cover;">
                        <h6 class="text-white mb-1">Emily Johnson</h6>
                        <p class="text-light mb-0 small">Head of Operations</p>
                    </div>
                </div>

                <div class="item">
                    <div class="text-center">
                        <img src="{{ asset('assets/img/gambar_1.jpg') }}" class="rounded-circle mb-3"
                            style="width:200px; height:200px; object-fit:cover;">
                        <h6 class="text-white mb-1">Michael Brown</h6>
                        <p class="text-light mb-0 small">Marketing Lead</p>
                    </div>
                </div>

                <div class="item">
                    <div class="text-center">
                        <img src="{{ asset('assets/img/gambar_2.jpg') }}" class="rounded-circle mb-3"
                            style="width:200px; height:200px; object-fit:cover;">
                        <h6 class="text-white mb-1">Sarah Lee</h6>
                        <p class="text-light mb-0 small">Product Designer</p>
                    </div>
                </div>

                <div class="item">
                    <div class="text-center">
                        <img src="{{ asset('assets/img/gambar_3.jpg') }}" class="rounded-circle mb-3"
                            style="width:200px; height:200px; object-fit:cover;">
                        <h6 class="text-white mb-1">David Wilson</h6>
                        <p class="text-light mb-0 small">Software Engineer</p>
                    </div>
                </div>

            </div>
        </div>
    </div>

    <!-- GALERI -->
    <div class="py-5">
        <div class="container">
            <h3 class="fw-bold mb-4 text-center" style="padding-bottom: 12px; margin-bottom: 40px;">
                Publikasi <span class="text-primary">Watery Nation</span>
            </h3>

            <div class="row g-3" data-masonry='{"percentPosition": true }'>
                @forelse ($publikasis as $publikasi)
                    <div class="col-sm-6 col-md-4 col-lg-3">

                        <a href="{{ route('publikasi.show', $publikasi->slug) }}" class="text-decoration-none text-dark">

                            <div class="card border shadow-sm rounded overflow-hidden gallery-card">

                                <div class="position-relative gallery-item">
                                    <img src="{{ Storage::url($publikasi->image) }}" class="card-img-top gallery-img"
                                        alt="Galeri">

                                    <div class="gallery-overlay d-flex align-items-end">
                                        <div class="gallery-text text-white p-3">
                                            <h5 class="mb-3 fw-bold">{{ $publikasi->title }}</h5>
                                            <p class="mb-0">
                                                {!! Str::limit($publikasi->description, 110) !!}
                                            </p>
                                        </div>
                                    </div>
                                </div>

                            </div>

                        </a>

                    </div>
                @empty
                    <p class="text-center">Galeri belum tersedia.</p>
                @endforelse
            </div>
        </div>
    </div>

@endsection

@push('custom-script')
    <script>
        $('.team-carousel').owlCarousel({
            loop: true,
            margin: 20,
            autoplay: true,
            autoplayTimeout: 3000,
            autoplayHoverPause: true,
            smartSpeed: 600,
            dots: false,
            responsive: {
                0: {
                    items: 1
                },
                576: {
                    items: 2
                },
                768: {
                    items: 3
                },
                992: {
                    items: 4
                },
                1092: {
                    items: 5
                }
            }
        });
    </script>
@endpush
