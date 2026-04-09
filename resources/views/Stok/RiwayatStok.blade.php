@extends('layouts.app')

@section('content')
<div class="container-fluid py-4 px-3" style="background-color: #f8f9fc; min-height: 100vh;">
    <div class="row">
        @include('layouts.sidebar')

        <div class="col-md-9 col-lg-10 ps-md-4">
            @include('layouts.topbar')

            <div class="card border-0 shadow-sm rounded-4 overflow-hidden bg-white">
                <div class="card-header bg-white border-0 p-4 d-flex justify-content-between align-items-center">
                    <h5 class="fw-bold mb-0">Riwayat Aktivitas Stok</h5>
                    <div class="d-flex gap-2">
                        <button class="btn btn-outline-dark rounded-pill px-3 btn-sm">
                            <i class="bi bi-download me-1"></i> Ekspor PDF
                        </button>
                    </div>
                </div>
                
                <div class="px-4 pb-4">
                    <div class="table-responsive">
                        <table class="table table-hover align-middle">
                            <thead class="table-light">
                                <tr>
                                    <th class="border-0 px-3 py-3 rounded-start">Waktu</th>
                                    <th class="border-0 py-3">Produk</th>
                                    <th class="border-0 py-3 text-center">Tipe</th>
                                    <th class="border-0 py-3">Jumlah</th>
                                    <th class="border-0 py-3 rounded-end px-3">Keterangan</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr class="d-none">
                                    <td colspan="5" class="text-center py-5 text-muted">
                                        <i class="bi bi-info-circle me-1"></i> Tidak ada aktivitas stok tercatat.
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection