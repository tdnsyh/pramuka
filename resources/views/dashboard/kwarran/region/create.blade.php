@extends('layouts.kwarran')
@section('content')
    <div class="container-fluid">
        <div class="card">
            <div class="card-body">
                <h1>Tambah Gudep</h1>
                <form action="/kwarran/region" method="POST">
                    @csrf
                    <div class="mb-3">
                        <label>Nama Gudep</label>
                        <input type="text" name="name" class="form-control" required>
                    </div>
                    <button class="btn btn-primary">Simpan</button>
                    <a href="/kwarran/region" class="btn btn-secondary">Kembali</a>
                </form>
            </div>
        </div>
        @include('partials.footer')
    </div>
@endsection
