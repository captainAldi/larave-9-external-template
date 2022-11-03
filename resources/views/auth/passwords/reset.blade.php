@extends('layouts.auth')

@section('konten')

<div class="text-center">
    <h1 class="h4 text-gray-900 mb-4">Reset Password !</h1>
</div>

<form class="user" method="POST" action="{{ route('password.update') }}">
    @csrf

    <input type="hidden" name="token" value="{{ $token }}">

    <div class="form-group">
        <input type="email" class="form-control form-control-user @error('email') is-invalid @enderror" name="email" value="{{ $email ?? old('email') }}" placeholder="Masukkan e-Mail...">

        @error('email')
            <span class="invalid-feedback" role="alert">
                <strong>{{ $message }}</strong>
            </span>
        @enderror
    </div>

    <div class="form-group">
        <input type="password" class="form-control form-control-user @error('password') is-invalid @enderror" name="password" required placeholder="Masukkan Password...">

        @error('password')
            <span class="invalid-feedback" role="alert">
                <strong>{{ $message }}</strong>
            </span>
        @enderror
    </div>

    <div class="form-group">
        <input type="password" class="form-control form-control-user @error('password_confirmation') is-invalid @enderror" name="password_confirmation" required placeholder="Konfirmasi Password...">

        @error('password_confirmation')
            <span class="invalid-feedback" role="alert">
                <strong>{{ $message }}</strong>
            </span>
        @enderror
    </div>

    <button type="submit" class="btn btn-primary btn-user btn-block">
        Submit
    </button>    

</form>

@endsection
