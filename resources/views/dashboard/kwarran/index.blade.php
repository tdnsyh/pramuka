@extends('layouts.kwarran')
@section('title', 'Dashboard')

@section('content')
    <div class="container-fluid">
        <h1>Dashboard</h1>
        <div class="mt-3">
            <div class="row row-cols-1 row-cols-md-3">
                <div class="col">
                    <div class="card border">
                        <div class="card-body d-flex align-items-center">
                            <div class="me-3">
                                <span class="py-2 px-3 rounded bg-primary-subtle d-inline-block">
                                    <i class="ti ti-users h1 text-primary"></i>
                                </span>
                            </div>
                            <div>
                                <h4 class="mb-1">Total Anggota</h4>
                                <h2 class="mb-0">{{ $jumlahAnggota }}</h2>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col">
                    <div class="card border">
                        <div class="card-body d-flex align-items-center">
                            <div class="me-3">
                                <span class="py-2 px-3 rounded bg-success-subtle d-inline-block">
                                    <i class="ti ti-user-check h1 text-success"></i>
                                </span>
                            </div>
                            <div>
                                <h4 class="mb-1">Anggota Aktif</h4>
                                <h2 class="mb-0">{{ $jumlahAnggota }}</h2>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col">
                    <div class="card border">
                        <div class="card-body d-flex align-items-center">
                            <div class="me-3">
                                <span class="py-2 px-3 rounded bg-danger-subtle d-inline-block">
                                    <i class="ti ti-user-off h1 text-danger"></i>
                                </span>
                            </div>
                            <div>
                                <h4 class="mb-1">Anggota Nonaktif</h4>
                                <h2 class="mb-0">{{ $anggotaNonaktif }}</h2>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="row row-cols-1 row-cols-md-2">
                <div class="col-md-8">
                    <div class="card border">
                        <div class="card-body">
                            <h3>Grafik Pemasukan & Pengeluaran Tahun {{ now()->year }}</h3>
                            <div id="chart-keuangan"></div>
                        </div>
                    </div>
                    <div class="card">
                        <div class="card-body">
                            <h3>Riwayat Keuangan Terbaru</h3>
                            <div class="table-responsive">
                                <table class="table">
                                    <thead class="table-primary">
                                        <tr>
                                            <th class="rounded-start">#</th>
                                            <th>Tanggal</th>
                                            <th>Jenis</th>
                                            <th>Kategori</th>
                                            <th class="rounded-end">Jumlah</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($riwayatKeuangan as $index => $item)
                                            <tr>
                                                <td>{{ $index + 1 }}</td>
                                                <td>{{ \Carbon\Carbon::parse($item->tanggal)->format('d M Y') }}</td>
                                                <td>
                                                    <span
                                                        class="badge bg-{{ $item->jenis == 'pemasukan' ? 'success' : 'danger' }}">
                                                        {{ ucfirst($item->jenis) }}
                                                    </span>
                                                </td>
                                                <td>{{ $item->kategori }}</td>
                                                <td>Rp {{ number_format($item->jumlah, 2, ',', '.') }}</td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="card border">
                        <div class="card-body">
                            <h1 class="py-2 px-3 rounded text-info bg-info-subtle d-inline-block">
                                <i class="ti ti-users"></i>
                            </h1>
                            <h4>Saldo Kas</h4>
                            <h5 class="mb-0">Rp {{ number_format($saldo, 2, ',', '.') }}</h5>
                        </div>
                    </div>
                    <div class="card border">
                        <div class="card-body">
                            <h1 class="py-2 px-3 rounded text-success bg-success-subtle d-inline-block">
                                <i class="ti ti-arrow-down-circle"></i>
                            </h1>
                            <h4>Total Pengeluaran</h4>
                            <h5 class="mb-0">Rp {{ number_format($totalPengeluaran, 2, ',', '.') }}</h5>
                        </div>
                    </div>
                    <div class="card border">
                        <div class="card-body">
                            <h1 class="py-2 px-3 rounded text-danger bg-danger-subtle d-inline-block">
                                <i class="ti ti-arrow-up-circle"></i>
                            </h1>
                            <h4>Total Pemasukan</h4>
                            <h5 class="card-title">Rp {{ number_format($totalPemasukan, 2, ',', '.') }}</h5>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        @include('partials.footer')
    </div>
@endsection


@push('script')
    <script src="https://cdn.jsdelivr.net/npm/apexcharts"></script>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            var options = {
                chart: {
                    type: 'bar',
                    height: 350
                },
                series: [{
                    name: 'Pemasukan',
                    data: @json($pemasukanBulanan)
                }, {
                    name: 'Pengeluaran',
                    data: @json($pengeluaranBulanan)
                }],
                xaxis: {
                    categories: @json($months)
                },
                colors: ['#28a745', '#dc3545'],
                plotOptions: {
                    bar: {
                        horizontal: false,
                        columnWidth: '55%',
                        endingShape: 'rounded'
                    },
                },
                dataLabels: {
                    enabled: false
                },
            };

            var chart = new ApexCharts(document.querySelector("#chart-keuangan"), options);
            chart.render();
        });
    </script>
@endpush
