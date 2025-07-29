@extends('layouts.kwarran')
@section('title', 'Edit Gudep')

@section('content')
    <div class="container-fluid">
        <div class="card">
            <div class="card-body">
                <h4>Edit Gudep</h4>
                <form action="/kwarran/gudep/{{ $gudep->id }}" method="POST">
                    @csrf @method('PUT')
                    <div class="mb-3">
                        <label>Nama Gudep</label>
                        <input type="text" name="name" class="form-control" value="{{ $gudep->name }}" required>
                    </div>
                    <button class="btn btn-success">Update</button>
                    <a href="/kwarran/gudep" class="btn btn-secondary">Kembali</a>
                </form>
            </div>
        </div>
        @include('partials.footer')
    </div>
@endsection
