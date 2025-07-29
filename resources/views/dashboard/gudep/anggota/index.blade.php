@extends('layouts.gudep')
@section('title', 'Data Anggota')

@section('content')
    <div class="container-fluid">
        <div class="card">
            <div class="card-body">
                <h1>Data Anggota</h1>
                <a href="{{ route('gudep.anggota.create') }}" class="btn bg-primary-subtle text-primary mt-2 rounded">Tambah
                    Anggota</a>

                <div class="table-responsive mt-3">
                    <table class="table" id="table1">
                        <thead class="table-primary border-0">
                            <tr>
                                <th>Nama</th>
                                <th>NTA</th>
                                <th>Pangkalan</th>
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
                                    <td>{{ $a->pangkalan }}</td>
                                    <td>{{ ucfirst($a->golongan) }}</td>
                                    <td>{{ $a->jabatan }}</td>
                                    <td>{{ ucfirst($a->status) }}</td>
                                    <td>
                                        <a href="/gudep/anggota/{{ $a->id }}/detail"
                                            class="btn btn-info btn-sm">Detail</a>
                                        <a href="/gudep/anggota/{{ $a->id }}/edit"
                                            class="btn btn-warning btn-sm">Edit</a>
                                        <form action="/gudep/anggota/{{ $a->id }}" method="POST" class="d-inline"
                                            onsubmit="return confirm('Yakin hapus anggota ini?')">
                                            @csrf @method('DELETE')
                                            <button class="btn btn-danger btn-sm">Hapus</button>
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
