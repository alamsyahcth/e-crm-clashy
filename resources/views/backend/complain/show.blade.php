@extends('backend.layouts.app')
@php $link = str_replace(' ', '-', strtolower($page)) @endphp
@section('titlePage', $page.' - '.$product->name)
@section('rightHeader')

@endsection

@section('content')
<div class="row">
  <div class="col-md-12">
    <div class="card">
      <div class="card-body">
        @foreach($data as $value)
        <a href="{{ url('admin/keluhan/'.$product->id.'/'.$value->user_id) }}">
          <div class="p-3 bg-light rounded mb-3">
            <div class="d-flex justify-content-between align-items-center">
              <div class="d-flex align-items-center p-3">
                <div class="flex-shrink-0 discussion-avatar mr-3">
                  {{ substr($value->name, 0, 1); }}
                </div>
                <div class="ms-3 flex-shrink-1">
                  <div class="d-block mb-0">
                    <h4 class="mb-0 text-uppercase me-2 align-items-center mr-2">{{ $value->name }}</h4>
                    <p class="mb-0 text-muted">{{ $value->email }}</p>
                    <p class="mb-0 text-muted">{{ $value->phone }}</p>
                  </div>
                </div>
              </div>
              <i class="mdi mdi-message-text-outline text-primary" style="font-size: 50px;"></i>
            </div>
          </div>
        </a>
        @endforeach
      </div>
    </div>
  </div>
</div>
@endsection

@push('style')
<style>
.discussion-avatar{
  width: 50px;
  height: 50px;
  border-radius: 100px;
  background: #e1d0d0;
  color: #261414;
  display: flex;
  justify-content: center;
  align-items: center;
  text-transform: uppercase;
}
.small-2{
  font-size: 10px;
}
a, a:hover{
  text-decoration: none !important;
}
</style>
@endpush