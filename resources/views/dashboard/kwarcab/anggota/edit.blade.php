@extends('layouts.kwarcab')
@section('title', 'Edit Anggota')

@section('content')
    <div class="container-fluid">
        <div class="card">
            <div class="card-body">
                <h1>Edit Anggota</h1>
                <form action="{{ route('kwarcab.anggota.update', $anggota->id) }}" method="POST"
                    enctype="multipart/form-data">
                    @csrf @method('PUT')
                    @include('dashboard.kwarcab.anggota._form', ['anggota' => $anggota])
                    <button type="submit" class="btn btn-primary">Update</button>
                </form>
            </div>
        </div>
        @include('partials.footer')
    </div>
@endsection
