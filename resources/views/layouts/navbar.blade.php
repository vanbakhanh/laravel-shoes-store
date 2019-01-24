<!-- Navbar -->
<nav id="nav-hide" class="navbar sticky-top navbar-expand-lg navbar-light bg-light mb-4">
    <div class="container">
        <a class="navbar-brand" href="{{ route('home') }}">
            <img src="{{ asset('images/logo-black.png') }}" width="60" height="20" alt="logo">
        </a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <!-- Left -->
            <ul class="navbar-nav mr-auto">
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('home') }}">
                        {{ trans('layouts.home') }}
                    </a>
                </li>
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        {{ trans('layouts.men') }}
                    </a>
                    <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                        @foreach ($categories = App\Models\Category::all()->sortBy('name') as $category)
                        <a class="dropdown-item" href="{{ route('category.men', $category->id) }}">
                            {{ $category->name }}
                        </a>
                        @endforeach
                    </div>
                </li>
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        {{ trans('layouts.women') }}
                    </a>
                    <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                        @foreach ($categories as $category)
                        <a class="dropdown-item" href="{{ route('category.women', $category->id) }}">
                            {{ $category->name }}
                        </a>
                        @endforeach
                    </div>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('admin.login') }}">
                        {{ trans('layouts.dashboard') }}
                    </a>
                </li>
            </ul>
            <!-- Search Form -->
            {{ Form::open(['route' => ['search'], 'method' => 'GET', 'class' => 'form-inline my-2 my-lg-0 mr-auto', 'role' => 'search']) }}
            {{ Form::search('keyword', '', ['class' => 'form-control form-control-sm', 'placeholder' => trans('layouts.search')]) }}
            {{ Form::close() }}
            <!-- Right -->
            <ul class="navbar-nav ml-auto">
                @guest
                <li class="nav-item">
                    <a class="nav-link" id="cart-qty" href="{{ route('cart.index') }}">
                        {{ trans('layouts.cart') }} {{ Cart::count() }}
                    </a>
                </li>
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        @if ('vi' == session()->get('website_language', 'en'))
                        {{ trans('layouts.vietnamese') }}
                        @else
                        {{ trans('layouts.english') }}
                        @endif
                    </a>
                    <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                        <a class="dropdown-item" href="{{ route('user.language', ['en']) }}">
                            {{ trans('layouts.english') }}
                        </a>
                        <a class="dropdown-item" href="{{ route('user.language', ['vi']) }}">
                            {{ trans('layouts.vietnamese') }}
                        </a>
                    </div>
                </li>
                <form class="form-inline">
                    <!-- Button trigger modal -->
                    <button type="button" class="btn btn-outline-primary" data-toggle="modal" data-target="#authModalCenter">
                        {{ trans('layouts.login') }}
                    </button>
                </form>
                @else
                <li class="nav-item">
                    <a class="nav-link" id="cart-qty" href="{{ route('cart.index') }}">
                        {{ trans('layouts.cart') }} {{ Cart::count() }}
                    </a>
                </li>
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        @if ('vi' == session()->get('website_language', 'en'))
                        {{ trans('layouts.vietnamese') }}
                        @else
                        {{ trans('layouts.english') }}
                        @endif
                    </a>
                    <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                        <a class="dropdown-item" href="{{ route('user.language', ['en']) }}">
                            {{ trans('layouts.english') }}
                        </a>
                        <a class="dropdown-item" href="{{ route('user.language', ['vi']) }}">
                            {{ trans('layouts.vietnamese') }}
                        </a>
                    </div>
                </li>
                <li class="dropdown nav-item">
                    <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                        {{ Auth::user()->name }}
                    </a>
                    <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                        <a class="dropdown-item" href="{{ route('user.edit', Auth::user()->id) }}">
                            {{ trans('layouts.profile') }}
                        </a>
                        <a class="dropdown-item" href="{{ route('order') }}">
                            {{ trans('layouts.order') }}
                        </a>
                        <a class="dropdown-item" href="{{ route('user.password.edit', Auth::user()->id) }}">
                            {{ trans('layouts.change_password') }}
                        </a>
                        <a class="dropdown-item" href="{{ route('user.logout') }}" onclick="event.preventDefault();document.getElementById('logout-form').submit();">
                            {{ trans('layouts.logout') }}
                        </a>
                        <form id="logout-form" action="{{ route('user.logout') }}" method="POST" style="display: none;">
                            @csrf
                        </form>
                    </div>
                </li>
                @endguest
            </ul>
        </div>
    </div>
</nav>
