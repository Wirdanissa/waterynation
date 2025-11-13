@extends('layouts.guest')

@section('title', 'Tim Organisasi - Watery Nation')
@section('menuTentang', 'active')
@section('menuTim', 'active')

@section('content')
    <div class="container py-5 px-4">
        <div class="row mb-5">
            <div class=" mb-4">
                <h3 class="fw-bold mb-4"
                    style="position: relative; display: inline-block; padding-bottom: 12px; margin-bottom: 40px;">
                    Founder <span class="text-primary">Watery Nation</span>
                    <span
                        style="position:absolute; left:0; bottom:0; width:100px; height:3px; background-color:#0d6efd; border-radius:2px;"></span>
                </h3>
            </div>

            <!-- Foto Founder -->
            <div class="col-md-4 text-center mb-4 mb-md-0">
                <img src="{{ asset('assets/img/founder.jpg') }}" alt="Founder Watery Nation" class="img-fluid mb-2"
                    style="width:300px; height:300px; object-fit:cover;">
            </div>

            <!-- Info Founder -->
            <div class="col-md-8 align-items-start">
                <h5 class="fw-bold mb-3">Arfiana Maulina Fatimah</h5>
                <p style="font-size: 16px; color: #333; line-height: 1.8;">
                    Highly experienced in Marketing, driving million viewers, and leads to multi-channel and partnerships
                    in Indonesia, Singapore, USA, Philippines, and the UK. A content creator for career & education who
                    works
                    in the start-up industries and freshman in Bina Nusantara University majoring Marketing Communications.
                    She already appears on several media especially known for <strong>'Magang di 6 Tempat
                        Bersamaan'</strong>.
                    Arfiana started Watery Nation (former Thirst project Indonesia) <strong>since 16 years old</strong>
                    to raise awareness about environment and empower women participation in leadership for the SDGs 6.
                </p>
            </div>
        </div>


        <!-- Team Members Section -->
        <div class="text-center mb-4">
            <h3 class="fw-bold mb-4"
                style="position: relative; display: inline-block; padding-bottom: 12px; margin-bottom: 40px;">
                Tim <span class="text-primary">Kami</span>
                <span
                    style="position:absolute; left:0; bottom:0; width:100px; height:3px; background-color:#0d6efd; border-radius:2px;"></span>
            </h3>
        </div>

        <div class="row justify-content-center align-items-center">
            <!-- Team Member 1 -->
            <div class="col-12 col-md-3 text-center mb-4">
                <img src="{{ asset('assets/img/gambar_2.jpg') }}" alt="John Smith" class="rounded-circle mb-2"
                    style="width:250px; height:250px; object-fit:cover;">
                <h5 class="mb-1">John Smith</h5>
                <p class="text-muted mb-0">Chief Technology Officer</p>
            </div>

            <!-- Team Member 2 -->
            <div class="col-12 col-md-3 text-center mb-4">
                <img src="{{ asset('assets/img/gambar_3.jpg') }}" alt="Emily Johnson" class="rounded-circle mb-2"
                    style="width:250px; height:250px; object-fit:cover;">
                <h5 class="mb-1">Emily Johnson</h5>
                <p class="text-muted mb-0">Head of Operations</p>
            </div>

            <!-- Team Member 3 -->
            <div class="col-12 col-md-3 text-center mb-4">
                <img src="{{ asset('assets/img/gambar_1.jpg') }}" alt="Michael Brown" class="rounded-circle mb-2"
                    style="width:250px; height:250px; object-fit:cover;">
                <h5 class="mb-1">Michael Brown</h5>
                <p class="text-muted mb-0">Marketing Lead</p>
            </div>

            <!-- Team Member 4 -->
            <div class="col-12 col-md-3 text-center mb-4">
                <img src="{{ asset('assets/img/gambar_2.jpg') }}" alt="Sarah Lee" class="rounded-circle mb-2"
                    style="width:250px; height:250px; object-fit:cover;">
                <h5 class="mb-1">Sarah Lee</h5>
                <p class="text-muted mb-0">Product Designer</p>
            </div>

            <!-- Team Member 5 -->
            <div class="col-12 col-md-3 text-center mb-4">
                <img src="{{ asset('assets/img/gambar_3.jpg') }}" alt="David Wilson" class="rounded-circle mb-2"
                    style="width:250px; height:250px; object-fit:cover;">
                <h5 class="mb-1">David Wilson</h5>
                <p class="text-muted mb-0">Software Engineer</p>
            </div>
        </div>
    </div>
@endsection
