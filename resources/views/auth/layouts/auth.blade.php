<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link rel="shortcut icon" href="{{ asset('assets/img/icon.png') }}">
    <title>@yield('title')</title>


    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=montserrat" rel="stylesheet" />
    {{-- Script Css --}}
    <link rel="stylesheet" href="{{ asset('assets/css/bootstrap.min.css') }}">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.13.1/font/bootstrap-icons.min.css">
    <link rel="stylesheet" href="{{ asset('assets/css/style.css') }}">
</head>

<body>
    <div class="min-vh-100 d-flex align-items-center justify-content-center bg-light">
        <div
            class="position-relative w-100 d-flex align-items-center justify-content-center min-vh-100 overflow-hidden">
            <div class="position-absolute top-0 start-0 w-100 h-100 bg-gradient"
                style="background: linear-gradient(to right, #f3f4f6, #e9fbee);"></div>

            <div class="position-relative z-1 w-100" style="max-width: 500px;">
                <div class="card shadow-lg border-0 rounded-4 mx-3 my-4">
                    <div class="card-body p-4 p-md-4 bg-white rounded-4">

                        <a href="/" class="d-flex align-items-center mb-4 text-decoration-none">
                            <img src="{{ asset('assets/img/icon.png') }}" alt="Logo"
                                class="rounded-circle me-2 object-fit-cover" style="width: 60px; height: 60px;">
                            <h1 class="h5 fw-bold text-primary text-uppercase mb-0 tracking-wide">Watery Nation</h1>
                        </a>

                        @yield('content')

                    </div>
                </div>
            </div>
        </div>
    </div>


    {{-- Script JS --}}
    <script src="{{ asset('assets/js/bootstrap.bundle.min.js') }}"></script>
    @stack('custom-script')
</body>

</html>
