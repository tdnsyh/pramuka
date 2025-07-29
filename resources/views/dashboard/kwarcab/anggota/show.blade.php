@extends('layouts.kwarcab')
@section('title', 'Detail Anggota')

@section('content')
    <div class="container-fluid">
        <div class="card">
            <div class="card-body">
                <h1>Detail {{ $anggota->name }}</h1>
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
                        <th>Golongan</th>
                        <td>{{ $anggota->golongan }}</td>
                    </tr>
                    <tr>
                        <th>Jabatan</th>
                        <td>{{ $anggota->jabatan }}</td>
                    </tr>
                    <tr>
                        <th>Status</th>
                        <td>{{ ucfirst($anggota->status) }}</td>
                    </tr>
                    <tr>
                        <th>Wilayah</th>
                        <td>{{ $anggota->region->name ?? '-' }}</td>
                    </tr>
                    <tr>
                        <th>Foto</th>
                        <td>
                            @if ($anggota->foto)
                                <img src="{{ asset('storage/' . $anggota->foto) }}" width="120" class="img-thumbnail">
                            @else
                                Tidak ada foto
                            @endif
                        </td>
                    </tr>
                </table>
                <a href="{{ route('kwarcab.anggota.index') }}" class="btn btn-secondary">Kembali</a>
            </div>
        </div>
        @include('partials.footer')
    </div>
@endsection
