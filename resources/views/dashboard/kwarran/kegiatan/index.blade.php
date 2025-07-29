@extends('layouts.kwarran')
@section('title', 'Daftar Kegiatan')

@section('content')
    <div class="container-fluid">
        <div class="card">
            <div class="card-body">
                <h1>Kegiatan</h1>
                <a href="{{ route('kwarran.kegiatan.create') }}" class="btn text-primary bg-primary-subtle rounded">Tambah
                    Kegiatan</a>
                <div class="mt-3">
                    @if ($kegiatan->isEmpty())
                        <div class="alert alert-warning" role="alert">
                            Belum ada data kegiatan.
                        </div>
                    @else
                        <div class="row row-cols-1 row-cols-md-3 g-4">
                            @foreach ($kegiatan as $k)
                                <div class="col">
                                    <div class="card border h-100">
                                        @if ($k->gambar)
                                            <div class="ratio ratio-16x9">
                                                <img src="{{ asset('storage/' . $k->gambar) }}"
                                                    class="card-img-top object-fit-cover" alt="{{ $k->judul }}">
                                            </div>
                                        @else
                                            <div
                                                class="ratio ratio-16x9 bg-secondary d-flex align-items-center justify-content-center text-white">
                                                <span class="fw-bold">Tidak ada gambar</span>
                                            </div>
                                        @endif

                                        <div class="card-body p-4 d-flex flex-column">
                                            <h4>{{ $k->judul }}</h4>
                                            <div class="mt-auto">
                                                <p class="mb-1"><strong>Tanggal:</strong>
                                                    {{ \Carbon\Carbon::parse($k->tanggal)->format('d M Y') }}</p>
                                                <p class="mb-1"><strong>Lokasi:</strong> {{ $k->lokasi }}</p>
                                                <div class="d-flex gap-2 mt-3">
                                                    <a href="{{ route('kwarran.kegiatan.show', $k) }}"
                                                        class="btn btn-info btn-sm" title="Lihat">
                                                        <i class="ti ti-eye"></i>
                                                    </a>
                                                    <a href="{{ route('kwarran.kegiatan.edit', $k) }}"
                                                        class="btn btn-warning btn-sm" title="Edit">
                                                        <i class="ti ti-pencil"></i>
                                                    </a>
                                                    <x-modal-hapus :id="$k->id" :judul="$k->judul" :route="route('kwarran.kegiatan.destroy', $k)"
                                                        :deskripsi="'Apakah Anda yakin ingin menghapus kegiatan ' .
                                                            e($k->judul)" />
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                        {{ $kegiatan->links() }}
                    @endif
                </div>
            </div>
        </div>
        @include('partials.footer')
    </div>
@endsection
