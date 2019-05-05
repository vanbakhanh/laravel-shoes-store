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
                    <h1>First slide label</h1>
                    <p>Nulla vitae elit libero, a pharetra augue mollis interdum.</p>
                </div>
            </div>
            <div class="carousel-item">
                <img src="/storage/cover/4.jpg" class="d-block w-100" alt="...">
                <div class="carousel-caption d-none d-md-block">
                    <h1>Second slide label</h1>
                    <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit.</p>
                </div>
            </div>
            <div class="carousel-item">
                <img src="/storage/cover/5.jpg" class="d-block w-100" alt="...">
                <div class="carousel-caption d-none d-md-block">
                    <h1>Third slide label</h1>
                    <p>Praesent commodo cursus magna, vel scelerisque nisl consectetur.</p>
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
<div class="benefit my-4">
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

<div class="new-arrivals" data-aos="fade-up">
    <h3 class="text-center text-uppercase py-4 m-0" data-aos="zoom-in">{{ trans('home.new') }}</h3>
    <div class="row">
        @include('frontend.common.product-card')
    </div>
    <div class="d-flex justify-content-center">{{ $products->links() }}</div>
</div>
@endsection