@extends('layouts.app')
@section('title', 'Daftar Kegiatan')

@section('content')
    <section class="py-5">
        <div class="container">
            <h1>Daftar Kegiatan</h1>
            <div class="row row-cols-1 row-cols-md-4 g-4">
                @foreach ($kegiatan as $item)
                    <div class="col">
                        <div class="card border h-100 shadow-sm">
                            @if ($item->gambar)
                                <div class="ratio ratio-16x9">
                                    <img src="{{ asset('storage/' . $item->gambar) }}"
                                        class="card-img-top object-fit-cover mb-0" alt="{{ $item->judul }}">
                                </div>
                            @endif
                            <div class="card-body p-4">
                                <span class="badge text-bg-primary mb-2">{{ $item->region->name ?? 'Kwarcab' }}</span>
                                <a href="{{ route('kegiatan.show', $item->slug) }}">
                                    <h5 class="card-title">{{ $item->judul }}</h5>
                                </a>
                                <p class="card-text">{{ $item->deskripsi_pendek }}</p>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
            {{ $kegiatan->links() }}
        </div>
    </section>
@endsection
