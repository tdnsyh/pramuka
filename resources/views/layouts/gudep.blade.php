<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>@yield('title', 'Default Title') - Pramuka Kwartir Cabang Kab. Tasikmalaya</title>
    <link rel="shortcut icon" type="image/png" href="{{ asset('assets/images/logos/seodashlogo.png') }}" />
    <link rel="stylesheet" href="{{ asset('assets/libs/simplebar/dist/simplebar.min.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/styles.min.css') }}" />
    @stack('style')
</head>

<body>
    <div class="page-wrapper" id="main-wrapper" data-layout="vertical" data-navbarbg="skin6" data-sidebartype="full"
        data-sidebar-position="fixed" data-header-position="fixed">
        <aside class="left-sidebar">
            <div>
                <div class="brand-logo d-flex align-items-center justify-content-between">
                    <a href="/gudep" class="text-nowrap logo-img">
                        <img src="{{ asset('assets/images/logos/logo-light.svg') }}" alt="" />
                    </a>
                    <div class="close-btn d-xl-none d-block sidebartoggler cursor-pointer" id="sidebarCollapse">
                        <i class="ti ti-x fs-8"></i>
                    </div>
                </div>
                <nav class="sidebar-nav scroll-sidebar" data-simplebar="">
                    <ul id="sidebarnav">
                        <li class="nav-small-cap"><i class="ti ti-dots nav-small-cap-icon fs-6"></i><span
                                class="hide-menu">Home</span>
                        </li>

                        <li class="sidebar-item">
                            <a class="sidebar-link" href="/gudep/dashboard">
                                <span><iconify-icon icon="solar:home-smile-bold-duotone"
                                        class="fs-6"></iconify-icon></span>
                                <span class="hide-menu">Dashboard</span>
                            </a>
                        </li>
                        <li class="nav-small-cap"><i class="ti ti-dots nav-small-cap-icon fs-6"></i><span
                                class="hide-menu">data</span>
                        </li>
                        <li class="sidebar-item">
                            <a class="sidebar-link" href="/gudep/anggota">
                                <span><iconify-icon icon="solar:users-group-rounded-bold-duotone"
                                        class="fs-6"></iconify-icon></span>
                                <span class="hide-menu">Anggota Gudep</span>
                            </a>
                        </li>

                        <li class="sidebar-item">
                            <a class="sidebar-link" href="/gudep/keuangan">
                                <span><iconify-icon icon="solar:wallet-bold-duotone"
                                        class="fs-6"></iconify-icon></span>
                                <span class="hide-menu">Keuangan</span>
                            </a>
                        </li>
                        <li class="nav-small-cap"><i class="ti ti-dots nav-small-cap-icon fs-6"></i><span
                                class="hide-menu">lainnya</span>
                        </li>
                        <li class="sidebar-item">
                            <a class="sidebar-link" href="/gudep/profil">
                                <span><iconify-icon icon="solar:wallet-bold-duotone"
                                        class="fs-6"></iconify-icon></span>
                                <span class="hide-menu">Profil</span>
                            </a>
                        </li>
                        <li class="sidebar-item">
                            <a class="sidebar-link" href="/gudep/tentang">
                                <span><iconify-icon icon="solar:wallet-bold-duotone"
                                        class="fs-6"></iconify-icon></span>
                                <span class="hide-menu">Tentang Gudep</span>
                            </a>
                        </li>
                        <li class="sidebar-item">
                            <a class="sidebar-link" href="/logout"
                                onclick="event.preventDefault(); document.getElementById('logout-form').submit();"
                                aria-expanded="false">
                                <span>
                                    <iconify-icon icon="solar:logout-bold-duotone" class="fs-6"></iconify-icon>
                                </span>
                                <span class="hide-menu">Keluar</span>
                            </a>
                            <form id="logout-form" action="/logout" method="POST" class="d-none">
                                <input type="hidden" name="_token" value="{{ csrf_token() }}">
                            </form>
                        </li>
                    </ul>
                </nav>
            </div>
        </aside>
        <div class="body-wrapper">
            <header class="app-header">
                <nav class="navbar navbar-expand-lg navbar-light">
                    <ul class="navbar-nav">
                        <li class="nav-item d-block d-xl-none">
                            <a class="nav-link sidebartoggler nav-icon-hover" id="headerCollapse"
                                href="javascript:void(0)">
                                <i class="ti ti-menu-2"></i>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link nav-icon-hover" href="javascript:void(0)">
                                <i class="ti ti-bell-ringing"></i>
                                <div class="notification bg-primary rounded-circle"></div>
                            </a>
                        </li>
                    </ul>
                    <div class="navbar-collapse justify-content-end px-0" id="navbarNav">
                        <ul class="navbar-nav flex-row ms-auto align-items-center justify-content-end">
                            <li class="nav-item dropdown">
                                <a class="nav-link nav-icon-hover" href="javascript:void(0)" id="drop2"
                                    data-bs-toggle="dropdown" aria-expanded="false">
                                    <img src="{{ asset('assets/images/profile/user-1.jpg') }}" alt=""
                                        width="35" height="35" class="rounded-circle">
                                </a>
                            </li>
                        </ul>
                    </div>
                </nav>
            </header>
            @yield('content')
        </div>
    </div>
    <script src="{{ asset('assets/libs/jquery/dist/jquery.min.js') }}"></script>
    <script src="{{ asset('assets/libs/bootstrap/dist/js/bootstrap.bundle.min.js') }}"></script>
    <script src="{{ asset('assets/libs/simplebar/dist/simplebar.js') }}"></script>
    <script src="{{ asset('assets/js/sidebarmenu.js') }}"></script>
    <script src="{{ asset('assets/js/app.min.js') }}"></script>
    <script src="https://cdn.jsdelivr.net/npm/iconify-icon@1.0.8/dist/iconify-icon.min.js"></script>
    @stack('script')
</body>

</html>
