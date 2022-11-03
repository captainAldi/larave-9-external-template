@extends('layouts.dashboard')

@section('judul')
  <h1 class="h3 mb-4 text-gray-800">Verifikasi e-Mail</h1>
@endsection

@section('konten')

<div class="card shadow mb-4">
  <div class="card-header py-3">
    <h6 class="m-0 font-weight-bold text-primary">Data</h6>
  </div>

  <div class="card-body">
    @if (session('resent'))
        <div class="alert alert-success" role="alert">
            Link Verifikasi Baru telah di Kirim ke email anda.
        </div>
    @endif

    Sebelum melanjutkan, silahkan periksa email untuk link verifikasi.
    Jika anda tidak menerima email

    <form class="d-inline" method="POST" action="{{ route('verification.resend') }}">
        @csrf
        <button type="submit" class="btn btn-link p-0 m-0 align-baseline">Klik Disini untuk Request Link Baru</button>.
    </form>
  </div>
</div>

@endsection
