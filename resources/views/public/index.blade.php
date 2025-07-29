@extends('layouts.app')
@section('title', 'Home')

@section('content')
    <div class="section py-4">
        <div class="container">
            <h1>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Velit amet doloremque atque id repellat fugit
                blanditiis commodi eius rerum expedita.</h1>
            <div class="mt-3">
                <a href="/login" class="btn btn-primary rounded">Login</a>
                <a href="/kegiatan" class="btn btn-info rounded">Kegiatan</a>
            </div>

            <div class="mt-3">
                <div class="col-md-4">
                    <img href="https://codetime.dev" alt="CodeTime Badge" class="w-100 rounded"
                        src="https://shields.jannchie.com/endpoint?style=flat-square&color=&url=https%3A%2F%2Fapi.codetime.dev%2Fv3%2Fusers%2Fshield%3Fuid%3D25401">
                </div>
            </div>
        </div>
    </div>
@endsection
