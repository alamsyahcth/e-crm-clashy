@extends('frontend.layouts.app')

@section('title')
{{ config('app.name', 'Clashy') }}
@endsection

@section('description')

@endsection

@section('content')
<div class="container my-5">
  <div class="row">
    <div class="col-md-12">
      <h1 class="mb-4">{{ $data->title }}</h1>
      <img src="{{ asset('img/article/'.$data->featured_image) }}" style="width: 100%; height: 300px; object-fit:cover;" class="mb-5 rounded-lg" alt="">
      <p>{{ $data->content }}</p>
    </div>
  </div>
</div>
@endsection