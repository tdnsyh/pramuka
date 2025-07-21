@extends('layouts.kwarran')
@section('content')
    <div class="container-fluid">
        <div class="card">
            <div class="card-body">
                <h4>Tambah Akun Gudep</h4>

                <form method="POST" action="{{ route('kwarran.pengguna.store') }}">
                    @csrf

                    <div class="mb-3">
                        <label>Nama</label>
                        <input type="text" name="name" class="form-control" required>
                    </div>

                    <div class="mb-3">
                        <label>Email</label>
                        <input type="email" name="email" class="form-control" required>
                    </div>

                    <div class="mb-3">
                        <label>Password</label>
                        <input type="password" name="password" class="form-control" required>
                    </div>

                    <div class="mb-3">
                        <label>Konfirmasi Password</label>
                        <input type="password" name="password_confirmation" class="form-control" required>
                    </div>

                    <div class="mb-3">
                        <label>Pilih Gudep</label>
                        <select name="region_id" class="form-select" required>
                            <option value="">-- Pilih Gudep --</option>
                            @foreach ($regions as $r)
                                <option value="{{ $r->id }}">{{ $r->name }}</option>
                            @endforeach
                        </select>
                    </div>

                    <button class="btn btn-primary">Simpan</button>
                    <a href="/kwarran/pengguna" class="btn btn-secondary">Kembali</a>
                </form>
            </div>
        </div>
        @include('partials.footer')
    </div>
@endsection
