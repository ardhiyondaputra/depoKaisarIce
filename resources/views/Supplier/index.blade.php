@extends('layouts.app')

@section('content')
<div class="container-fluid py-4 px-3" style="background-color: #f8f9fc; min-height: 100vh;">
    <div class="row">
        @include('layouts.sidebar')

        <div class="col-md-9 col-lg-10 ps-md-4">
            @include('layouts.topbar')

            <div class="card border-0 shadow-sm rounded-4 overflow-hidden bg-white">
                <div class="card-header bg-white border-0 p-4 d-flex justify-content-between align-items-center">
                    <h5 class="fw-bold mb-0">Data Supplier</h5>
                    <button class="btn btn-dark rounded-pill px-4 shadow-sm" data-bs-toggle="modal" data-bs-target="#modalTambahSupplier">
                        <i class="bi bi-plus-lg me-1"></i> Tambah Supplier
                    </button>
                </div>
                
                <div class="table-responsive px-4 pb-4">
                    <table class="table table-hover align-middle">
                        <thead class="table-light">
                            <tr>
                                <th class="border-0 px-3 py-3 rounded-start">No</th>
                                <th class="border-0 py-3">Nama Supplier</th>
                                <th class="border-0 py-3">Alamat</th>
                                <th class="border-0 py-3">Kontak</th>
                                <th class="border-0 py-3 rounded-end text-end px-3">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td colspan="5" class="text-center py-5 text-muted">
                                    <i class="bi bi-info-circle me-1"></i> Data kosong.
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="modalTambahSupplier" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content rounded-4 border-0 shadow">
            <form action="#" method="POST">
                @csrf
                <div class="modal-header border-0 p-4">
                    <h5 class="fw-bold">Tambah Supplier Baru</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>
                <div class="modal-body p-4 pt-0">
                    <div class="mb-3">
                        <label class="form-label small fw-bold">Nama Supplier</label>
                        <input type="text" name="nama_supplier" class="form-control rounded-3" placeholder="Masukkan nama PT/Toko" required>
                    </div>
                    <div class="mb-3">
                        <label class="form-label small fw-bold">Alamat</label>
                        <textarea name="alamat" class="form-control rounded-3" rows="3" placeholder="Alamat lengkap supplier" required></textarea>
                    </div>
                    <div class="mb-3">
                        <label class="form-label small fw-bold">Nomor Kontak / WA</label>
                        <input type="number" name="kontak" class="form-control rounded-3" placeholder="Contoh: 08123456789" required>
                    </div>
                </div>
                <div class="modal-footer border-0 p-4 pt-0">
                    <button type="submit" class="btn btn-dark w-100 rounded-pill py-2 shadow-sm fw-bold">Simpan Supplier</button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection