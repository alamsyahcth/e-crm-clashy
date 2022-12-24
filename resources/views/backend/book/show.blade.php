@extends('backend.layouts.app')
@php $link = str_replace(' ', '-', strtolower($page)) @endphp
@section('titlePage', $page)
@section('rightHeader')
  {{-- <a href="{{ url($role.'/'.$link.'/create') }}" class="btn btn-primary btn-sm d-flex align-items-center"><i class="mdi mdi-plus-circle-outline mr-2"></i> Tambah Data</a> --}}
@endsection

@section('content')
<div class="row">
  <div class="col-md-12">
    @if($data->is_promo == 'yes')
      <div class="alert alert-success">Customer atas nama <strong>{{ $data->user_name }}</strong> berhak mendapatkan promo</div>
    @endif
    @if($data->schedule_status == 0)
      <div class="alert alert-danger mt-3">Maaf, jadwal telah dinonaktifkan</div>
    @endif
    <div class="card">
      <div class="card-body py-5 d-flex justify-content-between align-items-center border-bottom">
        <h5 class="mb-0">Kode Booking: <span class="text-primary">{{ $data->invoice }}</span></h5>
        <div>
          <span>Status: </span>
          @if($data->book_status == 0)  
            <div class="badge badge-danger">Belum Hadir</div>
          @elseif($data->book_status == 1)
            <div class="badge badge-success">Selesai</div>
          @elseif($data->book_status == 2)
            <div class="badge badge-secondary">Batal</div>
          @endif
        </div>
      </div>
      <div class="col-md-12 py-5 border-bottom">
        <h6 class="text-muted">Data Booking</h6>
        <div class="row">
          <div class="col-md-4">
            <p>Tanggal: <strong>{{ $data->schedule_day }} {{ getDateFormat($data->schedule_date) }}</strong></p>
          </div>
          <div class="col-md-4">
            <p>Waktu: <strong>{{ timeFormat($data->time_start) .'-'. timeFormat($data->time_end) }}</strong></p>
          </div>
          <div class="col-md-4">
            <p>Eyelash technician: <strong>{{ $data->employee_name }} ({{ $data->employee_phone }})</strong></p>
          </div>
        </div>
      </div>
      <div class="card-body py-5 border-bottom">
        <div class="row">
          <div class="col-md-6">
            <h6 class="text-muted mb-4">Data Customer</h6>
            <div class="d-flex justify-content-between align-items-center mb-3">
              <p>Nama Customer:</p>
              <p><strong>{{ $data->user_name }}</strong></p>
            </div>
            <div class="d-flex justify-content-between align-items-center mb-3">
              <p>Email Customer:</p>
              <p><strong>{{ $data->user_email }}</strong></p>
            </div>
            <div class="d-flex justify-content-between align-items-center mb-3">
              <p>No Handphone Customer:</p>
              <p><strong>{{ $data->user_phone }}</strong></p>
            </div>
          </div>
          <div class="col-md-6">
            <h6 class="text-muted mb-4">Data Produk</h6>
            <div class="row">
              <div class="col-md-4 my-auto">
                <img src="{{ asset('img/product/'.$data->product_image) }}" class="img-fluid rounded" alt="">
              </div>
              <div class="col-md-8 my-auto">
                <h6 class="mb-0">{{ $data->product_name }}</h6>
                <p class="text-muted mb-0">{{ currency($data->product_price) }}</p>
              </div>
            </div>
          </div>
        </div>
      </div>
      @if($data->book_status == 0)
        @if($data->schedule_status == 1)
          <div class="card-body py-5 d-flex justify-content-end align-items-center">
            <a href="{{ url($role.'/'.$link.'/action/cancel/'.$data->book_id) }}" class="btn btn-outline-secondary btn-lg mr-4">Batal</a>
            <a href="{{ url($role.'/'.$link.'/action/present/'.$data->book_id) }}" class="btn btn-primary btn-lg">Hadir</a>
          </div>
        @endif
      @endif
    </div>
  </div>
</div>
@endsection

@push('style')
<style>
  .btn-accordion {
    font-size: 18px;
  }
</style>
@endpush