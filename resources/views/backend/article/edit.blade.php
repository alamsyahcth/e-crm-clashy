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
            <label for="title">Title</label>
            <input type="text" class="form-control @error('title') is-invalid @enderror" name="title" id="title" value="{{ $data->title }}" placeholder="Title">
            @error('title')
            <span class="invalid-feedback" role="alert">
              <strong>{{ $message }}</strong>
            </span>
            @enderror
          </div>

          <div class="form-group mb-3">
            <label for="content">Konten</label>
            <textarea type="textarea" class="form-control @error('content') is-invalid @enderror" name="content" id="content" value=" value="{{ $data->content }}"" placeholder="Konten"> {{ $data->content }}"</textarea>
            @error('content')
            <span class="invalid-feedback" role="alert">
              <strong>{{ $message }}</strong>
            </span>
            @enderror
          </div>


          <div class="form-group mb-3">
            <label for="featured_image">Featured Image</label>
            <input type="file" class="form-control @error('image') is-invalid @enderror" name="featured_image" id="featured_image" placeholder="Featured Image">
            <img src="{{ asset('img/'.$path.'/'.$data->featured_image) }}" class="mt-3" alt="">
            <input type="hidden" name="image_old" value="{{ $data->featured_image }}">
            @error('featured_image')
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