@extends('layouts.app')
@section('title', 'Daftar gudep')

@section('content')
    @include('partials.navbar')
    <div class="section py-4">
        <div class="container">
            <h1>Daftar Gudep</h1>
            <div class="mb-3">
                <p class="text-muted">
                    Berikut adalah daftar Gudep yang terdaftar. Setiap gudep memiliki informasi dasar.
                </p>
            </div>

            <div class="row row-cols-1 row-cols-md-4 g-4">
                @forelse ($gudeps as $gudep)
                    <div class="col">
                        <div class="card border mb-0">
                            <div class="ratio ratio-4x3">
                                <img src="{{ asset('storage/' . ($gudep->about->logo ?? 'assets/images/default.jpg')) }}"
                                    class="card-img-top object-fit-cover" alt="Logo {{ $gudep->name }}"
                                    onerror="this.onerror=null;this.src='{{ asset('assets/images/default.jpg') }}';">
                            </div>
                            <div class="card-body p-4">
                                <a href="{{ route('gudep.show', $gudep->name) }}">
                                    <h5 class="card-title">{{ $gudep->name }}</h5>
                                </a>

                                <p class="card-text text-muted mb-0">
                                    {{ Str::limit(strip_tags($gudep->about->isi ?? 'Belum ada deskripsi.'), 50) }}
                                </p>
                            </div>
                        </div>
                    </div>
                @empty
                    <div class="col-12">
                        <div class="alert alert-info">Belum ada data gudep.</div>
                    </div>
                @endforelse
            </div>
        </div>
    </div>
@endsection
