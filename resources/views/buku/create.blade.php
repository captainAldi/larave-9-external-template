@extends('layouts.dashboard')

@push('styles')
<link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
@endpush

@section('judul')
  <h1 class="h3 mb-4 text-gray-800">Buku</h1>
@endsection

@section('konten')
<div class="card shadow mb-4">
  <div class="card-header py-3">
    <h6 class="m-0 font-weight-bold text-primary">Create</h6>
  </div>

  <div class="card-body">
    @if (session('status'))
      <div class="alert alert-success" role="alert">
        {{ session('status') }}
      </div>
    @endif
    
    <form action="{{ route('post.proses-tambah.buku') }}" method="post">
      @csrf

      <div class="form-group row">
        <label for="judul" class="col-sm-2 col-form-label">Judul</label>

        <div class="col-sm-10">
          <input type="text" class="form-control @error('judul') is-invalid @enderror" name="judul" value="{{ old('judul', '') }}">

          @error('judul')
            <div class="invalid-feedback">
              <strong>{{ $message }}</strong>
            </div>
          @enderror
        </div>
        
      </div>

      <div class="form-group row">
        <label for="edisi_ke" class="col-sm-2 col-form-label">Edisi</label>

        <div class="col-sm-10">
          <input type="text" class="form-control @error('edisi_ke') is-invalid @enderror" name="edisi_ke" value="{{ old('edisi_ke', '') }}">

          @error('edisi_ke')
            <div class="invalid-feedback">
              <strong>{{ $message }}</strong>
            </div>
          @enderror
        </div>
        
      </div>

      <div class="form-group row">
        <label for="edisi_ke" class="col-sm-2 col-form-label">Penerbit</label>

        <div class="col-sm-10">
          <select class="penerbit-id form-control custom-select" name="penerbit_ke">
            <option value="">Pilih Opsi</option>
            @foreach($data_penerbit as $penerbit)
              <option value="{{ $penerbit->id }}" {{ old('penerbit_id') == $penerbit->id ? 'selected' : '' }}>{{ $penerbit->nama }}</option>
            @endforeach
          </select>

          @error('penerbit_ke')
            <div class="invalid-feedback">
              <strong>{{ $message }}</strong>
            </div>
          @enderror
        </div>
        
      </div>


      <button type="submit" class="btn btn-success">
        Simpan
      </button>

    </form>

  </div>
</div>
@endsection

@push('scripts')
<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>

<script>
  $(document).ready(function() {
    $('.penerbit-id').select2();
  });
</script>
@endpush
