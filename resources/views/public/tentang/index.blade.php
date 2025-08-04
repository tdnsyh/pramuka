@extends('layouts.app')
@section('title', 'Tentang Kwartir Cabang')

@section('content')
    @include('partials.navbar')
    <section class="py-5">
        <div class="container">
            <div class="row row-cols-1 row-cols-md-2 g-4">
                <div class="col">
                    <img src="https://images.unsplash.com/photo-1619973516465-da5fecfad5f3?q=80&w=1470&auto=format&fit=crop&ixlib=rb-4.1.0&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D"
                        alt="" class="img-fluid object-fit-cover rounded w-100">
                    <div class="rounded border bg-primary-subtle p-4 mt-3">
                        <p class="mb-0">Lorem ipsum dolor sit amet consectetur, adipisicing elit. Adipisci, porro.</p>
                    </div>
                </div>
                <div class="col">
                    <h1 class="">Kwartir Cabang Gerakan Pramuka Kabupaten Tasikmalaya</h1>
                    <p>
                        Kwartir Cabang Gerakan Pramuka Kabupaten Tasikmalaya merupakan organisasi kepramukaan tingkat
                        kabupaten yang bertugas membina dan mengembangkan kegiatan Pramuka di seluruh wilayah Tasikmalaya.
                        Berdiri sejak 2022, Kwarcab ini menjadi pusat koordinasi kegiatan kepramukaan, pelatihan pembina,
                        dan pengembangan gugus depan.
                    </p>
                    <h2>Visi</h2>
                    <div class="rounded border bg-dark-subtle p-4 mb-3">
                        <p class="mb-0">
                            Menjadi pusat pembinaan Pramuka yang unggul dalam membentuk generasi muda yang berkarakter,
                            mandiri, dan
                            cinta tanah air.
                        </p>
                    </div>
                    <h2 class="mb-3">Misi</h2>
                    <ul class="list-unstyled">
                        <li class="mb-2 d-flex align-items-start">
                            <i class="ti ti-check text-success me-2 mt-1"></i>
                            Menyelenggarakan pendidikan kepramukaan yang aktif, kreatif, dan menyenangkan.
                        </li>
                        <li class="mb-2 d-flex align-items-start">
                            <i class="ti ti-check text-success me-2 mt-1"></i>
                            Mengembangkan potensi peserta didik melalui kegiatan latihan, lomba, dan perkemahan.
                        </li>
                        <li class="mb-2 d-flex align-items-start">
                            <i class="ti ti-check text-success me-2 mt-1"></i>
                            Memberikan pelatihan berkualitas bagi pembina dan pelatih Pramuka.
                        </li>
                        <li class="mb-2 d-flex align-items-start">
                            <i class="ti ti-check text-success me-2 mt-1"></i>
                            Memperkuat kerja sama dengan Kwartir Ranting dan instansi terkait.
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </section>

    <section class="py-5 bg-light">
        <div class="container py-4">
            <h1>Struktur Organisasi</h1>
            <p>Berikut ini adalah struktur kepengurusan Kwarcab [Nama Kabupaten/Kota] periode [202X–202X]:</p>
            <div class="ratio ratio-21x9">
                <img src="https://images.unsplash.com/photo-1619973516465-da5fecfad5f3?q=80&w=1470&auto=format&fit=crop&ixlib=rb-4.1.0&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D"
                    alt="" class="img-fluid object-fit-cover rounded w-100">
            </div>
        </div>
    </section>

    <section class="py-5">
        <div class="container">
            <h1 class="fw-bold">Kontak Sekretariat</h1>
            <p class="text-muted">Hubungi kami untuk informasi, kerjasama, atau pelaporan kegiatan Pramuka</p>

            <div class="row g-4">
                <!-- Info Kontak -->
                <div class="col-lg-5">
                    <div class="card border">
                        <div class="card-body p-0">
                            <div id="map" style="height: 300px; border-radius: 8px;"></div>
                        </div>
                    </div>
                    <div class="card border">
                        <div class="card-body">
                            <h5 class="card-title mb-3"><i class="ti ti-map-2 text-success me-2"></i>Alamat</h5>
                            <p class="card-text mb-3">
                                <strong>Kwartir Cabang Gerakan Pramuka [Nama Kabupaten/Kota]</strong><br>
                                Jl. [Nama Jalan], [Kelurahan/Kecamatan], [Kabupaten/Kota]
                            </p>

                            <h5 class="card-title mb-2"><i class="ti ti-phone text-success me-2"></i>Telepon /
                                WA</h5>
                            <p class="card-text mb-3">
                                <a href="https://wa.me/628xxxxxxxxxx" class="text-decoration-none">
                                    <i class="bi bi-whatsapp me-1"></i>08xxxxxxxxxx
                                </a>
                            </p>

                            <h5 class="card-title mb-2"><i class="ti ti-mail text-success me-2"></i>Email</h5>
                            <p class="card-text mb-3">
                                <a href="mailto:info@pramuka-[kabupaten].or.id" class="text-decoration-none">
                                    info@pramuka-[kabupaten].or.id
                                </a>
                            </p>

                            <div class="d-flex gap-3 mt-3">
                                <a href="#" class="text-success fs-4" aria-label="Instagram"><i
                                        class="bi bi-instagram"></i></a>
                                <a href="#" class="text-primary fs-4" aria-label="Facebook"><i
                                        class="bi bi-facebook"></i></a>
                                <a href="#" class="text-info fs-4" aria-label="X / Twitter"><i
                                        class="bi bi-x"></i></a>
                                <a href="#" class="text-danger fs-4" aria-label="YouTube"><i
                                        class="bi bi-youtube"></i></a>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Form Kontak -->
                <div class="col-lg-7">
                    <div class="card border">
                        <div class="card-body">
                            <h5 class="card-title mb-3"><i class="bi bi-chat-dots-fill text-success me-2"></i>Kirim
                                Pesan</h5>
                            <p class="text-muted">Isi form berikut, kami akan menghubungi kembali secepatnya.</p>
                            <form action="#" method="POST" class="row g-3">
                                <div class="col-md-6">
                                    <label for="nama" class="form-label">Nama</label>
                                    <input type="text" class="form-control" id="nama" name="nama"
                                        placeholder="Nama lengkap" required>
                                </div>
                                <div class="col-md-6">
                                    <label for="email" class="form-label">Email / WA</label>
                                    <input type="text" class="form-control" id="email" name="email"
                                        placeholder="Email atau WhatsApp" required>
                                </div>
                                <div class="col-12">
                                    <label for="subjek" class="form-label">Subjek</label>
                                    <input type="text" class="form-control" id="subjek" name="subjek"
                                        placeholder="Judul pesan" required>
                                </div>
                                <div class="col-12">
                                    <label for="pesan" class="form-label">Pesan</label>
                                    <textarea class="form-control" id="pesan" name="pesan" rows="4" placeholder="Tulis pesan kamu..."
                                        required></textarea>
                                </div>
                                <div class="col-12 text-end">
                                    <button type="submit" class="btn btn-primary">
                                        <i class="bi bi-send-fill me-1"></i>Kirim Pesan
                                    </button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </section>
@endsection

@push('script')
    <!-- Tambahkan di <head> -->
    <link rel="stylesheet" href="https://unpkg.com/leaflet@1.9.4/dist/leaflet.css" />
    <script src="https://unpkg.com/leaflet@1.9.4/dist/leaflet.js"></script>

    <script>
        // Koordinat: Gedung Pramuka Kabupaten Tasikmalaya
        const map = L.map('map').setView([-7.3673738, 108.1105474], 17);

        // Tile layer
        L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
            attribution: '&copy; <a href="https://osm.org/">OpenStreetMap</a> contributors'
        }).addTo(map);

        // Marker dan popup
        L.marker([-7.3673738, 108.1105474])
            .addTo(map)
            .bindPopup("<strong>Gedung Pramuka</strong><br>Kabupaten Tasikmalaya")
            .openPopup();
    </script>
@endpush
