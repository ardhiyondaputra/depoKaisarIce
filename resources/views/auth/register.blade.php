@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">

                <div class="card-header">Register</div>

                <div class="card-body">

                    <form method="POST" action="{{ route('register') }}">
                        @csrf

                        {{-- USERNAME --}}
                        <div class="row mb-3">
                            <label for="username"
                                   class="col-md-4 col-form-label text-md-end">
                                Username
                            </label>

                            <div class="col-md-6">
                                <input id="username"
                                       type="text"
                                       class="form-control @error('username') is-invalid @enderror"
                                       name="username"
                                       value="{{ old('username') }}"
                                       required autofocus>

                                @error('username')
                                    <span class="invalid-feedback">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        {{-- PASSWORD --}}
                        <div class="row mb-3">
                            <label for="password"
                                   class="col-md-4 col-form-label text-md-end">
                                Password
                            </label>

                            <div class="col-md-6">
                                <input id="password"
                                       type="password"
                                       class="form-control @error('password') is-invalid @enderror"
                                       name="password"
                                       required>

                                @error('password')
                                    <span class="invalid-feedback">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        {{-- CONFIRM PASSWORD --}}
                        <div class="row mb-3">
                            <label for="password-confirm"
                                   class="col-md-4 col-form-label text-md-end">
                                Confirm Password
                            </label>

                            <div class="col-md-6">
                                <input id="password-confirm"
                                       type="password"
                                       class="form-control"
                                       name="password_confirmation"
                                       required>
                            </div>
                        </div>

                        {{-- BUTTON --}}
                        <div class="row mb-0">
                            <div class="col-md-6 offset-md-4">

                                <button type="submit"
                                        class="btn btn-primary">
                                    Register
                                </button>

                            </div>
                        </div>

                    </form>

                </div>
            </div>
        </div>
    </div>
</div>
@endsection