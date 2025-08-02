@extends('layouts.kwarcab')
@section('title', 'Dashboard')

@section('content')
    <div class="container-fluid">
        <h1>Sample Page</h1>
        <div class="mt-3">
            <div class="row g-4">
                <div class="col-md-6">
                    <div class="card mb-0 border">
                        <div class="card-body">
                            <h4>Total Anggota</h4>
                            <h1>{{ $totalAnggota }}</h1>
                        </div>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="card border mb-0">
                        <div class="card-body">
                            <h4>Aktif</h4>
                            <h1>{{ $aktif }}</h1>
                        </div>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="card border mb-0">
                        <div class="card-body">
                            <h4>Nonaktif</h4>
                            <h1>{{ $nonaktif }}</h1>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="mt-4">
            <h3>Statistik Wilayah</h3>
            <div class="row g-4">
                <div class="col-md-3">
                    <div class="card mb-0 border">
                        <div class="card-body">
                            <h4>Total Kwarran</h4>
                            <h1 class="fw-semibold mb-0">{{ $totalKwarran }}</h1>
                        </div>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="card mb-0 border">
                        <div class="card-body">
                            <h4>Total Gudep</h4>
                            <h1 class="fw-semibold mb-0">{{ $totalGudep }}</h1>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="mt-4">
            <h3>Statistik Anggota</h3>
            <div class="row row-cols-2 row-cols-md-4 g-4">
                <div class="col">
                    <div class="card border mb-0">
                        <div class="card-body">
                            <h4>Siaga</h4>
                            <h1>{{ $siaga }}</h1>
                        </div>
                    </div>
                </div>
                <div class="col">
                    <div class="card border mb-0">
                        <div class="card-body">
                            <h4>Penggalang</h4>
                            <h1>{{ $penggalang }}</h1>
                        </div>
                    </div>
                </div>
                <div class="col">
                    <div class="card border mb-0">
                        <div class="card-body">
                            <h4>Penegak</h4>
                            <h1>{{ $penegak }}</h1>
                        </div>
                    </div>
                </div>
                <div class="col">
                    <div class="card border mb-0">
                        <div class="card-body">
                            <h4>Pandega</h4>
                            <h1>{{ $pandega }}</h1>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="mt-4">
            <h3>Statistik Kegiatan</h3>
            <div class="row g-4">
                <div class="col-md-4">
                    <div class="card border mb-0">
                        <div class="card-body">
                            <h3>Total Kegiatan
                                <h1 class="card-title">{{ $totalKegiatan }}</h1>
                        </div>
                    </div>
                </div>

                <div class="col-md-4">
                    <div class="card border mb-0">
                        <div class="card-body">
                            <div class="h3">Kegiatan Kwarcab</div>
                            <h1 class="card-title">{{ $kegiatanKwarcab }}</h5>
                        </div>
                    </div>
                </div>

                <div class="col-md-4">
                    <div class="card border mb-0">
                        <div class="card-body">
                            <div class="h3">Kegiatan Kwarran</div>
                            <h5 class="card-title">{{ $kegiatanKwarran }}</h5>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="mt-4">
            <div class="row">
                <div class="col-md-12">
                    <h3>Statistik Keuangan Kwarcab</h3>
                </div>

                <div class="col-md-4">
                    <div class="card border-success mb-3">
                        <div class="card-header">Total Pemasukan</div>
                        <div class="card-body text-success">
                            <h5 class="card-title">Rp {{ number_format($totalPemasukan, 2, ',', '.') }}</h5>
                        </div>
                    </div>
                </div>

                <div class="col-md-4">
                    <div class="card border-danger mb-3">
                        <div class="card-header">Total Pengeluaran</div>
                        <div class="card-body text-danger">
                            <h5 class="card-title">Rp {{ number_format($totalPengeluaran, 2, ',', '.') }}</h5>
                        </div>
                    </div>
                </div>

                <div class="col-md-4">
                    <div class="card border-primary mb-3">
                        <div class="card-header">Saldo</div>
                        <div class="card-body text-primary">
                            <h5 class="card-title">Rp {{ number_format($saldo, 2, ',', '.') }}</h5>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    @include('partials.footer')
    </div>
@endsection
