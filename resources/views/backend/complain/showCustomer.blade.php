@extends('backend.layouts.app')
@php $link = str_replace(' ', '-', strtolower($page)) @endphp
@section('titlePage', $page.' - '.$product->name)
@section('rightHeader')

@endsection

@section('content')
<div class="row">
  <div class="col-md-12">
    <div class="card">
      <div class="card-header">
        {{ $customer->name }}
      </div>
      <div class="card-body all-complain">
        @foreach ($data as $value)
          @if($value->id == null)
          <div class="col-md-12 text-center py-5">
            <p class="text-muted">
              Belum ada komplain
            </p>
          </div>
          @else
            @if($value->is_admin == 0 && $value->is_customer == 1)
              <div class="d-flex justify-content-start mb-2">
                <div class="complain-box left p-2 rounded bg-primary text-light">
                  <p class="mb-1">{{ $value->message }}</p>
                  <p class="small-2 mb-0 opacity-5">{{ getDateFormat(Carbon\Carbon::createFromFormat('Y-m-d H:i:s', $value->created_at)->format('Y-m-d')).' - '. Carbon\Carbon::createFromFormat('Y-m-d H:i:s', $value->created_at)->format('H.i')}}</p>
                </div>
              </div>
            @endif
            @if($value->is_customer == 0 && $value->is_admin == 1)
              <div class="d-flex justify-content-end mb-2 text-end">
                <div class="complain-box right p-2 rounded bg-secondary">
                  <p class="mb-1">{{ $value->message }}</p>
                  <p class="small-2 mb-0 opacity-5">{{ getDateFormat(Carbon\Carbon::createFromFormat('Y-m-d H:i:s', $value->created_at)->format('Y-m-d')).' - '. Carbon\Carbon::createFromFormat('Y-m-d H:i:s', $value->created_at)->format('H.i')}}</p>
                </div>
              </div>
            @endif
          @endif
        @endforeach
      </div>
      <div class="card-footer">
        <form action="{{ url('admin/keluhan/store/'.$product->id.'/'.$customer->id) }}" method="post">
          @csrf
          <div class="row align-items-center">
            <div class="col-11">
              <input type="text" name="message" id="message" class="form-control" rows="3" placeholder="Masukkan pesan anda" required>
            </div>
            <div class="col-1">
              <button type="submit" class="btn btn-dark">Kirim</button>
            </div>
          </div>
        </form>
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
.complain-box{
  max-width: 75%;
}
.all-complain{
  height: 60vh;
  overflow-y: auto;
  display: flex;
  flex-direction: column-reverse;
}
</style>
@endpush