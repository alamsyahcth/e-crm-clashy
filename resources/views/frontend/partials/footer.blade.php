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
<footer class="bg-dark text-white">
  <div class="container py-4">
    <div class="row py-5">
      <div class="col-md-4 mb-3 mb-md-0">
        <h6 class="text-uppercase mb-3">Customer services</h6>
        <ul class="list-unstyled mb-0">
          <li><a class="footer-link" href="#!">Help &amp; Contact Us</a></li>
          <li><a class="footer-link" href="#!">Returns &amp; Refunds</a></li>
          <li><a class="footer-link" href="#!">Online Stores</a></li>
          <li><a class="footer-link" href="#!">Terms &amp; Conditions</a></li>
        </ul>
      </div>
      <div class="col-md-4 mb-3 mb-md-0">
        <h6 class="text-uppercase mb-3">Company</h6>
        <ul class="list-unstyled mb-0">
          <li><a class="footer-link" href="#!">What We Do</a></li>
          <li><a class="footer-link" href="#!">Available Services</a></li>
          <li><a class="footer-link" href="#!">Latest Posts</a></li>
          <li><a class="footer-link" href="#!">FAQs</a></li>
        </ul>
      </div>
      <div class="col-md-4">
        <h6 class="text-uppercase mb-3">Social media</h6>
        <ul class="list-unstyled mb-0">
          <li><a class="footer-link" href="#!">Twitter</a></li>
          <li><a class="footer-link" href="#!">Instagram</a></li>
          <li><a class="footer-link" href="#!">Tumblr</a></li>
          <li><a class="footer-link" href="#!">Pinterest</a></li>
        </ul>
      </div>
    </div>
    <div class="border-top pt-4" style="border-color: #1d1d1d !important">
      <div class="row">
        <div class="col-md-6 text-center text-md-start">
          <p class="small text-muted mb-0">&copy; 2021 All rights reserved.</p>
        </div>
        <div class="col-md-6 text-center text-md-end">
          <p class="small text-muted mb-0">Template designed by <a class="text-white reset-anchor"
              href="https://bootstrapious.com/p/boutique-bootstrap-e-commerce-template">Bootstrapious</a></p>
          <!-- If you want to remove the backlink, please purchase the Attribution-Free License. See details in readme.txt or license.txt. Thanks!-->
        </div>
      </div>
    </div>
  </div>
</footer>
<!-- JavaScript files-->
<script src="{{ asset('frontend/vendor/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
<script src="{{ asset('frontend/vendor/glightbox/js/glightbox.min.js') }}"></script>
<script src="{{ asset('frontend/vendor/nouislider/nouislider.min.js') }}"></script>
<script src="{{ asset('frontend/vendor/swiper/swiper-bundle.min.js') }}"></script>
<script src="{{ asset('frontend/vendor/choices.js/public/assets/scripts/choices.min.js') }}"></script>
<script src="{{ asset('frontend/js/front.js') }}"></script>
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