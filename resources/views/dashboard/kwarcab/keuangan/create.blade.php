@extends('layouts.kwarcab')
@section('title', 'Keuangan')

@section('content')
    <div class="container-fluid">
        <div class="card">
            <div class="card-body">
                <h1>Tambah Data Keuangan</h1>

                <form action="{{ route('kwarcab.keuangan.store') }}" method="POST">
                    @csrf

                    @include('dashboard.kwarcab.keuangan.form', ['keuangan' => null])

                    <button type="submit" class="btn btn-success">Simpan</button>
                    <a href="{{ route('kwarcab.keuangan.index') }}" class="btn btn-secondary">Kembali</a>
                </form>
            </div>
        </div>
        @include('partials.footer')
    </div>
@endsection
