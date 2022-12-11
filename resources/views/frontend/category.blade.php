@extends('frontend.layouts.app')

@section('title')
{{ config('app.name', 'Clashy') }}
@endsection

@section('description')

@endsection

@section('content')
<div class="container">
  <!-- HERO SECTION-->
  <section class="py-5 bg-light">
    <div class="container">
      <div class="row px-4 px-lg-5 py-lg-4 align-items-center">
        <div class="col-lg-6">
          <h1 class="h2 text-uppercase mb-0">@if(!empty($category->name)) {{ $category->name }} @else Semua Produk @endif</h1>
        </div>
        <div class="col-lg-6 text-lg-end">
          <nav aria-label="breadcrumb">
            <ol class="breadcrumb justify-content-lg-end mb-0 px-0 bg-light">
              <li class="breadcrumb-item"><a class="text-dark" href="{{ url('/') }}">Home</a></li>
              <li class="breadcrumb-item active" aria-current="page">@if(!empty($category->name)) {{ $category->name }} @else Semua Produk @endif</li>
            </ol>
          </nav>
        </div>
      </div>
    </div>
  </section>
  <section class="py-5">
    <div class="container p-0">
      <div class="row">
        <!-- SHOP SIDEBAR-->
        <div class="col-lg-3 order-2 order-lg-1">
          <h5 class="text-uppercase mb-4">Kategori</h5>
          <ul class="list-unstyled small text-muted font-weight-normal mb-5">
            @if(!empty($category->id))
              @foreach($allCategory as $value)
                <li class="mb-2"><a class="reset-anchor @if($category->slug == $value->slug) text-primary @endif" href="{{ url('/'.$value->slug) }}">{{ $value->name }}</a></li>
              @endforeach
            @else
              @foreach($allCategory as $value)
                <li class="mb-2"><a class="reset-anchor" href="{{ url('/'.$value->slug) }}">{{ $value->name }}</a></li>
              @endforeach
            @endif
          </ul>
        </div>
        <!-- SHOP LISTING-->
        <div class="col-lg-9 order-1 order-lg-2 mb-5 mb-lg-0">
          <div class="row mb-3 align-items-center">
            <div class="col-lg-6 mb-2 mb-lg-0">
              <p class="text-sm text-muted mb-0">Showing 1–12 of 53 results</p>
            </div>
            {{-- <div class="col-lg-6">
              <ul class="list-inline d-flex align-items-center justify-content-lg-end mb-0">
                <li class="list-inline-item">
                  <select class="form-control" id="getSortProduct">
                    <option value="default">Urut Berdasarkan</option>
                    <option value="desc">A-Z</option>
                    <option value="asc">Z-A</option>
                    <option value="high">Harga Tertinggi</option>
                    <option value="low">Harga Terendah</option>
                  </select>
                </li>
              </ul>
            </div> --}}
          </div>
          <div class="row">
            
            @foreach($product as $value)
            <div class="col-lg-4 col-sm-6">
              <div class="product text-center">
                <div class="mb-3 position-relative">
                  <div class="badge text-white bg-"></div>
                    <a class="d-block" href="{{ url('produk/'.$value->slug) }}">
                      <img class="img-fluid img-product w-100" src="{{ asset('img/product/'.$value->image) }}" alt="{{ $value->name }}">
                    </a>
                  <div class="product-overlay">
                    <ul class="mb-0 list-inline">
                      <li class="list-inline-item m-0 p-0"><a class="btn btn-sm btn-outline-dark" href="#!"><i class="far fa-heart"></i></a></li>
                      <li class="list-inline-item m-0 p-0"><a class="btn btn-sm btn-dark" href="{{ url('produk/'.$value->slug) }}"">Lihat Produk</a></li>
                    </ul>
                  </div>
                </div>
                <h6> <a class="reset-anchor" href="{{ url('produk/'.$value->slug) }}">{{ $value->name }}</a></h6>
                <p class="small text-muted">{{ currency($value->price) }}</p>
              </div>
            </div>
            @endforeach

            {{ $product->links() }}
            
          </div>
          <!-- PAGINATION-->
          {{-- <nav aria-label="Page navigation example">
            <ul class="pagination justify-content-center justify-content-lg-end">
              <li class="page-item mx-1"><a class="page-link" href="#!" aria-label="Previous"><span aria-hidden="true">«</span></a></li>
              <li class="page-item mx-1 active"><a class="page-link" href="#!">1</a></li>
              <li class="page-item mx-1"><a class="page-link" href="#!">2</a></li>
              <li class="page-item mx-1"><a class="page-link" href="#!">3</a></li>
              <li class="page-item ms-1"><a class="page-link" href="#!" aria-label="Next"><span aria-hidden="true">»</span></a></li>
            </ul>
          </nav> --}}
        </div>
      </div>
    </div>
  </section>
</div>
@endsection

@push('style')
<style>
.img-product{
  width: 100%;
  height: 300px;
  object-fit: cover;
}
</style>
@endpush

@push('script')
<script>
  // $(document).ready(function() {
  //   handleDataProduct()
  // })

  // function getProduct(typeValue) {
  //   let type = typeValue
  //   $.ajax({
  //     type: "get",
  //     url: "{{ url('category/get') }}" + "/" + type,
  //     dataType: "json",
  //     success: function(res) {

  //     }
  //   })
  // }

  // function handleDataProduct() {
  //   let type;
  //   $('#getSortProduct').on('change', function() {
  //     let data = $(this).val();
  //     getProduct(data)
  //   })
  //   getProduct('default')
  // }
</script>
@endpush