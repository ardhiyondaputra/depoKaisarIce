@extends('layouts.app')

@section('title', 'Distribusi')

@section('content')

<div class="container-fluid py-4 px-3" style="background-color: #f8f9fc; min-height: 100vh;">

    <div class="row">

        {{-- SIDEBAR --}}
        @include('layouts.sidebar')

        <div class="col-md-9 col-lg-10 ps-md-4"
     style="margin-left: 16.666667%;">

            {{-- TOPBAR --}}
            @include('layouts.topbar')

            {{-- ALERT --}}
            @if(session('success'))
            <div class="alert alert-success mt-3 rounded-3 shadow-sm">
                {{ session('success') }}
            </div>
            @endif

            {{-- CARD --}}
            <div class="card border-0 shadow-sm rounded-4 overflow-hidden bg-white mt-4">

                {{-- HEADER --}}
                <div class="card-header bg-white border-0 p-4 d-flex justify-content-end align-items-center">

                    <button class="btn btn-dark rounded-pill px-4 shadow-sm fw-bold"
                            style="font-size: 0.85rem;"
                            data-bs-toggle="modal"
                            data-bs-target="#modalTambah">

                        Tambah Distribusi

                    </button>

                </div>

                {{-- TABLE --}}
                <div class="table-responsive px-4 pb-4">

                    <table class="table table-hover align-middle">

                        {{-- ================= HEADER ================= --}}
                        <thead class="table-light">
                            <tr class="text-muted">

                                <th>No Transaksi</th>
                                <th>Tanggal</th>
                                <th>Pelanggan</th>
                                <th>Kurir</th>
                                <th>Total Transaksi</th>
                                <th>Status</th>
                                <th>Detail</th>
                                <th>Aksi</th>

                            </tr>
                        </thead>

                        {{-- ================= BODY ================= --}}
                        <tbody>

                        @forelse($data as $d)

                            @php

                                $total = 0;
                                $status = 'berhasil';

                                foreach($d->detail as $detail){

                                    $total += $detail->subtotal;

                                    if($detail->status_pengiriman == 'pending'){
                                        $status = 'pending';
                                    }

                                    if($detail->status_pengiriman == 'gagal'){
                                        $status = 'gagal';
                                    }

                                }

                            @endphp

                            {{-- ================= ROW UTAMA ================= --}}
                            <tr>

                                {{-- NO TRANSAKSI --}}
                                <td>

                                    <span class="fw-bold">
                                        #TRX-{{ $d->id_distribusi }}
                                    </span>

                                </td>

                                {{-- TANGGAL --}}
                                <td>

                                    {{ $d->tanggal_keluar }}

                                </td>

                                {{-- PELANGGAN --}}
                                <td>

                                    {{ $d->pelanggan->nama_pelanggan }}

                                </td>

                                {{-- KURIR --}}
                                <td>

                                    {{ $d->karyawan->nama_karyawan }}

                                </td>

                                {{-- TOTAL --}}
                                <td class="fw-bold">

                                    Rp {{ number_format($total, 0, ',', '.') }}

                                </td>

                                {{-- STATUS --}}
                                <td>

                                    @if($status == 'pending')

                                        <span class="badge bg-warning text-dark">
                                            Pending
                                        </span>

                                    @elseif($status == 'berhasil')

                                        <span class="badge bg-success">
                                            Berhasil
                                        </span>

                                    @else

                                        <span class="badge bg-danger">
                                            Gagal
                                        </span>

                                    @endif

                                </td>

                                {{-- DETAIL --}}
                                <td>

                                    <button class="btn btn-sm btn-primary rounded-pill"
                                            data-bs-toggle="collapse"
                                            data-bs-target="#detail{{ $d->id_distribusi }}">

                                        Detail Produk

                                    </button>

                                </td>

                                {{-- AKSI --}}
                                <td>

                                    <form action="{{ route('distribusi.destroy', $d->id_distribusi) }}"
      method="POST"
      class="d-inline"
      onsubmit="return confirm('Yakin ingin menghapus distribusi ini?')">

    @csrf
    @method('DELETE')

    <button type="submit"
                                                class="btn btn-outline-danger btn-sm rounded-pill px-3 fw-bold"
                                                style="font-size: 0.8rem;">
                                                Hapus
                                            </button>

