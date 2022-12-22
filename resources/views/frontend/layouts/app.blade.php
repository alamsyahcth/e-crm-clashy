<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="csrf-token" content="{{ csrf_token() }}">
  <title>@yield('title')</title>
  <meta name="description" content="">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <meta name="robots" content="all,follow">

  <link rel="apple-touch-icon" sizes="57x57" href="{{ asset('img/favicon/apple-icon-57x57.png') }}">
  <link rel="apple-touch-icon" sizes="60x60" href="{{ asset('img/favicon/apple-icon-60x60.png') }}">
  <link rel="apple-touch-icon" sizes="72x72" href="{{ asset('img/favicon/apple-icon-72x72.png') }}">
  <link rel="apple-touch-icon" sizes="76x76" href="{{ asset('img/favicon/apple-icon-76x76.png') }}">
  <link rel="apple-touch-icon" sizes="114x114" href="{{ asset('img/favicon/apple-icon-114x114.png') }}">
  <link rel="apple-touch-icon" sizes="120x120" href="{{ asset('img/favicon/apple-icon-120x120.png') }}">
  <link rel="apple-touch-icon" sizes="144x144" href="{{ asset('img/favicon/apple-icon-144x144.png') }}">
  <link rel="apple-touch-icon" sizes="152x152" href="{{ asset('img/favicon/apple-icon-152x152.png') }}">
  <link rel="apple-touch-icon" sizes="180x180" href="{{ asset('img/favicon/apple-icon-180x180.png') }}">
  <link rel="icon" type="image/png" sizes="192x192" href="{{ asset('img/favicon/android-icon-192x192.png') }}">
  <link rel="icon" type="image/png" sizes="32x32" href="{{ asset('img/favicon/favicon-32x32.png') }}">
  <link rel="icon" type="image/png" sizes="96x96" href="{{ asset('img/favicon/favicon-96x96.png') }}">
  <link rel="icon" type="image/png" sizes="16x16" href="{{ asset('img/favicon/favicon-16x16.png') }}">
  <link rel="manifest" href="{{ asset('img/favicon/manifest.json') }}">
  <meta name="msapplication-TileColor" content="#ffffff">
  <meta name="msapplication-TileImage" content=""{{ asset('img/favicon/ms-icon-144x144.png') }}">
  <meta name="theme-color" content="#ffffff">
    
  <!-- gLightbox gallery-->
  <link rel="stylesheet" href="{{ asset('frontend/vendor/glightbox/css/glightbox.min.css') }}">
  <!-- Range slider-->
  <link rel="stylesheet" href="{{ asset('frontend/vendor/nouislider/nouislider.min.css') }}">
  <!-- Choices CSS-->
  <link rel="stylesheet" href="{{ asset('frontend/vendor/choices.js/public/assets/styles/choices.min.css') }}">
  <!-- Swiper slider-->
  <link rel="stylesheet" href="{{ asset('vendor/swiper/swiper.min.css') }}">
  <!-- Google fonts-->
  <link rel="stylesheet"
    href="https://fonts.googleapis.com/css2?family=Libre+Franklin:wght@300;400;700&amp;display=swap">
  <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Martel+Sans:wght@300;400;800&amp;display=swap">
  <!-- theme stylesheet-->
  <link rel="stylesheet" href="{{ asset('frontend/css/style.default.css') }}" id="theme-stylesheet">
  <!-- Custom stylesheet - for your changes-->
  <link rel="stylesheet" href="{{ asset('frontend/css/custom.css') }}">
  <!-- Favicon-->
  <link rel="stylesheet" href="{{ asset('backend/vendors/datatable/datatable.min.css') }}">
  @stack('style')
  <style>
    .form-control:focus {
      color: #212529;
      background-color: #fff;
      border-color: #F1BFB7;
      outline: 0;
      box-shadow: 0 0 0 0.25rem rgb(255 248 247);
    }
    label{
      font-size: 14px;
      color: #656565;
    }
    .form-control{
      color: #444444;
      border: 1px solid #ececec;
      padding: 10px 10px;
    }
    .btn-primary{
      color: #ffffff;
    }
    .btn-primary:hover, .btn-primary:focus {
      color: #ffffff !important;
      background-color: #B16154;
      border-color: #B16154;
    }
    .text-primary{
      color: #B16154 !important;
    }
    .btn{

    }
  </style>
</head>

<body>
  <div class="page-holder">
    @include('frontend.partials.header')
    @yield('content')
    @stack('modal')
    @include('frontend.partials.footer')
    @stack('script')
  </div>
</body>

</html>