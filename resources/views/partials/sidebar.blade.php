<!-- partial:partials/_settings-panel.html -->
<div class="theme-setting-wrapper">
    <div id="settings-trigger"><i class="ti-settings"></i></div>
    <div id="theme-settings" class="settings-panel">
      <i class="settings-close ti-close"></i>
      <p class="settings-heading">SIDEBAR SKINS</p>
      <div class="sidebar-bg-options selected" id="sidebar-light-theme"><div class="img-ss rounded-circle bg-light border me-3"></div>Light</div>
      <div class="sidebar-bg-options" id="sidebar-dark-theme"><div class="img-ss rounded-circle bg-dark border me-3"></div>Dark</div>
      <p class="settings-heading mt-2">HEADER SKINS</p>
      <div class="color-tiles mx-0 px-4">
        <div class="tiles success"></div>
        <div class="tiles warning"></div>
        <div class="tiles danger"></div>
        <div class="tiles info"></div>
        <div class="tiles dark"></div>
        <div class="tiles default"></div>
      </div>
    </div>
  </div>
  <!-- partial -->
  <!-- partial:partials/_sidebar.html -->
  <nav class="sidebar sidebar-offcanvas" id="sidebar">
    <ul class="nav">
      <li class="nav-item">
        <a class="nav-link" href="/">
            <i class="mdi mdi-home menu-icon"></i>
            <span class="menu-title">Home</span>
        </a>
      </li>
      <li class="nav-item {{ Request::is('transaksi*') ? 'active' : '' }} {{ Request::is('pendapatan*') ? 'active' : '' }}">
        <a class="nav-link mb-2" data-bs-toggle="collapse" href="#ui-basic" aria-expanded="false" aria-controls="ui-basic">
          <i class="menu-icon mdi mdi-database"></i>
          <span class="menu-title">Data</span>
          <i class="menu-arrow"></i>
        </a>
        <div class="collapse {{ Request::is('pendapatan*') ? 'show' : '' }} {{ Request::is('transaksi*') ? 'show' : '' }}" id="ui-basic">
          <ul class="nav flex-column sub-menu" style="border-bottom-right-radius: 1rem;">
            <li class="nav-item"> <a class="nav-link" href="/produk">Produk</a></li>
            <li class="nav-item"> <a class="nav-link" href="/kategori">Kategori</a></li>
            <li class="nav-item"> <a class="nav-link {{ Request::is('transaksi*') ? 'active' : '' }}" href="/transaksi">Transaksi</a></li>
            <li class="nav-item"> <a class="nav-link {{ Request::is('pendapatan*') ? 'active' : '' }}" href="/pendapatan">Pendapatan</a></li>
          </ul>
        </div>
      </li>
    </ul>
  </nav>