</form>

                                </td>

                            </tr>

                            {{-- ================= DETAIL ================= --}}
                            <tr class="collapse bg-light"
                                id="detail{{ $d->id_distribusi }}">

                                <td colspan="8">

                                    <div class="p-3">

                                        <table class="table table-sm align-middle">

                                            <thead>

                                                <tr>

                                                    <th>Produk</th>
                                                    <th>Jumlah</th>
                                                    <th>Harga Satuan</th>
                                                    <th>Subtotal</th>
                                                    <th>Status</th>
                                                    <th>Keterangan</th>
                                                    <th>Aksi Status</th>

                                                </tr>

                                            </thead>

                                            <tbody>

                                                @foreach($d->detail as $detail)

                                                <tr>

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

                                                        Rp {{ number_format($detail->subtotal / $detail->jumlah, 0, ',', '.') }}

                                                    </td>

                                                    {{-- SUBTOTAL --}}
                                                    <td class="fw-semibold">

                                                        Rp {{ number_format($detail->subtotal, 0, ',', '.') }}

                                                    </td>

                                                    {{-- STATUS --}}
                                                    <td>

                                                        @if($detail->status_pengiriman == 'pending')

                                                            <span class="badge bg-warning text-dark">
                                                                Pending
                                                            </span>

                                                        @elseif($detail->status_pengiriman == 'berhasil')

                                                            <span class="badge bg-success">
                                                                Berhasil
                                                            </span>

                                                        @else

                                                            <span class="badge bg-danger">
                                                                Gagal
                                                            </span>

                                                        @endif

                                                    </td>

                                                    {{-- KETERANGAN --}}
                                                    <td>

                                                        @if($detail->status_pengiriman == 'gagal')

                                                            {{ $detail->keterangan_gagal }}

                                                        @else

                                                            -

                                                        @endif

                                                    </td>

                                                    {{-- AKSI STATUS --}}
                                                    <td>

                                                        @if($detail->status_pengiriman == 'pending')

                                                            {{-- BERHASIL --}}
                                                            <form action="{{ route('distribusi.updateStatus', $detail->id_detail_distribusi) }}"
                                                                  method="POST"
                                                                  class="mb-1">

                                                                @csrf
                                                                @method('PUT')

                                                                <input type="hidden"
                                                                       name="status_pengiriman"
                                                                       value="berhasil">

                                                                <button class="btn btn-sm btn-success rounded-pill w-100">

                                                                    Berhasil

                                                                </button>

                                                            </form>

                                                            {{-- GAGAL --}}
                                                            <button class="btn btn-sm btn-danger rounded-pill w-100"
                                                                    data-bs-toggle="modal"
                                                                    data-bs-target="#modalGagal{{ $detail->id_detail_distribusi }}">

                                                                Gagal

                                                            </button>

                                                        @else

                                                            <span class="text-muted">
                                                                Selesai
                                                            </span>

                                                        @endif

                                                    </td>

                                                </tr>

                                                @endforeach

                                            </tbody>

                                        </table>

                                    </div>

                                </td>

                            </tr>

                        @empty

                        <tr>

                            <td colspan="8"
                                class="text-center py-5 text-muted">

                                Belum ada data distribusi

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

    <div class="modal-dialog modal-xl modal-dialog-centered">

        <div class="modal-content rounded-4 border-0 shadow">

            <form action="{{ route('distribusi.store') }}"
                  method="POST">

                @csrf

                {{-- HEADER --}}
                <div class="modal-header border-0 p-4">

                    <h5 class="fw-bold mb-0">
                        Tambah Distribusi
                    </h5>

                    <button type="button"
                            class="btn-close"
                            data-bs-dismiss="modal">
                    </button>

                </div>

                {{-- BODY --}}
                <div class="modal-body p-4 pt-0">

                    <div class="row">

                        {{-- PELANGGAN --}}
                        <div class="col-md-6 mb-3">

                            <label class="form-label fw-semibold small text-muted">
                                PELANGGAN
                            </label>

                            <select name="pelanggan_id_pelanggan"
                                    class="form-select rounded-3 bg-light border-0 py-2"
                                    required>

                                <option disabled selected>
                                    Pilih Pelanggan
                                </option>

                                @foreach($pelanggan as $p)

                                <option value="{{ $p->id_pelanggan }}">
                                    {{ $p->nama_pelanggan }}
                                </option>

                                @endforeach

                            </select>

                        </div>

                        {{-- KURIR --}}
                        <div class="col-md-6 mb-3">

                            <label class="form-label fw-semibold small text-muted">
                                KURIR
                            </label>

                            <select name="karyawan_id_karyawan"
                                    class="form-select rounded-3 bg-light border-0 py-2"
                                    required>

                                <option disabled selected>
                                    Pilih Kurir
                                </option>

                                @foreach($karyawan as $k)

                                <option value="{{ $k->id_karyawan }}">
                                    {{ $k->nama_karyawan }}
                                </option>

                                @endforeach

                            </select>

                        </div>

                        {{-- TANGGAL --}}
                        <div class="col-md-6 mb-3">

                            <label class="form-label fw-semibold small text-muted">
                                TANGGAL DISTRIBUSI
                            </label>

                            <input type="date"
                                   name="tanggal"
                                   value="{{ date('Y-m-d') }}"
                                   class="form-control rounded-3 bg-light border-0 py-2"
                                   required>

                        </div>

                    </div>

                    <hr>

                    {{-- DETAIL DISTRIBUSI --}}
                    <div id="detail-container">

                        <div class="detail-item row mb-3">

                            {{-- PRODUK --}}
                            <div class="col-md-5">

                                <label class="form-label small text-muted fw-semibold">
                                    PRODUK
                                </label>

                                <select name="produk_id_produk[]"
                                        class="form-select rounded-3 bg-light border-0 py-2"
                                        required>

                                    <option disabled selected>
                                        Pilih Produk
                                    </option>

                                    @foreach($produk as $p)

                                    <option value="{{ $p->id_produk }}">
                                        {{ $p->jenis_es }} - {{ $p->ukuran_pack }}
                                    </option>

                                    @endforeach

                                </select>

                            </div>

                            {{-- JUMLAH --}}
                            <div class="col-md-3">

                                <label class="form-label small text-muted fw-semibold">
                                    JUMLAH
                                </label>

                                <input type="number"
                                       name="jumlah[]"
                                       class="form-control rounded-3 bg-light border-0 py-2"
                                       placeholder="Jumlah"
                                       required>

                            </div>

                            {{-- HAPUS --}}
                            <div class="col-md-2 d-flex align-items-end">

                                <button type="button"
                                        class="btn btn-danger rounded-pill remove-detail w-100">

                                    Hapus

                                </button>

                            </div>

                        </div>

                    </div>

                    {{-- TAMBAH PRODUK --}}
                    <button type="button"
                            class="btn btn-outline-dark rounded-pill mt-2"
                            id="btnTambahProduk">

                        + Tambah Produk

                    </button>

                </div>

                {{-- FOOTER --}}
                <div class="modal-footer border-0 p-4 pt-0">

                    <button type="submit"
                            class="btn btn-dark w-100 rounded-pill py-2 fw-semibold shadow-sm">

                        Simpan Distribusi

                    </button>

                </div>

            </form>

        </div>

    </div>

