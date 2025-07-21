@extends('layouts.kwarran')
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
                                        <a href="/kwarran/gudep/{{ $item->id }}/edit"
                                            class="btn btn-sm btn-warning">Edit</a>
                                        <form action="/kwarran/gudep/{{ $item->id }}" method="POST"
                                            style="display:inline;">
                                            @csrf @method('DELETE')
                                            <button type="submit" class="btn btn-sm btn-danger"
                                                onclick="return confirm('Hapus Gudep ini?')">Hapus</button>
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
