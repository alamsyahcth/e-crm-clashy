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
          <li class="list-inline-item m-0"><i class="fas fa-star small @if($getStars != 0 && $getStars >= 1) text-warning @else text-secondary opacity-4 @endif"></i></li>
          <li class="list-inline-item m-0 1"><i class="fas fa-star small @if($getStars > 1) text-warning @else text-secondary opacity-4 @endif"></i></li>
          <li class="list-inline-item m-0 2"><i class="fas fa-star small @if($getStars > 2) text-warning @else text-secondary opacity-4 @endif"></i></li>
          <li class="list-inline-item m-0 3"><i class="fas fa-star small @if($getStars > 3) text-warning @else text-secondary opacity-4 @endif"></i></li>
          <li class="list-inline-item m-0 4"><i class="fas fa-star small @if($getStars > 4) text-warning @else text-secondary opacity-4 @endif"></i></li>
        </ul>
        <h1>{{ $product->name }}</h1>
        <p class="text-muted lead">{{ currency($product->price) }}</p>
        <p class="text-sm mb-4">{{ $product->description }}</p>
        <a href="javascript:void(0)" class="btn btn-dark btn-lg mb-3" data-bs-toggle="modal" data-bs-target="#modalChooseDate">Booking Sekarang</a><br>
        <ul class="list-unstyled small d-inline-block">
          <li class="px-3 py-2 mb-1 bg-white"><strong class="text-uppercase">Didiskusikan:</strong><span class="ms-2 text-muted">10 Orang</span></li>
          <li class="px-3 py-2 mb-1 bg-white text-muted"><strong class="text-uppercase text-dark">Kategori:</strong><a class="reset-anchor ms-2" href="{{ url('/'.$getCategoryProduct->slug) }}">{{ $getCategoryProduct->name }}</a></li>
        </ul>
      </div>
    </div>
    <!-- DETAILS TABS-->
    <ul class="nav nav-tabs border-0" id="myTab" role="tablist">
      <li class="nav-item">
        <a class="nav-link text-uppercase active" id="product-discussion" data-bs-toggle="tab" href="#productDiscussion" role="tab" aria-controls="description" aria-selected="true">Diskusi Produk</a>
      </li>
      <li class="nav-item">
        <a class="nav-link text-uppercase" id="reviews-tab" data-bs-toggle="tab" href="#reviews" role="tab" aria-controls="reviews" aria-selected="false">Reviews</a>
      </li>
      <li class="nav-item">
        <a class="nav-link text-uppercase" id="complain-tab" data-bs-toggle="tab" href="#complain" role="tab" aria-controls="complain" aria-selected="false">Complain</a>
      </li>
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
                        <p class="small-2 text-muted mb-0">{{ getDateFormat(Carbon\Carbon::createFromFormat('Y-m-d H:i:s', $data->created_at)->format('Y-m-d')) }}</p>
                        <p class="text-sm mb-0 text-muted">{{ $data->message }}</p>
                      </div>
                    </div>
                    @foreach ($discussionReplies as $dataReply)
                      @if($data->discussion_id == $dataReply->discussion_id)
                      <div class="bg-product p-3">
                        <p class="small-2 mb-2 text-muted"><i>Balasan Oleh Admin</i></p>
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
            @if(Auth::check() == true)
              @if(Auth::user()->role == 2)
              <div class="col-md-12 py-3 border-top">
                <form action="{{ url('produk/store/'.$product->id) }}" method="post">
                  @csrf
                  <div class="form-group">
                    <textarea name="message" id="message" class="form-control" rows="3" placeholder="Masukkan pesan anda"></textarea>
                  </div>
                  <div class="form-group d-flex justify-content-end mt-3">
                    <button type="submit" class="btn btn-dark">Kirim</button>
                  </div>
                </form>
              </div>
              @elseif(Auth::user()->role == 1)
              <div class="col-md-12 py-5 text-center">
                <h5 class="text-muted">
                  Maaf kamu adalah admin, silahkan login sebagai customer
                </h5>
              </div>
              @endif
            @elseif(Auth::check() == false)
            <div class="col-md-12 py-5 text-center">
              <h5 class="text-muted mb-3">
                Jika kamu ingin berkomentar silahkan login dahulu
              </h5>
              <a href="{{ url('login') }}" class="btn btn-primary">Login</a>
            </div>
            @endif
            {{-- send message --}}

          </div>
        </div>
      </div>
      <div class="tab-pane fade" id="reviews" role="tabpanel" aria-labelledby="reviews-tab">
        <div class="p-4 p-lg-5 bg-white">
          <div class="row">

            {{-- give review --}}
            @if(Auth::check() == true)
              @if(Auth::user()->role == 2)
              <div class="col-lg-8">
                <p class="mb-3">Berikan penilaian anda utnuk produk ini</p>
                <div class="rating-stars mb-4">
                  <ul id="stars">
                    <li class="star 1" title="Poor" data-value="1">
                      <i class="fa fa-star"></i>
                    </li>
                    <li class="star 2" title="Fair" data-value="2">
                      <i class="fa fa-star"></i>
                    </li>
                    <li class="star 3" title="Good" data-value="3">
                      <i class="fa fa-star"></i>
                    </li>
                    <li class="star 4" title="Excellent" data-value="4">
                      <i class="fa fa-star"></i>
                    </li>
                    <li class="star 5" title="WOW!!!" data-value="5">
                      <i class='fa fa-star'></i>
                    </li>
                  </ul>
                </div>
                <form action="{{ url('produk/review/'.$product->id) }}" method="post">
                  @csrf
                  <input type="hidden" name="stars" id="starsValue" value="@if($showReview != null){{ $showReview->stars }}@else 0 @endif">
                  <div class="form-group">
                    <textarea name="comment" id="comment" class="form-control" rows="3" placeholder="Masukkan komentar anda">@if($showReview != null){{ $showReview->comment }}@endif</textarea>
                  </div>
                  <div class="form-group d-flex justify-content-end mt-3">
                    <button type="submit" class="btn btn-dark">Kirim</button>
                  </div>
                </form>
              </div>
              @elseif(Auth::user()->role == 1)
              <div class="col-md-12 py-5 text-center">
                <h5 class="text-muted">
                  Maaf kamu adalah admin, silahkan login sebagai customer
                </h5>
              </div>
              @endif
            @elseif(Auth::check() == false)
            <div class="col-md-12 py-5 text-center">
              <h5 class="text-muted mb-3">
                Jika kamu ingin memberikan review silahkan login dahulu
              </h5>
              <a href="{{ url('login') }}" class="btn btn-primary">Login</a>
            </div>
            @endif
            {{-- give review --}}

          </div>
        </div>
      </div>

      <div class="tab-pane fade" id="complain" role="tabpanel" aria-labelledby="complain">
        <div class="p-4 p-lg-5 bg-white">
          <div class="row">
            {{-- complain --}}
            @if(Auth::check() == true)
              @if(Auth::user()->role == 2)
              <div class="col-md-12 all-complain">
                <div class="row">
                  @foreach ($complain as $value)
                    @if($value->id == null)
                    <div class="col-md-12 text-center py-5">
                      <p class="text-muted">
                        Belum ada komplain
                      </p>
                    </div>
                    @else
                      @if($value->is_admin == 1 && $value->is_customer == 0)
                        <div class="d-flex justify-content-start mb-2">
                          <div class="complain-box left p-2 rounded">
                            <p class="mb-1">{{ $value->message }}</p>
                            <p class="small-2 mb-0 opacity-5">{{ getDateFormat(Carbon\Carbon::createFromFormat('Y-m-d H:i:s', $data->created_at)->format('Y-m-d')) }}</p>
                          </div>
                        </div>
                      @endif
                      @if($value->is_customer == 1 && $value->is_admin == 0)
                        <div class="d-flex justify-content-end mb-2 text-end">
                          <div class="complain-box right p-2 rounded">
                            <p class="mb-1">{{ $value->message }}</p>
                            <p class="small-2 mb-0 opacity-5">{{ getDateFormat(Carbon\Carbon::createFromFormat('Y-m-d H:i:s', $data->created_at)->format('Y-m-d')).' - '. Carbon\Carbon::createFromFormat('Y-m-d H:i:s', $data->created_at)->format('H.i')}}</p>
                          </div>
                        </div>
                      @endif
                    @endif
                  @endforeach
                </div>
              </div>
              <div class="col-md-12 py-3 border-top">
                <form action="{{ url('produk/complain/'.$product->id) }}" method="post">
                  @csrf
                  <div class="row">
                    <div class="col-11">
                      <input type="text" name="message" id="messageComplain" class="form-control" rows="3" placeholder="Masukkan pesan anda">
                    </div>
                    <div class="col-1">
                      <button type="submit" class="btn btn-dark">Kirim</button>
                    </div>
                  </div>
                </form>
              </div>
              @elseif(Auth::user()->role == 1)
              <div class="col-md-12 py-5 text-center">
                <h5 class="text-muted">
                  Maaf kamu adalah admin, silahkan login sebagai customer
                </h5>
              </div>
              @endif
            @elseif(Auth::check() == false)
            <div class="col-md-12 py-5 text-center">
              <h5 class="text-muted mb-3">
                Jika kamu ingin memberikan review silahkan login dahulu
              </h5>
              <a href="{{ url('login') }}" class="btn btn-primary">Login</a>
            </div>
            @endif
            {{-- complain --}}
          </div>
        </div>
      </div>
    </div>
    <div class="container">
      <h2 class="h5 text-uppercase mb-4">Rekomendasi Produk</h2>
      <div class="row">
        <!-- PRODUCT-->
        @foreach($recomendedProduct as $value)
        <div class="col-xl-3 col-lg-4 col-sm-6">
          <div class="product text-center">
            <div class="position-relative mb-3">
              <div class="badge text-white bg-"></div>
              <a class="d-block" href="{{ url('produk/'.$value->slug) }}">
                <img class="img-fluid img-product w-100" src="{{ asset('img/product/'.$value->image) }}" alt="{{ $value->name }}">
              </a>
              <div class="product-overlay">
                <ul class="mb-0 list-inline">
                  <li class="list-inline-item m-0 p-0"><a class="btn btn-sm btn-dark" href="{{ url('produk/'.$value->slug) }}">Lihat Produk</a></li>
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
    <!-- RELATED PRODUCTS-->
  </div>
