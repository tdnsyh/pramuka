@extends('layouts.app')
@section('title', $kegiatan->judul)
@php
    $start = \Carbon\Carbon::parse($kegiatan->tanggal)->format('Ymd');
    $end = \Carbon\Carbon::parse($kegiatan->tanggal)->addDay()->format('Ymd');
    $link =
        'https://www.google.com/calendar/render?action=TEMPLATE' .
        '&text=' .
        urlencode($kegiatan->judul) .
        '&dates=' .
        $start .
        '/' .
        $end .
        '&details=' .
        urlencode($kegiatan->deskripsi_pendek) .
        '&location=' .
        urlencode($kegiatan->lokasi);
@endphp
@section('content')
    @include('partials.navbar')
    <section class="py-4">
        <div class="container">
            <div class="row row-cols-1 row-cols-md-2 g-4">
                <div class="col-md-8">
                    <h1 class="mb-3">{{ $kegiatan->judul }}</h1>

                    @if ($kegiatan->gambar)
                        <img src="{{ asset('storage/' . $kegiatan->gambar) }}" class="img-fluid rounded mb-4 shadow-sm"
                            alt="{{ $kegiatan->judul }}">
                    @endif

                    <div class="rounded border p-4 bg-light">
                        <div class="row row-cols-2 row-cols-md-4 g-3 mb-0">
                            <div class="col">
                                <p class="text-muted mb-1">
                                    <i class="ti ti-building-community me-1"></i> Penyelenggara
                                </p>
                                <h5 class="mb-0">{{ $kegiatan->region->name ?? 'Kwarcab' }}</h5>
                            </div>

                            <div class="col">
                                <p class="text-muted mb-1">
                                    <i class="ti ti-calendar-event me-1"></i> Waktu
                                </p>
                                <h5 class="mb-0">{{ \Carbon\Carbon::parse($kegiatan->tanggal)->format('d M Y') }}</h5>
                            </div>

                            <div class="col">
                                <p class="text-muted mb-1">
                                    <i class="ti ti-map-pin me-1"></i> Lokasi
                                </p>
                                <h5 class="mb-0">{{ $kegiatan->lokasi }}</h5>
                            </div>

                            <div class="col">
                                <p class="text-muted mb-1">
                                    <i class="ti ti-users me-1"></i> Pendaftar
                                </p>
                                <h5 class="mb-0">{{ $kegiatan->pendaftaran_count }} orang</h5>
                            </div>
                        </div>
                    </div>

                    <div class="py-4">
                        {!! $kegiatan->deskripsi !!}
                    </div>

                    @if ($kegiatan->galeri->count())
                        <hr class="my-4">
                        <h2 class="mb-3">Galeri Kegiatan</h2>

                        <div class="row row-cols-2 row-cols-md-4 g-3" data-masonry='{"percentPosition": true }'>
                            @foreach ($kegiatan->galeri as $foto)
                                <div class="col">
                                    <img src="{{ asset('storage/' . $foto->gambar) }}" class="img-fluid w-100 rounded">
                                </div>
                            @endforeach
                        </div>
                    @endif

                    <div class="mt-4">
                        @if (\Carbon\Carbon::parse($kegiatan->tanggal)->isFuture())
                            <hr class="my-4">
                            <a href="{{ route('kegiatan.registrasi', $kegiatan->slug) }}"
                                class="btn btn-success rounded px-4 py-2">
                                <i class="ti ti-checklist me-2"></i> Daftar Sekarang
                            </a>

                            <a href="{{ $link }}" target="_blank" class="btn btn-primary rounded">
                                Tambahkan ke Google Calendar
                            </a>
                        @endif
                    </div>
                </div>
                <div class="col-md-4"></div>
            </div>
        </div>
    </section>
@endsection

@push('script')
    <script src="https://cdn.jsdelivr.net/npm/masonry-layout@4.2.2/dist/masonry.pkgd.min.js"
        integrity="sha384-GNFwBvfVxBkLMJpYMOABq3c+d3KnQxudP/mGPkzpZSTYykLBNsZEnG2D9G/X/+7D" crossorigin="anonymous" async>
    </script>
@endpush
