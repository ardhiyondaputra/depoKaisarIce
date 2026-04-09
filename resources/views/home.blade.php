@extends('layouts.app')

@section('content')
<div class="container-fluid py-4 px-3" style="background-color: #f8f9fc; min-height: 100vh;">
    <div class="row">

        @include('layouts.sidebar')

        <div class="col-md-9 col-lg-10 ps-md-4">

            @include('layouts.topbar')

            <div class="row g-4 mb-4 text-center">
                <div class="col-md-4">
                    <div class="card border-0 shadow-sm rounded-4 p-4 h-100 bg-white">
                        <div class="text-muted small mb-3 fw-bold text-uppercase"><i class="bi bi-box-seam me-1"></i> Data Produk</div>
                        <h1 class="fw-bold m-0" style="color: #1e3a5f;">{{ $total_produk ?? 0 }}</h1>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="card border-0 shadow-sm rounded-4 p-4 h-100 bg-white">
                        <div class="text-muted small mb-3 fw-bold text-uppercase"><i class="bi bi-truck me-1"></i> Data Supplier</div>
                        <h1 class="fw-bold m-0" style="color: #1e3a5f;">{{ $total_supplier ?? 0 }}</h1>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="card border-0 shadow-sm rounded-4 p-4 h-100 bg-white">
                        <div class="text-muted small mb-3 fw-bold text-uppercase"><i class="bi bi-people me-1"></i> Data Pelanggan</div>
                        <h1 class="fw-bold m-0" style="color: #1e3a5f;">{{ $total_pelanggan ?? 0 }}</h1>
                    </div>
                </div>
            </div>

            <div class="card border-0 shadow-sm rounded-4 p-4 mb-4 bg-white">
                <h5 class="fw-bold mb-4">Grafik Aktivitas Sistem</h5>
                <canvas id="myChart" style="max-height: 350px;"></canvas>
            </div>
        </div>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
</script>

<style>
    .rounded-4 { border-radius: 1.25rem !important; }
    .nav-link { font-weight: 500; transition: 0.2s; }
    .nav-link:hover:not(.active) { background-color: #f1f3f5; }
    .bg-success-subtle { background-color: #d1e7dd; }
    .dropdown-item:active { background-color: #f8d7da; color: #dc3545; }
</style>
@endsection