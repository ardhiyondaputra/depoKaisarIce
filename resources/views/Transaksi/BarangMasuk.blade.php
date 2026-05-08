@extends('layouts.app')

@section('title', 'Barang Masuk')

@section('content')
<div class="container-fluid py-4 px-3" style="background-color: #f8f9fc; min-height: 100vh;">
    <div class="row">

        {{-- SIDEBAR --}}
        @include('layouts.sidebar')

        <div class="col-md-9 col-lg-10 ps-md-4" style="margin-left: 16.666667%;">

            {{-- TOPBAR --}}
            @include('layouts.topbar')

            {{-- ALERT SUKSES --}}
            @if(session('success'))
            <div class="alert alert-success alert-dismissible fade show mt-3 rounded-3 shadow-sm" role="alert">
                <i class="bi bi-check-circle me-2"></i> {{ session('success') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
            @endif

            {{-- ALERT ERROR --}}
            @if(session('error'))
            <div class="alert alert-danger alert-dismissible fade show mt-3 rounded-3 shadow-sm" role="alert">
                <i class="bi bi-exclamation-circle me-2"></i> {{ session('error') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
            @endif

            {{-- CARD --}}
            <div class="card border-0 shadow-sm rounded-4 overflow-hidden bg-white mt-4">
                <div class="card-header bg-white border-0 p-4 d-flex justify-content-end align-items-center">
                    <button class="btn btn-dark rounded-pill px-4 shadow-sm fw-bold"
                            style="font-size: 0.85rem;"
                            data-bs-toggle="modal"
                            data-bs-target="#modalTambah">
                        Tambah Barang Masuk
                    </button>
                </div>

                {{-- TABLE --}}
                <div class="table-responsive px-4 pb-4">
                    <table class="table table-hover align-middle">
                        <thead class="table-light">
                            <tr class="text-muted">
                                <th>Tanggal & Waktu</th>
                                <th>Jenis Es</th>
                                <th>Jumlah</th>
                                <th>Harga Satuan</th>
                                <th>Total Harga</th>
                                <th>Supplier</th>
                                <th>Petugas</th>
                                <th>Input Oleh</th>
                                {{-- <th class="text-center">Aksi</th> --}}
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($data as $d)
                                @foreach($d->detail as $detail)
                                <tr>
                                    {{-- TANGGAL --}}
                                    <td>
                                        {{ \Carbon\Carbon::parse($d->tanggal_masuk)->format('d M Y, H:i') }}
                                    </td>

                                    {{-- PRODUK --}}
                                    <td>
                                        {{ $detail->produk->jenis_es }}
                                        <br>
                                        <small class="text-muted">
                                            {{ $detail->produk->ukuran_pack }}
                                        </small>
                                    </td>

                                    {{-- JUMLAH --}}
                                    <td>
                                        {{ $detail->jumlah }}
                                    </td>

                                    {{-- HARGA SATUAN --}}
                                    <td>
                                        Rp {{ number_format($detail->harga_beli / $detail->jumlah, 0, ',', '.') }}
                                    </td>

                                    {{-- TOTAL HARGA --}}
                                    <td class="fw-semibold">
                                        Rp {{ number_format($detail->harga_beli, 0, ',', '.') }}
                                    </td>

                                    {{-- SUPPLIER --}}
                                    <td>
                                        {{ $d->supplier->nama_supplier }}
                                    </td>

                                    {{-- PETUGAS --}}
                                    <td>
                                        {{ $d->karyawan->nama_karyawan }}
                                    </td>

                                    {{-- INPUT OLEH --}}
                                    <td>
                                        <span class="badge bg-dark">
                                            {{ $d->user->username }}
                                        </span>
                                    </td>
                                    
                                    {{-- AKSI --}}
                                    {{-- <td class="text-center">
                                        <span class="badge bg-secondary rounded-pill px-3 py-2" style="font-size: 0.75rem;">
                                            Permanen
                                        </span>
                                    </td> --}}
                                </tr>
                                @endforeach
                            @empty
                            <tr>
                                <td colspan="9"
                                    class="text-center py-5 text-muted">
                                    Belum ada data barang masuk
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

{{-- ================= MODAL TAMBAH ================= --}}
<div class="modal fade" id="modalTambah" tabindex="-1">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content rounded-4 border-0 shadow">
            <form action="{{ route('barang_masuk.store') }}" method="POST">
                @csrf
                {{-- HEADER --}}
                <div class="modal-header border-0 p-4">
                    <h5 class="fw-bold mb-0">
                        Tambah Barang Masuk
                    </h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>

                {{-- BODY --}}
                <div class="modal-body p-4 pt-0">

                    {{-- PRODUK --}}
                    <div class="mb-3">
                        <label class="form-label fw-semibold small text-muted">Produk</label>
                        <select name="produk_id_produk" class="form-select rounded-3 bg-light border-0 py-2" required>
                            <option value="" disabled selected>Pilih Produk</option>
                            @foreach($produk as $p)
                            <option value="{{ $p->id_produk }}">
                                {{ $p->jenis_es }} - {{ $p->ukuran_pack }}
                            </option>
                            @endforeach
                        </select>
                    </div>

                    {{-- SUPPLIER --}}
                    <div class="mb-3">
                        <label class="form-label fw-semibold small text-muted">Supplier</label>
                        <select name="supplier_id_supplier" class="form-select rounded-3 bg-light border-0 py-2" required>
                            <option value="" disabled selected>Pilih Supplier</option>
                            @foreach($supplier as $s)
                            <option value="{{ $s->id_supplier }}">
                                {{ $s->nama_supplier }}
                            </option>
                            @endforeach
                        </select>
                    </div>

                    {{-- PETUGAS --}}
                    <div class="mb-3">
                        <label class="form-label fw-semibold small text-muted">Petugas</label>
                        <select name="karyawan_id_karyawan" class="form-select rounded-3 bg-light border-0 py-2" required>
                            <option value="" disabled selected>Pilih Petugas</option>
                            @foreach($karyawan as $k)
                            <option value="{{ $k->id_karyawan }}">
                                {{ $k->nama_karyawan }}
                            </option>
                            @endforeach
                        </select>
                    </div>

                    {{-- JUMLAH --}}
                    <div class="mb-3">
                        <label class="form-label fw-semibold small text-muted">Jumlah (Pack)</label>
                        <input type="number" name="jumlah" class="form-control rounded-3 bg-light border-0 py-2" placeholder="Contoh: 10" required>
                    </div>

                    {{-- HARGA SATUAN (Ubah name jadi harga_satuan) --}}
                    <div class="mb-3">
                        <label class="form-label fw-semibold small text-muted">Harga Satuan</label>
                        <input type="number" name="harga_satuan" class="form-control rounded-3 bg-light border-0 py-2" placeholder="Contoh: 4500" required>
                    </div>

                    {{-- TANGGAL (Ubah type jadi datetime-local) --}}
                    <div class="mb-3">
                        <label class="form-label fw-semibold small text-muted">Tanggal</label>
                        <input type="datetime-local" name="tanggal" class="form-control rounded-3 bg-light border-0 py-2" value="{{ date('Y-m-d\TH:i') }}" required>
                    </div>

                </div>

                {{-- FOOTER --}}
                <div class="modal-footer border-0 p-4 pt-0">
                    <button type="submit" class="btn btn-dark w-100 rounded-pill py-2 fw-semibold shadow-sm">
                        Simpan Data
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection