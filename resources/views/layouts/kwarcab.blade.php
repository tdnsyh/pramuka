<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>kwarcab Dashboard</title>
    <link rel="shortcut icon" type="image/png" href="../assets/images/logos/seodashlogo.png" />
    <link rel="stylesheet" href="{{ asset('assets/libs/simplebar/dist/simplebar.min.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/styles.min.css') }}" />
</head>

<body>
    <div class="page-wrapper" id="main-wrapper" data-layout="vertical" data-navbarbg="skin6" data-sidebartype="full"
        data-sidebar-position="fixed" data-header-position="fixed">
        <aside class="left-sidebar">
            <div>
                <div class="brand-logo d-flex align-items-center justify-content-between">
                    <a href="./index.html" class="text-nowrap logo-img">
                        <img src="../assets/images/logos/logo-light.svg" alt="" />
                    </a>
                    <div class="close-btn d-xl-none d-block sidebartoggler cursor-pointer" id="sidebarCollapse">
                        <i class="ti ti-x fs-8"></i>
                    </div>
                </div>
                <nav class="sidebar-nav scroll-sidebar" data-simplebar="">
                    <ul id="sidebarnav">
                        <!-- Judul -->
                        <li class="nav-small-cap">
                            <i class="ti ti-dots nav-small-cap-icon fs-6"></i>
                            <span class="hide-menu">Beranda</span>
                        </li>

                        <!-- Dashboard -->
                        <li class="sidebar-item">
                            <a class="sidebar-link" href="/kwarcab" aria-expanded="false">
                                <span>
                                    <iconify-icon icon="solar:home-smile-bold-duotone" class="fs-6"></iconify-icon>
                                </span>
                                <span class="hide-menu">Dashboard</span>
                            </a>
                        </li>

                        <!-- Manajemen Anggota -->
                        <li class="nav-small-cap">
                            <i class="ti ti-dots nav-small-cap-icon fs-6"></i>
                            <span class="hide-menu">Manajemen</span>
                        </li>
                        <li class="sidebar-item">
                            <a class="sidebar-link" href="/kwarcab/anggota" aria-expanded="false">
                                <span>
                                    <iconify-icon icon="solar:users-group-rounded-bold-duotone"
                                        class="fs-6"></iconify-icon>
                                </span>
                                <span class="hide-menu">Anggota</span>
                            </a>
                        </li>

                        <!-- Manajemen Keuangan -->
                        <li class="sidebar-item">
                            <a class="sidebar-link" href="/kwarcab/keuangan" aria-expanded="false">
                                <span>
                                    <iconify-icon icon="solar:wallet-money-bold-duotone" class="fs-6"></iconify-icon>
                                </span>
                                <span class="hide-menu">Keuangan</span>
                            </a>
                        </li>

                        <!-- Manajemen Kegiatan -->
                        <li class="sidebar-item">
                            <a class="sidebar-link" href="/kwarcab/kegiatan" aria-expanded="false">
                                <span>
                                    <iconify-icon icon="solar:calendar-add-bold-duotone" class="fs-6"></iconify-icon>
                                </span>
                                <span class="hide-menu">Kegiatan</span>
                            </a>
                        </li>

                        <!-- Logout -->
                        <li class="nav-small-cap">
                            <i class="ti ti-dots nav-small-cap-icon fs-6"></i>
                            <span class="hide-menu">Akun</span>
                        </li>
                        <li class="sidebar-item">
                            <a class="sidebar-link" href="/kwarcab/region" aria-expanded="false">
                                <span>
                                    <iconify-icon icon="solar:user-plus-bold-duotone" class="fs-6"></iconify-icon>
                                </span>
                                <span class="hide-menu">Region</span>
                            </a>
                        </li>
                        <li class="sidebar-item">
                            <a class="sidebar-link" href="/kwarcab/pengguna" aria-expanded="false">
                                <span>
                                    <iconify-icon icon="solar:user-plus-bold-duotone" class="fs-6"></iconify-icon>
                                </span>
                                <span class="hide-menu">Manajemen User</span>
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
                                    <img src="../assets/images/profile/user-1.jpg" alt="" width="35"
                                        height="35" class="rounded-circle">
                                </a>
                                <div class="dropdown-menu dropdown-menu-end dropdown-menu-animate-up"
                                    aria-labelledby="drop2">
                                    <div class="message-body">
                                        <a href="javascript:void(0)"
                                            class="d-flex align-items-center gap-2 dropdown-item">
                                            <i class="ti ti-user fs-6"></i>
                                            <p class="mb-0 fs-3">Profile</p>
                                        </a>
                                        <a href="javascript:void(0)"
                                            class="d-flex align-items-center gap-2 dropdown-item">
                                            <i class="ti ti-mail fs-6"></i>
                                            <p class="mb-0 fs-3">Account</p>
                                        </a>
                                        <a href="./authentication-login.html"
                                            class="btn btn-outline-primary mx-3 mt-2 d-block">Logout</a>
                                    </div>
                                </div>
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
</body>

</html>
