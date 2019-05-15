@if ($products->isEmpty())
<div class="col-md-12 text-center">
    <p>{{ trans('home.empty') }}</p>
</div>
@else
@foreach ($products as $product)
<div class="col-lg-3 col-md-4 col-sm-6 col-6 mb-4 results-row" data-aos="fade-up">
    <div class="card card-product h-100">
        <a href="{{ route('product.show', $product->id) }}" class="swap-on-hover">
            @if (count($product->image) > 1)
            <img class="card-img-top img-front" src="{{ asset($product->image[0]) }}" alt="{{ $product->name }}">
            <img class="card-img-top img-back" src="{{ asset($product->image[1]) }}" alt="{{ $product->name }}">
            @else
            <img class="card-img-top img-front" src="{{ asset($product->image[0]) }}" alt="{{ $product->name }}">
            <img class="card-img-top img-back" src="{{ asset($product->image[0]) }}" alt="{{ $product->name }}">
            @endif
        </a>
        <div class="card-body px-0">
            <div class="mb-2">
                <span><a class="card-text text-muted"
                        href="{{ route('category.' . $product->gender, $product->category_id) }}">{{ $product->category->name }}</a></span>
                <span class="stars-outer float-right">
                    <div class="stars-inner" style="width: {{ $product->reviews->avg('rating')/5*100 }}%"></div>
                </span>
            </div>
            <h5 class="card-text"><a
                    href="{{ route('product.show', $product->id) }}">{{ $product->name }}</a></h5>
            <h5 class="card-text text-muted price">${{ $product->price }}</h5>
        </div>
    </div>
</div>
@endforeach
@endif