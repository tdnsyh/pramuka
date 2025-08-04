@extends('layouts.app')
@section('title', 'Daftar Kegiatan')

@section('content')
    @include('partials.navbar')
    <section class="py-4">
        <div class="container">
            <h1>Daftar Agenda yang akan datang</h1>
            <div class="mt-3">
                <div class="row row-cols-1 row-cols-md-4 g-4">
                    @foreach ($agenda as $item)
                        <div class="col">
                            <div class="card border h-100 shadow-sm">
                                @php
                                    $gambar = $item->gambar
                                        ? asset('storage/' . $item->gambar)
                                        : asset('assets/images/default.jpg');
                                @endphp

                                <div class="ratio ratio-16x9">
                                    <img src="{{ $gambar }}" class="card-img-top object-fit-cover mb-0"
                                        alt="{{ $item->judul }}"
                                        onerror="this.onerror=null;this.src='{{ asset('assets/images/default.jpg') }}';">
                                </div>
                                <div class="card-body p-4">
                                    <span class="badge text-bg-primary mb-2">{{ $item->region->type ?? '' }}
                                        {{ $item->region->name ?? 'Kwarcab' }}</span>
                                    <span class="badge text-bg-primary mb-2"></span>
                                    <a href="{{ route('kegiatan.show', $item->slug) }}">
                                        <h5 class="card-title">{{ $item->judul }}</h5>
                                    </a>
                                    <p class="card-text mb-0">{{ $item->deskripsi_pendek }}</p>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
    </section>

    <section class="py-4 kegiatan">
        <div class="container">
            <h1>Daftar Kegiatan</h1>
            <div class="mt-3">
                <div class="row row-cols-1 row-cols-md-4 g-4">
                    @foreach ($kegiatan as $item)
                        <div class="col">
                            <div class="card border h-100 shadow-sm">
                                @php
                                    $gambar = $item->gambar
                                        ? asset('storage/' . $item->gambar)
                                        : asset('assets/images/default.jpg');
                                @endphp

                                <div class="ratio ratio-16x9">
                                    <img src="{{ $gambar }}" class="card-img-top object-fit-cover mb-0"
                                        alt="{{ $item->judul }}"
                                        onerror="this.onerror=null;this.src='{{ asset('assets/images/default.jpg') }}';">
                                </div>
                                <div class="card-body p-4">
                                    <span class="badge text-bg-primary mb-2">{{ $item->region->type ?? '' }}
                                        {{ $item->region->name ?? 'Kwarcab' }}</span>
                                    <span class="badge text-bg-primary mb-2"></span>
                                    <a href="{{ route('kegiatan.show', $item->slug) }}">
                                        <h5 class="card-title">{{ $item->judul }}</h5>
                                    </a>
                                    <p class="card-text mb-0">{{ $item->deskripsi_pendek }}</p>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
    </section>
@endsection
