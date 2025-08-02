@extends('layouts.kwarran')
@section('title', 'Daftar Anggota')

@section('content')
    <div class="container-fluid">
        <div class="card">
            <div class="card-body">
                <h1>Daftar Anggota Gudep</h1>
                <div class="d-flex gap-2">
                    <a href="{{ route('kwarran.anggota.create') }}" class="btn btn-primary rounded">Tambah
                        Anggota</a>
                    <a href="{{ route('kwarran.anggota.import') }}" class="btn btn-success rounded">Import
                        Anggota</a>
                    <a href="{{ route('kwarran.anggota.export') }}" class="btn btn-warning rounded">Export
                        Anggota</a>
                </div>
                <div class="table-responsive mt-3">
                    <table class="table" id="table1">
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
                                        <a href="{{ route('kwarran.anggota.show', $a) }}" class="btn btn-info btn-sm"
                                            title="Lihat Detail">
                                            <i class="ti ti-eye"></i>
                                        </a>

                                        <a href="{{ route('kwarran.anggota.edit', $a) }}" class="btn btn-warning btn-sm"
                                            title="Edit Anggota">
                                            <i class="ti ti-pencil"></i>
                                        </a>
                                        <x-modal-hapus :id="$a->id" :judul="$a->name" :route="route('kwarran.anggota.destroy', $a)"
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
