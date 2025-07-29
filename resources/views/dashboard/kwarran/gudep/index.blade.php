@extends('layouts.kwarran')
@section('title', 'Daftar Gudep')

@section('content')
    <div class="container-fluid">
        <div class="card">
            <div class="card-body">
                <h1>Daftar Gudep</h1>
                <a href="{{ route('kwarran.gudep.create') }}" class="btn bg-primary-subtle text-primary rounded mt-2">Tambah
                    Gudep</a>

                @if (session('success'))
                    <div class="alert alert-success mt-3">{{ session('success') }}</div>
                @endif

                <div class="table-responsive mt-3">
                    <table class="table">
                        <thead class="table-primary border-0">
                            <tr>
                                <th>Nama Gudep</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($gudep as $item)
                                <tr>
                                    <td>{{ $item->name }}</td>
                                    <td>
                                        <a href="{{ route('kwarran.gudep.edit', $item) }}" class="btn btn-warning btn-sm"
                                            title="Edit Anggota">
                                            <i class="ti ti-pencil"></i>
                                        </a>
                                        <x-modal-hapus :id="$item->id" :judul="$item->name" :route="route('kwarran.gudep.destroy', $item)"
                                            :deskripsi="'Apakah Anda yakin ingin menghapus gudep ' . e($item->name)" />
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
