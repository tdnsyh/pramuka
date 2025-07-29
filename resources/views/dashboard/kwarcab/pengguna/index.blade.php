@extends('layouts.kwarcab')
@section('title', 'Daftar Pengguna')

@section('content')
    <div class="container-fluid">
        <div class="card">
            <div class="card-body">
                <h1>Pengguna sistem</h1>
                <a href="/kwarcab/pengguna/tambah" class="btn text-primary bg-primary-subtle mt-2 rounded">Tambah baru</a>
                <div class="table-responsive mt-3">
                    <table class="table" id="table1">
                        <thead class="table-primary border-0">
                            <tr>
                                <th>Nama</th>
                                <th>Email</th>
                                <th>Role</th>
                                <th>Wilayah</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($users as $user)
                                <tr>
                                    <td>{{ $user->name }}</td>
                                    <td>{{ $user->email }}</td>
                                    <td>{{ $user->role->name }}</td>
                                    <td>{{ $user->region->name ?? '-' }}</td>
                                    <td>
                                        <a href="/" class="btn btn-sm btn-info">Edit</a>
                                        <a href="/" class="btn btn-sm btn-danger">Hapus</a>
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
