@extends('layouts.gudep')
@section('title', 'Profil')

@section('content')
    <div class="container-fluid">
        <div class="card">
            <div class="card-body">
                <h1>Profil</h1>
                <div class="mt-3">
                    <div class="row row-cols-1 row-cols-md-2 g-4">
                        <div class="col">
                            <h4>Logo</h4>
                            @if (!empty($about->logo))
                                <img src="{{ asset('storage/' . $about->logo) }}" alt="Logo"
                                    class="img-fluid w-100 rounded">
                            @endif
                            <h4 class="mt-3">Foto Region</h4>
                            @if (!empty($about->foto))
                                <img src="{{ asset('storage/' . $about->foto) }}" alt="Foto"
                                    class="img-fluid w-100 rounded">
                            @endif
                        </div>
                        <div class="col">
                            <h3>Tentang Wilayah</h3>
                            <form action="{{ route('gudep.profil.about') }}" method="POST" enctype="multipart/form-data"
                                id="formTentang">
                                @csrf

                                <div class="mb-3">
                                    <label>Deskripsi</label>
                                    <div id="editor" style="min-height: 200px;">{!! old('isi', $about->isi ?? '') !!}</div>
                                    <input type="hidden" name="isi" id="isi">
                                </div>
                                <div class="mb-3">
                                    <label for="logo" class="form-label">Logo Wilayah</label>
                                    <input type="file" name="logo" id="logo" class="form-control">
                                </div>
                                <div class="mb-3">
                                    <label for="foto" class="form-label">Foto Wilayah</label>
                                    <input type="file" name="foto" id="foto" class="form-control">
                                </div>

                                <button type="submit" class="btn btn-primary">Simpan Profil Wilayah</button>
                            </form>
                            <div class="mt-3">
                                <h3>Akun</h3>
                                <form action="{{ route('gudep.profil.update') }}" method="POST">
                                    @csrf
                                    <div class="mb-3">
                                        <label class="form-label">Nama</label>
                                        <input type="text" name="name" class="form-control"
                                            value="{{ old('name', $user->name) }}">
                                        @error('name')
                                            <small class="text-danger">{{ $message }}</small>
                                        @enderror
                                    </div>

                                    <div class="mb-3">
                                        <label class="form-label">Email</label>
                                        <input type="email" name="email" class="form-control"
                                            value="{{ old('email', $user->email) }}">
                                        @error('email')
                                            <small class="text-danger">{{ $message }}</small>
                                        @enderror
                                    </div>

                                    <div class="mb-3">
                                        <label class="form-label">Password Baru (kosongkan jika tidak diubah)</label>
                                        <input type="password" name="password" class="form-control">
                                        @error('password')
                                            <small class="text-danger">{{ $message }}</small>
                                        @enderror
                                    </div>

                                    <div class="mb-3">
                                        <label class="form-label">Konfirmasi Password</label>
                                        <input type="password" name="password_confirmation" class="form-control">
                                    </div>

                                    <button type="submit" class="btn btn-primary">Simpan Perubahan</button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
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
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const quill = new Quill('#editor', {
                theme: 'snow'
            });

            const form = document.getElementById('formTentang');
            form.addEventListener('submit', function() {
                const deskripsiInput = document.getElementById('isi');
                deskripsiInput.value = quill.root.innerHTML;
            });
        });
    </script>
@endpush
