@extends('frontend.layouts.app')

@section('title')
  {{ config('app.name', 'Clashy') }}
@endsection

@section('description')

@endsection

@section('content')
<!-- HERO SECTION-->
<div class="container">
  <div class="row">
    <div class="col-md-12 position-relative">
      @if(Auth::check() == true)
        @if(Auth::user()->role == 2)
          @if(Auth::user()->point == 30)
            <div class="card bg-primary border-0 mb-3">
              <div class="card-body">
                <h5 class="mb-0">Selamat {{ Auth::user()->name }} point kamu sudah 30 dapatkan promo menarik dari kami !</h5>
              </div>
            </div>
          @endif
        @endif
      @endif
      <div class="swiper banner-slide">
        <div class="swiper-wrapper">
          @foreach($banner as $value)
          <div class="swiper-slide hero pb-3 bg-cover bg-center d-flex align-items-center"
            style="background: url({{ asset('img/banner/'.$value->image) }})">
            <div class="container py-5">
              <div class="row px-4 px-lg-5">
                <div class="col-lg-6">
                  <p class="text-muted small text-uppercase mb-2">{{ $value->description }}</p>
                  <h1 class="h2 text-uppercase mb-3">{{ $value->title }}</h1>
                  <a class="btn btn-dark" href="{{ url('/produk/'.$value->link) }}">Lihat Produk</a>
                </div>
              </div>
            </div>
          </div>
          @endforeach
        </div>
        <div class="swiper-pagination"></div>
      </div>
      <div class="swiper-button-next"><img src="{{ asset('img/arrow-right.svg') }}" alt=""></div>
      <div class="swiper-button-prev"><img src="{{ asset('img/arrow-left.svg') }}" alt=""></div>
    </div>
  </div>
  <!-- CATEGORIES SECTION-->
  <section class="pt-5">
    <header class="text-center">
      <p class="small text-muted small text-uppercase mb-1">Koleksi Menarik Dari Kami</p>
      <h2 class="h5 text-uppercase mb-4">Kategori Produk</h2>
    </header>
    <div class="row">
      @foreach($category as $value)
      <div class="col-md-4">
        <a class="category-item" href="{{ url('/'.$value->slug) }}">
          <img class="img-fluid img-category" src="{{ asset('img/categoryProduct/'.$value->image) }}" alt="" />
          <strong class="category-item-title">{{ $value->name }}</strong>
        </a>
      </div>
      @endforeach
    </div>
  </section>
  <!-- TRENDING PRODUCTS-->
  <section class="py-5">
    <header>
      <p class="small text-muted small text-uppercase mb-1">Kami Selalu Memberikan Produk Terbaik</p>
      <h2 class="h5 text-uppercase mb-4">Rekomendasi Produk</h2>
    </header>
    <div class="row">
      
      @foreach($product as $value)
      <div class="col-xl-3 col-lg-4 col-sm-6">
        <div class="product text-center">
          <div class="position-relative mb-3">
            <div class="badge text-white bg-"></div>
            <a class="d-block" href="{{ url('produk/'.$value->slug) }}">
              <img class="img-fluid img-product w-100" src="{{ asset('img/product/'.$value->image) }}" alt="{{ $value->name }}">
            </a>
            <div class="product-overlay">
              <ul class="mb-0 list-inline">
                <li class="list-inline-item m-0 p-0"><a class="btn btn-sm btn-dark" href="{{ url('produk/'.$value->slug) }}">Lihat Produk</a>
                </li>
              </ul>
            </div>
          </div>
          <h6> <a class="reset-anchor" href="{{ url('produk/'.$value->slug) }}">{{ $value->name }}</a></h6>
          <p class="small text-muted">{{ currency($value->price) }}</p>
        </div>
      </div>
      @endforeach

      {!! $product->links() !!}
  
    </div>
  </section>
@endsection

