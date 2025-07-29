@extends('layouts.kwarcab')
@section('title', 'Daftar Kegiatan')

@section('content')
    <div class="container-fluid">
        <div class="card">
            <div class="card-body">
                <h1>Kegiatan</h1>
                <a href="{{ route('kwarcab.kegiatan.create') }}" class="btn text-primary bg-primary-subtle rounded">Tambah
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
                                            <p class="mb-1">
                                                <span
                                                    class="badge text-bg-primary">{{ $k->region->name ?? 'Kwarcab' }}</span>
                                            </p>
                                            <h4>{{ $k->judul }}</h4>
                                            <div class="mt-auto">
                                                <p class="mb-1"><strong>Tanggal:</strong>
                                                    {{ \Carbon\Carbon::parse($k->tanggal)->format('d M Y') }}</p>
                                                <p class="mb-1"><strong>Lokasi:</strong> {{ $k->lokasi }}</p>
                                                <div class="d-flex gap-2 mt-3">
                                                    <a href="{{ route('kwarcab.kegiatan.show', $k) }}"
                                                        class="btn btn-info btn-sm" title="Lihat">
                                                        <i class="ti ti-eye"></i>
                                                    </a>
                                                    <a href="{{ route('kwarcab.kegiatan.edit', $k) }}"
                                                        class="btn btn-warning btn-sm" title="Edit">
                                                        <i class="ti ti-pencil"></i>
                                                    </a>
                                                    <x-modal-hapus :id="$k->id" :judul="$k->judul" :route="route('kwarcab.kegiatan.destroy', $k)"
                                                        :deskripsi="'Apakah Anda yakin ingin menghapus kegiatan ' .
                                                            e($k->judul)" />
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <!-- Modal Hapus -->
                                <div class="modal fade" id="modalHapus{{ $k->id }}" tabindex="-1"
                                    aria-labelledby="modalHapusLabel{{ $k->id }}" aria-hidden="true">
                                    <div class="modal-dialog">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title" id="modalHapusLabel{{ $k->id }}">Konfirmasi
                                                    Hapus</h5>
                                                <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                    aria-label="Tutup"></button>
                                            </div>
                                            <div class="modal-body">
                                                Apakah Anda yakin ingin menghapus kegiatan
                                                <strong>{{ $k->judul }}</strong>?
                                            </div>
                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-secondary"
                                                    data-bs-dismiss="modal">Batal</button>
                                                <form action="{{ route('kwarcab.kegiatan.destroy', $k) }}" method="POST"
                                                    class="d-inline">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="btn btn-danger">Hapus</button>
                                                </form>
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
