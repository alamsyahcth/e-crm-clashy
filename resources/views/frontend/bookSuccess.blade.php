@extends('frontend.layouts.app')

@section('title')
{{ config('app.name', 'Clashy') }}
@endsection

@section('description')

@endsection

@section('content')
<section class="py-5 bg-product">
  <div class="container">
    <div class="row justify-content-center">
      <div class="col-md-4">
        <div class="card py-5">
          <div class="card-body">
            <div class="row">
              <div class="col-md-12 text-center mb-3">
                <h3>Bukti Booking</h3>
                <p class="text-muted mb-0">{{ $dataBook->invoice }}</p>
                <p class="text-muted">{{ getDateFormat(Carbon\Carbon::createFromFormat('Y-m-d H:i:s', $dataBook->books_created_at)->format('Y-m-d')) }}</p>
              </div>
              @if($dataBook->book_is_promo == 'yes')
                <hr>
                <div class="col-md-12 text-center mb-3">
                  <div class="card bg-primary">
                    <div class="card-body">
                      <h5>Selamat {{ Auth::user()->name }} point kamu sudah 30 dapatkan promo menarik dari kami !</h5>
                    </div>
                  </div>
                </div>
              @endif
              <hr>
              <div class="col-md-12 mb-3">
                <div class="row h-100">
                  <div class="col-md-4 my-auto">
                    <img src="{{ asset('img/product/'.$dataBook->product_image) }}" class="img-fluid rounded" alt="">
                  </div>
                  <div class="col-md-8 my-auto">
                    <h6 class="mb-0">{{ $dataBook->product_name }}</h6>
                    <p class="text-muted mb-0">{{ currency($dataBook->product_price) }}</p>
                  </div>
                </div>
              </div>
              <hr>
              <div class="col-md-12 d-flex justify-content-between align-items-center border-bottom py-2">
                <p class="text-muted mb-0">Hari dan Tanggal</p>
                <p class="mb-0">{{ $dataBook->schedule_day.' '.getDateFormat($dataBook->schedule_date) }}</p>
              </div>
              <div class="col-md-12 d-flex justify-content-between align-items-center border-bottom py-2">
                <p class="text-muted mb-0">Waktu</p>
                <p class="mb-0">{{ timeFormat($dataBook->time_start) .'-'. timeFormat($dataBook->time_end) }}</p>
              </div>
              <div class="col-md-12 d-flex justify-content-between align-items-center border-bottom py-2">
                <p class="text-muted mb-0">Eyelash technician</p>
                <p class="mb-0">{{ $dataBook->employee_name }}</p>
              </div>
              <hr>
              <div class="col-md-12 text-center">
                <p class="text-muted mb-4"><small>Berikan bukti booking dengan klik tombol cetak pdf yang nantinya diberikan kepada resepsionis</small></p>
                <a href="{{ url('book/print/'.Crypt::encryptString($dataBook->book_id)) }}" target="_blank" class="btn btn-dark w-100 btn-lg mb-2">Cetak Booking Order</a>
                <a href="{{ url('produk') }}" class="btn btn-outline-dark w-100 btn-lg mb-2">Booking Lagi</a>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</section>
@endsection

@push('style')
<style>
  .bg-product {
    background-color: #f8f9fa;
  }
</style>
@endpush

@push('script')

@endpush