</section>
@endsection

@push('modal')
<div class="modal fade" id="modalChooseDate" tabindex="-1" role="dialog" aria-labelledby="modalChooseDateTitle"
  aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content border-0">
      <div class="modal-body py-5">
        <div class="row">
          @if(Auth::check() == true)
            @if(Auth::user()->role == 1)
              <div class="col-md-12 text-center mb-3">
                <h5 class="text-muted">
                  Maaf kamu adalah admin, silahkan login sebagai customer
                </h5>
              </div>
            @elseif(Auth::user()->role == 2)
              <div class="col-md-12 text-center mb-3">
                <h3>Pilih Tanggal</h3>
              </div>
              <div class="col-md-12">
                <form action="{{ url('book/search/store') }}" method="post">
                  @csrf
                  <select name="date" id="date" class="form-control mb-3">
                    @foreach($getSchedule as $value)
                      <option value="{{ $value->date }}">{{ getDateFormat($value->date) }}</option>
                    @endforeach
                  </select>
                  <input type="hidden" name="productSlug" value="{{ $product->slug }}">
                  <button type="submit" class="btn btn-primary w-100"><i class="fas fa-search"></i> Cari</button>
                </form>
              </div>
            @endif
          @elseif(Auth::check() == false)
            <div class="col-md-12 text-center mb-3">
              <h5 class="text-muted mb-3">
                Jika kamu ingin memberikan review silahkan login dahulu
              </h5>
              <a href="{{ url('login') }}" class="btn btn-primary">Login</a>
            </div>
          @endif
        </div>
      </div>
    </div>
  </div>
