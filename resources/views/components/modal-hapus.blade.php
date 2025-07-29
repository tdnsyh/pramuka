@props(['id', 'judul', 'deskripsi' => 'Apakah Anda yakin ingin menghapus ini?', 'route'])

<button type="button" {{ $attributes->merge(['class' => 'btn btn-danger btn-sm']) }} title="Hapus" data-bs-toggle="modal"
    data-bs-target="#modalHapus{{ $id }}">
    <i class="ti ti-trash"></i>
</button>

<div class="modal fade" id="modalHapus{{ $id }}" tabindex="-1"
    aria-labelledby="modalHapusLabel{{ $id }}" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="modalHapusLabel{{ $id }}">Konfirmasi Hapus</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Tutup"></button>
            </div>
            <div class="modal-body">
                {!! $deskripsi !!}
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                <form action="{{ $route }}" method="POST" class="d-inline">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn btn-danger">Hapus</button>
                </form>
            </div>
        </div>
    </div>
</div>
