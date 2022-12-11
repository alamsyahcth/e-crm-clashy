@extends('backend.layouts.app')
@php $link = str_replace(' ', '-', strtolower($page)) @endphp
@section('titlePage', $page)
@section('rightHeader')
  
@endsection

@section('content')
<div class="row">
  <div class="col-md-12">
    <div class="card">
      <div class="card-body">
        <form action="{{ url($role.'/'.$link.'/store') }}" method="post" enctype="multipart/form-data">
          @csrf
          <div class="form-group mb-3">
            <label for="name">Nama</label>
            <input type="text" class="form-control @error('name') is-invalid @enderror" name="name" id="name" value="{{ old('name') }}" placeholder="Nama">
            @error('name')
            <span class="invalid-feedback" role="alert">
              <strong>{{ $message }}</strong>
            </span>
            @enderror
          </div>

          <div class="form-group mb-3">
            <label for="slug">Slug <small class="text-secondary">(Pastikan slug tidak sama dengan data slug yang tersimpan)</small></label>
            <input type="text" class="form-control @error('slug') is-invalid @enderror" name="slug" id="slug" value="{{ old('slug') }}" placeholder="Slug" readonly>
            @error('slug')
            <span class="invalid-feedback" role="alert">
              <strong>{{ $message }}</strong>
            </span>
            @enderror
          </div>

          <div class="form-group mb-3">
            <label for="description">Deskripsi</label>
            <textarea type="textarea" class="form-control @error('description') is-invalid @enderror" name="description" id="description" value="{{ old('description') }}" placeholder="Deskripsi">{{ old('description') }}</textarea>
            @error('description')
            <span class="invalid-feedback" role="alert">
              <strong>{{ $message }}</strong>
            </span>
            @enderror
          </div>

          <div class="form-group mb-3">
            <label for="image">Gambar Kategori</label>
            <input type="file" class="form-control @error('image') is-invalid @enderror" name="image" id="image" value="{{ old('image') }}" placeholder="Gambar Kategori">
            @error('image')
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