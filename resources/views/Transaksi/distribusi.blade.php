@extends('layouts.app')

@section('content')
<div class="container-fluid py-4 px-3" style="background-color: #f8f9fc; min-height: 100vh;">
    <div class="row">
        @include('layouts.sidebar')

        <div class="col-md-9 col-lg-10 ps-md-4">
            @include('layouts.topbar')

            <div class="card border-0 shadow-sm rounded-4 overflow-hidden bg-white">
                <div class="card-header bg-white border-0 p-4 d-flex justify-content-between align-items-center">
                    <h5 class="fw-bold mb-0">Data Distribusi / Penjualan</h5>
                    <button class="btn btn-dark rounded-pill px-4 shadow-sm" data-bs-toggle="modal" data-bs-target="#modalTambahDistribusi">
                        <i class="bi bi-cart-plus me-1"></i> Input Distribusi Baru
                    </button>
                </div>
                
                <div class="table-responsive px-4 pb-4">
                    <table class="table table-hover align-middle">
                        <thead class="table-light">
                            <tr>
                                <th class="border-0 px-3 py-3 rounded-start">No. Transaksi</th>
                                <th class="border-0 py-3">Tanggal</th>
                                <th class="border-0 py-3">Pelanggan</th>
                                <th class="border-0 py-3">Total Item</th>
                                <th class="border-0 py-3 rounded-end text-center">Status</th>
                            </tr>
                        </thead>
                        <tbody>
                            {{-- Baris placeholder jika data kosong --}}
                            <tr>
                                <td colspan="5" class="text-center py-5 text-muted">
                                    <i class="bi bi-info-circle me-1"></i> Riwayat distribusi masih kosong.
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="modalTambahDistribusi" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content rounded-4 border-0 shadow">
            <form action="#" method="POST">
                @csrf
                <div class="modal-header border-0 p-4">
                    <h5 class="fw-bold">Input Distribusi Baru</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>
                <div class="modal-body p-4 pt-0">
                    <div class="mb-3">
                        <label class="form-label small fw-bold">Pilih Pelanggan</label>
                        <select name="id_pelanggan" class="form-select rounded-3" required>
                            <option value="" selected disabled>Pilih Pelanggan...</option>
                            </select>
                    </div>
                    <div class="mb-3">
                        <label class="form-label small fw-bold">Pilih Produk Es Batu</label>
                        <select name="id_produk" class="form-select rounded-3" required>
                            <option value="" selected disabled>Pilih Produk...</option>
                            </select>
                    </div>
                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label class="form-label small fw-bold">Jumlah (Qty)</label>
                            <input type="number" name="jumlah" class="form-control rounded-3" placeholder="0" required>
                        </div>
                        <div class="col-md-6 mb-3">
                            <label class="form-label small fw-bold">Tanggal Kirim</label>
                            <input type="date" name="tanggal" class="form-control rounded-3" value="{{ date('Y-m-d') }}" required>
                        </div>
                    </div>
                    <div class="mb-3">
                        <label class="form-label small fw-bold">Karyawan Pengirim</label>
                        <select name="id_karyawan" class="form-select rounded-3">
                            <option value="" selected disabled>Pilih Karyawan...</option>
                            </select>
                    </div>
                </div>
                <div class="modal-footer border-0 p-4 pt-0">
                    <button type="submit" class="btn btn-dark w-100 rounded-pill py-2 shadow-sm fw-bold">Proses Distribusi</button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection