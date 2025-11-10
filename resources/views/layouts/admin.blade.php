@extends('layouts.app')
@push('style-script')
    <link rel="stylesheet" href="{{ asset('assets/auth/css/styles.min.css') }}" />
@endpush

@section('body')
    <div class="page-wrapper" id="main-wrapper" data-layout="vertical" data-navbarbg="skin6" data-sidebartype="full"
        data-sidebar-position="fixed" data-header-position="fixed">

        <!-- Sidebar Start -->
        @include('partials.admin.admin-sidebar')
        <!--  Sidebar End -->

        <!--  Main wrapper -->
        <div class="body-wrapper">
            <!--  Header Start -->
            <header class="app-header">
                <nav class="navbar navbar-expand-lg navbar-light">
                    <ul class="navbar-nav">
                        <li class="nav-item d-block d-xl-none">
                            <div class="nav-link sidebartoggler nav-icon-hover" id="headerCollapse">
                                <i class="ti ti-menu-2"></i>
                            </div>
                        </li>
                    </ul>
                </nav>
            </header>
            <!--  Header End -->
            <div class="container-fluid">
                @yield('admin-content')
            </div>
        </div>
    </div>
@endsection
@push('custom-script')
    <script src="https://cdn.ckeditor.com/ckeditor5/41.0.0/classic/ckeditor.js"></script>
@endpush
