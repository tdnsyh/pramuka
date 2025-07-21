@extends('layouts.kwarcab')
@section('content')
    <div class="container-fluid">
        <div class="card">
            <div class="card-body">
                <h1>Daftar Wilayah</h1>
                <a href="/kwarcab/region/tambah" class="btn mt-2 bg-primary-subtle text-primary rounded">Tambah Wilayah</a>

                @if (session('success'))
                    <div class="alert alert-success mt-3">{{ session('success') }}</div>
                @endif
                <div class="table-responsive mt-3">
                    <table class="table">
                        <thead class="table-primary border-0">
                            <tr>
                                <th>Nama</th>
                                <th>Tipe</th>
                                <th>Induk</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($regions as $region)
                                <tr>
                                    <td>{{ $region->name }}</td>
                                    <td>{{ ucfirst($region->type) }}</td>
                                    <td>{{ $region->parent->name ?? '-' }}</td>
                                    <td>
                                        <a href="/kwarcab/region/{{ $region->id }}/edit"
                                            class="btn btn-warning btn-sm">Edit</a>
                                        <form action="/kwarcab/region/{{ $region->id }}" method="POST"
                                            style="display:inline-block">
                                            @csrf
                                            @method('DELETE')
                                            <button class="btn btn-danger btn-sm"
                                                onclick="return confirm('Yakin hapus?')">Hapus</button>
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
