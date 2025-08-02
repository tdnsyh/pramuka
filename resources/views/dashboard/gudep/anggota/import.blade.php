@extends('layouts.gudep')
@section('title', 'Import Anggota')

@section('content')
    <div class="container-fluid">
        <div class="card">
            <div class="card-body">
                <h1>Import Anggota</h1>
                <div class="mt-3">
                    <form action="{{ route('gudep.anggota.import') }}" method="POST" enctype="multipart/form-data">
                        @csrf

                        <div class="mb-3">
                            <label for="file" class="form-label">Upload File Excel</label>
                            <input type="file" name="file" id="file" class="form-control" accept=".xlsx,.xls"
                                required>
                        </div>

                        <button type="submit" class="btn btn-primary">
                            <i class="bi bi-upload"></i> Import Anggota
                        </button>
                    </form>
                </div>
            </div>
        </div>
        @include('partials.footer')
    </div>
@endsection
