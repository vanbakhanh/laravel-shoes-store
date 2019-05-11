@extends('layouts.master')

@section('title', trans('home.branch'))

@section('cover')
<div class="bd-example">
    <div id="carouselExampleCaptions" class="carousel slide" data-ride="carousel">
        <ol class="carousel-indicators">
            <li data-target="#carouselExampleCaptions" data-slide-to="0" class="active"></li>
            <li data-target="#carouselExampleCaptions" data-slide-to="1"></li>
            <li data-target="#carouselExampleCaptions" data-slide-to="2"></li>
        </ol>
        <div class="carousel-inner">
            <div class="carousel-item active">
                <img src="/storage/cover/1.jpg" class="d-block w-100" alt="...">
                <div class="carousel-caption d-none d-md-block">
                    <h1 data-aos="fade-left">NIKE FLYKNIT</h1>
                    <p data-aos="fade-right">Lightweight support for each cut, stride or strike.</p>
                </div>
            </div>
            <div class="carousel-item">
                <img src="/storage/cover/2.jpg" class="d-block w-100" alt="...">
                <div class="carousel-caption d-none d-md-block">
                    <h1>NIKE AIR MAX</h1>
                    <p>Lightweight support for each cut, stride or strike.</p>
                </div>
            </div>
            <div class="carousel-item">
                <img src="/storage/cover/3.jpg" class="d-block w-100" alt="...">
                <div class="carousel-caption d-none d-md-block">
                    <h1>NIKE AIR MAX</h1>
                    <p>Lightweight support for each cut, stride or strike.</p>
                </div>
            </div>
        </div>
        <a class="carousel-control-prev" href="#carouselExampleCaptions" role="button" data-slide="prev">
            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
            <span class="sr-only">Previous</span>
        </a>
        <a class="carousel-control-next" href="#carouselExampleCaptions" role="button" data-slide="next">
            <span class="carousel-control-next-icon" aria-hidden="true"></span>
            <span class="sr-only">Next</span>
        </a>
    </div>
</div>
@endsection

@section('content')
<div class="benefit mt-4" data-aos="flip-down">
    <div class="row benefit_row">
        <div class="col-lg-3 benefit_col">
            <div class="benefit_item d-flex flex-row align-items-center">
                <div class="benefit_icon"><i class="fa fa-truck" aria-hidden="true"></i></div>
                <div class="benefit_content">
                    <h6>@lang('layouts.free_shipping')</h6>
                </div>
            </div>
        </div>
        <div class="col-lg-3 benefit_col">
            <div class="benefit_item d-flex flex-row align-items-center">
                <div class="benefit_icon"><i class="fa fa-money-bill-alt" aria-hidden="true"></i></div>
                <div class="benefit_content">
                    <h6>@lang('layouts.cash_on_delivery')</h6>
                </div>
            </div>
        </div>
        <div class="col-lg-3 benefit_col">
            <div class="benefit_item d-flex flex-row align-items-center">
                <div class="benefit_icon"><i class="fa fa-undo" aria-hidden="true"></i></div>
                <div class="benefit_content">
                    <h6>5 @lang('layouts.days_return')</h6>
                </div>
            </div>
        </div>
        <div class="col-lg-3 benefit_col">
            <div class="benefit_item d-flex flex-row align-items-center">
                <div class="benefit_icon"><i class="fa fa-clock" aria-hidden="true"></i></div>
                <div class="benefit_content">
                    <h6>@lang('layouts.open_all_week')</h6>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="banner row mt-4">
    <div class="col-md-6" data-aos="fade-right">
        <div class="banner_item align-items-center" style="background-image:url(storage/cover/banner_women.jpg)">
            <div class="banner_category">
                <a href="{{ route('category.women', 1) }}" class="title">@lang('layouts.women')</a>
            </div>
        </div>
    </div>
    <div class="col-md-6" data-aos="fade-left">
        <div class="banner_item align-items-center" style="background-image:url(storage/cover/banner_men.jpg)">
            <div class="banner_category">
                <a href="{{ route('category.men', 1) }}" class="title">@lang('layouts.men')</a>
            </div>
        </div>
    </div>
</div>

<div class="new-arrivals mt-5" data-aos="fade-up">
    <h2 class="text-center py-4 m-0 title" data-aos="zoom-in">{{ trans('home.new') }}</h2>
    <div class="row">
        @include('frontend.common.product-card')
    </div>
    <div class="d-flex justify-content-center" data-aos="zoom-in">{{ $products->links() }}</div>
</div>
@endsection