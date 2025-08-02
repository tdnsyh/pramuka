@extends('layouts.gudep')
@section('title', 'Keuangan')

@section('content')
    <div class="container-fluid">
        <div class="card">
            <div class="card-body">
                <h1>Edit Data Keuangan</h1>

                <form action="{{ route('gudep.keuangan.update', $keuangan->id) }}" method="POST">
                    @csrf
                    @method('PUT')

                    @include('dashboard.gudep.keuangan.form', ['keuangan' => $keuangan])

                    <button type="submit" class="btn btn-primary">Update</button>
                    <a href="{{ route('gudep.keuangan.index') }}" class="btn btn-secondary">Batal</a>
                </form>
            </div>
        </div>
        @include('partials.footer')
    </div>
@endsection
