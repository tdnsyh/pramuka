@extends('layouts.kwarran')
@section('content')
    <div class="container-fluid">
        <div class="card">
            <div class="card-body">
                <h1>Daftar Anggota Gudep</h1>
                <div class="d-flex gap-2">
                    <a href="{{ url('/kwarran/anggota/tambah') }}"
                        class="btn bg-primary-subtle text-primary rounded mt-2">Tambah
                        Anggota</a>
                    <a href="{{ url('/kwarran/anggota/') }}" class="btn bg-success-subtle text-success rounded mt-2">Import
                        Anggota</a>
                    <a href="{{ url('/kwarran/anggota/') }}" class="btn bg-info-subtle text-info rounded mt-2">Export
                        Anggota</a>
                </div>
                <div class="table-responsive mt-3">
                    <table class="table">
                        <thead class="table-primary border-0">
                            <tr>
                                <th>Nama</th>
                                <th>NTA</th>
                                <th>Gudep</th>
                                <th>Golongan</th>
                                <th>Status</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($anggota as $a)
                                <tr>
                                    <td>{{ $a->name }}</td>
                                    <td>{{ $a->nta }}</td>
                                    <td>{{ $a->region->name ?? '-' }}</td>
                                    <td>{{ $a->golongan }}</td>
                                    <td>{{ ucfirst($a->status) }}</td>
                                    <td>
                                        <a href="{{ url('/kwarran/anggota/' . $a->id . '/detail') }}"
                                            class="btn btn-info btn-sm">Detail</a>
                                        <a href="{{ url('/kwarran/anggota/' . $a->id . '/edit') }}"
                                            class="btn btn-warning btn-sm">Edit</a>
                                        <form action="{{ url('/kwarran/anggota/' . $a->id) }}" method="POST"
                                            style="display:inline;">
                                            @csrf @method('DELETE')
                                            <button class="btn btn-danger btn-sm"
                                                onclick="return confirm('Yakin ingin menghapus?')">Hapus</button>
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
