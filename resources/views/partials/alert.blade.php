<link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/toastify-js/src/toastify.min.css">
<script type="text/javascript" src="https://cdn.jsdelivr.net/npm/toastify-js"></script>
@if (session('success'))
    <script>
        Toastify({
            text: "{{ session('success') }}",
            duration: 5000,
            close: true,
            gravity: "bottom",
            position: "right",
            backgroundColor: "#198754",
        }).showToast();
    </script>
@endif

@if (session('error'))
    <script>
        Toastify({
            text: "{{ session('error') }}",
            duration: 5000,
            close: true,
            gravity: "bottom",
            position: "right",
            backgroundColor: "#dc3545",
        }).showToast();
    </script>
@endif
