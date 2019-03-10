@extends('layouts.master')

@section('title', 'Nike ' . $productSelected->name)

@section('content')

<!-- Portfolio Item Row -->
<div class="row">
    <div class="col-lg-6 col-md-12">
        <div id="carouselProductIndicators" class="carousel slide" data-ride="carousel">
            <ol class="carousel-indicators mb-4">
                <li data-target="#carouselProductIndicators" data-slide-to="{{ $i = 0 }}" class="active">
                    <img class="d-block w-100" src="{{ asset($productSelected->image[0]) }}" alt="Slide">
                </li>
                @if (count($productSelected->image) > 1)
                @foreach (array_slice($productSelected->image, 1) as $image)
                <li data-target="#carouselProductIndicators" data-slide-to="{{ $i = $i + 1 }}">
                    <img class="d-block w-100" src="{{ asset($image) }}" alt="Slide">
                </li>
                @endforeach
                @endif
            </ol>
            <div class="carousel-inner">
                <div class="carousel-item active">
                    <img class="d-block w-100" src="{{ asset($productSelected->image[0]) }}" alt="Slide">
                </div>
                @if (count($productSelected->image) > 1)
                @foreach (array_slice($productSelected->image, 1) as $image)
                <div class="carousel-item">
                    <img class="d-block w-100" src="{{ asset($image) }}" alt="Slide">
                </div>
                @endforeach
                @endif
            </div>
            <a class="carousel-control-prev" href="#carouselProductIndicators" role="button" data-slide="prev">
                <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                <span class="sr-only">Previous</span>
            </a>
            <a class="carousel-control-next" href="#carouselProductIndicators" role="button" data-slide="next">
                <span class="carousel-control-next-icon" aria-hidden="true"></span>
                <span class="sr-only">Next</span>
            </a>
        </div>
    </div>
    <div class="col-lg-6 col-md-12 text-center">
        <p class="mt-2 mb-4">
            @if ($productSelected->gender == 'male')
            {{ trans('product.category_men', ['category' => $categorySelected->name]) }}
            @else
            {{ trans('product.category_women', ['category' => $categorySelected->name]) }}
            @endif
        </p>
        <h3 class="my-2 text-uppercase">{{ $productSelected->name }}</h3>
        <h3 class="my-4">$<b>{{ $productSelected->price }}</b></h3>
        {{ Form::open(['class' => 'form-horizontal']) }}
        <div class="form-group row">
            <label class="col-md-6 col-form-label text-uppercase">
                <b>{{ trans('product.color') }}</b>
            </label>
            <div class="col-md-6">
                <select class="form-control" name="color" id="color">
                    @foreach ($productSelected->colors()->pluck('name')->sort() as $color)
                    <option value="{{ $color }}">
                        {{ $color }}
                    </option>
                    @endforeach
                </select>
            </div>
        </div>
        <div class="form-group row">
            <label class="col-md-6 col-form-label text-uppercase">
                <b>{{ trans('product.size') }}</b>
            </label>
            <div class="col-md-6">
                <select class="form-control" name="size" id="size">
                    @foreach ($productSelected->sizes()->pluck('name')->sort() as $size)
                    <option value="{{ $size }}">
                        {{ $size }}
                    </option>
                    @endforeach
                </select>
            </div>
        </div>
        <div class="form-group row">
            <label class="col-md-6 col-form-label text-uppercase">
                <b>{{ trans('product.quantity') }}</b>
            </label>
            <div class="col-md-6">
                <select class="form-control" name="qty" id="qty">
                    @for ($i = 1; $i<=10; $i++) <option value="{{ $i }}">
                        {{ $i }}
                        </option>
                        @endfor
                </select>
            </div>
        </div>
        <div class="form-group row mb-0">
            <div class="col-md-12">
                {{ Form::hidden('productId', $productSelected->id, ['id' => 'productId']) }}
                <button type="button" class="btn btn-primary btn-block text-uppercase" id="addToCart">
                    {{ trans('product.add') }}
                </button>
            </div>
        </div>
        {{ Form::close() }}
        <div class="my-4">
            <p>{{ $productSelected->description }}</p>
            <a class="text-uppercase" href="#comment">
                {{ trans('product.read_comment', ['comments' => count($comments)]) }}
            </a>
        </div>
    </div>
</div>

<br>

<!-- Products Suggestion Row -->
<div class="row">
    <div class="col-md-12 my-4 text-center">
        <h3 class="text-uppercase">{{ trans('product.recommend_title') }}</h3>
    </div>
</div>
<div class="row justify-content-center">
    @foreach ($productsSuggestion as $product)
    <div class="col-lg-2 col-md-4 col-sm-4 col-6">
        <div class="card card-product h-100 text-center">
            <a href="{{ route('product.show', $product->id) }}">
                <img class="card-img-top" src="{{ asset($product->image[0]) }}" alt="Image">
            </a>
            <div class="card-body">
                <h5 class="card-title text-capitalize">
                    <small>
                        <a href="{{ route('product.show', $product->id) }}">{{ $product->name }}</a>
                    </small>
                </h5>
                <p class="card-text">${{ $product->price }}</p>
            </div>
        </div>
    </div>
    @endforeach
