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
    @include('partials.alert')

    {{-- konten --}}
    @yield('content')
    <section class="bg-dark pb-0 mb-0">
        <div class="container">
            <footer class="py-3 my-4">
                <ul class="nav justify-content-center border-bottom pb-3 mb-3">
                    <li class="nav-item"><a href="" class="nav-link px-2 text-body-secondary">Home</a></li>
                    <li class="nav-item"><a href="/tentang" class="nav-link px-2 text-body-secondary">Tentang</a></li>
                    <li class="nav-item"><a href="/kwarran" class="nav-link px-2 text-body-secondary">Kwarran</a></li>
                    <li class="nav-item"><a href="/kwarcab" class="nav-link px-2 text-body-secondary">Kwarcab</a></li>
                    <li class="nav-item"><a href="/kegiatan" class="nav-link px-2 text-body-secondary">Kegiatan</a></li>
                </ul>
                <p class="text-center text-body-secondary">© 2025 Company, Inc</p>
            </footer>
        </div>
    </section>
    <script src="https://cdn.jsdelivr.net/npm/masonry-layout@4.2.2/dist/masonry.pkgd.min.js"
        integrity="sha384-GNFwBvfVxBkLMJpYMOABq3c+d3KnQxudP/mGPkzpZSTYykLBNsZEnG2D9G/X/+7D" crossorigin="anonymous" async>
    </script>
    <script src="{{ asset('assets/libs/jquery/dist/jquery.min.js') }}"></script>
    <script src="{{ asset('assets/libs/bootstrap/dist/js/bootstrap.bundle.min.js') }}"></script>
    <script src="{{ asset('assets/libs/simplebar/dist/simplebar.js') }}"></script>
    @stack('script')
</body>

</html>
