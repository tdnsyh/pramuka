@extends('layouts.gudep')
@section('title', 'Keuangan')

@section('content')
    <div class="container-fluid">
        <div class="card">
            <div class="card-body">
                <h1>Keuangan</h1>
                <a href="{{ route('gudep.keuangan.create') }}" class="btn btn-primary rounded">Tambah Transaksi</a>
                <div class="table-responsive mt-3">
                    <table class="table" id="table1">
                        <thead class="table-primary">
                            <tr>
                                <th>Tanggal</th>
                                <th>Jenis</th>
                                <th>Kategori</th>
                                <th>Jumlah</th>
                                <th>Keterangan</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($keuangan as $item)
                                <tr>
                                    <td>{{ $item->tanggal }}</td>
                                    <td><span
                                            class="badge bg-{{ $item->jenis == 'pemasukan' ? 'success' : 'danger' }}">{{ ucfirst($item->jenis) }}</span>
                                    </td>
                                    <td>{{ $item->kategori }}</td>
                                    <td>Rp {{ number_format($item->jumlah, 0, ',', '.') }}</td>
                                    <td>{{ $item->keterangan }}</td>
                                    <td>
                                        <a href="{{ route('gudep.keuangan.edit', $item->id) }}"
                                            class="btn btn-sm btn-warning">Edit</a>
                                        <form action="{{ route('gudep.keuangan.destroy', $item->id) }}" method="POST"
                                            style="display:inline" onsubmit="return confirm('Yakin ingin menghapus?')">
                                            @csrf
                                            @method('DELETE')
                                            <button class="btn btn-sm btn-danger">Hapus</button>
                                        </form>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="6" class="text-center">Belum ada data.</td>
                                </tr>
                            @endforelse
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