</div>
<div class="row">
    <p class="col-md-12 text-center text-uppercase my-4">
        @if ($productSelected->gender == 'male')
        <a href="{{ route('category.men', $productSelected->category_id) }}">{{ trans('product.more') }}</a>
        @else
        <a href="{{ route('category.women', $productSelected->category_id) }}">{{ trans('product.more') }}</a>
        @endif
    </p>
</div>

<br>

<!-- Comments -->
<div class="row">
    <div class="col-md-12 my-4 text-center">
        <h3 class="text-uppercase">{{ trans('product.review_title') }}</h3>
    </div>
</div>

@guest
<div class="alert alert-dismissible alert-primary">
    <button type="button" class="close" data-dismiss="alert">&times;</button>
    <a href="{{ route('login') }}" class="alert-link">{{ trans('product.login') }}</a>
</div>
@else
<div class="list-group">
    <div class="list-group-item">
        {{ Form::open() }}
        <div class="form-group">
            {{ Form::textarea('content', '', ['class' => 'form-control', 'id' => 'commentContent', 'rows' => '1', 'placeholder' => trans('product.write_preview')]) }}
        </div>
        <button type="submit" class="btn btn-primary float-right" id="commentSubmit">
            {{ trans('product.review') }}
        </button>
        {{ Form::close() }}
    </div>
</div>
@endguest

<div class="list-group my-4" id="comment">
    <div class="list-group-item flex-column align-items-start">
        @if ($comments->isNotEmpty())
        @foreach ($comments as $cmt)
        <div class="d-flex w-100 justify-content-between">
            <h5 class="my-2">{{ $cmt->user->profile->full_name }}
                <small class="text-muted pl-1">{{ $cmt->created_at->diffForHumans() }}</small>
            </h5>
        </div>
        <p class="mb-2">{{ $cmt->content }}</p>
        @endforeach
        @else
        <p class="text-center p-0 m-0">{{ trans('product.no_review') }}</p>
        @endif
    </div>
</div>

<br>

<!-- Reviews -->
<div class="row">
    <div class="col-md-12 my-4 text-center">
        <h3 class="text-uppercase">Customer Rating</h3>
        <span class="fa fa-star checked"></span>
        <span class="fa fa-star checked"></span>
        <span class="fa fa-star checked"></span>
        <span class="fa fa-star checked"></span>
        <span class="fa fa-star"></span>
        <p>{{ $averageRating }} average based on {{ count($reviews) }} reviews</p>
    </div>
</div>

<div class="list-group">
    @if ($reviews->isNotEmpty())
    @foreach($reviews as $review)
    <div class="list-group-item list-group-item-action">
        <div class="d-flex w-100 justify-content-between">
            <h5>{{ $review->title }}</h5>
            <p class="text-muted">by <b>{{ $review->user->profile->full_name }}</b>
                {{ $review->created_at->diffForHumans() }}</p>
        </div>
        <p class="mb-0">{{ $review->body }}</p>
    </div>
    @endforeach
    @endif
</div>

<br>

<!-- Category Description -->
<div class="row">
    <div class="col-md-12 text-center text-uppercase my-4">
        <h3 class="display-5">{{ $categorySelected->name }}</h3>
        <p class="lead">{{ $categorySelected->description }}</p>
    </div>
</div>

<!-- Add to cart using ajax -->
<script type="text/javascript">
    var cart = {{ Cart::count() }};
    var text = '{{ trans('layouts.cart') }}';
    jQuery(document).ready(function () {
        jQuery('#addToCart').click(function (e) {
            e.preventDefault();
            var qty = parseInt(jQuery('#qty').val());
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
            jQuery.ajax({
                url: "{{ route('cart.add') }}",
                method: 'POST',
                data: {
                    color: jQuery('#color').val(),
                    size: jQuery('#size').val(),
                    qty: jQuery('#qty').val(),
                    productId: jQuery('#productId').val(),
                },
                success: function () {
                    $("#cart-qty").html(text + ' ' + (cart += qty));
                },
            });
        });
    });
</script>

<!-- Comment using ajax -->
<script type="text/javascript">
    jQuery(document).ready(function () {
        jQuery('#commentSubmit').click(function (e) {
            e.preventDefault();
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
            jQuery.ajax({
                url: "{{ route('comment.store') }}",
                method: 'POST',
                data: {
                    content: jQuery('#commentContent').val(),
                    product_id: jQuery('#productId').val(),
                },
                success: function () {
                    location.reload();
                },
            });
        });
    });
</script>

@endsection