@extends('layouts.kwarran')
@section('content')
    <div class="container-fluid">
        <div class="card">
            <div class="card-body">
                <h1>Daftar Akun Gudep</h1>
                <a href="/kwarran/pengguna/tambah" class="btn text-primary bg-primary-subtle rounded mt-2">Tambah Akun
                    Gudep</a>

                @if (session('success'))
                    <div class="alert alert-success mt-3">{{ session('success') }}</div>
                @endif

                <div class="table-responsive mt-3">
                    <table class="table">
                        <thead class="table-primary border-0">
                            <tr>
                                <th>Nama</th>
                                <th>Email</th>
                                <th>Wilayah</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($users as $u)
                                <tr>
                                    <td>{{ $u->name }}</td>
                                    <td>{{ $u->email }}</td>
                                    <td>{{ $u->region->name ?? '-' }}</td>
                                    <td>
                                        <a href="/kwarran/pengguna/{{ $u->id }}/edit"
                                            class="btn btn-warning btn-sm">Edit</a>
                                        <form action="/kwarran/pengguna/{{ $u->id }}" method="POST"
                                            style="display:inline;">
                                            @csrf @method('DELETE')
                                            <button class="btn btn-danger btn-sm"
                                                onclick="return confirm('Hapus akun ini?')">Hapus</button>
                                        </form>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
        @include('partials.footer')
    </div>
@endsection
