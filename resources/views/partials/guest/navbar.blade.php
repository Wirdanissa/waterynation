<nav class="navbar navbar-expand-lg navbar-dark bg-primary py-2 shadow-sm sticky-lg-top">
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

        <div class="collapse navbar-collapse justify-content-between" id="navbarNavDropdown">
            <ul class="navbar-nav mx-auto text-start text-lg-center mt-lg-0 py-lg-0 mt-2 py-2">
                <li class="nav-item">
                    <a class="nav-link @yield('menuBeranda')" href="{{ route('home') }}">Beranda</a>
                </li>

                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle @yield('menuTentang')" href="#" id="tentangDropdown"
                        role="button" data-bs-toggle="dropdown">Tentang</a>
                    <ul class="dropdown-menu" aria-labelledby="tentangDropdown">
                        <li><a class="dropdown-item @yield('menuProfile')" href="{{ route('profile') }}">Profil</a></li>
                        <li><a class="dropdown-item @yield('menuVisiMisi')" href="{{ route('visi-misi') }}">Visi & Misi</a></li>
                        <li><a class="dropdown-item @yield('menuTim')" href="{{ route('tim') }}">Tim Watery Nation</a></li>
                    </ul>
                </li>

                <li class="nav-item">
                    <a class="nav-link @yield('menuPublikasi')" href="{{ route('publikasi') }}">Publikasi</a>
                </li>

                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle @yield('menuProgram')" href="#" id="programDropdown"
                        role="button" data-bs-toggle="dropdown">Program</a>
                    <ul class="dropdown-menu" aria-labelledby="programDropdown">
                        <li><a class="dropdown-item" href="#">Offline Action</a></li>
                        <li><a class="dropdown-item" href="#">Online Webinar</a></li>
                        <li><a class="dropdown-item" href="#">Modul Development For Kids</a></li>
                    </ul>
                </li>

                <li class="nav-item">
                    <a class="nav-link @yield('menuDonasi')" href="#">Donasi</a>
                </li>

                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle @yield('menuVolunteer')" href="#" id="volunteerDropdown"
                        role="button" data-bs-toggle="dropdown">Volunteer</a>
                    <ul class="dropdown-menu" aria-labelledby="volunteerDropdown">
                        <li><a class="dropdown-item" href="#">Apa Kata Mereka</a></li>
                        <li><a class="dropdown-item" href="#">Tim Volunteer</a></li>
                        <li><a class="dropdown-item" href="#">Daftar Jadi Volunteer</a></li>
                    </ul>
                </li>
            </ul>

            <div class="d-flex flex-column flex-lg-row align-items-lg-center gap-2 mt-3 mt-lg-0">
                @switch(Auth::check() ? Auth::user()->role : 'guest')
                    @case('admin')
                        <div class="dropdown">
                            <a class="btn btn-light dropdown-toggle w-100 w-lg-auto" href="#" id="adminMenu"
                                data-bs-toggle="dropdown" aria-expanded="false">
                                {{ Auth::user()->name }}
                            </a>
                            <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="adminMenu">
                                <li><a class="dropdown-item" href="{{ route('admin.dashboard') }}">Dashboard</a></li>
                                <li>
                                    <hr class="dropdown-divider">
                                </li>
                                <li>
                                    <form method="POST" action="{{ route('logout') }}">
                                        @csrf
                                        <button type="submit" class="dropdown-item">Logout</button>
                                    </form>
                                </li>
                            </ul>
                        </div>
                    @break

                    @case('user')
                        <div class="dropdown">
                            <a class="btn btn-light dropdown-toggle w-100 w-lg-auto" href="#" id="adminMenu"
                                data-bs-toggle="dropdown" aria-expanded="false">
                                {{ Auth::user()->name }}
                            </a>
                            <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="adminMenu">
                                <li><a class="dropdown-item" href="#">Tim Volunteer</a></li>
                                <li><a class="dropdown-item" href="#">Daftar Volunteer</a></li>
                                <li>
                                    <hr class="dropdown-divider">
                                </li>
                                <li>
                                    <form method="POST" action="{{ route('logout') }}">
                                        @csrf
                                        <button type="submit" class="dropdown-item">Logout</button>
                                    </form>
                                </li>
                            </ul>
                        </div>
                    @break

                    @default
                        <a href="{{ route('login') }}" class="btn btn-outline-light w-100 w-lg-auto">Masuk / Daftar</a>
                @endswitch
            </div>
        </div>
    </div>
</nav>