@push('style')
<style>
.swiper {
  width: 100%;
  height: 100%;
}
.swiper-slide {
  background: #fff;

  /* Center slide text vertically */
  display: -webkit-box;
  display: -ms-flexbox;
  display: -webkit-flex;
  display: flex;
  -webkit-box-pack: center;
  -ms-flex-pack: center;
  -webkit-justify-content: center;
  justify-content: center;
  -webkit-box-align: center;
  -ms-flex-align: center;
  -webkit-align-items: center;
  align-items: center;
}
.swiper-horizontal>.swiper-pagination-progressbar, .swiper-pagination-progressbar.swiper-pagination-horizontal, .swiper-pagination-progressbar.swiper-pagination-vertical.swiper-pagination-progressbar-opposite, .swiper-vertical>.swiper-pagination-progressbar.swiper-pagination-progressbar-opposite {
  width: 100%;
  height: 4px;
  left: 0;
  bottom: 0;
  top: unset;
}
.swiper-pagination-progressbar .swiper-pagination-progressbar-fill {
  background: #00000038;
}
.swiper-pagination-progressbar {
  background: #00000008;
}
.swiper-button-next:after, .swiper-button-prev:after{
  font-size: 0;
}
.swiper-button-next{
  right: -5px;
}
.swiper-button-prev{
  left: -5px;
}
@media only screen and (max-width: 767px) {
  .swiper-button-next{
    bottom: 20px !important;
    top: unset;
    right: 30px;
  }
  .swiper-button-prev{
    bottom: 20px !important;
    top: unset;
    left: auto;
    right: 70px;
  }
}
.img-category{
  width: 100%;
  height: 400px;
  object-fit: cover;
}
.img-product{
  width: 100%;
  height: 300px;
  object-fit: cover;
}
</style>
@endpush

@push('script')
<script>
var swiper = new Swiper(".banner-slide", {
  pagination: {
    el: ".swiper-pagination",
    type: "progressbar",
  },
  navigation: {
    nextEl: ".swiper-button-next",
    prevEl: ".swiper-button-prev",
  },
});

@if(Auth::check() == true)
  @if(Auth::user()->role == 2)
    @if($countBookDone != 0)
      var myModal = new bootstrap.Modal(document.getElementById("productView"), {});
        document.onreadystatechange = function () {
        myModal.show();
      };
    @endif
  @endif
@else
var myModal = new bootstrap.Modal(document.getElementById("actionToLogin"), {});
  document.onreadystatechange = function () {
  myModal.show();
};
@endif

// document.querySelectorAll('.feedback li').forEach(entry => entry.addEventListener('click', e => {
//   if(!entry.classList.contains('active')) {
//     document.querySelector('.feedback li.active').classList.remove('active');
//     entry.classList.add('active');
//   }
//   e.preventDefault();
// }));

$('.feedback').each(function(iteration) {
  $(document).on('click', '.data-book[data-book-iteration='+iteration+'] .feedback li', function() {
    let data = $(this).data('rate')
    let book = $(this).data('book')
    $('.data-book[data-book-iteration='+iteration+'] .feedback li').removeClass('active');
    $('.data-book[data-book-iteration='+iteration+'] .feedback li[data-rate='+data+']').addClass('active')

    //console.log("book_id: "+book+", rate: "+data)

    $.ajax({
      url: window.location.origin+'/book-rate/'+book+'/'+data,
      type: 'get',
      dataType: 'json',
      success: function(res) {
        $('.book-'+book).fadeOut(1000);
      }
    })
  });
})
</script>
@endpush

@push('modal')
@if(Auth::check() == true)
  @if(Auth::user()->role == 2)
    @if($countBookDone != 0)
      <div class="modal fade" id="productView" tabindex="-1">
        <div class="modal-dialog modal-lg modal-dialog-centered">
          <div class="modal-content overflow-hidden border-0">
            <div class="modal-body">
              <h3 class="mb-3 pb-3 border-bottom">Hai Treatment kamu sudah selesai ayo beri penilaian</h3>
              <div class="row mt-3">
                @foreach ($bookDone as $value => $v)
                  <div class="col-md-12 border-bottom py-3 data-book book-{{ $v->book_id }}" data-book-iteration="{{ $value }}">
                    <div class="row h-100">
                      <div class="col-md-2 my-auto">
                        <img src="{{ asset('img/product/'.$v->product_image) }}" class="img-fluid rounded" alt="">
                      </div>
                      <div class="col-md-4 my-auto">
                        <p class="mb-0">Nama Customer:</p>
                        <h6>{{ $v->user_name }}</h6>
                      </div>
                      <div class="col-md-6 my-auto">
                        <p class="mb-0">No.Invoice:</p>
                        <h6>{{ $v->invoice }}</h6>
                      </div>
                      <div class="col-md-2"></div>
                      <div class="col-md-4 my-auto">
                        <p class="mb-0">Hari dan Tanggal:</p>
                        <h6>{{ $v->schedule_day }} {{ getDateFormat($v->schedule_date) }}<br> {{ timeFormat($v->time_start) }} - {{ timeFormat($v->time_end) }}</h6>
                      </div>
                      <div class="col-md-6 my-auto">
                        <p class="mb-0">Eyelash Technician</p>
                        <h6>{{ $v->employee_name }}</h6>
                      </div>
                      <div class="col-md-2"></div>
                      <div class="col-md-10 mt-4">
                        <p class="mb-0">Beri Penilaian</p>
                        <ul class="feedback">
                          <li class="angry" data-book="{{ $v->book_id }}" data-rate="1">
                            <div>
                              <svg class="eye left">
                                <use xlink:href="#eye">
                              </svg>
                              <svg class="eye right">
                                <use xlink:href="#eye">
                              </svg>
                              <svg class="mouth">
                                <use xlink:href="#mouth">
                              </svg>
                            </div>
                          </li>
                          <li class="sad" data-book="{{ $v->book_id }}" data-rate="2">
                            <div>
                              <svg class="eye left">
                                <use xlink:href="#eye">
                              </svg>
                              <svg class="eye right">
                                <use xlink:href="#eye">
                              </svg>
                              <svg class="mouth">
                                <use xlink:href="#mouth">
                              </svg>
                            </div>
                          </li>
                          <li class="ok" data-book="{{ $v->book_id }}" data-rate="3">
                            <div></div>
                          </li>
                          <li class="good" data-book="{{ $v->book_id }}" data-rate="4">
                            <div>
                              <svg class="eye left">
                                <use xlink:href="#eye">
                              </svg>
                              <svg class="eye right">
                                <use xlink:href="#eye">
                              </svg>
                              <svg class="mouth">
                                <use xlink:href="#mouth">
                              </svg>
                            </div>
                          </li>
                          <li class="happy" data-book="{{ $v->book_id }}" data-rate="5">
                            <div>
                              <svg class="eye left">
                                <use xlink:href="#eye">
                              </svg>
                              <svg class="eye right">
                                <use xlink:href="#eye">
                              </svg>
                            </div>
                          </li>
                        </ul>
                        
                        <svg xmlns="http://www.w3.org/2000/svg" style="display: none;">
                          <symbol xmlns="http://www.w3.org/2000/svg" viewBox="0 0 7 4" id="eye">
                            <path d="M1,1 C1.83333333,2.16666667 2.66666667,2.75 3.5,2.75 C4.33333333,2.75 5.16666667,2.16666667 6,1"></path>
                          </symbol>
                          <symbol xmlns="http://www.w3.org/2000/svg" viewBox="0 0 18 7" id="mouth">
                            <path d="M1,5.5 C3.66666667,2.5 6.33333333,1 9,1 C11.6666667,1 14.3333333,2.5 17,5.5"></path>
                          </symbol>
                        </svg>
                      </div>
                    </div>
                  </div>
                @endforeach
              </div>
            </div>
          </div>
        </div>
      </div>
    @endif
  @endif
@else
<div class="modal fade" id="actionToLogin" tabindex="-1">
  <div class="modal-dialog modal-sm modal-dialog-centered">
    <div class="modal-content overflow-hidden border-0">
      <div class="modal-body p-5 text-center">
        <h6 class="mb-3 pb-3">Hai untuk pengalaman yang lebih berkesan ayo buat akun</h6>
        <a href="{{ url('/register') }}" class="btn btn-dark w-100">Buat Akun</a>
        <p class="my-3">kamu sudah punya akun?</p>
        <a href="{{ url('/login') }}" class="btn btn-outline-dark w-100">Login disini</a>
      </div>
    </div>
  </div>
</div>
@endif
@endpush