@extends('layouts.kwarran')
@section('content')
    <div class="container-fluid">
        <div class="card">
            <div class="card-body">
                <h1>Detail {{ $anggota->name }}</h1>
                <div class="row mt-3">
                    <div class="col-md-4">
                        <img src="{{ asset('storage/' . $anggota->foto) }}" class="img-fluid w-100 rounded" alt="Foto">
                    </div>
                    <div class="col-md-8">
                        <p><strong>Nama:</strong> {{ $anggota->name }}</p>
                        <p><strong>NTA:</strong> {{ $anggota->nta }}</p>
                        <p><strong>Gudep:</strong> {{ $anggota->region->name ?? '-' }}</p>
                        <p><strong>Golongan:</strong> {{ $anggota->golongan }}</p>
                        <p><strong>Jabatan:</strong> {{ $anggota->jabatan }}</p>
                        <p><strong>Status:</strong> {{ ucfirst($anggota->status) }}</p>
                    </div>
                </div>
                <a href="/kwarran/anggota" class="btn btn-outline-primary mt-3">Kembali</a>
            </div>
        </div>
        @include('partials.footer')
    </div>
@endsection
