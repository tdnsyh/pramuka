@extends('layouts.app')
@section('title', 'Berhasil daftar')

@section('content')
    <section class="py-4">
        <div class="container">
            <h1 class="text-success fw-semibold">Pendaftaran Berhasil</h1>
            <p>Terima kasih telah mendaftar untuk kegiatan <strong>{{ $kegiatan->judul }}</strong>.</p>

            @if ($pendaftar)
                <div class="card border shadow-none">
                    <div class="card-body">
                        <h3 class="mb-3">Informasi Pendaftaran Anda</h3>
                        <p><strong>Nama:</strong> {{ $pendaftar->nama }}</p>
                        <p><strong>Asal:</strong> {{ $pendaftar->asal }}</p>
                        <p><strong>Asal Gudep:</strong> {{ $pendaftar->asal_gudep }}</p>
                        <p><strong>Kontak:</strong> {{ $pendaftar->kontak }}</p>
                        <p><strong>Jenis Kelamin:</strong>
                            {{ $pendaftar->jenis_kelamin == 'L' ? 'Laki-laki' : 'Perempuan' }}
                        </p>
                        <p><strong>Catatan:</strong> {{ $pendaftar->catatan ?? '-' }}</p>
                        <p><strong>Kode Registrasi:</strong></p>
                        <h1 class="py-2 px-3 rounded bg-success text-white d-inline-block">
                            {{ $pendaftar->kode_registrasi }}
                        </h1>
                    </div>
                </div>
            @endif
            <div class="alert alert-info mt-4">
                <h3><strong>Penting: Simpan Informasi Ini</strong></h3>
                <ol class="mb-2 ps-3">
                    <li><strong>Simpan kode registrasi Anda</strong>: Gunakan kode ini untuk konfirmasi atau bukti ke
                        panitia.</li>
                    <li><strong>Screenshot halaman ini</strong> sebagai cadangan jika kode hilang.</li>
                    <li>Jangan bagikan kode Anda ke orang lain, kecuali kepada panitia resmi kegiatan.</li>
                    <li>Jika Anda mengalami kendala, hubungi panitia melalui informasi kontak kegiatan.</li>
                </ol>
                <p class="text-muted mb-0"><small><em>Panitia tidak bertanggung jawab atas kehilangan data pendaftaran jika
                            kode tidak disimpan.</em></small></p>
            </div>
            <a href="{{ route('kegiatan.index') }}" class="btn btn-outline-primary rounded">Kembali ke Daftar Kegiatan</a>
        </div>
    </section>
@endsection
