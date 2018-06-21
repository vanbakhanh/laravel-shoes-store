<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">
<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <!-- CSS -->
    <link rel="stylesheet" type="text/css" href="{{ asset('css/bootstrap.min.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('css/dataTables.bootstrap4.min.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('css/dashboard.css') }}">

    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script type="text/javascript" src="{{ asset('js/jquery.min.js') }}"></script>
    <script type="text/javascript" src="{{ asset('js/popper.min.js') }}"></script>
    <script type="text/javascript" src="{{ asset('js/bootstrap.min.js') }}"></script>
    <script type="text/javascript" src="{{ asset('js/dataTable.js') }}"></script>

    <!-- Title -->
    <title>@yield('title')</title>
    <link rel="icon" href="{{ asset('images/logo_site.png') }}"/>
</head>
<body>	

    <!-- Wrapper -->
    <div id="wrapper">
        <div id="sidebar-wrapper" class="shadow-sm">
            <ul class="sidebar-nav">
                <li class="sidebar-brand"><a href="{{ route('admin.index') }}">{{ trans('layout.dashboard') }}</a></li>
                <li><a href="{{ route('user.index') }}">{{ trans('layout.user') }}</a></li>
                <li><a href="{{ route('admin.order') }}">{{ trans('layout.order') }}</a></li>              
                <li>
                    <a href="#product" data-toggle="collapse" aria-expanded="false">{{ trans('layout.product') }}</a>
                    <ul class="collapse list-unstyled" id="product">
                        <li><a href="{{ route('product.create') }}">{{ trans('layout.creat_product') }}</a></li>
                        <li><a href="{{ route('product.index') }}">{{ trans('layout.list_product') }}</a></li>
                    </ul>
                </li>
                <li><a href="{{ route('category.create') }}">{{ trans('layout.category') }}</a></li>
                <li><a href="{{ route('color.create') }}">{{ trans('layout.color') }}</a></li>
                <li><a href="{{ route('size.create') }}">{{ trans('layout.size') }}</a></li>
                <hr>
                <li><a href="{{ route('admin.password.edit') }}">{{ trans('layout.change_password') }}</a></li>
                <li><a href="{{ route('admin.logout') }}"  onclick="event.preventDefault(); document.getElementById('logout-form').submit();">{{ trans('layout.logout') }}</a><form id="logout-form" action="{{ route('admin.logout') }}" method="POST" style="display: none;">@csrf</form></li>
            </ul>
        </div>

        <div id="page-content-wrapper">
            <div class="container">
                <!-- Navbar -->
                <nav id="nav-down" class="navbar sticky-top navbar-expand-lg navbar-light bg-light rounded py-2 mb-4">
                    <div class="container">
                        <div class="navbar-brand p-0">
                            <a id="menu-toggle" href="#menu-toggle">
                                <span class="navbar-toggler-icon"></span>
                            </a>
                        </div>
                        <ul class="navbar-nav mr-auto">
                            <li class="nav-item"><a class="nav-link" href="{{ route('home') }}">{{ trans('layout.home') }}</a></li>
                        </ul>
                        <ul class="navbar-nav ml-auto">
                            <li><a class="nav-link disabled" href="#">{{ trans('layout.welcome', ['name' => Auth::user()->name]) }}</a></li>
                        </ul>
                    </div>
                </nav>

                <!-- Content -->
                @yield('content')
            </div>
            <!-- Footer -->
            @include('layouts.footer')
        </div>
    </div>

    <!-- Toggle action -->
    <script type="text/javascript">
        $("#menu-toggle").click(function(e) {
            e.preventDefault();
            $("#wrapper").toggleClass("toggled");
        });
    </script>

    <!-- When the user scrolls down, hide the navbar. When the user scrolls up, show the navbar -->
    <script type="text/javascript">
      var prevScrollpos = window.pageYOffset;
      window.onscroll = function() {
        var currentScrollPos = window.pageYOffset;
        if (prevScrollpos > currentScrollPos) {
          document.getElementById("nav-down").style.top = "0";
        } else {
          document.getElementById("nav-down").style.top = "-65px";
        }
        prevScrollpos = currentScrollPos;
      }
    </script>

</body>
</html>