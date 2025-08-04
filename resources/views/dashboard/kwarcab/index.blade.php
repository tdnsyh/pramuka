@extends('layouts.kwarcab')
@section('title', 'Dashboard')

@section('content')
    <div class="container-fluid">
        <h1>Dashboard</h1>
        <div class="mt-3">
            <div class="row g-4">
                <div class="col-md-6">
                    <div class="card mb-0 border">
                        <div class="card-body gap-3">
                            <h1 class="py-2 px-3 rounded text-primary bg-primary-subtle d-inline-block">
                                <i class="ti ti-users"></i>
                            </h1>
                            <div>
                                <h5 class="text-primary mb-1">Total Anggota</h5>
                                <h1 class="mb-0">{{ $totalAnggota }}</h1>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="card mb-0 border">
                        <div class="card-body gap-3">
                            <h1 class="py-2 px-3 rounded text-success bg-success-subtle d-inline-block">
                                <i class="ti ti-user-check"></i>
                            </h1>
                            <div>
                                <h5 class="text-success mb-1">Aktif</h5>
                                <h1 class="mb-0">{{ $aktif }}</h1>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="card mb-0 border">
                        <div class="card-body gap-3">
                            <h1 class="py-2 px-3 rounded text-danger bg-danger-subtle d-inline-block">
                                <i class="ti ti-user-off"></i>
                            </h1>
                            <div>
                                <h5 class="text-danger mb-1">Nonaktif</h5>
                                <h1 class="mb-0">{{ $nonaktif }}</h1>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="mt-3">
            <h3>Statistik Keuangan Kwarcab</h3>
            <div class="row row-cols-1 row-cols-md-2 g-4">
                <div class="col">
                    <div class="card">
                        <div class="card-body">
                            <div id="chartPemasukan"></div>
                            <div class="d-flex align-items-center gap-3 mt-3">
                                <h1 class="py-2 px-3 rounded text-success bg-success-subtle d-inline-block">
                                    <i class="ti ti-currency-dollar"></i>
                                </h1>
                                <div>
                                    <h5 class="mb-1 text-success">Total Pemasukan</h5>
                                    <h5 class="card-title">Rp {{ number_format($totalPemasukan, 2, ',', '.') }}</h5>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="card">
                        <div class="card-body">
                            <div id="chartPengeluaran"></div>
                            <div class="d-flex align-items-center gap-3 mt-3">
                                <h1 class="py-2 px-3 rounded text-danger bg-danger-subtle d-inline-block">
                                    <i class="ti ti-receipt-2"></i>
                                </h1>
                                <div>
                                    <h5 class="mb-1 text-danger">Total Pengeluaran</h5>
                                    <h5 class="card-title">Rp {{ number_format($totalPengeluaran, 2, ',', '.') }}</h5>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col">
                    <div class="card border-primary">
                        <div class="card-body d-flex align-items-center gap-3">
                            <h1 class="py-2 px-3 rounded text-primary bg-primary-subtle d-inline-block">
                                <i class="ti ti-wallet"></i>
                            </h1>
                            <div>
                                <h5 class="mb-1 text-primary">Saldo</h5>
                                <h5 class="card-title">Rp {{ number_format($saldo, 2, ',', '.') }}</h5>
                            </div>
                        </div>
                    </div>
                    <div class="card border">
                        <div class="card-body">
                            <div id="keuanganRadialChart"></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="mt-4">
            <div class="row g-4">
                <div class="col-md-6">
                    <h3>Statistik Anggota</h3>
                    <div class="row row-cols-2 g-4">
                        <div class="col">
                            <div class="card border mb-0">
                                <div class="card-body d-flex align-items-center gap-3">
                                    <h1 class="py-2 px-3 rounded text-warning bg-warning-subtle d-inline-block">
                                        <i class="ti ti-star"></i>
                                    </h1>
                                    <div>
                                        <h5 class="text-warning mb-1">Siaga</h5>
                                        <h1>{{ $siaga }}</h1>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col">
                            <div class="card border mb-0">
                                <div class="card-body d-flex align-items-center gap-3">
                                    <h1 class="py-2 px-3 rounded text-info bg-info-subtle d-inline-block">
                                        <i class="ti ti-flag"></i>
                                    </h1>
                                    <div>
                                        <h5 class="text-info mb-1">Penggalang</h5>
                                        <h1>{{ $penggalang }}</h1>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col">
                            <div class="card border mb-0">
                                <div class="card-body d-flex align-items-center gap-3">
                                    <h1 class="py-2 px-3 rounded text-warning bg-warning-subtle d-inline-block">
                                        <i class="ti ti-award"></i>
                                    </h1>
                                    <div>
                                        <h5 class="text-warning mb-1">Penegak</h5>
                                        <h1>{{ $penegak }}</h1>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col">
                            <div class="card border mb-0">
                                <div class="card-body d-flex align-items-center gap-3">
                                    <h1 class="py-2 px-3 rounded text-danger bg-danger-subtle d-inline-block">
                                        <i class="ti ti-medal"></i>
                                    </h1>
                                    <div>
                                        <h5 class="text-danger mb-1">Pandega</h5>
                                        <h1>{{ $pandega }}</h1>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="mt-4">
                        <h3>Statistik Kegiatan</h3>
                        <div class="card border">
                            <div class="card-body d-flex align-items-center gap-3">
                                <h1 class="py-2 px-3 rounded text-cyan bg-cyan-subtle d-inline-block">
                                    <i class="ti ti-calendar-event"></i>
                                </h1>
                                <div>
                                    <h5 class="text-cyan mb-1">Total Kegiatan</h5>
                                    <h1>{{ $totalKegiatan }}</h1>
                                </div>
                            </div>
                        </div>
                        <div class="card border">
                            <div class="card-body d-flex align-items-center gap-3">
                                <h1 class="py-2 px-3 rounded text-teal bg-teal-subtle d-inline-block">
                                    <i class="ti ti-building-community"></i>
                                </h1>
                                <div>
                                    <h5 class="text-teal mb-1">Kegiatan Kwarcab</h5>
                                    <h1>{{ $kegiatanKwarcab }}</h1>
                                </div>
                            </div>
                        </div>
                        <div class="card border">
                            <div class="card-body d-flex align-items-center gap-3">
                                <h1 class="py-2 px-3 rounded text-lime bg-lime-subtle d-inline-block">
                                    <i class="ti ti-building-community"></i>
                                </h1>
                                <div>
                                    <h5 class="text-lime mb-1">Kegiatan Kwarran</h5>
                                    <h1>{{ $kegiatanKwarran }}</h1>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-6">
                    <h3>Statistik Wilayah</h3>
                    <div class="card border">
                        <div class="card-body">
                            <div id="regionChart"></div>
                        </div>
                    </div>
                    <div class="card border">
                        <div class="card-body d-flex align-items-center gap-3">
                            <h1 class="py-2 px-3 rounded text-info bg-info-subtle d-inline-block">
                                <i class="ti ti-map-pin"></i>
                            </h1>
                            <div>
                                <h5 class="text-info mb-1">Total Kwarran</h5>
                                <h1 class="fw-semibold mb-0">{{ $totalKwarran }}</h1>
                            </div>
                        </div>
                    </div>
                    <div class="card border mb-0">
                        <div class="card-body d-flex align-items-center gap-3">
                            <h1 class="py-2 px-3 rounded text-secondary bg-secondary-subtle d-inline-block">
                                <i class="ti ti-school"></i>
                            </h1>
                            <div>
                                <h5 class="text-secondary mb-1">Total Gudep</h5>
                                <h1 class="fw-semibold mb-0">{{ $totalGudep }}</h1>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        @include('partials.footer')
    </div>
