<nav class="sidebar sidebar-offcanvas" id="sidebar">
  <ul class="nav">
    <li class="nav-item pt-3">
      <a class="nav-link d-block" href="{{ url('/') }}">
        <h6>{{ config('app.name', 'Clashy') }}</h6>
      </a>
    </li>
    <li class="nav-item mt-5">
      <a class="nav-link" href="index.html">
        <i class="mdi mdi-compass-outline menu-icon"></i>
        <span class="menu-title">Dashboard</span>
      </a>
    </li>
    <li class="nav-item">
      <a class="nav-link" data-toggle="collapse" href="#ui-basic" aria-expanded="false" aria-controls="ui-basic">
        <i class="mdi mdi-crosshairs-gps menu-icon"></i>
        <span class="menu-title">UI Elements</span>
        <i class="menu-arrow"></i>
      </a>
      <div class="collapse" id="ui-basic">
        <ul class="nav flex-column sub-menu">
          <li class="nav-item">
            <a class="nav-link" href="pages/ui-features/buttons.html">Buttons</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="pages/ui-features/dropdowns.html">Dropdowns</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="pages/ui-features/typography.html">Typography</a>
          </li>
        </ul>
      </div>
    </li>
    <li class="nav-item">
      <a class="nav-link" href="pages/icons/mdi.html">
        <i class="mdi mdi-contacts menu-icon"></i>
        <span class="menu-title">Icons</span>
      </a>
    </li>
    <li class="nav-item">
      <a class="nav-link" href="pages/forms/basic_elements.html">
        <i class="mdi mdi-format-list-bulleted menu-icon"></i>
        <span class="menu-title">Forms</span>
      </a>
    </li>
    <li class="nav-item">
      <a class="nav-link" href="pages/charts/chartjs.html">
        <i class="mdi mdi-chart-bar menu-icon"></i>
        <span class="menu-title">Charts</span>
      </a>
    </li>
    <li class="nav-item">
      <a class="nav-link" href="pages/tables/basic-table.html">
        <i class="mdi mdi-table-large menu-icon"></i>
        <span class="menu-title">Tables</span>
      </a>
    </li>
    <li class="nav-item pt-3">
      <a class="nav-link" href="http://bootstrapdash.com/demo/plus-free/documentation/documentation.html"
        target="_blank">
        <i class="mdi mdi-file-document-box menu-icon"></i>
        <span class="menu-title">Documentation</span>
      </a>
    </li>
  </ul>
</nav>