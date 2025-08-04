@extends('layouts.app')
@section('title', 'Home')

@section('content')
    @include('partials.navbar')

    {{-- hero section --}}
    <div class="py-4">
        <div class="container text-center">
            <h1 class="display-1 fw-semibold">"Satyaku kudarmakan, darmaku kubaktikan"</h1>
            <h4>Dengan penuh semangat pengabdian, kami menjalankan janji setia dan mengamalkan tugas suci.
                Satyaku kudarmakan, darmaku kubaktikan – bukan sekadar semboyan, tetapi prinsip hidup pramuka
                sejati.</h4>
            <a href="/kegiatan" class="btn btn-primary btn-lg">Lihat Kegiatan</a>
            <a href="/kegiatan" class="btn text-primary bg-primary-subtle btn-lg">Lihat Kwarran</a>
        </div>
        <div class="mt-4">
            <div id="carouselExampleSlidesOnly" class="carousel slide" data-bs-ride="carousel">
                <div class="carousel-inner">
                    <div class="carousel-item active">
                        <div class="ratio ratio-21x9">
                            <img src="https://images.unsplash.com/photo-1706694772364-a8da56e53f04?q=80&w=1031&auto=format&fit=crop&ixlib=rb-4.1.0&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D"
                                alt="" class="img-fluid object-fit-cover">
                        </div>
                    </div>
                    <div class="carousel-item">
                        <div class="ratio ratio-21x9">
                            <img src="https://images.unsplash.com/photo-1706694772364-a8da56e53f04?q=80&w=1031&auto=format&fit=crop&ixlib=rb-4.1.0&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D"
                                alt="" class="img-fluid object-fit-cover">
                        </div>
                    </div>
                    <div class="carousel-item">
                        <div class="ratio ratio-21x9">
                            <img src="https://images.unsplash.com/photo-1706694772364-a8da56e53f04?q=80&w=1031&auto=format&fit=crop&ixlib=rb-4.1.0&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D"
                                alt="" class="img-fluid object-fit-cover">
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <section id="sambutan-ketua" class="py-5 bg-light">
        <div class="container py-4">
            <div class="row">
                <div class="col-md-4 mb-3 mb-md-0">
                    <div class="ratio ratio-1x1">
                        <img src="https://images.unsplash.com/photo-1706694453861-dc3808da255d?q=80&w=870&auto=format&fit=crop&ixlib=rb-4.1.0&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D"
                            alt="Ketua Kwarcab" class="img-fluid rounded object-fit-cover">
                    </div>
                    <h5 class="mt-3 fw-semibold">[Nama Ketua Kwarcab]</h5>
                    <p class="text-muted">Ketua Kwartir Cabang [Nama Kabupaten/Kota]</p>
                </div>
                <div class="col-md-8">
                    <h1 class="fw-bold">Sambutan Ketua Kwarcab</h1>
                    <p class="lead text-justify">
                        Assalamu’alaikum warahmatullahi wabarakatuh,
                    </p>
                    <p class="text-justify">
                        Salam Pramuka! <br><br>
                        Dengan rasa syukur ke hadirat Tuhan Yang Maha Esa, kami menyambut hangat kehadiran Anda di website
                        resmi Kwartir Cabang Gerakan Pramuka [Nama Kabupaten/Kota]. Website ini kami hadirkan sebagai media
                        informasi, komunikasi, dan inspirasi bagi seluruh anggota Pramuka dan masyarakat umum.
                        <br><br>
                        Semoga semangat “<strong>Satyaku Kudarmakan, Darmaku Kubaktikan</strong>” terus menyala dan menjadi
                        pegangan dalam membentuk Pramuka yang berjiwa patriot, beretika, dan berbakti bagi bangsa dan
                        negara.
                        <br><br>
                        Terima kasih atas dukungan semua pihak yang telah membersamai perjalanan dan pengabdian Gerakan
                        Pramuka di tingkat cabang ini.
                    </p>
                    <p class="text-justify">
                        Wassalamu’alaikum warahmatullahi wabarakatuh.
                    </p>
                </div>
            </div>
        </div>
    </section>

    <section class="py-5">
        <div class="container">
            <h1 class="mb-4">Kegiatan Terbaru</h1>
            <div class="row row-cols-2 row-cols-md-4 g-4">
                @forelse($kegiatan as $item)
                    <div class="col">
                        <div class="card mb-0 border h-100">
                            <div class="ratio ratio-16x9">
                                <img src="{{ $item->gambar ? asset('storage/' . $item->gambar) : asset('assets/images/default.jpg') }}"
                                    class="card-img-top object-fit-cover mb-0" alt="{{ $item->judul }}" lazy="loading">
                            </div>
                            <div class="card-body">
                                <h5>{{ $item->judul }}</h5>
                                <small class="text-muted">{{ \Carbon\Carbon::parse($item->tanggal)->format('d M Y') }} -
                                    {{ $item->lokasi }}</small>
                                <p>{{ $item->deskripsi_pendek }}</p>
                                <a href="{{ route('kegiatan.show', $item->slug) }}">Selengkapnya</a>
                            </div>
                        </div>
                    </div>
                @empty
                    <p>Belum ada kegiatan yang terlaksana.</p>
                @endforelse
            </div>
        </div>
    </section>

    <section class="py-5">
        <div class="container">
            <h1>Agenda yang akan datang</h1>
            <div class="row row-cols-2 row-cols-md-4 g-4">
                @forelse($agenda as $item)
                    <div class="col">
                        <div class="card mb-0 border h-100">
                            @php
                                $gambar = $item->gambar
                                    ? asset('storage/' . $item->gambar)
                                    : asset('assets/images/default.jpg');
                            @endphp

                            <div class="ratio ratio-16x9">
                                <img src="{{ $gambar }}" class="card-img-top object-fit-cover mb-0"
                                    alt="{{ $item->judul }}">
                            </div>
                            <div class="card-body">
                                <h5>{{ $item->judul }}</h5>
                                <small class="text-muted">{{ \Carbon\Carbon::parse($item->tanggal)->format('d M Y') }} -
                                    {{ $item->lokasi }}</small>
                                <p>{{ $item->deskripsi_pendek }}</p>
                                <a href="{{ route('kegiatan.show', $item->slug) }}">Selengkapnya</a>
                            </div>
                        </div>
                    </div>
                @empty
                    <p>Belum ada kegiatan yang terlaksana.</p>
                @endforelse
            </div>
        </div>
    </section>

    <section class="py-5 bg-light">
        <div class="container py-4">
            <h1>Data Ringkas Pramuka</h1>
            <div class="row row-cols-2 row-cols-md-3 g-4 text-center">
                <div class="col">
                    <div class="card border">
                        <div class="card-body">
                            <h1 class="text-success">{{ $jumlahGudep }}</h1>
                            <p class="mb-0">Gugus Depan</p>
                        </div>
                    </div>
                </div>
                <div class="col">
                    <div class="card border">
                        <div class="card-body">
                            <h1 class="text-primary">{{ $jumlahKwarran }}</h1>
                            <p class="mb-0">Kwarran</p>
                        </div>
                    </div>
                </div>
                <div class="col">
                    <div class="card border">
                        <div class="card-body">
                            <h1 class="text-warning">{{ $jumlahAnggotaAktif }}</h1>
                            <p class="mb-0">Anggota Aktif</p>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row text-center">
                @foreach ($anggotaPerGolongan as $golongan => $jumlah)
                    <div class="col-md-3">
                        <div class="card border mb-0">
                            <div class="card-body">
                                <h4 class="text-uppercase text-success">{{ ucfirst($golongan) }}</h4>
                                <h2>{{ $jumlah }}</h2>
                                <p class="mb-0">Anggota</p>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </section>

    <section class="py-5">
        <div class="container">
            <h1>Galeri Kegiatan Terbaru</h1>
            <div class="row row-cols-2 row-cols-md-4 g-4" data-masonry='{"percentPosition": true }'>
                @forelse ($galeri as $item)
                    <div class="col">
                        <img src="{{ asset('storage/' . $item->gambar) }}" class="img-fluid w-100" alt="Foto Kegiatan">
                    </div>
                @empty
                    <p>Tidak ada galeri kegiatan.</p>
                @endforelse
            </div>
        </div>
    </section>

    <section class="py-5">
        <div class="container">
            <h1 class="text-center">Apa Kata Mereka?</h1>
            <div id="testimoniCarousel" class="carousel slide" data-bs-ride="carousel">
                <div class="carousel-inner text-center">

                    <div class="carousel-item active">
                        <blockquote class="blockquote">
                            <p class="mb-3">"Gerakan Pramuka membentuk karakter saya sejak kecil untuk siap memimpin dan
                                siap melayani."</p>
                            <footer class="blockquote-footer">Anita Dewi <cite title="Asal">Pembina SMPN 2</cite>
                            </footer>
                        </blockquote>
                    </div>

                    <div class="carousel-item">
                        <blockquote class="blockquote">
                            <p class="mb-3">"Pramuka itu bukan hanya baris-berbaris, tapi tentang persaudaraan dan
                                pengabdian."</p>
                            <footer class="blockquote-footer">Fadli Akbar <cite title="Asal">Penegak Gudep 07-002</cite>
                            </footer>
                        </blockquote>
                    </div>

                    <div class="carousel-item">
                        <blockquote class="blockquote">
                            <p class="mb-3">"Saya bangga menjadi bagian dari Pramuka. Ini adalah tempat tumbuhnya
                                pemimpin
                                masa depan."</p>
                            <footer class="blockquote-footer">Yulia Rahayu <cite title="Asal">Alumni Pandega</cite>
                            </footer>
                        </blockquote>
                    </div>

                </div>

                <button class="carousel-control-prev" type="button" data-bs-target="#testimoniCarousel"
                    data-bs-slide="prev">
                    <span class="carousel-control-prev-icon"></span>
                </button>
                <button class="carousel-control-next" type="button" data-bs-target="#testimoniCarousel"
                    data-bs-slide="next">
                    <span class="carousel-control-next-icon"></span>
                </button>
            </div>
        </div>
    </section>
@endsection
