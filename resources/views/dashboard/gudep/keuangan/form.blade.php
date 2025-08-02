<div class="mb-3">
    <label>Jenis Transaksi</label>
    <select name="jenis" class="form-control" required>
        <option value="">-- Pilih --</option>
        <option value="pemasukan" {{ old('jenis', $keuangan->jenis ?? '') == 'pemasukan' ? 'selected' : '' }}>Pemasukan
        </option>
        <option value="pengeluaran" {{ old('jenis', $keuangan->jenis ?? '') == 'pengeluaran' ? 'selected' : '' }}>
            Pengeluaran</option>
    </select>
</div>

<div class="mb-3">
    <label>Kategori</label>
    <input type="text" name="kategori" class="form-control" value="{{ old('kategori', $keuangan->kategori ?? '') }}"
        required>
</div>

<div class="mb-3">
    <label>Jumlah</label>
    <input type="number" name="jumlah" class="form-control" value="{{ old('jumlah', $keuangan->jumlah ?? '') }}"
        required>
</div>

<div class="mb-3">
    <label>Tanggal</label>
    <input type="date" name="tanggal" class="form-control" value="{{ old('tanggal', $keuangan->tanggal ?? '') }}"
        required>
</div>

<div class="mb-3">
    <label>Keterangan</label>
    <textarea name="keterangan" class="form-control">{{ old('keterangan', $keuangan->keterangan ?? '') }}</textarea>
</div>
