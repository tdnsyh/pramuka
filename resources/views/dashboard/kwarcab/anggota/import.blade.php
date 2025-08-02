@extends('layouts.kwarcab')
@section('title', 'Import Anggota')

@section('content')
    <div class="container-fluid">
        <div class="card">
            <div class="card-body">
                <h1>Import Anggota</h1>
                <div class="mt-3">
                    <form action="{{ route('kwarcab.anggota.submit') }}" method="POST" enctype="multipart/form-data">
                        @csrf

                        <div class="mb-3">
                            <label for="region_id" class="form-label">Pilih Region</label>
                            <select name="region_id" id="region_id" class="form-select" required>
                                <option value="" disabled selected>-- Pilih Region --</option>
                                @foreach ($regions as $region)
                                    <option value="{{ $region->id }}">{{ $region->name }}</option>
                                @endforeach
                            </select>
                        </div>

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
