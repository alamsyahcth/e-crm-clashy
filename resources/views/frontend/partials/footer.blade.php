<!-- SERVICES-->
<section class="py-5 bg-light">
  <div class="container">
    <div class="row text-center gy-3">
      <div class="col-lg-4">
        <div class="d-inline-block">
          <div class="d-flex align-items-end">
            <svg class="svg-icon svg-icon-big svg-icon-light">
              <use xlink:href="#delivery-time-1"> </use>
            </svg>
            <div class="text-start ms-3">
              <h6 class="text-uppercase mb-1">Free shipping</h6>
              <p class="text-sm mb-0 text-muted">Free shipping worldwide</p>
            </div>
          </div>
        </div>
      </div>
      <div class="col-lg-4">
        <div class="d-inline-block">
          <div class="d-flex align-items-end">
            <svg class="svg-icon svg-icon-big svg-icon-light">
              <use xlink:href="#helpline-24h-1"> </use>
            </svg>
            <div class="text-start ms-3">
              <h6 class="text-uppercase mb-1">24 x 7 service</h6>
              <p class="text-sm mb-0 text-muted">Free shipping worldwide</p>
            </div>
          </div>
        </div>
      </div>
      <div class="col-lg-4">
        <div class="d-inline-block">
          <div class="d-flex align-items-end">
            <svg class="svg-icon svg-icon-big svg-icon-light">
              <use xlink:href="#label-tag-1"> </use>
            </svg>
            <div class="text-start ms-3">
              <h6 class="text-uppercase mb-1">Festivaloffers</h6>
              <p class="text-sm mb-0 text-muted">Free shipping worldwide</p>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</section>
<!-- NEWSLETTER-->
<footer class="bg-light text-white">
  <div class="container py-4">
    <div class="row py-5">
      <div class="col-md-12 text-center">
        <img src="{{ asset('img/logo.jpg') }}" alt="" class="mb-5">
        <ul class="list-unstyled d-flex justify-content-center mb-0">
          <li><a class="footer-link mx-4" href="#!">Twitter</a></li>
          <li><a class="footer-link mx-4" href="#!">Instagram</a></li>
          <li><a class="footer-link mx-4" href="#!">Tumblr</a></li>
          <li><a class="footer-link mx-4" href="#!">Pinterest</a></li>
        </ul>
      </div>
    </div>
    <div class="border-top pt-4" style="border-color: #1d1d1d !important">
      <div class="row">
        <div class="col-md-12 text-center">
          <a href="{{ url('/') }}" class="small text-muted mb-0">&copy;{{ config('app.name', 'Clashy') }} 2021 All rights reserved.</a>
        </div>
      </div>
    </div>
  </div>
</footer>
<!-- JavaScript files-->
<script src="{{ asset('vendor/jquery/jquery.min.js') }}"></script>
<script src="{{ asset('frontend/vendor/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
<script src="{{ asset('frontend/vendor/glightbox/js/glightbox.min.js') }}"></script>
<script src="{{ asset('frontend/vendor/nouislider/nouislider.min.js') }}"></script>
<script src="{{ asset('vendor/swiper/swiper.min.js') }}"></script>
<script src="{{ asset('frontend/vendor/choices.js/public/assets/scripts/choices.min.js') }}"></script>
<script src="{{ asset('frontend/js/front.js') }}"></script>
<script src="{{ asset('backend/vendors/datatable/datatable.min.js') }}"></script>
<script src="{{ asset('backend/vendors/datatable/datatable-bootstrap.min.js') }}"></script>
<script>
  // ------------------------------------------------------- //
    //   Inject SVG Sprite - 
    //   see more here 
    //   https://css-tricks.com/ajaxing-svg-sprite/
    // ------------------------------------------------------ //
    function injectSvgSprite(path) {
    
        var ajax = new XMLHttpRequest();
        ajax.open("GET", path, true);
        ajax.send();
        ajax.onload = function(e) {
        var div = document.createElement("div");
        div.className = 'd-none';
        div.innerHTML = ajax.responseText;
        document.body.insertBefore(div, document.body.childNodes[0]);
        }
    }
    // this is set to BootstrapTemple website as you cannot 
    // inject local SVG sprite (using only 'icons/orion-svg-sprite.svg' path)
    // while using file:// protocol
    // pls don't forget to change to your domain :)
    injectSvgSprite('https://bootstraptemple.com/files/icons/orion-svg-sprite.svg'); 
        
</script>
<!-- FontAwesome CSS - loading as last, so it doesn't block rendering-->
<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.1/css/all.css"
  integrity="sha384-fnmOCqbTlWIlj8LyTjo7mOUStjsKC4pOpQbqyi7RrhN7udi9RwhKkMHpvLbHG9Sr" crossorigin="anonymous">