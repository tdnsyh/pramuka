<div class="mb-3">
    <label>Nama</label>
    <input type="text" name="name" class="form-control" value="{{ old('name', $anggota->name ?? '') }}" required>
</div>
<div class="mb-3">
    <label>NTA</label>
    <input type="text" name="nta" class="form-control" value="{{ old('nta', $anggota->nta ?? '') }}" required>
</div>
<div class="mb-3">
    <label>Wilayah</label>
    <select name="region_id" class="form-control" required>
        <option value="">Pilih Wilayah</option>
        @foreach ($regions as $r)
            <option value="{{ $r->id }}"
                {{ old('region_id', $anggota->region_id ?? '') == $r->id ? 'selected' : '' }}>{{ $r->name }}
            </option>
        @endforeach
    </select>
</div>
<div class="mb-3">
    <label>Golongan</label>
    <select name="golongan" class="form-control" required>
        <option value="">Pilih</option>
        @foreach (['siaga', 'penggalang', 'penegak', 'pandega'] as $g)
            <option value="{{ $g }}" {{ old('golongan', $anggota->golongan ?? '') == $g ? 'selected' : '' }}>
                {{ ucfirst($g) }}</option>
        @endforeach
    </select>
</div>
<div class="mb-3">
    <label>Pangkalan</label>
    <input type="text" name="pangkalan" class="form-control"
        value="{{ old('pangkalan', $anggota->pangkalan ?? '') }}" required>
</div>
<div class="mb-3">
    <label>Jabatan</label>
    <input type="text" name="jabatan" class="form-control" value="{{ old('jabatan', $anggota->jabatan ?? '') }}"
        required>
</div>
<div class="mb-3">
    <label>Status</label>
    <select name="status" class="form-control" required>
        <option value="aktif" {{ old('status', $anggota->status ?? '') == 'aktif' ? 'selected' : '' }}>Aktif</option>
        <option value="nonaktif" {{ old('status', $anggota->status ?? '') == 'nonaktif' ? 'selected' : '' }}>Nonaktif
        </option>
    </select>
</div>
<div class="mb-3">
    <label>Foto</label>
    <input type="file" name="foto" class="form-control">
    @if (!empty($anggota->foto))
        <img src="{{ asset('storage/' . $anggota->foto) }}" width="100" class="mt-2">
    @endif
</div>
