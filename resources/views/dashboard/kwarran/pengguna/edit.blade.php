@extends('layouts.kwarran')
@section('title', 'Edit Pengguna')

@section('content')
    <div class="container-fluid">
        <div class="card">
            <div class="card-body">
                <h4>Edit Akun Gudep</h4>

                <form method="POST" action="/kwarran/pengguna/{{ $user->id }}">
                    @csrf @method('PUT')

                    <div class="mb-3">
                        <label>Nama</label>
                        <input type="text" name="name" value="{{ $user->name }}" class="form-control" required>
                    </div>

                    <div class="mb-3">
                        <label>Email</label>
                        <input type="email" name="email" value="{{ $user->email }}" class="form-control" required>
                    </div>

                    <div class="mb-3">
                        <label>Password Baru (opsional)</label>
                        <input type="password" name="password" class="form-control">
                    </div>

                    <div class="mb-3">
                        <label>Konfirmasi Password</label>
                        <input type="password" name="password_confirmation" class="form-control">
                    </div>

                    <div class="mb-3">
                        <label>Wilayah Gudep</label>
                        <select name="region_id" class="form-select" required>
                            @foreach ($regions as $r)
                                <option value="{{ $r->id }}" {{ $user->region_id == $r->id ? 'selected' : '' }}>
                                    {{ $r->name }}</option>
                            @endforeach
                        </select>
                    </div>

                    <button class="btn btn-success">Update</button>
                    <a href="/kwarran/users" class="btn btn-secondary">Kembali</a>
                </form>
            </div>
        </div>
        @include('partials.footer')
    </div>
@endsection
