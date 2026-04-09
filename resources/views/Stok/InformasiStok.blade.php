@extends('layouts.app')

@section('content')
<div class="container-fluid py-4 px-3" style="background-color: #f8f9fc; min-height: 100vh;">
    <div class="row">
        @include('layouts.sidebar')

        <div class="col-md-9 col-lg-10 ps-md-4">
            @include('layouts.topbar')

            <div class="card border-0 shadow-sm rounded-4 overflow-hidden bg-white">
                <div class="card-header bg-white border-0 p-4 d-flex justify-content-between align-items-center">
                    <h5 class="fw-bold mb-0">Informasi Stok Real-Time</h5>
                    <button class="btn btn-outline-dark rounded-pill px-4 shadow-sm btn-sm">
                        <i class="bi bi-arrow-clockwise me-1"></i> Refresh Data
                    </button>
                </div>
                
                <div class="px-4 pb-4">
                    <div class="row g-3 mb-4">
                        <div class="col-md-4">
                            <div class="p-3 rounded-4 border shadow-sm bg-light">
                                <small class="text-muted fw-bold d-block mb-1">TOTAL STOK KESELURUHAN</small>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="p-3 rounded-4 border shadow-sm bg-light border-start border-warning border-4">
                                <small class="text-muted fw-bold d-block mb-1">STOK HAMPIR HABIS</small>
                            </div>
                        </div>
                    </div>

                    <div class="table-responsive">
                        <table class="table table-hover align-middle">
                            <thead class="table-light">
                                <tr>
                                    <th class="border-0 px-3 py-3 rounded-start">Nama Produk</th>
                                    <th class="border-0 py-3">Kategori</th>
                                    <th class="border-0 py-3">Stok Tersedia</th>
                                    <th class="border-0 py-3 text-center">Status</th>
                                    <th class="border-0 py-3 rounded-end text-end px-3">Update Terakhir</th>
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