<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
  <!-- Required meta tags -->
  <meta charset="utf-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
  <meta name="csrf-token" content="{{ csrf_token() }}">
  <title>@yield('titlePage')</title>

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

  <!-- plugins:css -->
  <link rel="stylesheet" href="{{ asset('backend/vendors/mdi/css/materialdesignicons.min.css') }}">
  <link rel="stylesheet" href="{{ asset('backend/vendors/flag-icon-css/css/flag-icon.min.css') }}">
  <link rel="stylesheet" href="{{ asset('backend/vendors/css/vendor.bundle.base.css') }}">
  <!-- endinject -->
  <!-- Plugin css for this page -->
  <link rel="stylesheet" href="{{ asset('backend/vendors/jquery-bar-rating/css-stars.css') }}" />
  <link rel="stylesheet" href="{{ asset('backend/vendors/font-awesome/css/font-awesome.min.css') }}" />
  <!-- End plugin css for this page -->
  <!-- inject:css -->
  <!-- endinject -->
  <!-- Layout styles -->
  <link rel="stylesheet" href="{{ asset('backend/css/demo_1/style.css') }}" />
  <link rel="stylesheet" href="{{ asset('backend/vendors/datatable/datatable.min.css') }}">
  <link rel="stylesheet" href="{{ asset('vendor/datepicker/datepicker.css') }}">
  <link rel="stylesheet" href="{{ asset('vendor/bootstrap-toggle/bootstrap-toggle.css') }}">
  <!-- End layout styles -->
  <style>
    .table th img, .table td img, .form-group img{
      width: 100px !important;
      height: 100px !important;
      object-fit: cover;
      border-radius: 10px !important
    }
    .notify{ 
      z-index: 1000000; margin-top: 5%; 
    }
    select.form-control.is-invalid{
      border: 1px #dc3545 solid;
    }
    select.form-control, .select2-container--default select.select2-selection--single, .select2-container--default .select2-selection--single select.select2-search__field, select.typeahead, select.tt-query, select.tt-hint {
      color: #000000;
    }
    .badge{
      color: #ffffff;
    }
  </style>
  @stack('style')
  @notifyCss
</head>

<body>
  <div class="container-scroller">
    <!-- partial:partials/_sidebar.html -->
    @include('backend.partials.sidebar')
    <!-- partial -->
    <div class="container-fluid page-body-wrapper">
      <!-- partial:partials/_navbar.html -->
      @include('backend.partials.header')
      <!-- partial -->
      <div class="main-panel">
        <div class="content-wrapper pb-0">
          <div class="page-header d-flex justify-content-between align-items-center">

            <x:notify-messages />

            <h3 class="page-title mb-0">@yield('titlePage')</h3>
            @yield('rightHeader')
          </div>

          <!-- first row starts here -->
          @yield('content')
        </div>
        <!-- content-wrapper ends -->
        @include('backend.partials.footer')
        <!-- partial -->
      </div>
      <!-- main-panel ends -->
    </div>
    <!-- page-body-wrapper ends -->
  </div>
  <!-- container-scroller -->
  <!-- plugins:js -->
  <script src="{{ asset('backend/vendors/js/vendor.bundle.base.js') }}"></script>
  <!-- endinject -->
  <!-- Plugin js for this page -->
  <script src="{{ asset('backend/vendors/jquery-bar-rating/jquery.barrating.min.js') }}"></script>
  <script src="{{ asset('backend/vendors/chart.js/Chart.min.js') }}"></script>
  <script src="{{ asset('backend/vendors/flot/jquery.flot.js') }}"></script>
  <script src="{{ asset('backend/vendors/flot/jquery.flot.resize.js') }}"></script>
  <script src="{{ asset('backend/vendors/flot/jquery.flot.categories.js') }}"></script>
  <script src="{{ asset('backend/vendors/flot/jquery.flot.fillbetween.js') }}"></script>
  <script src="{{ asset('backend/vendors/flot/jquery.flot.stack.js') }}"></script>
  <!-- End plugin js for this page -->
  <!-- inject:js -->
  <script src="{{ asset('backend/js/off-canvas.js') }}"></script>
  <script src="{{ asset('backend/js/hoverable-collapse.js') }}"></script>
  <script src="{{ asset('backend/js/misc.js') }}"></script>
  <script src="{{ asset('backend/js/settings.js') }}"></script>
  <script src="{{ asset('backend/js/todolist.js') }}"></script>
  <!-- endinject -->
  <!-- Custom js for this page -->
  <script src="{{ asset('backend/js/dashboard.js') }}"></script>
  <script src="{{ asset('backend/vendors/datatable/datatable.min.js') }}"></script>
  <script src="{{ asset('backend/vendors/datatable/datatable-bootstrap.min.js') }}"></script>
  <script src="{{ asset('vendor/datepicker/datepicker.min.js') }}"></script>
  <script src="{{ asset('vendor/bootstrap-toggle/bootstrap-toggle.min.js') }}"></script>
  <script>
    $('.datatable').DataTable();

    $('.datepicker').datepicker({
      todayHighlight: true,
      startDate: '-0d',
      format: "yyyy-mm-dd",
    });

    $('.datepickerAll').datepicker({
      todayHighlight: true,
      format: "yyyy-mm-dd",
    });
    
  </script>
  @stack('script')
  @notifyJs
  <!-- End custom js for this page -->
</body>

</html>