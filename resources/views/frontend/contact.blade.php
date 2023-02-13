@extends('frontend.layouts.app')

@section('title')
{{ config('app.name', 'Clashy') }}
@endsection

@section('description')

@endsection

@section('content')
<div class="container py-5">
  <div class="row">
    <div class="col-md-6">
      <h1 class="mb-5">Hubungi Kami</h1>
      <p class="fw-bold">Alamat</p>
      <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna
      aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis
      aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint
      occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.</p>
      <p><span class="fw-bold">Email</span> test@mail.com</p>
      <p><span class="fw-bold">No Handphone</span> 089999999999</p>
      <p class="fw-bold">Ikuti Kami di sosial media</p>
      <ul class="list-unstyled d-flex justify-content-start mb-0">
        <li><a class="footer-link mx-4" href="#!">Twitter</a></li>
        <li><a class="footer-link mx-4" href="#!">Instagram</a></li>
        <li><a class="footer-link mx-4" href="#!">Tumblr</a></li>
        <li><a class="footer-link mx-4" href="#!">Pinterest</a></li>
      </ul>
    </div>
  </div>
</div>
@endsection