@extends('layouts.app')

@section('content')
<div class="container-fluid py-4 px-3" style="background-color: #f8f9fc; min-height: 100vh;">
    <div class="row">
        @include('layouts.sidebar')

        <div class="col-md-9 col-lg-10 ps-md-4">
            @include('layouts.topbar')

            {{-- @if(session('success'))
                <div class="alert alert-success alert-dismissible fade show rounded-4 border-0 shadow-sm mb-4" role="alert">
                    <i class="bi bi-check-circle me-2"></i> {{ session('success') }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            @endif --}}

            <div class="card border-0 shadow-sm rounded-4 overflow-hidden bg-white mt-4">
                <div class="card-header bg-white border-0 p-4 d-flex justify-content-between align-items-center">
                    <h5 class="fw-bold mb-0" style="font-size: 1.1rem;">Data Supplier</h5>
                    <button class="btn btn-dark rounded-pill px-4 shadow-sm fw-bold" style="font-size: 0.85rem;" data-bs-toggle="modal" data-bs-target="#modalTambahSupplier">
                        Tambah Supplier
                    </button>
                </div>
                
                <div class="table-responsive px-4 pb-4">
                    <table class="table table-hover align-middle w-100">
                        <thead class="table-light">
                            <tr class="text-muted fs-6 fw-bold">
                                <th class="border-0 px-3 py-3 rounded-start" style="width: 35%;">Nama Supplier</th>
                                <th class="border-0 py-3" style="width: 30%;">Alamat</th>
                                <th class="border-0 py-3 text-center" style="width: 15%;">Kontak</th>
                                <th class="border-0 text-center py-3 rounded-end" style="width: 20%;">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($suppliers as $s)
                            <tr class="border-top">
                                <td class="py-3 border-0 px-3">
                                    <div class="text-dark fw-normal" style="font-size: 0.9rem;">{{ $s->nama_supplier }}</div>
                                </td>
                                <td class="border-0">
                                    <div class="text-muted small text-start">{{ $s->alamat }}</div>
                                </td>
                                <td class="border-0 text-center">
                                    <span class="text-dark" style="font-size: 0.85rem;">
                                        {{ $s->no_hp }}
                                    </span>
                                </td>
                                <td class="text-center border-0">
                                    <div class="d-flex justify-content-center gap-2">
                                        <button class="btn btn-light btn-sm rounded-pill px-3 fw-bold border shadow-sm" 
                                                style="font-size: 0.8rem;" data-bs-toggle="modal" data-bs-target="#modalEdit{{ $s->id_supplier }}">
                                            Edit
                                        </button>
                                        
                                        <form action="{{ route('supplier.destroy', $s->id_supplier) }}" method="POST" class="d-inline" onsubmit="return confirm('Yakin ingin menghapus supplier ini?')">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-outline-danger btn-sm rounded-pill px-3 fw-bold" style="font-size: 0.8rem;">
                                                Hapus
                                            </button>
                                        </form>
                                    </div>
                                </td>
                            </tr>

                            <div class="modal fade" id="modalEdit{{ $s->id_supplier }}" tabindex="-1" aria-hidden="true">
                                <div class="modal-dialog modal-dialog-centered">
                                    <div class="modal-content rounded-4 border-0 shadow">
                                        <form action="{{ route('supplier.update', $s->id_supplier) }}" method="POST">
                                            @csrf
                                            @method('PUT')
                                            <div class="modal-header border-0 p-4">
                                                <h5 class="fw-bold">Edit Data Supplier</h5>
                                                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                                            </div>
                                            <div class="modal-body p-4 pt-0">
                                                <div class="mb-3">
                                                    <label class="form-label small fw-bold text-muted">NAMA SUPPLIER</label>
                                                    <input type="text" name="nama_supplier" class="form-control bg-light border-0 rounded-3 py-2" value="{{ $s->nama_supplier }}" required>
                                                </div>
                                                <div class="mb-3">
                                                    <label class="form-label small fw-bold text-muted">ALAMAT</label>
                                                    <textarea name="alamat" class="form-control bg-light border-0 rounded-3 py-2" rows="3" required>{{ $s->alamat }}</textarea>
                                                </div>
                                                <div class="mb-3">
                                                    <label class="form-label small fw-bold text-muted">NOMOR KONTAK / WA</label>
                                                    <input type="text" name="no_hp" class="form-control bg-light border-0 rounded-3 py-2 fw-bold text-dark" value="{{ $s->no_hp }}" required>
                                                </div>
                                            </div>
                                            <div class="modal-footer border-0 p-4 pt-0">
                                                <button type="submit" class="btn btn-dark w-100 rounded-pill py-2 fw-bold shadow">Simpan Perubahan</button>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                            @empty
                            <tr>
                                <td colspan="4" class="text-center py-5 text-muted small">Belum ada data supplier tersedia.</td>
                            </tr>
                            @endforelse
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
            <form action="{{ route('supplier.store') }}" method="POST">
                @csrf
                <div class="modal-header border-0 p-4">
                    <h5 class="fw-bold">Tambah Supplier Baru</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>
                <div class="modal-body p-4 pt-0">
                    <div class="mb-3">
                        <label class="form-label small fw-bold text-muted">NAMA SUPPLIER</label>
                        <input type="text" name="nama_supplier" class="form-control bg-light border-0 rounded-3 py-2" placeholder="Contoh: PT. Sumber Es" required>
                    </div>
                    <div class="mb-3">
                        <label class="form-label small fw-bold text-muted">ALAMAT</label>
                        <textarea name="alamat" class="form-control bg-light border-0 rounded-3 py-2" rows="3" placeholder="Alamat lengkap supplier" required></textarea>
                    </div>
                    <div class="mb-3">
                        <label class="form-label small fw-bold text-muted">NOMOR KONTAK / WA</label>
                        <input type="text" name="no_hp" class="form-control bg-light border-0 rounded-3 py-2 fw-bold text-dark" placeholder="08123456789" required>
                    </div>
                </div>
                <div class="modal-footer border-0 p-4 pt-0">
                    <button type="submit" class="btn btn-dark w-100 rounded-pill py-2 fw-bold shadow">Simpan Supplier</button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection