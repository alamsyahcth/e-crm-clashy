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
      <h1>Article</h1>
    </div>
    @foreach($data as $value)
    <div class="col-md-4">
      <a href="{{ url('article/all/'. $value->id) }}">
        <div class="card border-0">
          <div class="card-body">
            <img src="{{ asset('img/article/'.$value->featured_image) }}" style="width: 100%; height: 250px; object-fit: cover;" class="mb-2" alt="">
            <h4>{{ $value->title }}</h4>
          </div>
        </div>
      </a>
    </div>
    @endforeach
  </div>
</div>
@endsection