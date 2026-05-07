@extends('layouts.app')

@section('content')
<style>
    input::-ms-reveal,
    input::-ms-clear {
        display: none;
    }

    .input-group-text {
        background-color: white;
        border-left: none;
    }
    .form-control:focus + .input-group-text {
        border-color: #86b7fe;
    }
</style>

<div class="container-fluid py-4 px-3" style="background-color: #f8f9fc; min-height: 100vh;">
    <div class="row">
        @include('layouts.sidebar')

        <div class="col-md-9 col-lg-10 ps-md-4"
     style="margin-left: 16.666667%;">
            @include('layouts.topbar')

            <div class="card border-0 shadow-sm rounded-4 overflow-hidden bg-white">
                <div class="card-header bg-white border-0 p-4 d-flex justify-content-between align-items-center">
                    <h5 class="fw-bold mb-0">Manajemen Pengguna</h5>
                    <button class="btn btn-dark rounded-pill px-4 shadow-sm" data-bs-toggle="modal" data-bs-target="#modalTambah">
                        <i class="bi bi-plus-lg me-1"></i> Tambah Admin
                    </button>
                </div>
                
                <div class="table-responsive px-4 pb-4">
                    <table class="table table-hover align-middle w-100">
                        <thead class="table-light">
                            <tr>
                                <th class="border-0 px-3 py-3 rounded-start" style="width: 40%;">Username</th>
                                <th class="border-0 py-3 text-center" style="width: 20%;">Role</th>
                                <th class="border-0 py-3 text-center" style="width: 20%;">Status</th>
                                <th class="border-0 py-3 text-center px-4" style="width: 20%;">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($admins as $admin)
                            <tr>
                                <td class="px-3">
                                    <div class="d-flex align-items-center">
                                        <img src="https://ui-avatars.com/api/?name={{ $admin->username }}&background=random" class="rounded-circle me-3" width="40" height="40">
                                        <div>
                                            <div class="fw-bold">{{ $admin->username }}</div>
                                            <small class="text-muted">ID: {{ $admin->id_user }}</small>
                                        </div>
                                    </div>
                                </td>
                                <td class="text-center">
                                    <span class="badge rounded-pill px-3 py-2 bg-primary-subtle text-primary">
                                        {{ strtoupper($admin->role) }}
                                    </span>
                                </td>
                                <td class="text-center">
                                    <span class="fw-bold small {{ $admin->status == 'aktif' ? 'text-success' : 'text-danger' }}">
                                        <i class="bi bi-circle-fill me-1" style="font-size: 7px;"></i> {{ ucfirst($admin->status) }}
                                    </span>
                                </td>
                                <td class="text-center px-3">
                                    <div class="d-flex justify-content-center align-items-center gap-2">
                                        <button class="btn btn-sm btn-light rounded-pill px-3 border shadow-sm fw-bold" 
                                                data-bs-toggle="modal" 
                                                data-bs-target="#modalEdit{{ $admin->id_user }}">
                                            Edit
                                        </button>
                                        
                                        <button class="btn btn-sm btn-outline-danger rounded-pill px-3 shadow-sm fw-bold"
                                                data-bs-toggle="modal" 
                                                data-bs-target="#modalHapus{{ $admin->id_user }}">
                                            <i class="bi bi-trash me-1"></i> Hapus
                                        </button>
                                    </div>
                                </td>
                            </tr>

                            <div class="modal fade" id="modalEdit{{ $admin->id_user }}" tabindex="-1" aria-hidden="true">
                                <div class="modal-dialog modal-dialog-centered">
                                    <div class="modal-content rounded-4 border-0 shadow">
                                        <form action="{{ route('DataAdmin.update', $admin->id_user) }}" method="POST">
                                            @csrf
                                            @method('PUT')
                                            <div class="modal-header border-0 p-4">
                                                <h5 class="fw-bold">Edit User</h5>
                                                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                                            </div>
                                            <div class="modal-body p-4 pt-0">
                                                <div class="mb-3">
                                                    <label class="form-label small fw-bold">Username</label>
                                                    <input type="text" name="username" class="form-control rounded-3" value="{{ $admin->username }}" required>
                                                </div>
                                                <div class="mb-3">
                                                    <label class="form-label small fw-bold">Status</label>
                                                    <select name="status" class="form-select rounded-3">
                                                        <option value="aktif" {{ $admin->status == 'aktif' ? 'selected' : '' }}>Aktif</option>
                                                        <option value="tidak aktif" {{ $admin->status == 'tidak aktif' ? 'selected' : '' }}>Tidak Aktif</option>
                                                    </select>
                                                </div>
                                                <div class="mb-3">
                                                    <label class="form-label small fw-bold">Password Baru</label>
                                                    <div class="input-group shadow-sm rounded-3">
                                                        <input type="password" 
                                                               name="password" 
                                                               id="pw{{ $admin->id_user }}" 
                                                               class="form-control border-end-0"
                                                               placeholder="Kosongkan jika tidak ganti"
                                                               style="border-top-left-radius: 0.5rem; border-bottom-left-radius: 0.5rem;">
                                                        <span class="input-group-text bg-white border-start-0" 
                                                              style="cursor: pointer; border-top-right-radius: 0.5rem; border-bottom-right-radius: 0.5rem;"
                                                              onclick="togglePro('pw{{ $admin->id_user }}', 'ic{{ $admin->id_user }}')">
                                                            <i class="bi bi-eye text-muted" id="ic{{ $admin->id_user }}"></i>
                                                        </span>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="modal-footer border-0 p-4 pt-0">
                                                <button type="submit" class="btn btn-dark w-100 rounded-pill py-2 fw-bold">Simpan Perubahan</button>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>

                            <div class="modal fade" id="modalHapus{{ $admin->id_user }}" tabindex="-1" aria-hidden="true">
                                <div class="modal-dialog modal-dialog-centered" style="max-width: 400px;">
                                    <div class="modal-content border-0 shadow rounded-4">
                                        <div class="modal-header border-0 p-4 pb-0">
                                            <h5 class="fw-bold mb-0">Konfirmasi Hapus</h5>
                                            <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                                        </div>
                                        <div class="modal-body text-center p-4">
                                            <div class="mb-4">
                                                <div class="bg-danger bg-opacity-10 rounded-circle d-inline-flex align-items-center justify-content-center" style="width: 80px; height: 80px;">
                                                    <i class="bi bi-trash3-fill text-danger" style="font-size: 2.5rem;"></i>
                                                </div>
                                            </div>
                                            <p class="mb-0">Apakah kamu yakin ingin menghapus {{ $admin->username }}?</p>
                                        </div>
                                        <div class="modal-footer border-0 p-4 pt-0">
                                            <div class="d-flex w-100 gap-2">
                                                <button type="button" class="btn btn-light w-100 rounded-pill py-2 fw-bold border" data-bs-dismiss="modal">Batal</button>
                                                <form action="{{ route('DataAdmin.destroy', $admin->id_user) }}" method="POST" class="w-100">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="btn btn-danger w-100 rounded-pill py-2 fw-bold">Ya, Hapus</button>
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="modalTambah" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content rounded-4 border-0 shadow">
            <form action="{{ route('DataAdmin.store') }}" method="POST">
                @csrf
                <div class="modal-header border-0 p-4">
                    <h5 class="fw-bold">Tambah Admin Baru</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>
                <div class="modal-body p-4 pt-0">
                    <div class="mb-3">
                        <label class="form-label small fw-bold">Username</label>
                        <input type="text" name="username" class="form-control rounded-3" placeholder="Masukkan username" required>
                    </div>
                    <div class="mb-3">
                        <label class="form-label small fw-bold">Password</label>
                        <div class="input-group shadow-sm rounded-3">
                            <input type="password" 
                                   name="password" 
                                   id="pwTambah" 
                                   class="form-control border-end-0" 
                                   placeholder="Masukkan password" 
                                   required>
                            <span class="input-group-text bg-white border-start-0" 
                                  style="cursor: pointer;"
                                  onclick="togglePro('pwTambah', 'icTambah')">
                                <i class="bi bi-eye text-muted" id="icTambah"></i>
                            </span>
                        </div>
                    </div>
                </div>
                <div class="modal-footer border-0 p-4 pt-0">
                    <button type="submit" class="btn btn-dark w-100 rounded-pill py-2 fw-bold">Tambah Sekarang</button>
                </div>
            </form>
        </div>
    </div>
</div>

<script>
function togglePro(inputId, iconId) {
    const input = document.getElementById(inputId);
    const icon = document.getElementById(iconId);
    
    if (input.type === "password") {
        input.type = "text";
        icon.classList.replace('bi-eye', 'bi-eye-slash');
    } else {
        input.type = "password";
        icon.classList.replace('bi-eye-slash', 'bi-eye');
    }
}

document.addEventListener('DOMContentLoaded', function() {
    const allModals = document.querySelectorAll('.modal');
    allModals.forEach(modal => {
        modal.addEventListener('hidden.bs.modal', function () {
            const form = modal.querySelector('form');
            if (form) form.reset();
            
            const passwordInputs = modal.querySelectorAll('input[type="text"]');
            passwordInputs.forEach(input => {
                if(input.name === 'password') input.type = 'password';
            });
            
            const icons = modal.querySelectorAll('.bi-eye-slash');
            icons.forEach(icon => {
                icon.classList.replace('bi-eye-slash', 'bi-eye');
            });
        });
    });
});
</script>
@endsection