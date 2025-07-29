@extends('layouts.kwarran')
@section('title', $kegiatan->judul)

@section('content')
    <div class="container-fluid">
        <div class="card">
            <div class="card-body">
                <h1>{{ $kegiatan->judul }}</h1>

                <p class="mb-0 mt-3"><strong>Tanggal:</strong>
                    {{ \Carbon\Carbon::parse($kegiatan->tanggal)->format('d M Y') }}
                </p>
                <p class="mb-0"><strong>Lokasi:</strong> {{ $kegiatan->lokasi }}</p>
                <p class="mb-0"><strong>Deskripsi Singkat:</strong> {{ $kegiatan->deskripsi_pendek }}</p>
                <hr>
                <div>{!! $kegiatan->deskripsi !!}</div>
                <div class="mt-3">
                    <hr class="my-4">
                    <h5 class="mb-3">Tambah Gambar Galeri</h5>
                    <form action="{{ route('kwarran.kegiatan.galeri.store', $kegiatan->id) }}" method="POST"
                        enctype="multipart/form-data">
                        @csrf
                        <div class="mb-3">
                            <input type="file" name="gambar[]" class="form-control" multiple required>
                            <small class="text-muted">Pilih beberapa gambar sekaligus</small>
                        </div>
                        <button type="submit" class="btn btn-primary rounded">
                            <i class="ti ti-upload me-1"></i> Upload Gambar
                        </button>
                    </form>
                </div>
                <div class="mt-4">
                    @if ($kegiatan->galeri->count())
                        <div class="mb-4">
                            <h5>Galeri Kegiatan</h5>
                            <div class="row row-cols-2 row-cols-md-4 g-3" data-masonry='{"percentPosition": true }'>
                                @foreach ($kegiatan->galeri as $foto)
                                    <div class="col-6 col-md-3">
                                        <div class="position-relative border rounded overflow-hidden">
                                            <img src="{{ asset('storage/' . $foto->gambar) }}" class="img-fluid w-100">
                                            <form
                                                action="{{ route('kwarran.kegiatan.galeri.destroy', [$kegiatan->id, $foto->id]) }}"
                                                method="POST" class="position-absolute top-0 end-0 m-1">
                                                @csrf
                                                @method('DELETE')
                                                <button class="btn btn-sm btn-danger"
                                                    onclick="return confirm('Hapus gambar ini?')">
                                                    <i class="ti ti-trash"></i>
                                                </button>
                                            </form>
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                        </div>
                    @endif
                </div>

                <a href="{{ route('kwarran.kegiatan.index') }}" class="btn btn-outline-secondary rounded">Kembali</a>
            </div>
        </div>
        @include('partials.footer')
    </div>
@endsection

@push('script')
    <script src="https://cdn.jsdelivr.net/npm/masonry-layout@4.2.2/dist/masonry.pkgd.min.js"
        integrity="sha384-GNFwBvfVxBkLMJpYMOABq3c+d3KnQxudP/mGPkzpZSTYykLBNsZEnG2D9G/X/+7D" crossorigin="anonymous" async>
    </script>
@endpush
