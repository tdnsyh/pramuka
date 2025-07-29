@extends('layouts.kwarran')
@section('title', 'Edit Anggota')

@section('content')
    <div class="container-fluid">
        <div class="card">
            <div class="card-body">
                <h1>Edit Anggota</h1>
                <form action="{{ url('/kwarran/anggota/' . $anggota->id) }}" method="POST" enctype="multipart/form-data">
                    @csrf @method('PUT')
                    @include('dashboard.kwarran.anggota._form')
                </form>
            </div>
        </div>
        @include('partials.footer')
    </div>
@endsection
