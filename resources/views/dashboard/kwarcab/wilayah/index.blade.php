@extends('layouts.kwarcab')
@section('title', 'Daftar Wilayah')

@section('content')
    <div class="container-fluid">
        <div class="card">
            <div class="card-body">
                <h1>Daftar Wilayah</h1>
                <a href="/kwarcab/wilayah/tambah" class="btn mt-2 bg-primary-subtle text-primary rounded">Tambah Wilayah</a>

                @if (session('success'))
                    <div class="alert alert-success mt-3">{{ session('success') }}</div>
                @endif
                <div class="table-responsive mt-3">
                    <table class="table" id="table1">
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
                                        <a href="{{ route('kwarcab.wilayah.edit', $region) }}"
                                            class="btn btn-warning btn-sm" title="Edit Anggota">
                                            <i class="ti ti-pencil"></i>
                                        </a>
                                        <x-modal-hapus :id="$region->id" :judul="$region->name" :route="route('kwarcab.wilayah.destroy', $region)"
                                            :deskripsi="'Apakah Anda yakin ingin menghapus wilayah ' . e($region->name)" />
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

@push('script')
    <script src="{{ asset('assets/extensions/jquery/jquery.min.js') }}"></script>
    <script src="{{ asset('assets/extensions/datatables.net/js/jquery.dataTables.min.js') }}"></script>
    <script src="{{ asset('assets/extensions/datatables.net-bs5/js/dataTables.bootstrap5.min.js') }}"></script>
    <script src="{{ asset('assets/js/datatables.js') }}"></script>
@endpush

@push('style')
    <link rel="stylesheet" href="{{ asset('assets/extensions/datatables.net-bs5/css/dataTables.bootstrap5.min.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/table-datatable-jquery.css') }}">
@endpush
