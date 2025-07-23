@extends('layouts.kwarcab')
@section('content')
    <div class="container-fluid">
        <div class="card">
            <div class="card-body">
                <h1>Kegiatan</h1>
                <a href="{{ route('kwarcab.kegiatan.create') }}" class="btn text-primary bg-primary-subtle rounded">Tambah
                    Kegiatan</a>
            </div>
        </div>
        @include('partials.footer')
    </div>
@endsection
