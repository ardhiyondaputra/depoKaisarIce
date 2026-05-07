@extends('layouts.app')

@section('content')

<div class="container-fluid py-4 px-3"
     style="background-color: #f8f9fc; min-height: 100vh;">

    <div class="row">

        {{-- SIDEBAR --}}
        @include('layouts.sidebar')

        <div class="col-md-9 col-lg-10 ps-md-4"
     style="margin-left: 16.666667%;">

            {{-- TOPBAR --}}
            @include('layouts.topbar')

            {{-- ================= CARD ================= --}}
            <div class="row g-4 mb-4">

                {{-- STOK --}}
                <div class="col-md-3">

                    <div class="card border-0 shadow-sm rounded-4 p-4 bg-white h-100">

                        <div class="text-muted small fw-bold text-uppercase mb-3">

                            Total Stok

                        </div>

                        <h2 class="fw-bold text-primary m-0">

                            {{ $totalStok }}

                        </h2>

                        <small class="text-muted">
                            Total stok es tersedia
                        </small>

                    </div>

                </div>

                {{-- BARANG MASUK --}}
                <div class="col-md-3">

                    <div class="card border-0 shadow-sm rounded-4 p-4 bg-white h-100">

                        <div class="text-muted small fw-bold text-uppercase mb-3">

                            Barang Masuk Hari Ini

                        </div>

                        <h2 class="fw-bold text-success m-0">

                            {{ $barangMasukHariIni }}

                        </h2>

                        <small class="text-muted">
                            Transaksi barang masuk
                        </small>

                    </div>

                </div>

                {{-- DISTRIBUSI --}}
                <div class="col-md-3">

                    <div class="card border-0 shadow-sm rounded-4 p-4 bg-white h-100">

                        <div class="text-muted small fw-bold text-uppercase mb-3">

                            Distribusi Hari Ini

                        </div>

                        <h2 class="fw-bold text-danger m-0">

                            {{ $distribusiHariIni }}

                        </h2>

                        <small class="text-muted">
                            Distribusi hari ini
                        </small>

                    </div>

                </div>

                {{-- PENDING --}}
                <div class="col-md-3">

                    <div class="card border-0 shadow-sm rounded-4 p-4 bg-white h-100">

                        <div class="text-muted small fw-bold text-uppercase mb-3">

                            Distribusi Pending

                        </div>

                        <h2 class="fw-bold text-warning m-0">

                            {{ $distribusiPending }}

                        </h2>

                        <small class="text-muted">
                            Menunggu pengiriman
                        </small>

                    </div>

                </div>

            </div>

            {{-- ================= GRAFIK ================= --}}
            <div class="card border-0 shadow-sm rounded-4 p-4 mb-4 bg-white">

                <div class="d-flex justify-content-between align-items-center mb-4">

                    <h5 class="fw-bold mb-0">
                        Grafik Operasional 7 Hari Terakhir
                    </h5>

                </div>

                <canvas id="chartAktivitas"
                        style="max-height: 350px;"></canvas>

            </div>

            {{-- ================= DISTRIBUSI TERBARU ================= --}}
            <div class="card border-0 shadow-sm rounded-4 p-4 bg-white">

                <div class="d-flex justify-content-between align-items-center mb-4">

                    <h5 class="fw-bold mb-0">
                        Distribusi Terbaru
                    </h5>

                </div>

                <div class="table-responsive">

                    <table class="table table-hover align-middle">

                        <thead class="table-light">

                            <tr>

                                <th>No Transaksi</th>
                                <th>Pelanggan</th>
                                <th>Kurir</th>
                                <th>Total Produk</th>
                                <th>Tanggal</th>

                            </tr>

                        </thead>

                        <tbody>

                            @forelse($distribusiTerbaru as $d)

                            <tr>

                                <td>

                                    #TRX-{{ $d->id_distribusi }}

                                </td>

                                <td>

                                    {{ $d->pelanggan->nama_pelanggan }}

                                </td>

                                <td>

                                    {{ $d->karyawan->nama_karyawan }}

                                </td>

                                <td>

                                    {{ $d->detail->count() }} Produk

                                </td>

                                <td>

                                    {{ $d->tanggal_keluar }}

                                </td>

                            </tr>

                            @empty

                            <tr>

                                <td colspan="5"
                                    class="text-center py-5 text-muted">

                                    Belum ada distribusi

                                </td>

                            </tr>

                            @endforelse

                        </tbody>

                    </table>

                </div>

            </div>

        </div>

    </div>

</div>

{{-- ================= CHART JS ================= --}}
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

<script>

const ctx = document.getElementById('chartAktivitas');

new Chart(ctx, {

    type: 'line',

    data: {

        labels: {!! json_encode($tanggal) !!},

        datasets: [

            {
                label: 'Barang Masuk',
                data: {!! json_encode($dataMasuk) !!},
                borderColor: 'green',
                backgroundColor: 'rgba(0,128,0,0.1)',
                borderWidth: 3,
                tension: 0.4,
                fill: true
            },

            {
                label: 'Distribusi',
                data: {!! json_encode($dataKeluar) !!},
                borderColor: 'red',
                backgroundColor: 'rgba(255,0,0,0.1)',
                borderWidth: 3,
                tension: 0.4,
                fill: true
            }

        ]

    },

    options: {

        responsive: true,

        plugins: {

            legend: {
                position: 'top'
            }

        }

    }

});

</script>

<style>

.rounded-4 {
    border-radius: 1.25rem !important;
}

</style>

@endsection