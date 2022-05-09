<nav class="navbar default-layout col-lg-12 col-12 p-0 fixed-top d-flex align-items-top flex-row">
    <div class="text-center navbar-brand-wrapper d-flex align-items-center justify-content-start">
      <div class="me-3">
        <button class="navbar-toggler navbar-toggler align-self-center" type="button" data-bs-toggle="minimize">
          <span class="icon-menu"></span>
        </button>
      </div>
      <div>
        <a class="navbar-brand brand-logo" href="/">
          <img src="/images/logo.svg" alt="logo" />
        </a>
        <a class="navbar-brand brand-logo-mini" href="/">
          <img src="/images/logo-mini.svg" alt="logo" />
        </a>
      </div>
    </div>
    <div class="navbar-menu-wrapper d-flex align-items-center">
        @if(isset($navbar) && $navbar)
        <ul class="navbar-nav">
            <li class="nav-item font-weight-semibold d-none d-lg-block ms-0">
            <h1 class="welcome-text">Hallo, <span class="text-black fw-bold">{{ auth()->user()->name }}</span></h1>
            </li>
        </ul>
        @endif
        @if(isset($cart) && $cart)
            <h6 class="mb-0 me-3">Menu dipilih <span id="selectedItem" class="badge ms-1 rounded-pill bg-danger">0</span></h4>
            <button data-bs-toggle="modal" id="showCheckout{{ $order->id }}" data-bs-target="#checkout{{ $order->id }}" type="button" class="btn btn-rounded btn-inverse-success btn-fw">Checkout</button>
        @endif
      <ul class="navbar-nav ms-auto">
        <li class="nav-item dropdown d-none d-lg-block user-dropdown">
          <a class="nav-link" id="UserDropdown" href="#" data-bs-toggle="dropdown" aria-expanded="false">
            <img class="img-xs rounded-circle" src="https://ui-avatars.com/api/?name={{ auth()->user()->name}}" alt="Profile image"> </a>
          <div class="dropdown-menu dropdown-menu-right navbar-dropdown" aria-labelledby="UserDropdown">
            <div class="dropdown-header text-center">
              <img class="img-md rounded-circle" src="https://ui-avatars.com/api/?name={{ auth()->user()->name}}" alt="Profile image">
              <p class="mb-1 mt-3 font-weight-semibold">{{ auth()->user()->name }}</p>
              <p class="fw-light text-muted mb-0">{{ auth()->user()->email }}</p>
            </div>
            <form action="/logout" method="POST">
                @csrf
                <button class="dropdown-item" type="submit"><i class="dropdown-item-icon mdi mdi-power text-primary me-2"></i>Sign Out</button>
            </form>
          </div>
        </li>
      </ul>
      <button class="navbar-toggler navbar-toggler-right d-lg-none align-self-center" type="button" data-bs-toggle="offcanvas">
        <span class="mdi mdi-menu"></span>
      </button>
    </div>
  </nav>
