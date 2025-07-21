@extends('layouts.app')
@section('title', $title ?? '-')

@section('content')
    <div class="row row-cols-1 row-cols-md-2 w-100 min-vh-100 g-0">
        <div class="col-md-5 col bg-white d-flex align-items-center min-vh-100">
            <div class="px-5">
                <a href="/register" class="d-block mb-3">
                    <img src="https://sman4-tsm.sch.id/wp-content/uploads/2025/04/WhatsApp-Image-2025-04-30-at-09.55.41-600x450.jpeg"
                        class="border-0 rounded object-fit-cover" width="150" alt="Logo">
                </a>
                <h3 class="fw-semibold">Pengguna baru?</h3>
                <p>Buat akun sekarang dan mulai kelola pemesanan part dengan cepat dan mudah.</p>
                <form action="{{ route('register') }}" method="POST">
                    @csrf
                    <div class="mb-3">
                        <label for="name" class="form-label">Nama</label>
                        <input type="text" class="form-control" id="name" name="name" required>
                    </div>
                    <div class="mb-3">
                        <label for="email" class="form-label">Email</label>
                        <input type="email" class="form-control" id="email" name="email" required>
                    </div>
                    <div class="row row-cols-1 row-cols-md-2">
                        <div class="col">
                            <div class="mb-3">
                                <label for="password" class="form-label">Kata sandi</label>
                                <input type="password" class="form-control" id="password" name="password" required>
                            </div>
                        </div>
                        <div class="col">
                            <div class="mb-3">
                                <label for="password_confirmation" class="form-label">Konfirmasi
                                    kata sandi</label>
                                <input type="password" class="form-control" id="password_confirmation"
                                    name="password_confirmation" required>
                            </div>
                        </div>
                    </div>
                    <button type="submit" class="btn btn-success w-100 shadow-none">Register</button>
                    <div class="mt-2">
                        <p>
                            Sudah punya akun? <a href="{{ route('login') }}" class="text-decoration-none">Masuk
                                disini!</a>
                        </p>
                    </div>
                </form>
            </div>
        </div>
        <div class="col-md-7 bg-success col">

        </div>
    </div>
@endsection
