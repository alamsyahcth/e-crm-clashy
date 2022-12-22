@extends('frontend.layouts.app')

@section('title')
{{ config('app.name', 'Clashy') }}
@endsection

@section('description')

@endsection

@section('content')
<section class="py-5 bg-product">
  <div class="container">
    <div class="row">
      <div class="col-md-9 mb-5">
        <form action="{{ url('book/search/store') }}" method="post">
          @csrf
          <div class="row">
            <div class="col-10">
              <select name="date" id="date" class="form-control mb-3">
                @foreach($getSchedule as $value)
                  <option value="{{ $value->date }}">{{ getDateFormat($value->date) }}</option>
                @endforeach
              </select>
              <input type="hidden" name="productSlug" value="{{ $product->slug }}">
            </div>
            <div class="col-2">
              <button type="submit" class="btn btn-primary w-100"><i class="fas fa-search"></i> Cari</button>
            </div>
          </div>
        </form>
      </div>
      <div class="col-md-9">
        <p class="text-muted mb-0">Menampilkan Jadwal untuk Tanggal:</p>
        <h4 class="mb-4">{{ $schedule->day }}, {{ getDateFormat($schedule->date) }}</h4>
      </div>
      <div class="col-md-9">
        @foreach($scheduleList as $value)
        <div class="card border-0 mb-3">
          <div class="card-body">
            <div class="d-flex justify-content-between align-items-center">
              <div class="d-flex justify-content-start align-items-center">
                <div class="d-block me-5">
                  <p class="mb-0 text-muted">Nama Therapist</p>
                  @foreach($employee as $employeeValues)
                    @if($value->employee_id == $employeeValues->id)
                      <h6>{{ $employeeValues->name }}</h6>
                    @endif
                  @endforeach
                </div>
                <div class="d-block">
                  <p class="mb-0 text-muted">Waktu</p>
                  <h6>{{ timeFormat($value->time_start) }} - {{ timeFormat($value->time_end) }}</h6>
                </div>
              </div>
              <button class="btn btn-primary btn-lg btn-choose-time" data-id="{{ $value->id }}" data-employee="{{ $employeeValues->name }}" data-time="{{ timeFormat($value->time_start) }} - {{ timeFormat($value->time_end) }}">Pilih Jam</button>
            </div>
          </div>
        </div>
        @endforeach
      </div>
      <div class="col-md-3">
        <div class="card sticky-top border-0">
          <div class="card-body">
            <img src="{{ asset('img/product/'.$product->image) }}" class="img-fluid mb-3" alt="">
            <div class="d-flex justify-content-between align-items-center">
              <p class="text-muted">Nama Produk</p>
              <p>{{ $product->name }}</p>
            </div>
            <div class="d-flex justify-content-between align-items-center">
              <p class="text-muted">Harga</p>
              <p>{{ currency($product->price) }}</p>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</section>
@endsection

@push('modal')
<div class="modal fade" id="modalBook" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered">
    <div class="modal-content border-0">
      <div class="modal-header border-0">
        <h5 class="modal-title" id="staticBackdropLabel">Konfirmasi Booking</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <form action="{{ url('book/store') }}" method="post">
        @csrf
        <div class="modal-body">
          <div class="d-flex justify-content-between align-items-center py-3 border-bottom">
            <p class="text-muted mb-0">Nama Produk</p>
            <p class="mb-0">{{ $product->name }}</p>
          </div>
          <div class="d-flex justify-content-between align-items-center py-3 border-bottom">
            <p class="text-muted mb-0">Harga</p>
            <p class="mb-0">{{ currency($product->price) }}</p>
          </div>
          <div class="d-flex justify-content-between align-items-center py-3 border-bottom">
            <p class="text-muted mb-0">Hari dan Tanggal</p>
            <p class="mb-0">{{ $schedule->day }}, {{ getDateFormat($schedule->date) }}</p>
          </div>
          <div class="d-flex justify-content-between align-items-center py-3 border-bottom">
            <p class="text-muted mb-0">Waktu</p>
            <p class="mb-0 getTime"></p>
          </div>
          <div class="d-flex justify-content-between align-items-center py-3 border-bottom">
            <p class="text-muted mb-0">Therapist</p>
            <p class="mb-0 getTherapist"></p>
          </div>
        </div>
        <input type="hidden" name="schedule_detail_id" id="scheduleDetailId">
        <input type="hidden" name="user_id" value="{{ Auth::user()->id }}">
        <input type="hidden" name="product_id" value="{{ $product->id }}">
        <input type="hidden" name="date_pick" value="{{ $schedule->date }}">
        <div class="modal-footer border-0">
          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
          <button type="Submit" class="btn btn-primary">Booking Sekarang</button>
        </div>
      </form>
    </div>
  </div>
</div>
@endpush

@push('style')
<style>
  .bg-product {
    background-color: #f8f9fa;
  }
</style>
@endpush

@push('script')
<script>
$(document).on('click', '.btn-choose-time', function() {
  $('#modalBook').modal('show');
  $('#scheduleDetailId').val($(this).data('id'));
  $('.getTime').html($(this).data('time'));
  $('.getTherapist').html($(this).data('employee'));
})
</script>
@endpush