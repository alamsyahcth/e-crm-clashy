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
      <div class="col-md-12 mb-5">
        <h3>Profil</h3>
      </div>
      <div class="col-md-12 bg-light">
        <ul class="nav nav-pills">
          <li class="nav-item">
            <a class="nav-link rounded-0 @if(request()->is('profil/edit-profil')) active @endif" href="{{ url('profil/edit-profil') }}">Edit Profil</a>
          </li>
          <li class="nav-item">
            <a class="nav-link rounded-0 @if(request()->is('profil/ubah-password')) active @endif" href="{{ url('profil/ubah-password') }}">Ubah Password</a>
          </li>
          <li class="nav-item">
            <a class="nav-link rounded-0 @if(request()->is('profil/history-booking')) active @endif" href="{{ url('profil/history-booking') }}">History Booking</a>
          </li>
        </ul>
      </div>
      <div class="col-md-12">
        <div class="card rounded-0 border-0">
          <div class="card-body p-3">
            @if ($message = Session::get('success'))
              <div class="alert alert-success" role="alert">
                <span>{{ $message }}</span>
              </div>
            @endif

            @if ($message = Session::get('error'))
              <div class="alert alert-danger" role="alert">
                <span>{{ $message }}</span>
              </div>
            @endif

            @if(request()->is('profil/edit-profil'))
              @include('frontend.profile.components.profile')
            @elseif (request()->is('profil/ubah-password'))
              @include('frontend.profile.components.password')
            @elseif (request()->is('profil/history-booking'))
              @include('frontend.profile.components.history')
            @endif
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
<script>
$(".alert").delay(2000).slideUp(200, function() {
  $(this).alert('close');
});
</script>
@endpush