@extends('layouts.kwarcab')
@section('title', 'Data Anggota')

@section('content')
    <div class="container-fluid">
        <div class="card">
            <div class="card-body">
                <h1>Daftar Anggota</h1>
                <div class="d-flex gap-2">
                    <a href="{{ route('kwarcab.anggota.create') }}" class="btn btn-primary rounded">Tambah
                        Anggota</a>
                    <a href="{{ route('kwarcab.anggota.import') }}" class="btn btn-success rounded">Import
                        Anggota</a>
                    <a href="{{ route('kwarcab.anggota.export') }}" class="btn btn-warning rounded">Export
                        Anggota</a>
                </div>
                @if (session('success'))
                    <div class="alert alert-success mt-3">{{ session('success') }}</div>
                @endif
                <div class="table-responsive mt-3">
                    <table class="table" id="table1">
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
                                        <a href="{{ route('kwarcab.anggota.show', $a) }}" class="btn btn-info btn-sm"
                                            title="Lihat Detail">
                                            <i class="ti ti-eye"></i>
                                        </a>

                                        <a href="{{ route('kwarcab.anggota.edit', $a) }}" class="btn btn-warning btn-sm"
                                            title="Edit Anggota">
                                            <i class="ti ti-pencil"></i>
                                        </a>
                                        <x-modal-hapus :id="$a->id" :judul="$a->name" :route="route('kwarcab.anggota.destroy', $a)"
                                            :deskripsi="'Apakah Anda yakin ingin menghapus anggota ' . e($a->name)" />
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
