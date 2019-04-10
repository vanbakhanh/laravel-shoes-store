@if ($products->isEmpty())
<div class="col-md-12 text-center">
    <p>{{ trans('home.empty') }}</p>
</div>
@else
@foreach ($products as $product)
<div class="col-lg-3 col-md-4 col-sm-6 col-6 mb-4 results-row">
    <div class="card card-product h-100">
        <a href="{{ route('product.show', $product->id) }}">
            <img class="card-img-top" src="{{ asset($product->image[0]) }}" alt="{{ $product->name }}">
        </a>
        <div class="card-body px-0">
            <div class="mb-1">
                @if ($product->gender == 'male')
                <span><a href="{{ route('category.men', $product->category_id) }}">{{ $product->category->name }}</a></span>
                @else
                <span><a href="{{ route('category.women', $product->category_id) }}">{{ $product->category->name }}</a></span>
                @endif
                <span class="stars-outer float-right">
                    <div class="stars-inner" style="width: {{ $product->reviews->avg('rating')/5*100 }}%"></div>
                </span>
            </div>
            <h5 class="card-title text-capitalize"> <a
                    href="{{ route('product.show', $product->id) }}">{{ $product->name }}</a></h5>
            <h5 class="card-text price">${{ $product->price }}</h5>
        </div>
    </div>
</div>
@endforeach
@endif

<!-- Sort -->
<script type="text/javascript">
    var ascending = false;
    var decrease = true;
    // Convert $ to string ''
    var convertToNumber = function (value) {
        return parseFloat(value.replace('$', ''));
    }
    // Sort the price is ascending
    $('.tab-content').on('click', '.priceAscending', function () {
        var sorted = $('.results-row').sort(function (a, b) {
            return (ascending ==
                (convertToNumber($(a).find('.price').html()) <
                    convertToNumber($(b).find('.price').html()))) ? 1 : -1;
        });
        $('.results').html(sorted);
    });
    // Sort the price is decrease
    $('.tab-content').on('click', '.decreaseAscending', function () {
        var sorted = $('.results-row').sort(function (a, b) {
            return (decrease ==
                (convertToNumber($(a).find('.price').html()) <
                    convertToNumber($(b).find('.price').html()))) ? 1 : -1;
        });
        $('.results').html(sorted);
    });
</script>