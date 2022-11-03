@extends('layouts.auth')

@section('konten')

<div class="text-center">
    <h1 class="h4 text-gray-900 mb-4">Selamat Datang !</h1>
</div>

<form class="user" method="POST" action="{{ route('login') }}">
    @csrf    

    <div class="form-group">
        <input type="email" class="form-control form-control-user @error('email') is-invalid @enderror" name="email" placeholder="Masukkan e-Mail...">

        @error('email')
            <span class="invalid-feedback" role="alert">
                <strong>{{ $message }}</strong>
            </span>
        @enderror
    </div>

    <div class="form-group">
        <input type="password" class="form-control form-control-user @error('password') is-invalid @enderror" name="password" required autocomplete="current-password" placeholder="Masukkan Password...">

        @error('password')
            <span class="invalid-feedback" role="alert">
                <strong>{{ $message }}</strong>
            </span>
        @enderror
    </div>

    <div class="form-group">
        <div class="custom-control custom-checkbox small">
            <input type="checkbox" class="custom-control-input" id="remember" name="remember" {{ old('remember') ? 'checked' : '' }}>
            <label class="custom-control-label" for="remember">Ingat Saya</label>
        </div>
    </div>

    <button type="submit" class="btn btn-primary btn-user btn-block">
        Login
    </button>

</form>

<hr>

@if (Route::has('password.request'))
    <div class="text-center">
        <a class="small" href="{{ route('password.request') }}">Lupa Password ?</a>
    </div>
@endif

<div class="text-center">
    <a class="small" href="{{ route('register') }}">Buat Akun Baru!</a>
</div>

@endsection
