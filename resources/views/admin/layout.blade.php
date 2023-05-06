<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="apple-touch-icon" sizes="76x76" href="../../assets/img/apple-icon.png">
    <link rel="icon" type="image/png" href="logo.png">
    <title>
        Admin | PATANI
    </title>
    <script src="{{ asset('node_modules/tinymce/tinymce.js') }}"></script>
    <!--     Fonts and icons     -->
    <link rel="stylesheet" type="text/css" href="https://fonts.googleapis.com/css?family=Roboto:300,400,500,700,900|Roboto+Slab:400,700" />
    <!-- Nucleo Icons -->
    <link href="../../assets/css/nucleo-icons.css" rel="stylesheet" />
    <link href="../../assets/css/nucleo-svg.css" rel="stylesheet" />
    <!-- Font Awesome Icons -->
    <script src="https://kit.fontawesome.com/42d5adcbca.js" crossorigin="anonymous"></script>
    <!-- Material Icons -->
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons+Round" rel="stylesheet">
    <!-- CSS Files -->
    <link id="pagestyle" href="../../assets/css/material-dashboard.css?v=3.0.6" rel="stylesheet" />
    <!-- Nepcha Analytics (nepcha.com) -->
    <!-- Nepcha is a easy-to-use web analytics. No cookies and fully compliant with GDPR, CCPA and PECR. -->
    <script defer data-site="YOUR_DOMAIN_HERE" src="https://api.nepcha.com/js/nepcha-analytics.js"></script>

    <!-- CSS -->
    <script type="text/javascript" src="https://code.jquery.com/jquery-3.6.0.min.js"></script>



    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.4/css/jquery.dataTables.css" />

    <script src="https://cdn.datatables.net/1.13.4/js/jquery.dataTables.js"></script>


    <style>
        .form-control{
            background: whitesmoke !important;
            padding: 10px;
            box-shadow: grey;
        }
    </style>

</head>

<body class="g-sidenav-show  bg-gray-200">
<aside class="sidenav navbar navbar-vertical navbar-expand-xs border-0 border-radius-xl my-3 fixed-start ms-3   bg-gradient-dark" id="sidenav-main">
    <div class="bg-white"><a href="{{route('home')}}"><img src="{{asset('logo.png')}}"  class="w-100" alt="main_logo"></a></div>

    <hr class="horizontal light mt-0 mb-2">
    <div class="collapse navbar-collapse  w-auto h-auto" id="sidenav-collapse-main">
        <ul class="navbar-nav">
            <li class="nav-item ">
                <a class="nav-link text-white {{ Request::routeIs('admin.dashboard') ? 'active bg-gradient-success' : '' }}" href="">
                    <span class="sidenav-mini-icon"> D </span>
                    <span class="sidenav-normal  ms-2  ps-1"> Dashboard </span>
                </a>
            </li>

            <li class="nav-item ">
                <a class="nav-link text-white {{ Request::routeIs('categories.index') ? 'active bg-gradient-success' : '' }}" href="{{route('categories.index')}}">
                    <span class="sidenav-mini-icon"> Ctr </span>
                    <span class="sidenav-normal  ms-2  ps-1"> Category </span>
                </a>
            </li>

            <li class="nav-item ">
                <a class="nav-link text-white {{ Request::routeIs('products.index') ? 'active bg-gradient-success' : '' }}" href="{{route('products.index')}}">
                    <span class="sidenav-mini-icon"> Pro </span>
                    <span class="sidenav-normal  ms-2  ps-1"> Product </span>
                </a>
            </li>

            <li class="nav-item ">
                <a class="nav-link text-white {{ Request::routeIs('articles.index') ? 'active bg-gradient-success' : '' }}" href="{{route('articles.index')}}">
                    <span class="sidenav-mini-icon"> Art </span>
                    <span class="sidenav-normal  ms-2  ps-1"> Article </span>
                </a>
            </li>

            <li class="nav-item ">
                <a class="nav-link text-white {{ Request::routeIs('workshops.index') ? 'active bg-gradient-success' : '' }}" href="{{route('workshops.index')}}">
                    <span class="sidenav-mini-icon"> Wrk </span>
                    <span class="sidenav-normal  ms-2  ps-1"> Workshops </span>
                </a>
            </li>

            <li class="nav-item ">
                <a class="nav-link text-white {{ Request::routeIs('admin.orderList') ? 'active bg-gradient-success' : '' }}" href="{{route('admin.orderList')}}">
                    <span class="sidenav-mini-icon"> OL </span>
                    <span class="sidenav-normal  ms-2  ps-1"> Order List </span>
                </a>
            </li>

        </ul>
    </div>
</aside>
<main class="main-content position-relative max-height-vh-100 h-100 border-radius-lg ">
    <!-- Navbar -->
    <nav class="navbar navbar-main navbar-expand-lg position-sticky mt-4 top-1 px-0 mx-4 shadow-none border-radius-xl z-index-sticky" id="navbarBlur" data-scroll="true">
        <div class="container-fluid py-1 px-3">
            <div class="sidenav-toggler sidenav-toggler-inner d-xl-block d-none ">
                <a href="javascript:;" class="nav-link text-body p-0">
                    <div class="sidenav-toggler-inner">
                        <i class="sidenav-toggler-line"></i>
                        <i class="sidenav-toggler-line"></i>
                        <i class="sidenav-toggler-line"></i>
                    </div>
                </a>
            </div>
        </div>
    </nav>
    <!-- End Navbar -->
    <div class="container-fluid py-4">
        @yield('content')
    </div>
</main>

<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 1440 320"><path fill="#4CAF50" fill-opacity="1" d="M0,64L120,90.7C240,117,480,171,720,186.7C960,203,1200,181,1320,170.7L1440,160L1440,320L1320,320C1200,320,960,320,720,320C480,320,240,320,120,320L0,320Z"></path></svg>

<!--   Core JS Files   -->
<script src="../../assets/js/core/popper.min.js"></script>
<script src="../../assets/js/core/bootstrap.min.js"></script>
<script src="../../assets/js/plugins/perfect-scrollbar.min.js"></script>
<script src="../../assets/js/plugins/smooth-scrollbar.min.js"></script>
<!-- Kanban scripts -->
<script src="../../assets/js/plugins/dragula/dragula.min.js"></script>
<script src="../../assets/js/plugins/jkanban/jkanban.js"></script>
<script src="../../assets/js/plugins/chartjs.min.js"></script>

<!-- Github buttons -->
<script async defer src="https://buttons.github.io/buttons.js"></script>
<!-- Control Center for Material Dashboard: parallax effects, scripts for the example pages etc -->
<script src="../../assets/js/material-dashboard.min.js?v=3.0.6"></script>
<script type="text/javascript" src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

<!-- JS -->
<script type="text/javascript" src="https://cdn.datatables.net/v/bs5/dt-1.11.3/datatables.min.js"></script>
<link rel="stylesheet" href="https://cdn.datatables.net/1.13.4/css/jquery.dataTables.css" />


<script src="https://cdn.datatables.net/1.13.4/js/jquery.dataTables.js"></script>

@stack('script')
</body>

</html>
