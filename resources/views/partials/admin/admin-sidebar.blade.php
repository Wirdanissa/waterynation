<aside id="sidebar" class="d-flex flex-column flex-shrink-0 bg-white border-end vh-100 position-fixed">
    <!-- Logo -->
    <div class="px-3 py-4 border-bottom">
        <div class="d-flex align-items-center mb-3 border-bottom pb-3 border-2">
            <img src="{{ asset('assets/img/icon.png') }}" alt="Watery Nation Logo" class="me-2"
                style="height: 40px;">
            <span class="fs-5 fw-semibold">Watery Nation</span>
        </div>

        <!-- Navigation -->
        <ul class="nav nav-pills flex-column mb-auto">
            <li class="nav-item">
                <a href="{{ route('admin.dashboard') }}" class="nav-link @yield('adminDashboard')">
                    Dashboard
                </a>
            </li>
            <li class="nav-item">
                <a href="{{ route('logout') }}" class="nav-link @yield('adminDashboard')">
                    Logout
                </a>
            </li>
        </ul>
    </div>

    <!-- User Info -->
    <div class="mt-auto px-3 py-4 border-top">
        <div class="d-flex align-items-center gap-2 bg-light p-2 rounded">
            @if (Auth::user()->foto_profile)
                <img src="{{ asset('storage/' . Auth::user()->foto_profile) }}" class="rounded-circle" alt="Foto Profil"
                    style="width:40px; height:40px; object-fit:cover;">
            @else
                <i class="bi bi-person-circle fs-2 text-secondary"></i>
            @endif
            <div class="small text-dark">
                <p class="mb-0 fw-medium">{{ Auth::user()->name }}</p>
                <p class="mb-0 text-muted">{{ Auth::user()->email }}</p>
            </div>
        </div>
    </div>
</aside>
