<nav class="navbar navbar-expand-lg navbar-dark bg-primary py-2 shadow-sm">
    <div class="container">
        <a class="navbar-brand d-flex align-items-center" href="{{ route('home') }}">
            <img src="{{ asset('assets/img/icon.png') }}" alt="Logo" width="45" height="45"
                class="d-inline-block align-text-top rounded-circle me-2">
            <span class="fw-bold">Watery Nation</span>
        </a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNavDropdown"
            aria-controls="navbarNavDropdown" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse justify-content-center" id="navbarNavDropdown">
            <ul class="navbar-nav mx-auto text-start text-lg-center mt-lg-0 py-lg-0 mt-2 py-2">
                <li class="nav-item">
                    <a class="nav-link active" aria-current="page" href="#">Beranda</a>
                </li>
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="#" id="navbarDropdownMenuLink" role="button"
                        data-bs-toggle="dropdown" aria-expanded="false">
                        Tentang Kami
                    </a>
                    <ul class="dropdown-menu" aria-labelledby="navbarDropdownMenuLink">
                        <li><a class="dropdown-item" href="#">Profile Watery Nation</a></li>
                        <li><a class="dropdown-item" href="#">Visi Misi dan Program</a></li>
                        <li><a class="dropdown-item" href="#">Tim dan Mitra</a></li>
                    </ul>
                </li>
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="#" id="navbarDropdownMenuLink" role="button"
                        data-bs-toggle="dropdown" aria-expanded="false">
                        Program
                    </a>
                    <ul class="dropdown-menu" aria-labelledby="navbarDropdownMenuLink">
                        <li><a class="dropdown-item" href="#">Daftar Program</a></li>
                        <li><a class="dropdown-item" href="#">Volunteer</a></li>
                    </ul>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="#">Publikasi</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="#">Donasi</a>
                </li>
                @switch(Auth::check() ? Auth::user()->role : 'guest')
                    @case('Admin')
                        <li class="nav-item d-lg-none">
                            <a href="" class="btn btn-light w-100 mt-2">Dashboard</a>
                        </li>
                    @break

                    @case('User')
                        <li class="nav-item d-lg-none">
                            <a href="{{ route('login') }}" class="btn btn-light w-100 mt-2">Jhon Doe</a>
                        </li>
                    @break

                    @default
                        <li class="nav-item dropdown d-lg-none">
                            {{-- <a href="{{ route('login') }}" class="btn btn-light w-100 mt-2">Masuk / Daftar</a> --}}
                            <a class="nav-link dropdown-toggle" href="#" id="navbarDropdownMenuLink" role="button"
                                data-bs-toggle="dropdown" aria-expanded="false">
                                Masuk / Daftar
                            </a>
                            <ul class="dropdown-menu" aria-labelledby="navbarDropdownMenuLink">
                                <li><a class="dropdown-item" href="{{ route('login') }}">Masuk</a></li>
                                <li><a class="dropdown-item" href="#">Daftar</a></li>
                            </ul>
                        </li>
                @endswitch
            </ul>
        </div>
        @switch(Auth::check() ? Auth::user()->role : 'guest')
            @case('Admin')
                <div class="d-none d-lg-flex ">
                    <a href="" class="btn btn-light">Dashboard</a>
                </div>
            @break

            @case('User')
                <div class="d-none d-lg-flex ">
                    <a href="{{ route('login') }}" class="btn btn-light">Jhon Doe</a>
                </div>
            @break

            @default
                <div class="d-none d-lg-flex ">
                    <a href="{{ route('login') }}" class="btn btn-light">Masuk / Daftar</a>
                </div>
        @endswitch

    </div>
</nav>
