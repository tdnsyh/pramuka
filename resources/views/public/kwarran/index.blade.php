@extends('layouts.app')
@section('title', 'Daftar Kwarran')

@section('content')
    @include('partials.navbar')
    <div class="section py-4">
        <div class="container">
            <h1>Daftar Kwarran</h1>
            <div class="mb-3">
                <p class="text-muted">
                    Berikut adalah daftar Kwarran yang terdaftar. Setiap kwarran memiliki informasi dasar wilayah dan satuan
                    gudep di bawahnya.
                </p>
            </div>

            <div class="row row-cols-1 row-cols-md-4 g-4">
                @forelse ($kwarrans as $kwarran)
                    <div class="col">
                        <div class="card border">
                            <div class="ratio ratio-4x3">
                                <img src="{{ asset('storage/' . ($kwarran->about->logo ?? 'images/default-logo.png')) }}"
                                    class="card-img-top object-fit-cover" alt="Logo {{ $kwarran->name }}"
                                    onerror="this.onerror=null;this.src='{{ asset('images/default-logo.png') }}';">
                            </div>
                            <div class="card-body p-4">
                                <a href="{{ route('kwarran.show', $kwarran->id) }}">
                                    <h5 class="card-title">{{ $kwarran->name }}</h5>
                                </a>

                                <p class="card-text text-muted mb-0">
                                    {{ Str::limit(strip_tags($kwarran->about->isi ?? 'Belum ada deskripsi.'), 50) }}
                                </p>
                            </div>
                        </div>
                    </div>
                @empty
                    <div class="col-12">
                        <div class="alert alert-info">Belum ada data kwarran.</div>
                    </div>
                @endforelse
            </div>
        </div>
    </div>
@endsection
