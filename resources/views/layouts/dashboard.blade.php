<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <!-- CSS -->
    <link rel="stylesheet" type="text/css" href="{{ asset('css/app.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('css/common.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('css/admin.css') }}">

    <!-- Optional JavaScript -->
    <script type="text/javascript" src="{{ asset('js/app.js') }}"></script>

    <!-- Title -->
    <title>@yield('title')</title>

    <!-- Logo -->
    <link rel="icon" href="{{ asset('storage/logo/logo-site.png') }}" />
</head>

<body>
    <!-- Wrapper -->
    <div id="wrapper">
        <div id="sidebar-wrapper">
            <ul class="sidebar-nav">
                <li class="sidebar-nav-logo">
                    <img src="{{ asset('storage/logo/logo-black.png') }}" width="60" height="20" alt="logo">
                </li>
                <li>
                    <a href="{{ route('admin.index') }}"><i class="fas fa-user-shield"></i>{{ trans('layouts.admin') }}</a>
                </li>
                <li>
                    <a href="{{ route('user.index') }}"><i class="fas fa-users"></i>{{ trans('layouts.user') }}</a>
                </li>
                <li>
                    <a href="{{ route('order.manager') }}"><i class="fas fa-shopping-cart"></i>{{ trans('layouts.order') }}</a>
                </li>
                <li>
                    <a href="#product" data-toggle="collapse" aria-expanded="false"><i class="fas fa-box-open"></i>{{ trans('layouts.product') }}</a>
                    <ul class="collapse list-unstyled" id="product">
                        <li>
                            <a href="{{ route('product.create') }}">{{ trans('layouts.creat_product') }}</a>
                        </li>
                        <li>
                            <a href="{{ route('product.index') }}">{{ trans('layouts.list_product') }}</a>
                        </li>
                    </ul>
                </li>
                <li>
                    <a href="{{ route('category.create') }}"><i class="fas fa-filter"></i>{{ trans('layouts.category') }}</a>
                </li>
                <li>
                    <a href="{{ route('review.index') }}"><i class="fas fa-star"></i>{{ trans('layouts.review') }}</a>
                </li>
                <li>
                    <a href="{{ route('color.create') }}"><i class="fas fa-palette"></i>{{ trans('layouts.color') }}</a>
                </li>
                <li>
                    <a href="{{ route('size.create') }}"><i class="fas fa-pencil-ruler"></i>{{ trans('layouts.size') }}</a>
                </li>
                <li>
                    <a
                        href="{{ route('admin.password.edit', Auth::user()->id) }}"><i class="fas fa-lock"></i>{{ trans('layouts.change_password') }}</a>
                </li>
                <li>
                    <a href="{{ route('admin.logout') }}"
                        onclick="event.preventDefault(); document.getElementById('logout-form').submit();"><i class="fas fa-sign-out-alt"></i>{{ trans('layouts.logout') }}</a>
                    <form id="logout-form" action="{{ route('admin.logout') }}" method="POST" style="display: none;">
                        @csrf
                    </form>
                </li>
            </ul>
        </div>
        <div id="page-content-wrapper">
            <div class="container" id="content">
                <!-- Navbar -->
                <nav class="navbar navbar-expand-lg navbar-light bg-light rounded mb-4">
                    <div id="toggler">
                        <button id="menu-toggle" class="navbar-toggler" type="button">
                            <span class="navbar-toggler-icon"></span>
                        </button>
                    </div>
                    <ul class="navbar-nav">
                        <li class="nav-item disabled">
                            {{ trans('layouts.welcome', ['name' => Auth::user()->name]) }}
                        </li>
                    </ul>
                    <button class="navbar-toggler" type="button" data-toggle="collapse"
                        data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent"
                        aria-expanded="false" aria-label="Toggle navigation">
                        <span class="navbar-toggler-icon"></span>
                    </button>
                    <div class="collapse navbar-collapse" id="navbarSupportedContent">
                        <ul class="navbar-nav ml-auto text-center">
                            <li class="nav-item">
                                <a class="nav-link" href="{{ route('home') }}">{{ trans('layouts.home') }}</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link"
                                    href="{{ route('dashboard.index') }}">{{ trans('layouts.dashboard') }}</a>
                            </li>
                            <li class="nav-item dropdown">
                                <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button"
                                    data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                    @if ('vi' == session()->get('website_language', 'en'))
                                    {{ trans('layouts.vietnamese') }}
                                    @else
                                    {{ trans('layouts.english') }}
                                    @endif
                                </a>
                                <div class="dropdown-menu dropdown-menu-right text-center"
                                    aria-labelledby="navbarDropdown">
                                    <a class="dropdown-item"
                                        href="{{ route('user.language', ['en']) }}">{{ trans('layouts.english') }}</a>
                                    <a class="dropdown-item"
                                        href="{{ route('user.language', ['vi']) }}">{{ trans('layouts.vietnamese') }}</a>
                                </div>
                            </li>
                        </ul>
                    </div>
                </nav>
                <!-- Notification -->
                @include('layouts.notification')

                <!-- Content -->
                @yield('content')
            </div>
            <!-- Footer -->
            <footer class="mt-4">
                <div class="container">
                    <div class="py-4 border-top">
                        <div class="row">
                            <div class="col text-left">
                                <p class="m-0">
                                    {{ trans('layouts.copyright') }}
                                </p>
                            </div>
                            <div class="col text-right">
                                <p class="m-0">
                                    <a href="#">Back to top</a>
                                </p>
                            </div>
                        </div>
                    </div>
                </div>
            </footer>
        </div>
    </div>

    <!-- Toggle action -->
    <script type="text/javascript">
        $("#menu-toggle").click(function (e) {
            e.preventDefault();
            $("#wrapper").toggleClass("toggled");
        });
    </script>
</body>

</html>