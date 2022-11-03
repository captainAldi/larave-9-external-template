@extends('layouts.auth')

@section('konten')

<div class="text-center">
    <h1 class="h4 text-gray-900 mb-4">Link Reset !</h1>
</div>


@if (session('status'))
    <div class="alert alert-success" role="alert">
        {{ session('status') }}
    </div>
@endif

<form class="user" method="POST" action="{{ route('password.email') }}">
    @csrf    

    <div class="form-group">
        <input type="email" class="form-control form-control-user @error('email') is-invalid @enderror" name="email" placeholder="Masukkan e-Mail...">

        @error('email')
            <span class="invalid-feedback" role="alert">
                <strong>{{ $message }}</strong>
            </span>
        @enderror
    </div>

    <button type="submit" class="btn btn-primary btn-user btn-block">
        Kirim
    </button>

</form>
@endsection
