<div class="mb-3">
    <label>Nama</label>
    <input type="text" name="name" class="form-control" value="{{ old('name', $anggota->name ?? '') }}">
</div>
<div class="mb-3">
    <label>NTA</label>
    <input type="text" name="nta" class="form-control" value="{{ old('nta', $anggota->nta ?? '') }}">
</div>
<div class="mb-3">
    <label>Gudep</label>
    <select name="region_id" class="form-control">
        @foreach ($regions as $r)
            <option value="{{ $r->id }}"
                {{ old('region_id', $anggota->region_id ?? '') == $r->id ? 'selected' : '' }}>{{ $r->name }}
            </option>
        @endforeach
    </select>
</div>
<div class="mb-3">
    <label>Golongan</label>
    <select name="golongan" class="form-control">
        <option value="siaga" {{ old('golongan', $anggota->golongan ?? '') == 'siaga' ? 'selected' : '' }}>Siaga
        </option>
        <option value="penggalang" {{ old('golongan', $anggota->golongan ?? '') == 'penggalang' ? 'selected' : '' }}>
            Penggalang</option>
        <option value="penegak" {{ old('golongan', $anggota->golongan ?? '') == 'penegak' ? 'selected' : '' }}>Penegak
        </option>
        <option value="pandega" {{ old('golongan', $anggota->golongan ?? '') == 'pandega' ? 'selected' : '' }}>Pandega
        </option>
    </select>
</div>
<div class="mb-3">
    <label>Jabatan</label>
    <input type="text" name="jabatan" class="form-control" value="{{ old('jabatan', $anggota->jabatan ?? '') }}">
</div>
<div class="mb-3">
    <label>Status</label>
    <select name="status" class="form-control">
        <option value="aktif" {{ old('status', $anggota->status ?? '') == 'aktif' ? 'selected' : '' }}>Aktif</option>
        <option value="nonaktif" {{ old('status', $anggota->status ?? '') == 'nonaktif' ? 'selected' : '' }}>Nonaktif
        </option>
    </select>
</div>
<div class="mb-3">
    <label>Foto</label>
    <input type="file" name="foto" class="form-control">
    @if (!empty($anggota->foto))
        <img src="{{ asset('storage/' . $anggota->foto) }}" alt="" class="img-thumbnail mt-2" width="100">
    @endif
</div>
<button type="submit" class="btn btn-success">Simpan</button>
<a href="{{ url('/kwarran/anggota') }}" class="btn btn-secondary">Kembali</a>
