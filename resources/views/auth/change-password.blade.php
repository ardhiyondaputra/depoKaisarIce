@extends('layouts.app')

@section('content')

<div class="container mt-5">

    <div class="card shadow mx-auto" style="max-width:500px">

        <div class="card-body">

            <h4 class="mb-4">Ganti Password</h4>

            <form method="POST"
      action="{{ route('password.change.update') }}">

    @csrf

    <div class="mb-3">
        <label>Password Lama</label>

        <input type="password"
               name="password_lama"
               class="form-control"
               required>
    </div>


    <div class="mb-3">
        <label>Password Baru</label>

        <input type="password"
               name="password_baru"
               class="form-control"
               required>
    </div>


    <div class="mb-3">
        <label>Konfirmasi Password Baru</label>

        <input type="password"
               name="password_baru_confirmation"
               class="form-control"
               required>
    </div>


    <div class="mb-3">
        <label>Recovery Key (7 karakter bebas)</label>

        <input type="text"
               name="recovery_key"
               class="form-control"
               maxlength="7"
               required>
    </div>


    <button class="btn btn-dark w-100">
        Simpan
    </button>

</form>

        </div>

    </div>

</div>

@endsection