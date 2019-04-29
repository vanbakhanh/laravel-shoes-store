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
    <link rel="stylesheet" type="text/css" href="{{ asset('css/user.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('css/aos.css') }}">

    <!-- Title -->
    <title>@yield('title')</title>

    <!-- Logo -->
    <link rel="icon" href="{{ asset('storage/logo/logo-site.png') }}" />
</head>

<body>
    @include('layouts.navbar')

    @section('modal')
    @include('frontend.common.auth-modal')
    @show

    @yield('cover')

    <div class="container">
    @include('layouts.notification')
    @yield('content')
    </div>

    @include('layouts.footer')

    <!-- Optional JavaScript -->
    <script type="text/javascript" src="{{ asset('js/app.js') }}"></script>
    <script type="text/javascript" src="{{ asset('js/user.js') }}"></script>

    @yield('script')
</body>

</html>