@extends('layouts.kwarcab')
@section('title', 'Tambah Anggota')

@section('content')
    <div class="container-fluid">
        <div class="card">
            <div class="card-body">
                <h1>Tambah Anggota</h1>
                <form action="{{ route('kwarcab.anggota.store') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    @include('dashboard.kwarcab.anggota._form')
                    <button type="submit" class="btn btn-primary">Simpan</button>
                </form>
            </div>
        </div>
        @include('partials.footer')
    </div>
@endsection