</div>
@endpush

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
p.small-2{
  font-size: 10px;
}
.all-comment{
  height: 500px;
  overflow-y: auto;
}
/* Rating Star Widgets Style */
.rating-stars ul {
  list-style-type:none;
  padding:0;
  
  -moz-user-select:none;
  -webkit-user-select:none;
}
.rating-stars ul > li.star {
  display:inline-block;
  
}

/* Idle State of the stars */
.rating-stars ul > li.star > i.fa {
  font-size:2.5em; /* Change the size of the stars */
  color:#ccc; /* Color on idle state */
}

/* Hover state of the stars */
.rating-stars ul > li.star.hover > i.fa {
  color:#FFCC36;
}

/* Selected state of the stars */
.rating-stars ul > li.star.selected > i.fa {
  color:#FF912C;
}
.img-product{
  width: 100%;
  height: 300px;
  object-fit: cover;
}
.all-complain{
  max-height: 400px;
  overflow-y: auto;
  display: flex;
  flex-direction: column-reverse;
}
.complain-box.left{
  max-width: 75%;
  background-color: #2c2c2c;
  color: #ffffff;
}
.complain-box.right{
  max-width: 75%;
  background-color: #e2e2e2;
  color: #353535;
}
</style>
@endpush

@push('script')
<script>
  $(document).ready(function(){

  let i = 1;
  $('#stars li').parent().children('li.star').each(function(e){
    let data = Number($('#starsValue').val());
    if (i <= data) {
      $(this).addClass('hover');
      // console.log('add: '+ i +', data: '+data)
    } else {
      $(this).removeClass('hover');
      // console.log('min: '+ i +', data: '+data)
    }
    i++
  });
  
  /* 1. Visualizing things on Hover - See next part for action on click */
  $('#stars li').on('mouseover', function(){
    var onStar = parseInt($(this).data('value'), 10); // The star currently mouse on
   
    // Now highlight all the stars that's not after the current hovered star
    $(this).parent().children('li.star').each(function(e){
      if (e < onStar) {
        $(this).addClass('hover');
      }
      else {
        $(this).removeClass('hover');
      }
    });
    
  }).on('mouseout', function(){
    $(this).parent().children('li.star').each(function(e){
      $(this).removeClass('hover');
    });
  });
  
  
  /* 2. Action to perform on click */
  $('#stars li').on('click', function(){
    var onStar = parseInt($(this).data('value'), 10); // The star currently selected
    var stars = $(this).parent().children('li.star');
    
    for (i = 0; i < stars.length; i++) {
      $(stars[i]).removeClass('selected');
    }
    
    for (i = 0; i < onStar; i++) {
      $(stars[i]).addClass('selected');
    }
    
    // JUST RESPONSE (Not needed)
    var ratingValue = parseInt($('#stars li.selected').last().data('value'), 10);
    responseMessage(ratingValue);
    
  });
  
  
});


function responseMessage(msg) {
  $('#starsValue').val(msg)
}
</script>
@endpush