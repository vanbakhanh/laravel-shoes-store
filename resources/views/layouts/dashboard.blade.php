<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">
<head>
    @include('layouts.head')
    @include('layouts.script')
    <title>@yield('title')</title>
    <link rel="icon" href="{{ asset('images/logo_site.png') }}"/>
</head>
<body>	

    <!-- Wrapper -->
    <div id="wrapper">
        <div id="sidebar-wrapper">
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
                <li><a href="{{ route('admin.password.edit', Auth::user()->id) }}">{{ trans('layout.change_password') }}</a></li>
                <li><a href="{{ route('admin.logout') }}"  onclick="event.preventDefault(); document.getElementById('logout-form').submit();">{{ trans('layout.logout') }}</a><form id="logout-form" action="{{ route('admin.logout') }}" method="POST" style="display: none;">@csrf</form></li>
            </ul>
        </div>

        <!-- Navbar -->
        <nav id="nav-down" class="navbar sticky-top navbar-expand-lg navbar-light bg-light py-2 mb-2">
            <div class="container">
                <div class="navbar-brand p-0">
                    <a id="menu-toggle" href="#menu-toggle">
                        <span class="navbar-toggler-icon"></span>
                    </a>
                </div>
                <ul class="navbar-nav mr-auto">
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('home') }}">{{ trans('layout.home') }}</a>
                    </li>
                </ul>
                <ul class="navbar-nav ml-auto">
                    <!-- Authentication Links -->
                    @guest
                    <li><a class="nav-link" href="{{ route('login') }}">{{ __('Login') }}</a></li>
                    <li><a class="nav-link" href="{{ route('register') }}">{{ __('Register') }}</a></li>
                    @else
                    <li><a class="nav-link disabled" href="#">{{ trans('layout.welcome', ['name' => Auth::user()->name]) }}</a></li>
                    @endguest
                </ul>
            </div>
        </nav>

        <!-- Content -->
        <div id="page-content-wrapper">
            <div class="container">
                @yield('content')      
            </div>
        </div>
        @include('layouts.footer')
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
          document.getElementById("nav-down").style.top = "-60px";
        }
        prevScrollpos = currentScrollPos;
      }
    </script>
</body>
</html>