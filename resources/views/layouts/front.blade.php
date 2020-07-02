<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta http-equiv="x-ua-compatible" content="ie=edge">
  <title>@yield('title')</title>
  <!-- Bootstrap core CSS -->
  <link rel="stylesheet" href="{{ asset('assets/user/css/bootstrap.min.css') }}">
  <!-- Fluent Design Bootstrap -->
  <link rel="stylesheet" href="{{ asset('assets/user/css/fluent.css') }}">
  <!-- Micon icons-->
  <link rel="stylesheet" href="{{ asset('assets/user/css/micon.min.css') }}">
  {{-- fontawesome --}}
  <link href="{{ asset('assets/admin/vendor/fontawesome-free/css/all.min.css') }}" rel="stylesheet" type="text/css">
  <!--Custom style -->
  <link rel="stylesheet" href="{{ asset('assets/user/css/mystyle.css') }}">

</head>

<body>
  <!-- Navbar -->
  <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
    <div class="container">
      <a class="navbar-brand" href="/">
        <span class="d-inline-block align-top ml-2">Kabar Burung</span>
      </a>
      <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarExample" aria-controls="navbarExample"
        aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>

      <div class="collapse navbar-collapse" id="navbarExample">
        <ul class="navbar-nav ml-auto">
          <li class="nav-item{{ request()->is('/')? ' active' : '' }}">
            <a class="nav-link" href="/">Home
              <span class="sr-only">(current)</span>
            </a>
          </li>
          <li class="nav-item">
            <a class="nav-link{{ request()->is('berita/terbaru*')? ' active' : '' }}" href="{{ route('front.latest') }}">Terbaru</a>
          </li>
          <li class="nav-item dropdown {{ request()->is('kategori*')? ' active' : '' }}">
            <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true"
              aria-expanded="false">
              Kategori
            </a>
            <div class="dropdown-menu" aria-labelledby="navbarDropdown">
              @foreach ($categories as $category)
                  @if ($category->posts->count() > 0)
                    <a class="dropdown-item{{ request()->is('kategori/' . $category->slug.'*')? ' active' : '' }}" href="{{ route('front.category', $category->slug) }}">{{ $category->name }}</a>
                  @endif
              @endforeach
            </div>
          </li>
          {{-- <li class="nav-item">
            <a class="nav-link disabled" href="#">Disabled</a>
          </li> --}}
        </ul>
      </div>
    </div>
  </nav>
  <!-- Navbar -->
  <div class="container">
    @yield('content')
  </div>  

  <!-- Footer -->
<footer class="page-footer font-small green-grey darken-3 mt-5">

  <!-- Footer Elements -->
  <div class="container">

    <!-- Grid row-->
    <div class="row">

      <!-- Grid column -->
      <div class="col-md-12 py-5">
        <div class="mb-5 flex-center">

          <!-- Facebook -->
          <a class="fb-ic">
            <i class="mi mi-facebook mi-2x text-white mr-md-5 mr-3"> </i>
          </a>
          <!-- Twitter -->
          <a class="tw-ic">
            <i class="mi mi-twitter mi-2x text-white mr-md-5 mr-3"> </i>
          </a>
          <!-- Google +-->
          <a class="gplus-ic">
            <i class="mi mi-google-plus mi-2x text-white mr-md-5 mr-3"> </i>
          </a>
          <!--Linkedin -->
          <a class="li-ic">
            <i class="mi mi-linkedin mi-2x text-white mr-md-5 mr-3"> </i>
          </a>
          <!--Instagram-->
          <a class="ins-ic">
            <i class="mi mi-instagram mi-2x text-white mr-md-5 mr-3"> </i>
          </a>
          <!--Pinterest-->
          <a class="pin-ic">
            <i class="mi mi-pinterest-p mi-2x text-white"> </i>
          </a>

        </div>
      </div>
      <!-- Grid column -->

    </div>
    <!-- Grid row-->

  </div>
  <!-- Footer Elements -->

  <!-- Copyright -->
  <div class="footer-copyright text-center py-3 text-white-50">© 2018 Copyright:
    <a href="https://github.com/muhammadihsanansory" class="text-white"> Muhammad Ihsan Ansory</a>
  </div>
  <!-- Copyright -->

</footer>
<!-- Footer -->
  <!-- Scripts -->
  <!-- JQuery -->
  <script type="text/javascript" src="{{ asset('assets/user/js/jquery-3.3.1.min.js') }}"></script>
  <!-- Bootstrap tooltips -->
  <script type="text/javascript" src="{{ asset('assets/user/js/popper.min.js') }}"></script>
  <!-- Bootstrap core JavaScript -->
  <script type="text/javascript" src="{{ asset('assets/user/js/bootstrap.min.js') }}"></script>
</body>

</html>
