@extends('layouts.kwarcab')
@section('title', isset($kegiatan) ? 'Edit kegiatan' : 'Tambah kegiatan')

@section('content')
    <div class="container-fluid">
        <div class="card">
            <div class="card-body">
                <h1 class="mb-3">{{ isset($kegiatan) ? 'Edit kegiatan' : 'Tambah kegiatan' }}</h1>

                <form method="POST"
                    action="{{ isset($kegiatan) ? route('kwarcab.kegiatan.update', $kegiatan) : route('kwarcab.kegiatan.store') }}"
                    enctype="multipart/form-data" id="formKegiatan">
                    @csrf
                    @if (isset($kegiatan))
                        @method('PUT')
                    @endif
                    <div class="mb-3">
                        <label>Judul</label>
                        <input type="text" name="judul" class="form-control"
                            value="{{ old('judul', $kegiatan->judul ?? '') }}" required>
                    </div>

                    <div class="mb-3">
                        <label>Deskripsi Singkat</label>
                        <input type="text" name="deskripsi_pendek" class="form-control"
                            value="{{ old('deskripsi_pendek', $kegiatan->deskripsi_pendek ?? '') }}" required>
                    </div>

                    <div class="mb-3">
                        <label>Deskripsi</label>
                        <div id="editor" style="min-height: 200px;">{!! old('isi', $kegiatan->deskripsi ?? '') !!}</div>
                        <input type="hidden" name="deskripsi" id="deskripsi">
                    </div>

                    <div class="mb-3">
                        <label>Tanggal</label>
                        <input type="date" name="tanggal" class="form-control"
                            value="{{ old('tanggal', $kegiatan->tanggal ?? '') }}" required>
                    </div>

                    <div class="mb-3">
                        <label>Lokasi</label>
                        <input type="text" name="lokasi" class="form-control"
                            value="{{ old('lokasi', $kegiatan->lokasi ?? '') }}">
                    </div>

                    <div class="mb-3">
                        <label>Gambar (optional)</label>
                        <input type="file" name="gambar" class="form-control">
                    </div>

                    @if (isset($kegiatan) && $kegiatan->gambar)
                        <div class="mb-3">
                            <p>Gambar Saat Ini:</p>
                            <img src="{{ asset('storage/' . $kegiatan->gambar) }}" width="200" class="mb-3">
                        </div>
                    @endif
                    <button class="btn btn-success">{{ isset($kegiatan) ? 'Update' : 'Simpan' }}</button>
                    <a href="{{ route('kwarcab.kegiatan.index') }}" class="btn btn-secondary">Kembali</a>
                </form>
            </div>
        </div>
        @include('partials.footer')
    </div>
@endsection

@push('style')
    <link href="https://cdn.jsdelivr.net/npm/quill@2.0.3/dist/quill.snow.css" rel="stylesheet" />
@endpush

@push('script')
    <script src="https://cdn.jsdelivr.net/npm/quill@2.0.3/dist/quill.js"></script>
    <script src="{{ asset('assets/js/kegiatan.js') }}"></script>
@endpush
