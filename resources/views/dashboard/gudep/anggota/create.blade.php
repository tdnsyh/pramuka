@extends('layouts.gudep')
@section('content')
    <div class="container-fluid">
        <div class="card">
            <div class="card-body">
                <h4>Tambah Anggota</h4>
                <form action="{{ route('gudep.anggota.store') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="mb-3">
                        <label>Nama</label>
                        <input type="text" name="name" class="form-control" required>
                    </div>
                    <div class="mb-3">
                        <label>NTA</label>
                        <input type="text" name="nta" class="form-control" required>
                    </div>
                    <div class="mb-3">
                        <label>Pangkalan</label>
                        <input type="text" name="pangkalan" class="form-control" required>
                    </div>
                    <div class="mb-3">
                        <label>Golongan</label>
                        <select name="golongan" class="form-control" required>
                            <option value="">- Pilih -</option>
                            <option value="siaga">Siaga</option>
                            <option value="penggalang">Penggalang</option>
                            <option value="penegak">Penegak</option>
                            <option value="pandega">Pandega</option>
                        </select>
                    </div>
                    <div class="mb-3">
                        <label>Jabatan</label>
                        <input type="text" name="jabatan" class="form-control">
                    </div>
                    <div class="mb-3">
                        <label>Status</label>
                        <select name="status" class="form-control">
                            <option value="aktif">Aktif</option>
                            <option value="nonaktif">Nonaktif</option>
                        </select>
                    </div>
                    <div class="mb-3">
                        <label>Foto</label>
                        <input type="file" name="foto" class="form-control">
                    </div>
                    <button class="btn btn-primary">Simpan</button>
                    <a href="/gudep/anggota/" class="btn btn-outline-primary">Kembali</a>

                </form>
            </div>
        </div>
        @include('partials.footer')
    </div>
@endsection
