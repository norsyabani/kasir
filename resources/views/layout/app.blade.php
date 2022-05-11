<!DOCTYPE html>
<html lang="en">

<head>
  <!-- Required meta tags -->
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <title>@yield('title')</title>

  @include('partials.head')

    <style>
        .dots {
        width: 13.4px;
        height: 13.4px;
        background: #474bff;
        color: #474bff;
        border-radius: 50%;
        box-shadow: 22.4px 0,-22.4px 0;
        animation: dots-u8fzftmd 1s infinite linear alternate;
        }

        @keyframes dots-u8fzftmd {
        0% {
            box-shadow: 22.4px 0,-22.4px 0;
            background: ;
        }

        33% {
            box-shadow: 22.4px 0,-22.4px 0 rgba(71,75,255,0.13);
            background: rgba(71,75,255,0.13);
        }

        66% {
            box-shadow: 22.4px 0 rgba(71,75,255,0.13),-22.4px 0;
            background: rgba(71,75,255,0.13);
        }
        }
    </style>

</head>
<body>
  <div class="container-scroller">
    <!-- partial:partials/_navbar.html -->
    @include('partials.navbar')
    <!-- partial -->
    <div class="container-fluid page-body-wrapper">

    @include('partials.sidebar')
      <!-- partial -->
      <div class="main-panel">
        <div class="content-wrapper">
          <div class="row">
            <div class="col-sm-12">
              <div class="home-tab">
                @yield('content')
              </div>
            </div>
          </div>
        </div>
        <!-- content-wrapper ends -->
        <!-- partial:partials/_footer.html -->
        @include('partials.footer')
        <!-- partial -->
      </div>
      <!-- main-panel ends -->
    </div>
    <!-- page-body-wrapper ends -->
  </div>
  <!-- container-scroller -->

  @include('partials.scripts')
</body>

</html>

