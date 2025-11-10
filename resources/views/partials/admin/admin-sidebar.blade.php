 <aside class="left-sidebar">
     <!-- Sidebar scroll -->
     <div class="scroll-sidebar" data-simplebar>
         <!-- Logo Section -->
         <div class="d-flex mb-4 align-items-center">
             <img src="{{ asset('assets/img/icon.png') }}" alt="Logo" width="40" height="auto"
                 class="d-inline-block me-3 rounded-circle">
             <a class="navbar-brand d-flex d-lg-inline-block mx-auto mx-lg-0 text-center text-lg-start"
                 href="{{ route('admin.dashboard') }}">
                 <h5 class="me-3 fw-bold fs-4 fs-md-2 fs-lg-1 text-primary mt-2" style="letter-spacing: 2px;">
                     Watery Nation
                 </h5>
             </a>
             <div class="close-btn d-xl-none d-block sidebartoggler cursor-pointer" id="sidebarCollapse">
                 <i class="ti ti-x fs-8"></i>
             </div>
         </div>

         <hr class="fs-1">

         <!-- Sidebar navigation -->
         <nav class="sidebar-nav">
             <ul id="sidebarnav" class="mb-4 pb-2">
                 <!-- Dashboard -->
                 <li class="sidebar-item mb-4">
                     <a class="sidebar-link @yield('menuDashboard')" href="{{ route('admin.dashboard') }}"
                         aria-expanded="false">
                         <span class="aside-icon p-2 bg-primary rounded-3">
                             <i class="ti ti-layout-dashboard fs-5 text-light"></i>
                         </span>
                         <span class="hide-menu ms-2 ps-1">Dashboard</span>
                     </a>
                 </li>

                 {{-- Donasi --}}
                 <li class="sidebar-item mb-4">
                     <a class="sidebar-link @yield('menuDonasi')" href="{{ route('admin.donasi.index') }}"
                         aria-expanded="false">
                         <span class="aside-icon p-2 bg-primary rounded-3">
                             <i class="bi bi-wallet fs-5 text-light"></i>
                         </span>
                         <span class="hide-menu ms-2 ps-1">Donasi</span>
                     </a>
                 </li>

                 <!-- Program -->
                 <li class="sidebar-item mb-3">
                     <a class="sidebar-link d-flex align-items-center justify-content-between" data-bs-toggle="collapse"
                         href="#programsMenu" role="button" aria-expanded="@yield('menuProgramExpanded', 'false')"
                         aria-controls="programsMenu">

                         <div class="d-flex align-items-center">
                             <span class="aside-icon p-2 bg-primary rounded-3">
                                 <i class="ti ti-receipt fs-5 text-light"></i>
                             </span>
                             <span class="hide-menu ms-2 ps-1">Menu Program</span>
                         </div>
                         <i class="ti ti-chevron-down"></i>
                     </a>

                     <ul class="collapse list-unstyled ms-5 mt-2 @yield('menuProgramShow')" id="programsMenu">
                         <li class="sidebar-item">
                             <a href="{{ route('admin.program.index') }}"
                                 class="sidebar-link @yield('menuProgramList') ms-2 ps-1 p-2">
                                 Program
                             </a>
                         </li>
                         <li class="sidebar-item">
                             <a href="{{ route('admin.program-registrasi.index') }}"
                                 class="sidebar-link @yield('menuProgramRegistrations') ms-2 ps-1 p-2">
                                 Pendaftar Program
                             </a>
                         </li>
                     </ul>
                 </li>

                 {{-- Publikasi --}}
                 <li class="sidebar-item mb-4">
                     <a class="sidebar-link @yield('menuPublikasi')" href="{{ route('admin.publikasi.index') }}"
                         aria-expanded="false">
                         <span class="aside-icon p-2 bg-primary rounded-3">
                             <i class="bi bi-file-earmark-richtext-fill fs-5 text-light"></i>
                         </span>
                         <span class="hide-menu ms-2 ps-1">Publikasi</span>
                     </a>
                 </li>

                 {{-- Volunteer --}}
                 <li class="sidebar-item mb-3">
                     <a class="sidebar-link d-flex align-items-center justify-content-between" data-bs-toggle="collapse"
                         href="#volunteerMenu" role="button" aria-expanded="@yield('menuVolunteerExpanded', 'false')"
                         aria-controls="volunteerMenu">

                         <div class="d-flex align-items-center">
                             <span class="aside-icon p-2 bg-primary rounded-3">
                                 <i class="ti ti-receipt fs-5 text-light"></i>
                             </span>
                             <span class="hide-menu ms-2 ps-1">Menu Volunteer</span>
                         </div>
                         <i class="ti ti-chevron-down"></i>
                     </a>

                     <ul class="collapse list-unstyled ms-5 mt-2 @yield('menuVolunteerShow')" id="volunteerMenu">
                         <li class="sidebar-item">
                             <a href="{{ route('admin.volunteer.index') }}"
                                 class="sidebar-link @yield('menuVolunteerList') ms-2 ps-1 p-2">
                                 Volunteer
                             </a>
                         </li>
                         <li class="sidebar-item">
                             <a href="{{ route('admin.volunteer-registrasi.index') }}"
                                 class="sidebar-link @yield('menuVolunteerRegistrations') ms-2 ps-1 p-2">
                                 Pendaftar Volunteer
                             </a>
                         </li>
                     </ul>
                 </li>

                 {{-- Organisasi --}}
                 <li class="sidebar-item mb-4">
                     <a class="sidebar-link @yield('menuOrganisasi')" href="{{ route('admin.organisasi.index') }}"
                         aria-expanded="false">
                         <span class="aside-icon p-2 bg-primary rounded-3">
                             <i class="bi bi-building-fill fs-5 text-light"></i>
                         </span>
                         <span class="hide-menu ms-2 ps-1">Profile Organisasi</span>
                     </a>
                 </li>

                 <!-- User -->
                 <li class="sidebar-item mb-4">
                     <a class="sidebar-link @yield('menuUser')" href="{{ route('admin.user.index') }}"
                         aria-expanded="false">
                         <span class="aside-icon p-2 bg-primary rounded-3">
                             <i class="ti ti-user fs-5 text-light"></i>
                         </span>
                         <span class="hide-menu ms-2 ps-1">User</span>
                     </a>
                 </li>

                 <!-- Logout -->
                 <li class="sidebar-item mb-4">
                     <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                         @csrf
                     </form>
                     <a class="sidebar-link" href="{{ route('logout') }}"
                         onclick="event.preventDefault(); document.getElementById('logout-form').submit();"
                         aria-expanded="false">
                         <span class="aside-icon p-2 bg-primary rounded-3">
                             <i class="ti ti-logout fs-5 text-light"></i>
                         </span>
                         <span class="hide-menu ms-2 ps-1">Logout</span>
                     </a>
                 </li>
             </ul>
         </nav>
         <!-- End Sidebar navigation -->
     </div>
     <!-- End Sidebar scroll -->
 </aside>
