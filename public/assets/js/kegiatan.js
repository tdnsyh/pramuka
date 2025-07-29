// Inisialisasi editor Quill dan proses submit form
document.addEventListener('DOMContentLoaded', function () {
    const quill = new Quill('#editor', { theme: 'snow' });

    const form = document.getElementById('formKegiatan');
    form.addEventListener('submit', function () {
        const deskripsiInput = document.getElementById('deskripsi');
        deskripsiInput.value = quill.root.innerHTML;
    });
});
