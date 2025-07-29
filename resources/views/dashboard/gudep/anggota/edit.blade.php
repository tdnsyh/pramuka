@extends('layouts.gudep')
@section('title', 'Edit Anggota')

@section('content')
    <div class="container-fluid">
        <div class="card">
            <div class="card-body">
                <h4>Edit Anggota</h4>
                <form action="/gudep/anggota/{{ $anggota->id }}" method="POST" enctype="multipart/form-data">
                    @csrf @method('PUT')
                    <div class="mb-3">
                        <label>Nama</label>
                        <input type="text" name="name" class="form-control" value="{{ $anggota->name }}" required>
                    </div>
                    <div class="mb-3">
                        <label>NTA</label>
                        <input type="text" name="nta" class="form-control" value="{{ $anggota->nta }}" required>
                    </div>
                    <div class="mb-3">
                        <label>Pangkalan</label>
                        <input type="text" name="pangkalan" class="form-control" value="{{ $anggota->pangkalan }}"
                            required>
                    </div>
                    <div class="mb-3">
                        <label>Golongan</label>
                        <select name="golongan" class="form-control">
                            <option value="siaga" {{ $anggota->golongan == 'siaga' ? 'selected' : '' }}>Siaga</option>
                            <option value="penggalang" {{ $anggota->golongan == 'penggalang' ? 'selected' : '' }}>Penggalang
                            </option>
                            <option value="penegak" {{ $anggota->golongan == 'penegak' ? 'selected' : '' }}>Penegak</option>
                            <option value="pandega" {{ $anggota->golongan == 'pandega' ? 'selected' : '' }}>Pandega</option>
                        </select>
                    </div>
                    <div class="mb-3">
                        <label>Jabatan</label>
                        <input type="text" name="jabatan" class="form-control" value="{{ $anggota->jabatan }}">
                    </div>
                    <div class="mb-3">
                        <label>Status</label>
                        <select name="status" class="form-control">
                            <option value="aktif" {{ $anggota->status == 'aktif' ? 'selected' : '' }}>Aktif</option>
                            <option value="nonaktif" {{ $anggota->status == 'nonaktif' ? 'selected' : '' }}>Nonaktif
                            </option>
                        </select>
                    </div>
                    <div class="mb-3">
                        <label>Foto</label>
                        <input type="file" name="foto" class="form-control">
                        @if ($anggota->foto)
                            <img src="{{ asset('storage/' . $anggota->foto) }}" width="100" class="mt-2">
                        @endif
                    </div>
                    <button class="btn btn-success">Update</button>
                    <a href="/gudep/anggota/" class="btn btn-outline-primary">Kembali</a>
                </form>
            </div>
        </div>
        @include('partials.footer')
    </div>
@endsection
