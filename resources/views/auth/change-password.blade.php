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

    <button class="btn btn-dark w-100">
        Simpan
    </button>

</div>

@endsection