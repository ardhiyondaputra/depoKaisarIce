@extends('layouts.app')

@section('content')
<div class="container-fluid py-4 px-3" style="background-color: #f8f9fc; min-height: 100vh;">
    <div class="row">
        @include('layouts.sidebar')

        <div class="col-md-9 col-lg-10 ps-md-4">
            @include('layouts.topbar')

            <div class="card border-0 shadow-sm rounded-4 overflow-hidden bg-white">

                <div class="card-header bg-white border-0 p-4 d-flex justify-content-between align-items-center">
                    <h5 class="fw-bold mb-0">Data Karyawan Pengiriman</h5>

                    <button class="btn btn-dark rounded-pill px-4 shadow-sm"
                        data-bs-toggle="modal"
                        data-bs-target="#modalTambahKaryawan">

                        <i class="bi bi-plus-lg me-1"></i>
                        Tambah Karyawan

                    </button>
                </div>


                <div class="table-responsive px-4 pb-4">
                    <table class="table table-hover align-middle">

                        <thead class="table-light">
                            <tr>
                                <th>Nama</th>
                                <th>Alamat</th>
                                <th>No HP</th>
                                <th class="text-end">Aksi</th>
                            </tr>
                        </thead>


                        <tbody id="tbodyKaryawan">

                            <tr id="emptyRow">
                                <td colspan="4"
                                    class="text-center py-5 text-muted">

                                    <i class="bi bi-info-circle me-1"></i>
                                    Belum ada data karyawan.

                                </td>
                            </tr>

                        </tbody>

                    </table>
                </div>

            </div>
        </div>
    </div>
</div>


<!-- MODAL TAMBAH KARYAWAN -->
<div class="modal fade" id="modalTambahKaryawan">

    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content rounded-4 border-0 shadow">

            <form id="formTambahKaryawan">

                <div class="modal-header border-0 p-4">
                    <h5 class="fw-bold">Tambah Karyawan Baru</h5>

                    <button type="button"
                        class="btn-close"
                        data-bs-dismiss="modal">
                    </button>
                </div>


                <div class="modal-body p-4 pt-0">

                    <div class="mb-3">
                        <label class="form-label small fw-bold">
                            Nama Lengkap
                        </label>

                        <input type="text"
                            id="nama"
                            class="form-control rounded-3"
                            placeholder="Masukkan nama karyawan"
                            required>
                    </div>


                    <div class="mb-3">
                        <label class="form-label small fw-bold">
                            Alamat
                        </label>

                        <input type="text"
                            id="alamat"
                            class="form-control rounded-3"
                            placeholder="Masukkan alamat"
                            required>
                    </div>


                    <div class="mb-3">
                        <label class="form-label small fw-bold">
                            Nomor HP
                        </label>

                        <input type="text"
                            id="nohp"
                            class="form-control rounded-3"
                            placeholder="Contoh: 08123456789"
                            required>
                    </div>

                </div>


                <div class="modal-footer border-0 p-4 pt-0">

                    <button type="submit"
                        class="btn btn-dark w-100 rounded-pill py-2 shadow-sm fw-bold">

                        Simpan Data Karyawan

                    </button>

                </div>

            </form>

        </div>
    </div>

</div>


<script>

document
.getElementById("formTambahKaryawan")
.addEventListener("submit", function(e){

    e.preventDefault();

    let nama = document.getElementById("nama").value;
    let alamat = document.getElementById("alamat").value;
    let nohp = document.getElementById("nohp").value;

    let tbody = document.getElementById("tbodyKaryawan");

    let emptyRow = document.getElementById("emptyRow");

    if(emptyRow){
        emptyRow.remove();
    }

    let row = `
        <tr>
            <td>${nama}</td>
            <td>${alamat}</td>
            <td>${nohp}</td>
            <td class="text-end">
                <button class="btn btn-sm btn-danger"
                    onclick="hapusRow(this)">
                    Hapus
                </button>
            </td>
        </tr>
    `;

    tbody.insertAdjacentHTML("beforeend", row);

    document.getElementById("formTambahKaryawan").reset();

    let modal = bootstrap.Modal
        .getInstance(document.getElementById("modalTambahKaryawan"));

    modal.hide();

});


function hapusRow(btn){

    if(confirm("Yakin hapus data karyawan?")){

        btn.closest("tr").remove();

    }

}

</script>

@endsection