@endsection

@push('script')
    <!-- Include ApexCharts -->
    <script src="https://cdn.jsdelivr.net/npm/apexcharts"></script>

    <script>
        document.addEventListener("DOMContentLoaded", function() {
            var options = {
                chart: {
                    type: 'pie'
                },
                labels: ['Kwarran', 'Gudep'],
                series: [{{ $totalKwarran }}, {{ $totalGudep }}],
                colors: ['#3b82f6', '#10b981'],
                title: {
                    text: 'Distribusi Wilayah Kwarran & Gudep',
                    align: 'center'
                },
                legend: {
                    position: 'bottom'
                }
            };

            var chart = new ApexCharts(document.querySelector("#regionChart"), options);
            chart.render();
        });
    </script>

    <script>
        document.addEventListener("DOMContentLoaded", function() {
            const totalPemasukan = {{ $totalPemasukan }};
            const totalPengeluaran = {{ $totalPengeluaran }};
            const saldo = {{ $saldo }};

            // Nilai maksimum untuk pembanding (bisa sesuaikan)
            const maxValue = Math.max(totalPemasukan, totalPengeluaran, saldo, 1); // minimal 1 agar tidak error

            const options = {
                chart: {
                    type: 'radialBar',
                    height: 320,
                    toolbar: {
                        show: false
                    }
                },
                series: [
                    Math.round((totalPemasukan / maxValue) * 100),
                    Math.round((totalPengeluaran / maxValue) * 100),
                    Math.round((saldo / maxValue) * 100)
                ],
                labels: ['Pemasukan', 'Pengeluaran', 'Saldo'],
                colors: ['#16a34a', '#dc2626', '#3b82f6'],
                plotOptions: {
                    radialBar: {
                        hollow: {
                            size: '30%'
                        },
                        dataLabels: {
                            name: {
                                fontSize: '14px'
                            },
                            value: {
                                fontSize: '16px',
                                formatter: function(val) {
                                    return val + '%';
                                }
                            }
                        }
                    }
                },
                tooltip: {
                    y: {
                        formatter: function(_, opts) {
                            const index = opts.seriesIndex;
                            const rawValues = [totalPemasukan, totalPengeluaran, saldo];
                            return 'Rp ' + new Intl.NumberFormat('id-ID').format(rawValues[index]);
                        }
                    }
                },
                legend: {
                    show: true,
                    position: 'bottom',
                    fontSize: '13px'
                }
            };

            new ApexCharts(document.querySelector("#keuanganRadialChart"), options).render();
        });
    </script>

    <script>
        document.addEventListener("DOMContentLoaded", function() {
            const bulanLabels = {!! json_encode($pemasukanBulanan->keys()) !!};
            const pemasukanData = {!! json_encode($pemasukanBulanan->values()) !!};
            const pengeluaranData = {!! json_encode($pengeluaranBulanan->values()) !!};

            const baseOptions = {
                chart: {
                    type: 'area',
                    height: 150,
                    sparkline: {
                        enabled: true
                    }
                },
                stroke: {
                    curve: 'smooth',
                    width: 2
                },
                fill: {
                    opacity: 0.2
                },
                tooltip: {
                    enabled: true,
                    y: {
                        formatter: val => 'Rp ' + new Intl.NumberFormat('id-ID').format(val)
                    }
                },
                xaxis: {
                    categories: bulanLabels
                }
            };

            new ApexCharts(document.querySelector("#chartPemasukan"), {
                ...baseOptions,
                series: [{
                    name: 'Pemasukan',
                    data: pemasukanData
                }],
                colors: ['#16a34a']
            }).render();

            new ApexCharts(document.querySelector("#chartPengeluaran"), {
                ...baseOptions,
                series: [{
                    name: 'Pengeluaran',
                    data: pengeluaranData
                }],
                colors: ['#dc2626']
            }).render();
        });
    </script>
@endpush
