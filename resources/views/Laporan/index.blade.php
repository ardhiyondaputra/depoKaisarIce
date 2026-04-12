@extends('layouts.app')

@section('content')
<div class="container-fluid py-4 px-3" style="background-color: #f8f9fc; min-height: 100vh;">
    <div class="row">
        @include('layouts.sidebar')

        <div class="col-md-9 col-lg-10 ps-md-4">
            @include('layouts.topbar')

            <div class="card border-0 shadow-sm rounded-4 overflow-hidden bg-white">
                <div class="card-header bg-white border-0 p-4 d-flex justify-content-between align-items-center">
                    <h5 class="fw-bold mb-0">Laporan Operasional</h5>
                    <button class="btn btn-dark rounded-pill px-4 shadow-sm">
                        <i class="bi bi-file-earmark-pdf me-1"></i> Cetak Laporan (PDF)
                    </button>
                </div>
                
                <div class="px-4 pb-4">
                    <form action="#" method="GET" class="row g-3 mb-4 align-items-end p-4 rounded-4 bg-light border-0 mx-0">
                        <div class="col-md-3">
                            <label class="form-label small fw-bold text-muted">Dari Tanggal</label>
                            <input type="date" name="start_date" class="form-control rounded-3 border-0 shadow-sm">
                        </div>

                        <div class="col-md-3">
                            <label class="form-label small fw-bold text-muted">Sampai Tanggal</label>
                            <input type="date" name="end_date" class="form-control rounded-3 border-0 shadow-sm">
                        </div>

                        <div class="col-md-4">
                            <label class="form-label small fw-bold text-muted">Kategori Laporan</label>
                            <select class="form-select rounded-3 border-0 shadow-sm text-muted">
                                <option selected>Semua Aktivitas</option>
                                <option>Barang Masuk</option>
                                <option>Barang Keluar / Distribusi</option>
                            </select>
                        </div>

                        <div class="col-md-2">
                            <button type="submit" class="btn btn-dark w-100 rounded-3 shadow-sm fw-bold">
                                <i class="bi bi-filter me-1"></i> Terapkan
                            </button>
                        </div>
                    </form>

                    <div class="table-responsive">
                        <table class="table table-hover align-middle">
                            <thead class="table-light">
                                <tr>
                                    <th class="border-0 px-3 py-3 rounded-start">Periode Rentang Waktu</th>
                                    <th class="border-0 py-3">Total Masuk</th>
                                    <th class="border-0 py-3">Total Keluar</th>
                                    <th class="border-0 py-3 text-center">Selisih Stok</th>
                                    <th class="border-0 py-3 rounded-end text-end px-3">Status</th>
                                </tr>
                            </thead>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection