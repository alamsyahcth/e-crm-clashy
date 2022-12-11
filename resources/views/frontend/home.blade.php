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
                <li class="list-inline-item m-0 p-0"><a class="btn btn-sm btn-outline-dark" href="#!"><i class="far fa-heart"></i></a></li>
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
</script>
@endpush

@push('modal')
<div class="modal fade" id="productView" tabindex="-1">
  <div class="modal-dialog modal-lg modal-dialog-centered">
    <div class="modal-content overflow-hidden border-0">
      <button class="btn-close p-4 position-absolute top-0 end-0 z-index-20 shadow-0" type="button"
        data-bs-dismiss="modal" aria-label="Close"></button>
      <div class="modal-body p-0">
        <div class="row align-items-stretch">
          <div class="col-lg-6 p-lg-0"><a class="glightbox product-view d-block h-100 bg-cover bg-center"
              style="background: url(img/product-5.jpg)" href="img/product-5.jpg') }}" data-gallery="gallery1"
              data-glightbox="Red digital smartwatch"></a><a class="glightbox d-none"
              href="img/product-5-alt-1.jpg') }}" data-gallery="gallery1" data-glightbox="Red digital smartwatch"></a><a
              class="glightbox d-none" href="img/product-5-alt-2.jpg') }}" data-gallery="gallery1"
              data-glightbox="Red digital smartwatch"></a>
          </div>
          <div class="col-lg-6">
            <div class="p-4 my-md-4">
              <ul class="list-inline mb-2">
                <li class="list-inline-item m-0"><i class="fas fa-star small text-warning"></i></li>
                <li class="list-inline-item m-0 1"><i class="fas fa-star small text-warning"></i></li>
                <li class="list-inline-item m-0 2"><i class="fas fa-star small text-warning"></i></li>
                <li class="list-inline-item m-0 3"><i class="fas fa-star small text-warning"></i></li>
                <li class="list-inline-item m-0 4"><i class="fas fa-star small text-warning"></i></li>
              </ul>
              <h2 class="h4">Red digital smartwatch</h2>
              <p class="text-muted">$250</p>
              <p class="text-sm mb-4">Lorem ipsum dolor sit amet, consectetur adipiscing elit. In ut ullamcorper
                leo, eget euismod orci. Cum sociis natoque penatibus et magnis dis parturient montes nascetur
                ridiculus mus. Vestibulum ultricies aliquam convallis.</p>
              <div class="row align-items-stretch mb-4 gx-0">
                <div class="col-sm-7">
                  <div class="border d-flex align-items-center justify-content-between py-1 px-3"><span
                      class="small text-uppercase text-gray mr-4 no-select">Quantity</span>
                    <div class="quantity">
                      <button class="dec-btn p-0"><i class="fas fa-caret-left"></i></button>
                      <input class="form-control border-0 shadow-0 p-0" type="text" value="1">
                      <button class="inc-btn p-0"><i class="fas fa-caret-right"></i></button>
                    </div>
                  </div>
                </div>
                <div class="col-sm-5"><a
                    class="btn btn-dark btn-sm w-100 h-100 d-flex align-items-center justify-content-center px-0"
                    href="cart.html">Add to cart</a></div>
              </div><a class="btn btn-link text-dark text-decoration-none p-0" href="#!"><i
                  class="far fa-heart me-2"></i>Add to wish list</a>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
@endpush