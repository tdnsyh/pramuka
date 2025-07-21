@extends('layouts.gudep')
@section('content')
    <div class="container-fluid">
        <div class="card">
            <div class="card-body">
                <h1 class="mb-3">Detail Anggota</h1>
                <div class="row row-cols-1 row-cold-md-2 g-3">
                    <div class="col-md-4">
                        @if ($anggota->foto)
                            <img src="{{ asset('storage/' . $anggota->foto) }}" class="img-fluid w-100 rounded">
                        @else
                            <img src="{{ asset('images/default-avatar.png') }}" class="img-thumbnail">
                        @endif
                    </div>
                    <div class="col-md-8">
                        <table class="table">
                            <tr>
                                <th>Nama</th>
                                <td>{{ $anggota->name }}</td>
                            </tr>
                            <tr>
                                <th>NTA</th>
                                <td>{{ $anggota->nta }}</td>
                            </tr>
                            <tr>
                                <th>Pangkalan</th>
                                <td>{{ $anggota->pangkalan }}</td>
                            </tr>
                            <tr>
                                <th>Golongan</th>
                                <td>{{ ucfirst($anggota->golongan) }}</td>
                            </tr>
                            <tr>
                                <th>Jabatan</th>
                                <td>{{ $anggota->jabatan ?? '-' }}</td>
                            </tr>
                            <tr>
                                <th>Status</th>
                                <td>
                                    @if ($anggota->status === 'aktif')
                                        <span class="badge bg-success">Aktif</span>
                                    @else
                                        <span class="badge bg-secondary">Nonaktif</span>
                                    @endif
                                </td>
                            </tr>
                            <tr>
                                <th>Ditambahkan</th>
                                <td>{{ $anggota->created_at->format('d M Y H:i') }}</td>
                            </tr>
                            <tr>
                                <th>Terakhir diubah</th>
                                <td>{{ $anggota->updated_at->format('d M Y H:i') }}</td>
                            </tr>
                        </table>
                    </div>
                </div>
                <div class="mt-3">
                    <a href="/gudep/anggota" class="btn bg-secondary text-white rounded">Kembali</a>
                    <a href="/gudep/anggota/{{ $anggota->id }}/edit" class="btn bg-warning text-white rounded">Edit</a>
                </div>
            </div>
        </div>
        @include('partials.footer')
    </div>
@endsection
