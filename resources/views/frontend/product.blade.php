@extends('frontend.layouts.app')

@section('title')
{{ config('app.name', 'Clashy') }}
@endsection

@section('description')

@endsection

@section('content')
<section class="py-5 bg-product">
  <div class="container">
    <div class="row mb-5">
      <div class="col-lg-6">
        <!-- PRODUCT SLIDER-->
        <div class="row m-sm-0">
          <div class="col-sm-10 order-1 order-sm-2">
            <img src="{{ asset('img/product/'.$product->image) }}" class="img-fluid" alt="">
          </div>
        </div>
      </div>
      <!-- PRODUCT DETAILS-->
      <div class="col-lg-6">
        <ul class="list-inline mb-2 text-sm">
          <li class="list-inline-item m-0"><i class="fas fa-star small text-warning"></i></li>
          <li class="list-inline-item m-0 1"><i class="fas fa-star small text-warning"></i></li>
          <li class="list-inline-item m-0 2"><i class="fas fa-star small text-warning"></i></li>
          <li class="list-inline-item m-0 3"><i class="fas fa-star small text-warning"></i></li>
          <li class="list-inline-item m-0 4"><i class="fas fa-star small text-warning"></i></li>
        </ul>
        <h1>{{ $product->name }}</h1>
        <p class="text-muted lead">{{ currency($product->price) }}</p>
        <p class="text-sm mb-4">{{ $product->description }}</p>
        <a class="text-dark p-0 mb-4 d-inline-block" href="#!"><i class="far fa-heart me-2"></i>Tambahkan ke Produk Yang Disuka</a><br>
        <ul class="list-unstyled small d-inline-block">
          <li class="px-3 py-2 mb-1 bg-white"><strong class="text-uppercase">Didiskusikan:</strong><span class="ms-2 text-muted">10 Orang</span></li>
          <li class="px-3 py-2 mb-1 bg-white text-muted"><strong class="text-uppercase text-dark">Kategori:</strong><a class="reset-anchor ms-2" href="{{ url('/'.$getCategoryProduct->slug) }}">{{ $getCategoryProduct->name }}</a></li>
        </ul>
      </div>
    </div>
    <!-- DETAILS TABS-->
    <ul class="nav nav-tabs border-0" id="myTab" role="tablist">
      <li class="nav-item"><a class="nav-link text-uppercase active" id="product-discussion" data-bs-toggle="tab" href="#productDiscussion" role="tab" aria-controls="description" aria-selected="true">Diskusi Produk</a></li>
      <li class="nav-item"><a class="nav-link text-uppercase" id="reviews-tab" data-bs-toggle="tab" href="#reviews" role="tab" aria-controls="reviews" aria-selected="false">Reviews</a></li>
    </ul>
    <div class="tab-content mb-5" id="myTabContent">
      <div class="tab-pane fade show active" id="productDiscussion" role="tabpanel" aria-labelledby="product-discussion">
        <div class="p-4 p-lg-5 bg-white">
          <div class="row">

            {{-- show messages --}}
            <div class="col-md-12 all-comment">
              @if($countDiscussion != 0)
                <div class="row justify-content-end mb-3">
                  @foreach($dataDiscussion as $data)
                  <div class="col-md-12 py-3 mb-3 border">
                    <div class="d-flex align-items-center mb-3 p-3">
                      <div class="flex-shrink-0 discussion-avatar">
                        {{ substr($data->name, 0, 1); }}
                      </div>
                      <div class="ms-3 flex-shrink-1">
                        <h6 class="mb-0 text-uppercase me-2 align-items-center">{{ $data->name }}</h6>
                        <p class="small text-muted mb-0">{{ getDateFormat(Carbon\Carbon::createFromFormat('Y-m-d H:i:s',
                          $data->created_at)->format('Y-m-d')) }}</p>
                        <p class="text-sm mb-0 text-muted">{{ $data->message }}</p>
                      </div>
                    </div>
                    @foreach ($discussionReplies as $dataReply)
                      @if($data->id == $dataReply->discussion_id)
                      <div class="bg-product p-3">
                        <p class="small mb-2 text-muted"><i>Balasan Oleh Admin</i></p>
                        <p class="text-muted mb-0">{{ $dataReply->message }}</p>
                      </div>
                      @endif
                    @endforeach
                  </div>
                  @endforeach
                </div>
              @else
                <div class="py-5 px-auto">
                  <h6 class="text-secondary opacity-3">Belum ada diskusi, jadilah yang pertama!</h6>
                </div>
              @endif
            </div>
            {{-- show messages --}}

            {{-- send message --}}
            <div class="col-md-12 py-3 border-top">
              <form action="{{ url('produk/'.$product->id.'/store') }}" method="post">
                @csrf
                <div class="form-group">
                  <textarea name="message" id="message" class="form-control" rows="3" placeholder="Masukkan pesan anda"></textarea>
                </div>
                <div class="form-group d-flex justify-content-end mt-3">
                  <button type="submit" class="btn btn-dark">Kirim</button>
                </div>
              </form>
            </div>
            {{-- send message --}}

          </div>
        </div>
      </div>
      <div class="tab-pane fade" id="reviews" role="tabpanel" aria-labelledby="reviews-tab">
        <div class="p-4 p-lg-5 bg-white">
          <div class="row">
            <div class="col-lg-8">
              <div class="d-flex mb-3">
                <div class="flex-shrink-0"><img class="rounded-circle" src="img/customer-1.png" alt="" width="50"/></div>
                <div class="ms-3 flex-shrink-1">
                  <h6 class="mb-0 text-uppercase">Jason Doe</h6>
                  <p class="small text-muted mb-2 text-uppercase">20 May 2020</p>
                  <ul class="list-inline mb-1 text-xs">
                    <li class="list-inline-item m-0"><i class="fas fa-star text-warning"></i></li>
                    <li class="list-inline-item m-0"><i class="fas fa-star text-warning"></i></li>
                    <li class="list-inline-item m-0"><i class="fas fa-star text-warning"></i></li>
                    <li class="list-inline-item m-0"><i class="fas fa-star text-warning"></i></li>
                    <li class="list-inline-item m-0"><i class="fas fa-star-half-alt text-warning"></i></li>
                  </ul>
                  <p class="text-sm mb-0 text-muted">Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.</p>
                </div>
              </div>
              <div class="d-flex">
                <div class="flex-shrink-0"><img class="rounded-circle" src="img/customer-2.png" alt="" width="50"/></div>
                <div class="ms-3 flex-shrink-1">
                  <h6 class="mb-0 text-uppercase">Jane Doe</h6>
                  <p class="small text-muted mb-0 text-uppercase">20 May 2020</p>
                  <ul class="list-inline mb-1 text-xs">
                    <li class="list-inline-item m-0"><i class="fas fa-star text-warning"></i></li>
                    <li class="list-inline-item m-0"><i class="fas fa-star text-warning"></i></li>
                    <li class="list-inline-item m-0"><i class="fas fa-star text-warning"></i></li>
                    <li class="list-inline-item m-0"><i class="fas fa-star text-warning"></i></li>
                    <li class="list-inline-item m-0"><i class="fas fa-star-half-alt text-warning"></i></li>
                  </ul>
                  <p class="text-sm mb-0 text-muted">Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.</p>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
    <!-- RELATED PRODUCTS-->
    <h2 class="h5 text-uppercase mb-4">Rekomendasi Produk</h2>
    <div class="row">
      <!-- PRODUCT-->
      @foreach($recomendedProduct as $value)
      <div class="col-xl-3 col-lg-4 col-sm-6">
        <div class="product text-center">
          <div class="position-relative mb-3">
            <div class="badge text-white bg-"></div>
            <a class="d-block" href="{{ url('product/'.$value->slug) }}">
              <img class="img-fluid img-product w-100" src="{{ asset('img/product/'.$value->image) }}" alt="{{ $value->name }}">
            </a>
            <div class="product-overlay">
              <ul class="mb-0 list-inline">
                <li class="list-inline-item m-0 p-0"><a class="btn btn-sm btn-outline-dark" href="#!"><i class="far fa-heart"></i></a></li>
                <li class="list-inline-item m-0 p-0"><a class="btn btn-sm btn-dark" href="cart.html">Lihat Produk</a>
                </li>
              </ul>
            </div>
          </div>
          <h6> <a class="reset-anchor" href="{{ url('produk/'.$value->slug) }}">{{ $value->name }}</a></h6>
          <p class="small text-muted">{{ currency($value->price) }}</p>
        </div>
      </div>
      @endforeach

    </div>
  </div>
</section>
@endsection

@push('style')
<style>
.bg-product{
  background-color: #f8f9fa;
}
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
p.small{
  font-size: 10px;
}
.all-comment{
  height: 500px;
  overflow-y: auto;
}
</style>
@endpush

@push('script')

@endpush