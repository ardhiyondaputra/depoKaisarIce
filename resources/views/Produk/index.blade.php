@extends('layouts.app')

@section('content')
<div class="container-fluid py-4 px-3" style="background-color: #f8f9fc; min-height: 100vh;">
    <div class="row">
        @include('layouts.sidebar')

        <div class="col-md-9 col-lg-10 ps-md-4">
            @include('layouts.topbar')

            <div class="card border-0 shadow-sm rounded-4 overflow-hidden bg-white mt-4">
                <div class="card-header bg-white border-0 p-4 d-flex justify-content-between align-items-center">
                    <h5 class="fw-bold mb-0" style="font-size: 1.1rem;">Data Produk Es Batu</h5>
                    <button class="btn btn-dark rounded-pill px-4 shadow-sm fw-bold" style="font-size: 0.85rem;" data-bs-toggle="modal" data-bs-target="#modalTambahProduk">
                        Tambah Produk
                    </button>
                </div>
                
                <div class="table-responsive px-4 pb-4">
                    <table class="table table-hover align-middle w-100">
                        <thead class="table-light">
                            <tr class="text-muted fs-6 fw-bold">
                                <th class="border-0 px-3 py-3 rounded-start" style="width: 40%;">Jenis Es</th>
                                <th class="border-0 text-center py-3" style="width: 15%;">Ukuran</th>
                                <th class="border-0 text-center py-3" style="width: 25%;">Harga Satuan</th>
                                <th class="border-0 text-center py-3 rounded-end" style="width: 20%;">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($produk as $p)
                            <tr class="border-top">
                                <td class="py-3 border-0">
                                    <div class="d-flex align-items-center">
                                        <div>
                                            <div class="text-dark mb-0" class="small">{{ $p->jenis_es }}</div>
                                        </div>
                                    </div>
                                </td>
                                <td class="border-0 text-center">
                                    <span class="badge rounded-pill px-3 py-2 text-uppercase" 
                                          style="background-color: #ebf4ff; color: #090808; small;">
                                        {{ $p->ukuran_pack }}
                                    </span>
                                </td>
                                <td class="border-0 text-center">
                                    <span style="small;">
                                        Rp {{ number_format($p->harga_jual, 0, ',', '.') }}
                                    </span>
                                </td>
                                <td class="text-center border-0">
                                    <button class="btn btn-light btn-sm rounded-pill px-3 fw-bold border shadow-sm me-1" 
                                            style="font-size: 0.8rem;" data-bs-toggle="modal" data-bs-target="#modalEdit{{ $p->id_produk }}">
                                        Edit
                                    </button>
                                    <form action="{{ route('produk.destroy', $p->id_produk) }}" method="POST" class="d-inline" onsubmit="return confirm('Yakin ingin menghapus produk ini?')">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-outline-danger btn-sm rounded-pill px-3 fw-bold" style="font-size: 0.8rem;">
                                            Hapus
                                        </button>
                                    </form>
                                </td>
                            </tr>

                            <div class="modal fade" id="modalEdit{{ $p->id_produk }}" tabindex="-1" aria-hidden="true">
                                <div class="modal-dialog modal-dialog-centered">
                                    <div class="modal-content rounded-4 border-0 shadow">
                                        <form action="{{ route('produk.update', $p->id_produk) }}" method="POST">
                                            @csrf
                                            @method('PUT')
                                            <div class="modal-header border-0 p-4">
                                                <h5 class="fw-bold">Edit Produk</h5>
                                                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                                            </div>
                                            <div class="modal-body p-4 pt-0">
                                                <div class="mb-3">
                                                    <label class="form-label small fw-bold text-muted">JENIS ES</label>
                                                    <input type="text" name="jenis_es" class="form-control bg-light border-0 rounded-3 py-2" value="{{ $p->jenis_es }}" required>
                                                </div>
                                                <div class="mb-3">
                                                    <label class="form-label small fw-bold text-muted">UKURAN PACK</label>
                                                    <input type="text" name="ukuran_pack" class="form-control bg-light border-0 rounded-3 py-2" value="{{ $p->ukuran_pack }}" required>
                                                </div>
                                                <div class="mb-3">
                                                    <label class="form-label small fw-bold text-muted">HARGA JUAL</label>
                                                    <input type="number" name="harga_jual" class="form-control bg-light border-0 rounded-3 py-2 fw-bold" value="{{ $p->harga_jual }}" required>
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
                                <td colspan="4" class="text-center py-5 text-muted small">Belum ada data produk tersedia.</td>
                            </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="modalTambahProduk" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content rounded-4 border-0 shadow">
            <form action="{{ route('produk.store') }}" method="POST">
                @csrf
                <div class="modal-header border-0 p-4">
                    <h5 class="fw-bold">Tambah Produk Baru</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>
                <div class="modal-body p-4 pt-0">
                    <div class="mb-3">
                        <label class="form-label small fw-bold text-muted">JENIS ES</label>
                        <input type="text" name="jenis_es" class="form-control bg-light border-0 rounded-3 py-2" placeholder="Contoh: Es Kristal" required>
                    </div>
                    <div class="mb-3">
                        <label class="form-label small fw-bold text-muted">UKURAN PACK</label>
                        <input type="text" name="ukuran_pack" class="form-control bg-light border-0 rounded-3 py-2" placeholder="Contoh: 5kg" required>
                    </div>
                    <div class="mb-3">
                        <label class="form-label small fw-bold text-muted">HARGA JUAL</label>
                        <input type="number" name="harga_jual" class="form-control bg-light border-0 rounded-3 py-2 fw-bold" placeholder="0" required>
                    </div>
                </div>
                <div class="modal-footer border-0 p-4 pt-0">
                    <button type="submit" class="btn btn-dark w-100 rounded-pill py-2 fw-bold shadow">Simpan Produk</button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection