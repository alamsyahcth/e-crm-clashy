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
        <form action="{{ url($role.'/'.$link.'/update/'.$data->id) }}" method="post" enctype="multipart/form-data">
          @csrf
          <div class="form-group mb-3">
            <label for="title">Judul Banner</label>
            <input type="text" class="form-control @error('title') is-invalid @enderror" name="title" id="title" value="{{ $data->title }}" placeholder="Judul Banner">
            @error('title')
            <span class="invalid-feedback" role="alert">
              <strong>{{ $message }}</strong>
            </span>
            @enderror
          </div>

          <div class="form-group mb-3">
            <label for="description">Deskripsi</label>
            <textarea type="textarea" class="form-control @error('description') is-invalid @enderror" name="description" id="description" value="{{ $data->description }}" placeholder="Deskripsi">{{ $data->description }}</textarea>
            @error('description')
            <span class="invalid-feedback" role="alert">
              <strong>{{ $message }}</strong>
            </span>
            @enderror
          </div>

          <div class="form-group mb-3">
            <label for="link">Link Ke Produk</label>
            <select name="link" id="link" class="form-control @error('link') is-invalid @enderror" value="{{ $data->link }}">
              <option value="">Pilih Link Produk</option>
              @foreach ($product as $value)
                <option value="{{ $value->slug }}" @if($data->link == $value->slug) selected @endif>{{ $value->name }}</option>
              @endforeach
            </select>
            @error('category_id')
            <span class="invalid-feedback" role="alert">
              <strong>{{ $message }}</strong>
            </span>
            @enderror
          </div>

          <div class="form-group mb-3">
            <label for="image">Gambar Kategori</label>
            <input type="file" class="form-control @error('image') is-invalid @enderror" name="image" id="image" placeholder="Gambar Kategori">
            <img src="{{ asset('img/'.$path.'/'.$data->image) }}" class="mt-3" alt="">
            <input type="hidden" name="image_old" value="{{ $data->image }}">
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