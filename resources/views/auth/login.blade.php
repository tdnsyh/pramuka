@extends('layouts.app')
@section('title', $title ?? '-')

@section('content')
    <div class="container d-flex justify-content-center align-items-center py-5">
        <div class="card border shadow-none col-md-4">
            <div class="card-body">
                <a href="/login" class="d-block mb-3 text-center">
                    <img src="https://images.seeklogo.com/logo-png/23/1/gerakan-pramuka-logo-png_seeklogo-234983.png"
                        class="border-0 rounded object-fit-cover" width="150" alt="Logo">
                </a>
                <h3 class="fw-semibold mt-3 mb-2 text-center">Selamat Datang!</h3>
                <p class="mb-4 text-center">Silakan login untuk mengakses sistem data anggota Pramuka</p>
                <form action="{{ route('login') }}" method="POST">
                    @csrf
                    <div class="mb-3 text-start">
                        <label for="email" class="form-label">Email</label>
                        <input type="email" class="form-control" id="email" name="email" required>
                    </div>
                    <div class="mb-3 text-start">
                        <label for="password" class="form-label">Kata Sandi</label>
                        <input type="password" class="form-control" id="password" name="password" required>
                    </div>
                    <button type="submit" class="btn btn-primary w-100 mb-3">Login</button>
                </form>
            </div>
        </div>
    </div>
@endsection
