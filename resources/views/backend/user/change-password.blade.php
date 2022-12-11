@extends('backend.layouts.app')
@php $link = str_replace(' ', '-', strtolower($page)) @endphp
@section('titlePage', 'Ubah Password')
@section('rightHeader')
  
@endsection

@section('content')
<div class="row">
  <div class="col-md-12">
    <div class="card">
      <div class="card-body">
        <form action="{{ url($role.'/'.$link.'/change-password-action') }}" method="post" enctype="multipart/form-data">
          @csrf

          <div class="form-group mb-3">
            <label for="old_password">Password Lama</label>
            <input type="password" class="form-control @error('old_password') is-invalid @enderror" name="old_password" id="old_password" value="{{ old('old_password') }}" placeholder="Masukkan password lama anda">
            @error('old_password')
            <span class="invalid-feedback" role="alert">
              <strong>{{ $message }}</strong>
            </span>
            @enderror
          </div>

          <div class="form-group mb-3">
            <label for="new_password">Password Baru</label>
            <input type="password" class="form-control @error('new_password') is-invalid @enderror" name="new_password" id="new_password" value="{{ old('new_password') }}" placeholder="Masukkan password lama anda">
            @error('new_password')
            <span class="invalid-feedback" role="alert">
              <strong>{{ $message }}</strong>
            </span>
            @enderror
          </div>

          <div class="form-group mb-3">
            <label for="confirm_new_password">Password Baru</label>
            <input type="password" class="form-control @error('confirm_new_password') is-invalid @enderror" name="confirm_new_password" id="confirm_new_password" value="{{ old('confirm_new_password') }}" placeholder="Konfirmasi Password Baru">
            @error('confirm_new_password')
            <span class="invalid-feedback" role="alert">
              <strong>{{ $message }}</strong>
            </span>
            @enderror
          </div>

          <div class="form-group d-flex justify-content-end">
            <button type="submit" class="btn btn-primary btn-lg">Simpan</button>
          </div>

        </form>
      </div>
    </div>
  </div>
</div>
@endsection

@push('script')
<script>
$('#name').on('keyup input', function() {
  $('#slug').val(convertToSlug($(this).val()))
})
function convertToSlug(Text) {
  return Text.toLowerCase().replace(/ /g, '-').replace(/[^\w-]+/g, '');
}
</script>
@endpush