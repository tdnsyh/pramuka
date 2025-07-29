@extends('layouts.kwarran')
@section('title', 'Tambah Anggota')

@section('content')
    <div class="container-fluid">
        <div class="card">
            <div class="card-body">
                <h1>Tambah Anggota</h1>
                <form action="{{ url('/kwarran/anggota/simpan') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    @include('dashboard.kwarran.anggota._form')
                </form>
            </div>
        </div>
        @include('partials.footer')
    </div>
@endsection
