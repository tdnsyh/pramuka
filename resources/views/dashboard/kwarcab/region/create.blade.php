@extends('layouts.kwarcab')
@section('content')
    <div class="container-fluid">
        <div class="card">
            <div class="card-body">
                <h4>Tambah Wilayah</h4>

                <form method="POST" action="/kwarcab/region/">
                    @csrf

                    <div class="mb-3">
                        <label class="form-label">Nama Wilayah</label>
                        <input type="text" class="form-control" name="name" required>
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Tipe</label>
                        <select class="form-select" name="type" required>
                            <option value="kwarcab">Kwarcab</option>
                            <option value="kwarran">Kwarran</option>
                            <option value="gudep">Gudep</option>
                        </select>
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Induk (Opsional)</label>
                        <select class="form-select" name="parent_id">
                            <option value="">-- Tidak Ada --</option>
                            @foreach ($parents as $parent)
                                <option value="{{ $parent->id }}">{{ $parent->name }} ({{ $parent->type }})</option>
                            @endforeach
                        </select>
                    </div>

                    <button type="submit" class="btn btn-primary">Simpan</button>
                    <a href="/kwarcab/region" class="btn btn-secondary">Kembali</a>
                </form>
            </div>
        </div>
        @include('partials.footer')
    </div>
@endsection
