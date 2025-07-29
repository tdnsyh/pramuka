@extends('layouts.kwarcab')
@section('title', 'Edit Wilayah')

@section('content')
    <div class="container-fluid">
        <div class="card">
            <div class="card-body">
                <h4>Edit Wilayah</h4>

                @if ($errors->any())
                    <div class="alert alert-danger">
                        <ul class="mb-0">
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif

                <form action="/kwarcab/wilayah/{{ $region->id }}" method="POST">
                    @csrf
                    @method('PUT')

                    <!-- Nama -->
                    <div class="mb-3">
                        <label for="name" class="form-label">Nama Wilayah</label>
                        <input type="text" class="form-control" id="name" name="name" value="{{ $region->name }}"
                            required>
                    </div>

                    <!-- Tipe -->
                    <div class="mb-3">
                        <label for="type" class="form-label">Tipe Wilayah</label>
                        <select class="form-select" id="type" name="type" required>
                            <option value="kwarcab" {{ $region->type === 'kwarcab' ? 'selected' : '' }}>Kwarcab</option>
                            <option value="kwarran" {{ $region->type === 'kwarran' ? 'selected' : '' }}>Kwarran</option>
                            <option value="gudep" {{ $region->type === 'gudep' ? 'selected' : '' }}>Gudep</option>
                        </select>
                    </div>

                    <!-- Parent -->
                    <div class="mb-3">
                        <label for="parent_id" class="form-label">Induk Wilayah (Opsional)</label>
                        <select class="form-select" id="parent_id" name="parent_id">
                            <option value="">-- Tidak Ada --</option>
                            @foreach ($parents as $parent)
                                <option value="{{ $parent->id }}"
                                    {{ $region->parent_id == $parent->id ? 'selected' : '' }}>
                                    {{ $parent->name }} ({{ ucfirst($parent->type) }})
                                </option>
                            @endforeach
                        </select>
                    </div>

                    <button type="submit" class="btn btn-primary">Update</button>
                    <a href="/kwarcab/wilayah" class="btn btn-secondary">Kembali</a>
                </form>
            </div>
        </div>
        @include('partials.footer')
    </div>
@endsection
