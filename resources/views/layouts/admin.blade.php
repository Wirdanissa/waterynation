@extends('layouts.app')

@section('body')
    <div class="d-flex min-vh-100 bg-light">

        {{-- Sidebar Desktop --}}
        <aside class="d-none d-lg-flex flex-column flex-shrink-0 bg-white border-end vh-100 position-fixed"
            style="width:250px;">
            <div class="px-3 py-4 border-bottom">
                <div class="d-flex align-items-center mb-3 border-bottom pb-3 border-2">
                    <img src="{{ asset('assets/img/icon.png') }}" alt="Watery Nation Logo" class="me-2" style="height:40px;">
                    <span class="fs-5 fw-semibold">Watery Nation</span>
                </div>

                <ul class="nav nav-pills flex-column mb-auto">
                    <li class="nav-item">
                        <a href="{{ route('admin.dashboard') }}" class="nav-link @yield('adminDashboard')">Dashboard</a>
                    </li>
                    <li class="nav-item">
                        <form action="{{ route('logout') }}" method="POST"> @csrf
                            <button type="submit" class="nav-link @yield('adminLogout')">Logout</button>
                        </form>
                    </li>
                </ul>
            </div>

            {{-- User Info --}}
            <div class="mt-auto px-3 py-4 border-top">
                <div class="d-flex align-items-center gap-2 bg-light p-2 rounded">
                    @if (Auth::user()->foto_profile)
                        <img src="{{ asset('storage/' . Auth::user()->foto_profile) }}" class="rounded-circle"
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

        {{-- Sidebar Mobile Offcanvas + Toggle --}}
        <div class="d-lg-none">
            <button class="btn btn-outline-primary m-2" type="button" data-bs-toggle="offcanvas"
                data-bs-target="#sidebarOffcanvas" aria-controls="sidebarOffcanvas">
                <i class="bi bi-toggles"></i> <span class="visually-hidden">Toggle Sidebar</span>
            </button>

            <div class="offcanvas offcanvas-start" tabindex="-1" id="sidebarOffcanvas"
                aria-labelledby="sidebarOffcanvasLabel">
                <div class="offcanvas-header">
                    <h5 class="offcanvas-title" id="sidebarOffcanvasLabel">Watery Nation</h5>
                    <button type="button" class="btn-close text-reset" data-bs-dismiss="offcanvas"
                        aria-label="Close"></button>
                </div>
                <div class="offcanvas-body d-flex flex-column">
                    <ul class="nav nav-pills flex-column mb-auto">
                        <li class="nav-item">
                            <a href="{{ route('admin.dashboard') }}" class="nav-link @yield('adminDashboard')">Dashboard</a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ route('logout') }}" class="nav-link @yield('adminDashboard')">Dashboard</a>
                        </li>
                    </ul>

                    {{-- User Info --}}
                    <div class="mt-auto px-3 py-4 border-top">
                        <div class="d-flex align-items-center gap-2 bg-light p-2 rounded">
                            @if (Auth::user()->foto_profile)
                                <img src="{{ asset('storage/' . Auth::user()->foto_profile) }}" class="rounded-circle"
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
                </div>
            </div>
        </div>

        {{-- Konten Utama --}}
        <div class="flex-grow-1" style="margin-left:250px;">
            <main class="p-4">
                <div class="border rounded bg-white p-4 shadow-sm">
                    @yield('admin-content')
                </div>
            </main>

            {{-- Footer --}}
            <footer class="p-4 border-top bg-white text-center">
                <p class="mb-0">&copy; {{ date('Y') }} Watery Nation. All rights reserved.</p>
            </footer>
        </div>
    </div>
@endsection
