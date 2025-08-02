@extends('layouts.app')
@section('title', 'Detail Gudep')

@section('content')
    @include('partials.navbar')
    <div class="section py-4">
        <div class="container">
            <h1>{{ $gudep->name }}</h1>
            <p class="text-muted">Di bawah Kwarran: {{ $kwarran->name }}</p>

            @if ($about)
                <div class="row row-cols-1 row-cols-md-2 g-4">
                    <div class="col-md-7">
                        <div>{!! $about->isi !!}</div>
                    </div>
                    <div class="col-md-5">
                        @if ($about->logo)
                            <div class="mb-3">
                                <h3>Logo</h3>
                                <img src="{{ asset('storage/' . $about->logo) }}" alt="Logo"
                                    class="img-fluid rounded w-100">
                            </div>
                        @endif

                        @if ($about->foto)
                            <div class="mb-3">
                                <h3>Foto</h3>
                                <img src="{{ asset('storage/' . $about->foto) }}" alt="Foto"
                                    class="img-fluid w-100 rounded">
                            </div>
                        @endif
                    </div>
                </div>
            @else
                <p class="text-muted">Belum ada deskripsi gudep.</p>
            @endif
        </div>
    </div>
@endsection
