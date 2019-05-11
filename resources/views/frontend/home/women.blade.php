@extends('layouts.master')

@section('title', trans('home.category_shoes', ['name' => $categorySelected->name]))

@section('content')
<div class="row">
    <div class="col-lg-3">
        <h3 class="title mt-5 mb-4">{{ trans('home.women') }}</h3>
        <div class="list-group list-group-flush">
            @foreach ($categories as $category)
            <a href="{{ route('category.women', $category->id) }}"
                class="list-group-item d-flex justify-content-between align-items-center list-group-item-action">
                {{ $category->name }}
                <span class="badge badge-dark badge-pill">{{ count($category->products) }}</span>
            </a>
            @endforeach
        </div>
    </div>
    <div class="col-lg-9 tab-content">
        <div class="row">
            <div class="col-md-12 mt-5 mb-4">
                <h3 class="title float-left">
                    {{ trans('home.category_shoes', ['name' => $categorySelected->name]) }} ({{ count($products) }})
                </h3>
                <div class="dropdown float-right">
                    <button class="btn btn-sm btn-outline-dark dropdown-toggle" type="button" id="dropdownMenu2"
                        data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        {{ trans('home.sort') }}
                    </button>
                    <div class="dropdown-menu dropdown-menu-right" aria-labelledby="dropdownMenu2">
                        <button class="dropdown-item decreaseAscending" type="button">{{ trans('home.price') }}:
                            $$-$</button>
                        <button class="dropdown-item priceAscending" type="button">{{ trans('home.price') }}:
                            $-$$</button>
                    </div>
                </div>
            </div>
        </div>
        <div class="row results">
            @include('frontend.common.product-card')
        </div>
        <div class="d-flex justify-content-center">{{ $products->links() }}</div>
    </div>
</div>
@endsection

@section('script')
@include('frontend.common.product-card-script')
@endsection