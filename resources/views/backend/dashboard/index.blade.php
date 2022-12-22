@extends('backend.layouts.app')
@php $link = str_replace(' ', '-', strtolower($page)) @endphp
@section('titlePage', $page)
@section('rightHeader')

@endsection

@section('content')
<div class="row">
  <div class="col-md-8 stretch-card grid-margin">
    <div class="card">
      <div class="card-body">
        <div class="d-flex justify-content-between flex-wrap">
          <div>
            <div class="card-title mb-0">Total Keseluruhan Bintang</div>
            <h3 class="font-weight-bold mb-0">{{ $getStars }} <i class="mdi mdi-star text-warning"></i></h3>
          </div>
        </div>
        <div class="flot-chart-wrapper mt-5">
          <canvas id="chartStars"></canvas>
        </div>
      </div>
    </div>
  </div>
  <div class="col-md-4 grid-margin">
    <div class="card">
      <div class="card-body">
        <div class="d-flex mb-4 pb-2">
          <div class="hexagon">
            <div class="hex-mid hexagon-warning">
              <i class="mdi mdi mdi-book-open"></i>
            </div>
          </div>
          <div class="pl-4">
            <h4 class="font-weight-bold text-warning mb-0"> {{ $booking }} </h4>
            <h6 class="text-muted">Total Booking</h6>
          </div>
        </div>
        <div class="d-flex mb-4 pb-2">
          <div class="hexagon">
            <div class="hex-mid hexagon-danger">
              <i class="mdi mdi-sunglasses"></i>
            </div>
          </div>
          <div class="pl-4">
            <h4 class="font-weight-bold text-danger mb-0">{{ $product }}</h4>
            <h6 class="text-muted">Jumlah Produk</h6>
          </div>
        </div>
        <div class="d-flex mb-4 pb-2">
          <div class="hexagon">
            <div class="hex-mid hexagon-success">
              <i class="mdi mdi-account-multiple-outline"></i>
            </div>
          </div>
          <div class="pl-4">
            <h4 class="font-weight-bold text-success mb-0"> {{ $customer }} </h4>
            <h6 class="text-muted">Jumlah Customer</h6>
          </div>
        </div>
        <div class="d-flex mb-4 pb-2">
          <div class="hexagon">
            <div class="hex-mid hexagon-info">
              <i class="mdi mdi-calendar-multiple"></i>
            </div>
          </div>
          <div class="pl-4">
            <h4 class="font-weight-bold text-info mb-0">{{ $schedule }}</h4>
            <h6 class="text-muted">Jumlah Jadwal Aktif</h6>
          </div>
        </div>
        <div class="d-flex">
          <div class="hexagon">
            <div class="hex-mid hexagon-primary">
              <i class="mdi mdi-emoticon-sad"></i>
            </div>
          </div>
          <div class="pl-4">
            <h4 class="font-weight-bold text-primary mb-0">{{ $complain }}</h4>
            <h6 class="text-muted mb-0">Jumlah Keluhan</h6>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
@for($i=1; $i<=5; $i++)
  <input type="hidden" id="stars-{{ $i }}" value="{{ $dataStars[$i] }}">
@endfor
@endsection

@push('script')
<script src="{{ asset('vendor/chartjs/chartjs.js') }}"></script>
<script>
  const ctx = document.getElementById('chartStars');
  new Chart(ctx, {
    type: 'bar',
    data: {
      labels: ['Bintang 1', 'Bintang 2', 'Bintang 3', 'Bintang 4', 'Bintang 5'],
      datasets: [{
        label: 'Jumlah Bintang',
        data: [$('#stars-1').val(),$('#stars-2').val(),$('#stars-3').val(),$('#stars-4').val(),$('#stars-5').val(),],
        backgroundColor: '#fad505',
      }],
    },
    options: {
      scales: {
        y: {
          beginAtZero: true
        }
      }
    }
  });
</script>
@endpush