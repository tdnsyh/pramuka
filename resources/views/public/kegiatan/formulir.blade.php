@extends('layouts.app')
@section('title', 'Formulir pendaftaran kegiatan ' . $kegiatan->judul)

@section('content')
    @include('partials.navbar')
    <section class="py-4">
        <div class="container">
            <h2>Formulir Pendaftaran - {{ $kegiatan->judul }}</h2>
            <form action="{{ route('kegiatan.store', $kegiatan->slug) }}" method="POST">
                @csrf
                <div class="mb-3">
                    <label>Nama Lengkap</label>
                    <input type="text" name="nama" class="form-control" required>
                </div>
                <div class="mb-3">
                    <label>Asal Sekolah/Organisasi</label>
                    <input type="text" name="asal" class="form-control">
                </div>
                <div class="mb-3">
                    <label>Asal Gudep</label>
                    <input type="text" name="asal_gudep" class="form-control">
                </div>
                <div class="mb-3">
                    <label>Kontak (WA/Email)</label>
                    <input type="text" name="kontak" class="form-control">
                </div>
                <div class="mb-3">
                    <label>Jenis Kelamin</label>
                    <select name="jenis_kelamin" class="form-select">
                        <option value="">-- Pilih --</option>
                        <option value="L">Laki-laki</option>
                        <option value="P">Perempuan</option>
                    </select>
                </div>
                <div class="mb-3">
                    <label>Catatan Tambahan</label>
                    <textarea name="catatan" class="form-control" rows="3"></textarea>
                </div>
                <div class="alert alert-warning">
                    <h3><strong>Panduan Pendaftaran</strong></h3>
                    <ol class="mb-2 ps-3">
                        <li>Pastikan data yang Anda isi saat mendaftar adalah benar dan sesuai.</li>
                        <li>Setelah mendaftar, Anda akan mendapatkan <strong>kode registrasi</strong> yang unik.</li>
                        <li><strong>Catat atau screenshot kode registrasi</strong> tersebut sebagai bukti pendaftaran.</li>
                        <li>Gunakan kode registrasi tersebut jika Anda ingin mengonfirmasi atau mencetak ulang bukti
                            pendaftaran.</li>
                        <li>Jika ada kendala, hubungi panitia melalui kontak yang tersedia di pengumuman kegiatan.</li>
                    </ol>
                    <p class="text-muted mb-0"><small><em>Mohon simpan baik-baik informasi pendaftaran Anda.</em></small>
                    </p>
                </div>
                <button type="submit" class="btn btn-primary rounded">Kirim Pendaftaran</button>
                <a href="/kegiatan" class="btn btn-outline-secondary rounded">Kembali</a>
            </form>
        </div>
    </section>
@endsection
