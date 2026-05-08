@extends('layouts.app')

@section('title', 'Laporan Operasional')

@section('content')

<div class="container-fluid py-4 px-3" style="background-color: #f8f9fc; min-height: 100vh;">
    <div class="row">

        @include('layouts.sidebar')

        <div class="col-md-9 col-lg-10 ps-md-4" style="margin-left: 16.666667%;">

            @include('layouts.topbar')

            {{-- ======================================================== --}}
            {{-- AREA PENCARIAN & FILTER --}}
            {{-- ======================================================== --}}
            <div class="card border-0 shadow-sm rounded-4 mt-4 mb-4">
                <div class="card-body p-4 bg-light" style="border-bottom-left-radius: 1rem; border-bottom-right-radius: 1rem;">
                    <form method="GET">
                        <div class="row">
                            <div class="col-md-3 mb-3">
                                <label class="form-label fw-semibold small text-muted">TANGGAL AWAL</label>
                                <input type="date" name="tanggal_awal" value="{{ $tanggalAwal }}" class="form-control bg-white rounded-3 border-0 py-2" required>
                            </div>

                            <div class="col-md-3 mb-3">
                                <label class="form-label fw-semibold small text-muted">TANGGAL AKHIR</label>
                                <input type="date" name="tanggal_akhir" value="{{ $tanggalAkhir }}" class="form-control bg-white rounded-3 border-0 py-2" required>
                            </div>

                            <div class="col-md-3 mb-3">
                                <label class="form-label fw-semibold small text-muted">JENIS TRANSAKSI</label>
                                <select name="jenis" class="form-select bg-white rounded-3 border-0 py-2">
                                    <option value="semua" {{ $jenis == 'semua' ? 'selected' : '' }}>Semua Transaksi</option>
                                    <option value="masuk" {{ $jenis == 'masuk' ? 'selected' : '' }}>Hanya Barang Masuk</option>
                                    <option value="keluar" {{ $jenis == 'keluar' ? 'selected' : '' }}>Hanya Distribusi</option>
                                </select>
                            </div>

                            <div class="col-md-3 mb-3">
                                <label class="form-label fw-semibold small text-muted">CARI DATA</label>
                                <div class="input-group bg-white rounded-3 overflow-hidden">
                                    <span class="input-group-text bg-transparent border-0 text-muted ps-3 pe-2">
                                        <i class="bi bi-search"></i>
                                    </span>
                                    <input type="text" name="cari" value="{{ $cari }}" class="form-control bg-transparent border-0 py-2 shadow-none ps-1" placeholder="Search...">
                                </div>
                            </div>

                            <div class="col-md-12 d-flex justify-content-end gap-2 mt-2">
                                <button type="submit" formaction="{{ route('laporan.index') }}" class="btn btn-primary rounded-pill px-4 fw-bold shadow-sm">
                                    Tampilkan di Tabel
                                </button>
                                
                                {{-- Tombol Cetak  ke cetak PDF --}}
                                <button type="submit" formaction="{{ route('laporan.cetak') }}" class="btn btn-dark rounded-pill px-4 fw-bold shadow-sm" formtarget="_blank">
                                    Cetak PDF
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>

            {{-- ======================================================== --}}
            {{-- AREA CONTENT/DATA --}}
            {{-- ======================================================== --}}
            <div class="card border-0 shadow-sm rounded-4 mb-5">
                <div class="card-header bg-white border-bottom p-4">
                    <h5 class="fw-bold mb-0">Preview Hasil Laporan</h5>
                </div>

                <div class="card-body p-4">
                    
                    {{-- PREVIEW BARANG MASUK --}}
                    @if($jenis == 'semua' || $jenis == 'masuk')
                    <div class="mb-5">
                        <div class="d-flex align-items-center mb-3">
                            <span class="badge bg-success rounded-pill px-3 py-2 me-2">MASUK</span>
                            <h6 class="fw-bold mb-0">Data Barang Masuk</h6>
                        </div>
                        
                        <div class="table-responsive rounded-3 border">
                            <table class="table table-hover align-middle table-borderless mb-0">
                                <thead class="table-light border-bottom">
                                    <tr>
                                        <th class="ps-3">Tanggal</th>
                                        <th>Produk</th>
                                        <th>Jumlah</th>
                                        <th>Total Nominal</th>
                                        <th class="pe-3">Supplier</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @forelse($barangMasuk as $bm)
                                        @foreach($bm->detail as $detail)
                                        <tr>
                                            <td class="ps-3">{{ \Carbon\Carbon::parse($bm->tanggal_masuk)->format('d M Y, H:i') }}</td>
                                            <td>{{ $detail->produk->jenis_es }} <small class="text-muted">({{ $detail->produk->ukuran_pack }})</small></td>
                                            <td>{{ $detail->jumlah }}</td>
                                            <td class="fw-semibold">Rp {{ number_format($detail->harga_beli, 0, ',', '.') }}</td>
                                            <td class="pe-3">{{ $bm->supplier->nama_supplier }}</td>
                                        </tr>
                                        @endforeach
                                    @empty
                                        <tr><td colspan="5" class="text-center py-4 text-muted">Tidak ada data Barang Masuk pada periode ini.</td></tr>
                                    @endforelse
                                </tbody>
                                {{-- Baris Total Khusus Barang Masuk --}}
                                @if($barangMasuk->isNotEmpty())
                                <tfoot>
                                    <tr class="bg-light border-top">
                                        <td colspan="3" class="text-end fw-bold">Total Barang Masuk:</td>
                                        <td colspan="2" class="fw-bold text-success">Rp {{ number_format($totalBarangMasuk, 0, ',', '.') }}</td>
                                    </tr>
                                </tfoot>
                                @endif
                            </table>
                        </div>
                    </div>
                    @endif

                    {{-- PREVIEW DISTRIBUSI --}}
                    @if($jenis == 'semua' || $jenis == 'keluar')
                    <div>
                        <div class="d-flex align-items-center mb-3">
                            <span class="badge bg-primary rounded-pill px-3 py-2 me-2">KELUAR</span>
                            <h6 class="fw-bold mb-0">Data Distribusi</h6>
                        </div>

                        <div class="table-responsive rounded-3 border">
                            <table class="table table-hover align-middle table-borderless mb-0">
                                <thead class="table-light border-bottom">
                                    <tr>
                                        <th class="ps-3">Tanggal</th>
                                        <th>Produk</th>
                                        <th>Jumlah</th>
                                        <th>Subtotal Nominal</th>
                                        <th class="pe-3">Pelanggan</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @forelse($distribusi as $d)
                                        @foreach($d->detail as $detail)
                                        <tr>
                                            <td class="ps-3">{{ \Carbon\Carbon::parse($d->tanggal_keluar)->format('d M Y, H:i') }}</td>
                                            <td>{{ $detail->produk->jenis_es }} <small class="text-muted">({{ $detail->produk->ukuran_pack }})</small></td>
                                            <td>{{ $detail->jumlah }}</td>
                                            <td class="fw-semibold">Rp {{ number_format($detail->subtotal, 0, ',', '.') }}</td>
                                            <td class="pe-3">{{ $d->pelanggan->nama_pelanggan }}</td>
                                        </tr>
                                        @endforeach
                                    @empty
                                        <tr><td colspan="5" class="text-center py-4 text-muted">Tidak ada data Distribusi pada periode ini.</td></tr>
                                    @endforelse
                                </tbody>
                                {{-- Baris Total Khusus Distribusi --}}
                                @if($distribusi->isNotEmpty())
                                <tfoot>
                                    <tr class="bg-light border-top">
                                        <td colspan="3" class="text-end fw-bold">Total Distribusi:</td>
                                        <td colspan="2" class="fw-bold text-primary">Rp {{ number_format($totalDistribusi, 0, ',', '.') }}</td>
                                    </tr>
                                </tfoot>
                                @endif
                            </table>
                        </div>
                    </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>
@endsection