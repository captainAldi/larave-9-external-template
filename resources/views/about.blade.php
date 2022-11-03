@extends('layouts.dashboard')

@section('judul')
  <h1 class="h3 mb-4 text-gray-800">About</h1>
@endsection

@section('konten')
<div class="card shadow mb-4">
  <div class="card-header py-3">
    <h6 class="m-0 font-weight-bold text-primary">Info</h6>
  </div>

  <div class="card-body">
    @if (session('status'))
      <div class="alert alert-success" role="alert">
        {{ session('status') }}
      </div>
    @endif
    
    <i>About ...</i>

  </div>
</div>
@endsection