</div>

{{-- ================= MODAL GAGAL ================= --}}
@foreach($data as $d)

    @foreach($d->detail as $detail)

    <div class="modal fade"
         id="modalGagal{{ $detail->id_detail_distribusi }}"
         tabindex="-1">

        <div class="modal-dialog modal-dialog-centered">

            <div class="modal-content rounded-4 border-0 shadow">

                <form action="{{ route('distribusi.updateStatus', $detail->id_detail_distribusi) }}"
                      method="POST">

                    @csrf
                    @method('PUT')

                    <input type="hidden"
                           name="status_pengiriman"
                           value="gagal">

                    <div class="modal-header border-0">

                        <h5 class="fw-bold">
                            Alasan Distribusi Gagal
                        </h5>

                        <button type="button"
                                class="btn-close"
                                data-bs-dismiss="modal">
                        </button>

                    </div>

                    <div class="modal-body">

                        <textarea name="keterangan_gagal"
                                  class="form-control"
                                  rows="4"
                                  placeholder="Masukkan alasan gagal..."
                                  required></textarea>

                    </div>

                    <div class="modal-footer border-0">

                        <button class="btn btn-danger w-100 rounded-pill">

                            Simpan Status Gagal

                        </button>

                    </div>

                </form>

            </div>

        </div>

    </div>

    @endforeach

@endforeach

{{-- ================= SCRIPT ================= --}}
<script>

document.addEventListener('DOMContentLoaded', function () {

    const btnTambah = document.getElementById('btnTambahProduk');

    const container = document.getElementById('detail-container');

    btnTambah.addEventListener('click', function () {

        let html = `

            <div class="detail-item row mb-3">

                <div class="col-md-5">

                    <label class="form-label small text-muted fw-semibold">
                        PRODUK
                    </label>

                    <select name="produk_id_produk[]"
                            class="form-select rounded-3 bg-light border-0 py-2"
                            required>

                        <option disabled selected>
                            Pilih Produk
                        </option>

                        @foreach($produk as $p)

                        <option value="{{ $p->id_produk }}">
                            {{ $p->jenis_es }} - {{ $p->ukuran_pack }}
                        </option>

                        @endforeach

                    </select>

                </div>

                <div class="col-md-3">

                    <label class="form-label small text-muted fw-semibold">
                        JUMLAH
                    </label>

                    <input type="number"
                           name="jumlah[]"
                           class="form-control rounded-3 bg-light border-0 py-2"
                           placeholder="Jumlah"
                           required>

                </div>

                <div class="col-md-2 d-flex align-items-end">

                    <button type="button"
                            class="btn btn-danger rounded-pill remove-detail w-100">

                        Hapus

                    </button>

                </div>

            </div>

        `;

        container.insertAdjacentHTML('beforeend', html);

    });

    document.addEventListener('click', function(e){

        if(e.target.classList.contains('remove-detail')){

            let items = document.querySelectorAll('.detail-item');

            if(items.length > 1){

                e.target.closest('.detail-item').remove();

            }

        }

    });

});

</script>

@endsection