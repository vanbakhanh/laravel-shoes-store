<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">
<head>
	@include('layouts.head')
	@include('layouts.script')
	<title>@yield('title')</title>
	<link rel="icon" href="{{ asset('images/logo_site.png') }}"/>
</head>
<body>
	@include('layouts.navbar')

	<div class="container">
		@yield('content')
	</div>
	
	@include('layouts.footer')
</body>
</html>