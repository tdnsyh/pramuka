@extends('layouts.kwarran')
@section('title', 'Import Anggota')

@section('content')
    <div class="container-fluid">
        <div class="card">
            <div class="card-body">
                <h1>Import Anggota</h1>
                <div class="mt-3">
                    <form action="{{ route('kwarran.anggota.import') }}" method="POST" enctype="multipart/form-data">
                        @csrf

                        <div class="mb-3">
                            <label for="region_id" class="form-label">Pilih Wilayah (Anak dari Kwarcab)</label>
                            <select name="region_id" id="region_id" class="form-select" required>
                                <option disabled selected>-- Pilih Region --</option>
                                @forelse ($regions as $region)
                                    <option value="{{ $region->id }}">{{ $region->name }} ({{ $region->type }})</option>
                                @empty
                                    <option disabled>Tidak ada region anak</option>
                                @endforelse
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
