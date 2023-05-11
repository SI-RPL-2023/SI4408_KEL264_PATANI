<!DOCTYPE html>
<html lang="en" itemscope itemtype="http://schema.org/WebPage">

<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="apple-touch-icon" sizes="76x76" href="{{ asset('landing/assets/img/apple-icon.png') }}">
    <link rel="icon" type="image/png" href="logo.png">
    <title>
        PATANI
    </title>
    <!--     Fonts and icons     -->
    <link rel="stylesheet" type="text/css" href="https://fonts.googleapis.com/css?family=Roboto:300,400,500,700,900|Roboto+Slab:400,700" />
    <!-- Nucleo Icons -->
    <link href="{{ asset('landing/assets/css/nucleo-icons.css') }}" rel="stylesheet" />
    <link href="{{ asset('landing/assets/css/nucleo-svg.css') }}" rel="stylesheet" />
    <!-- Font Awesome Icons -->
    <script src="https://kit.fontawesome.com/42d5adcbca.js" crossorigin="anonymous"></script>
    <!-- Material Icons -->
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons+Round" rel="stylesheet">
    <!-- CSS Files -->
    <link id="pagestyle" href="{{ asset('landing/assets/css/material-kit-pro.css?v=3.0.3') }}" rel="stylesheet" />


</head>

<body class="rental bg-gray-200">

<!-- Navbar Light -->

<nav
    class="navbar navbar-expand-lg navbar-light bg-white z-index-3 py-3 position-fixed w-100">
    <div class="container">
        <a class="navbar-brand" href="{{route('home')}}" rel="tooltip" title="Designed and Coded by Creative Tim" data-placement="bottom">
            <img src="logo.png" alt="" style="width: 100px">
        </a>
        <a href="https://www.creative-tim.com/product/material-design-system-pro#pricingCard" class="btn btn-sm  bg-gradient-primary  btn-round mb-0 ms-auto d-lg-none d-block">Buy Now</a>
        <button class="navbar-toggler shadow-none ms-2" type="button" data-bs-toggle="collapse" data-bs-target="#navigation" aria-controls="navigation" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon mt-2">
        <span class="navbar-toggler-bar bar1"></span>
        <span class="navbar-toggler-bar bar2"></span>
        <span class="navbar-toggler-bar bar3"></span>
      </span>
        </button>
        <div class="collapse navbar-collapse w-100 pt-3 pb-2 py-lg-0" id="navigation">
            <ul class="navbar-nav navbar-nav-hover mx-auto">
                <li class="nav-item mx-2">
                    <a class="nav-link ps-2 d-flex justify-content-between cursor-pointer align-items-center" href="{{route('workshops.landing')}}" role="button">
                        Workshops
                    </a>


                </li>

                <li class="nav-item mx-2">
                    <a class="nav-link ps-2 d-flex justify-content-between cursor-pointer align-items-center" href="{{route('articles.landing')}}" role="button">
                        Articles
                    </a>
                </li>


                <li class="nav-item mx-2">
                    <a class="nav-link ps-2 d-flex justify-content-between cursor-pointer align-items-center" href="{{route('store')}}" role="button">
                        Store
                    </a>
                </li>
                @guest
                @else
                    <li class="nav-item mx-2">
                        <a class="nav-link ps-2 d-flex justify-content-between cursor-pointer align-items-center" href="{{route('cart')}}" role="button">
                            Cart ({{count(\Illuminate\Support\Facades\Auth::user()->carts)}})
                        </a>
                    </li>

                    <li class="nav-item mx-2">
                        <a class="nav-link ps-2 d-flex justify-content-between cursor-pointer align-items-center" href="{{route('order.list')}}" role="button">
                            Order List
                        </a>
                    </li>
                @endguest



            </ul>

            <ul class="navbar-nav d-lg-block d-none">
                <ul class="navbar-nav ms-auto">
                    <!-- Authentication Links -->
                    @guest
                        @if (Route::has('login'))
                            <li class="nav-item">
                                <a class="nav-link" href="{{ route('login') }}">{{ __('Login') }}</a>
                            </li>
                        @endif

                        @if (Route::has('register'))
                            <li class="nav-item">
                                <a class="nav-link" href="{{ route('register') }}">{{ __('Register') }}</a>
                            </li>
                        @endif
                    @else
                        <li class="nav-item dropdown">
                            <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                {{ Auth::user()->name }}
                            </a>

                            <div class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdown">
                                <a class="dropdown-item" href="{{ route('logout') }}"
                                   onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                    {{ __('Logout') }}
                                </a>
                                <a class="dropdown-item" href="{{ route('editProfile') }}">
                                    Edit Profile
                                </a>
                                @if(\Illuminate\Support\Facades\Auth::user()->role =='admin')
                                    <a class="dropdown-item" href="{{ route('admin.index') }}">
                                      Dashboard Admin
                                    </a>
                                @endif


                                @if(\Illuminate\Support\Facades\Auth::user()->role =='mitra')
                                    <a class="dropdown-item" href="{{ route('mitraArticles.index') }}">
                                        Dashboard Mitra
                                    </a>
                                @endif

                                <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                                    @csrf
                                </form>
                            </div>
                        </li>


                    @endguest
                </ul>
            </ul>
        </div>
    </div>
</nav>
<!-- End Navbar -->


@yield('content')
<!-- Navbar Transparent -->


<!--   Core JS Files   -->
<script src="../landing/assets/js/core/popper.min.js" type="text/javascript"></script>
<script src="../landing/assets/js/core/bootstrap.min.js" type="text/javascript"></script>
<script src="../landing/assets/js/plugins/perfect-scrollbar.min.js"></script>
<!--  Plugin for TypedJS, full documentation here: https://github.com/mattboldt/typed.js/ -->
<script src="../landing/assets/js/plugins/typedjs.js"></script>
<script src="../landing/assets/js/plugins/choices.min.js"></script>
<script src="../landing/assets/js/plugins/flatpickr.min.js"></script>
<!--  Plugin for Parallax, full documentation here: https://github.com/wagerfield/parallax  -->
<script src="../landing/assets/js/plugins/parallax.min.js"></script>
<!--  Plugin for the Sliders, full documentation here: http://refreshless.com/nouislider/ -->
<script src="../landing/assets/js/plugins/nouislider.min.js" type="text/javascript"></script>
<!--  Plugin for the blob animation -->
<script src="../landing/assets/js/plugins/anime.min.js" type="text/javascript"></script>
<!-- Control Center for Material UI Kit: parallax effects, scripts for the example pages etc -->
<!--  Google Maps Plugin    -->
<script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyDTTfWur0PDbZWPr7Pmq8K3jiDp0_xUziI"></script>
<script src="../landing/assets/js/material-kit-pro.min.js?v=3.0.3" type="text/javascript"></script>
<script>
    if (document.getElementById('choices-button')) {
        var element = document.getElementById('choices-button');
        const example = new Choices(element, {
            searchEnabled: false
        });

    }
    if (document.getElementById('choices-remove-button')) {
        var element = document.getElementById('choices-remove-button');
        const example = new Choices(element, {
            searchEnabled: false
        });
    }

    if (document.querySelector('.datepicker')) {
        flatpickr('.datepicker', {
            mode: "range"
        }); // flatpickr
    }
</script>
</body>

</html>
