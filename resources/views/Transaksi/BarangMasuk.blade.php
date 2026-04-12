@extends('layouts.app')

@section('content')
<div class="container-fluid py-4 px-3" style="background-color: #f8f9fc; min-height: 100vh;">
    <div class="row">
        @include('layouts.sidebar')

        <div class="col-md-9 col-lg-10 ps-md-4">
            @include('layouts.topbar')

            <div class="card border-0 shadow-sm rounded-4 overflow-hidden bg-white">
                <div class="card-header bg-white border-0 p-4 d-flex justify-content-between align-items-center">
                    <h5 class="fw-bold mb-0">Riwayat Barang Masuk</h5>

                    <button class="btn btn-dark rounded-pill px-4 shadow-sm"
                        data-bs-toggle="modal"
                        data-bs-target="#modalTambahBarangMasuk">

                        <i class="bi bi-plus-lg me-1"></i> Input Barang Masuk
                    </button>
                </div>

                <div class="table-responsive px-4 pb-4">
                    <table class="table table-hover align-middle" id="tableBarangMasuk">

                        <thead class="table-light">
                            <tr>
                                <th>Tanggal</th>
                                <th>Nama Produk</th>
                                <th>Jumlah Masuk</th>
                                <th>Supplier</th>
                                <th>Petugas</th>
                            </tr>
                        </thead>

                        <tbody id="tbodyBarangMasuk">

                            <tr id="emptyRow">
                                <td colspan="5" class="text-center py-5 text-muted">
                                    <i class="bi bi-info-circle me-1"></i>
                                    Belum ada transaksi barang masuk.
                                </td>
                            </tr>

                        </tbody>

                    </table>
                </div>
            </div>
        </div>
    </div>
</div>


<!-- MODAL -->
<div class="modal fade" id="modalTambahBarangMasuk">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content rounded-4 border-0 shadow">

            <form id="formBarangMasuk">

                <div class="modal-header border-0 p-4">
                    <h5 class="fw-bold">Input Barang Masuk</h5>

                    <button type="button"
                        class="btn-close"
                        data-bs-dismiss="modal"></button>
                </div>

                <div class="modal-body p-4 pt-0">

                    <!-- PRODUK -->
                    <div class="mb-3">
                        <label class="form-label small fw-bold">
                            Pilih Produk
                        </label>

                        <select id="produk"
                            class="form-select rounded-3"
                            required>

                            <option disabled selected>
                                Pilih Es Batu...
                            </option>

                            <option>Es Kristal 5kg</option>
                            <option>Es Tube 10kg</option>
                            <option>Es Balok 25kg</option>

                        </select>
                    </div>


                    <!-- SUPPLIER -->
                    <div class="mb-3">
                        <label class="form-label small fw-bold">
                            Supplier
                        </label>

                        <select id="supplier"
                            class="form-select rounded-3"
                            required>

                            <option disabled selected>
                                Pilih Supplier...
                            </option>

                            <option>CV Sumber Ice</option>
                            <option>PT Es Makmur</option>

                        </select>
                    </div>


                    <!-- JUMLAH + TANGGAL -->
                    <div class="row">

                        <div class="col-md-6 mb-3">
                            <label class="form-label small fw-bold">
                                Jumlah Masuk
                            </label>

                            <input type="number"
                                id="jumlah"
                                class="form-control rounded-3"
                                placeholder="0"
                                required>
                        </div>


                        <div class="col-md-6 mb-3">
                            <label class="form-label small fw-bold">
                                Tanggal
                            </label>

                            <input type="date"
                                id="tanggal"
                                class="form-control rounded-3"
                                value="{{ date('Y-m-d') }}"
                                required>
                        </div>

                    </div>

                </div>


                <div class="modal-footer border-0 p-4 pt-0">

                    <button type="submit"
                        class="btn btn-dark w-100 rounded-pill py-2 shadow-sm fw-bold">

                        Simpan Transaksi

                    </button>

                </div>

            </form>

        </div>
    </div>
</div>


<script>

document
.getElementById("formBarangMasuk")
.addEventListener("submit", function(e){

    e.preventDefault();

    let produk = document.getElementById("produk").value;
    let supplier = document.getElementById("supplier").value;
    let jumlah = document.getElementById("jumlah").value;
    let tanggal = document.getElementById("tanggal").value;

    let tbody = document.getElementById("tbodyBarangMasuk");

    let emptyRow = document.getElementById("emptyRow");

    if(emptyRow){
        emptyRow.remove();
    }

    let row = `
        <tr>
            <td>${tanggal}</td>
            <td>${produk}</td>
            <td>${jumlah}</td>
            <td>${supplier}</td>
            <td>Admin</td>
        </tr>
    `;

    tbody.insertAdjacentHTML("beforeend", row);

    document.getElementById("formBarangMasuk").reset();

    let modal = bootstrap.Modal
        .getInstance(document.getElementById("modalTambahBarangMasuk"));

    modal.hide();

});

</script>

@endsection