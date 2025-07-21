@extends('layouts.kwarcab')
@section('content')
    <div class="container-fluid">
        <div class="card">
            <div class="card-body">
                <h1>Daftar Anggota Kwarcab</h1>
                <div class="d-flex gap-2">
                    <a href="{{ route('kwarcab.anggota.create') }}" class="btn text-primary bg-primary-subtle rounded">Tambah
                        Anggota</a>
                    <a href="{{ url('/kwarcab/anggota/') }}" class="btn bg-success-subtle text-success rounded">Import
                        Anggota</a>
                    <a href="{{ url('/kwarcab/anggota/') }}" class="btn bg-info-subtle text-info rounded">Export
                        Anggota</a>
                </div>
                @if (session('success'))
                    <div class="alert alert-success mt-3">{{ session('success') }}</div>
                @endif
                <div class="table-responsive mt-3">
                    <table class="table">
                        <thead class="table-primary border-0">
                            <tr>
                                <th>Nama</th>
                                <th>NTA</th>
                                <th>Golongan</th>
                                <th>Jabatan</th>
                                <th>Status</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($anggota as $a)
                                <tr>
                                    <td>{{ $a->name }}</td>
                                    <td>{{ $a->nta }}</td>
                                    <td>{{ $a->golongan }}</td>
                                    <td>{{ $a->jabatan }}</td>
                                    <td>{{ ucfirst($a->status) }}</td>
                                    <td>
                                        <a href="{{ route('kwarcab.anggota.show', $a->id) }}"
                                            class="btn btn-info btn-sm">Detail</a>
                                        <a href="{{ route('kwarcab.anggota.edit', $a->id) }}"
                                            class="btn btn-warning btn-sm">Edit</a>
                                        <form action="{{ route('kwarcab.anggota.destroy', $a->id) }}" method="POST"
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
