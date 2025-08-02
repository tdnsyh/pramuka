@extends('layouts.app')
@section('title', $kwarran->name)

@section('content')
    @include('partials.navbar')
    <div class="section py-4">
        <div class="container">
            <h1>{{ $kwarran->name }}</h1>
            @if ($about)
                <div class="mt-3">
                    <div class="row row-cols-1 row-cols-md-2 g-4">
                        <div class="col-md-7">
                            <div>{!! $about->isi !!}</div>
                            <div class="mt-3">
                                <h3>Gudep di bawah {{ $kwarran->name }}:</h3>
                                <div class="row row-cols-2 row-cols-md-3 g-4">
                                    @forelse ($gudepList as $gudep)
                                        <div class="col">
                                            <div class="card border">
                                                <div class="ratio ratio-4x3">
                                                    <img src="{{ asset('storage/' . ($gudep->about->logo ?? 'images/default-logo.png')) }}"
                                                        class="card-img-top object-fit-cover" alt="Logo {{ $gudep->name }}"
                                                        onerror="this.onerror=null;this.src='{{ asset('images/default-logo.png') }}';">
                                                </div>
                                                <div class="card-body p-4">
                                                    <h5 class="card-title mb-2">{{ $gudep->name }}</h5>
                                                    <a href="{{ route('gudep.show', $gudep->id) }}"
                                                        class="btn btn-sm btn-outline-primary">
                                                        Lihat Detail
                                                    </a>
                                                </div>
                                            </div>
                                        </div>
                                    @empty
                                        <div class="col-12">
                                            <div class="alert alert-info">Tidak ada gudep terdaftar.</div>
                                        </div>
                                    @endforelse
                                </div>
                            </div>
                        </div>
                        <div class="col-md-5">
                            @if ($about->logo)
                                <div class="mb-3">
                                    <h3>Logo</h3>
                                    <img src="{{ asset('storage/' . $about->logo) }}" alt="Logo" class="w-100 rounded">
                                </div>
                            @endif

                            @if ($about->foto)
                                <div class="mb-3">
                                    <h3>Foto</h3>
                                    <img src="{{ asset('storage/' . $about->foto) }}" alt="Foto" class="w-100 rounded">
                                </div>
                            @endif
                        </div>
                    </div>
                </div>
            @else
                <p class="text-muted">Belum ada deskripsi wilayah.</p>
            @endif
        </div>
    </div>
@endsection
