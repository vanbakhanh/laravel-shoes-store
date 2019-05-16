@extends('layouts.dashboard')

@section('title', trans('dashboard.dashboard'))

@section('content')
<div class="card-deck text-center mb-4">
    <div class="card">
        <div class="card-body">
            <p class="card-text">{{ trans('dashboard.admin') }}</p>
            <h3 class="card-title">{{ $admins }}</h3>
            <a class="card-link" href="{{ route('admin.index') }}">{{ trans('dashboard.view') }}</a>
        </div>
    </div>
    <div class="card">
        <div class="card-body">
            <p class="card-text">{{ trans('dashboard.user') }}</p>
            <h3 class="card-title">{{ $users }}</h3>
            <a class="card-link" href="{{ route('user.index') }}">{{ trans('dashboard.view') }}</a>
        </div>
    </div>
    <div class="card">
        <div class="card-body">
            <p class="card-text">{{ trans('dashboard.product') }}</p>
            <h3 class="card-title">{{ $products }}</h3>
            <a class="card-link" href="{{ route('product.index') }}">{{ trans('dashboard.view') }}</a>
        </div>
    </div>
    <div class="card">
        <div class="card-body">
            <p class="card-text">{{ trans('dashboard.review') }}</p>
            <h3 class="card-title">{{ $reviews }}</h3>
            <a class="card-link" href="{{ route('review.index') }}">{{ trans('dashboard.view') }}</a>
        </div>
    </div>
</div>
<div class="card-deck text-center mb-4">
    <div class="card">
        <div class="card-body">
            <p class="card-text">{{ trans('dashboard.order') }}</p>
            <h3 class="card-title">{{ $orders['total'] }}</h3>
            <a class="card-link" href="{{ route('order.manager') }}">{{ trans('dashboard.view') }}</a>
        </div>
    </div>
    <div class="card">
        <div class="card-body">
            <p class="card-text">{{ trans('dashboard.profit') }}</p>
            <h3 class="card-title">${{ $orders['profit'] }}</h3>
            <a class="card-link" href="{{ route('order.manager') }}">{{ trans('dashboard.view') }}</a>
        </div>
    </div>
    <div class="card">
        <div class="card-body">
            <p class="card-text">{{ trans('dashboard.sold') }}</p>
            <h3 class="card-title">{{ $orders['quantity'] }}</h3>
            <a class="card-link" href="{{ route('order.manager') }}">{{ trans('dashboard.view') }}</a>
        </div>
    </div>
</div>
<div class="row">
    <div class="col-md-6 col-sm-12 mb-4">
        <div class="card">
            <div class="card-body">
                <h3 class="card-title">{{ trans('dashboard.daily_orders') }}</h3>
                <canvas id="ordersTotalData"></canvas>
            </div>
        </div>
    </div>
    <div class="col-md-6 col-sm-12 mb-4">
        <div class="card">
            <div class="card-body">
                <h3 class="card-title">{{ trans('dashboard.daily_profit') }}</h3>
                <canvas id="ordersProfitData"></canvas>
            </div>
        </div>
    </div>
</div>
<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-body">
                <h3 class="card-title">{{ trans('dashboard.daily_selling_products') }}</h3>
                <canvas id="ordersQuantityData"></canvas>
            </div>
        </div>
    </div>
</div>
@endsection

@section('script')
<script>
    var ordersTotalData = new Chart(document.getElementById('ordersTotalData'), {
        type: 'bar',
        data: {
            labels: @json($orders['chart']['total']['label']),
            datasets: [{
                label: 'Total orders per day',
                data: @json($orders['chart']['total']['data']),
                backgroundColor: [
                    '#e53935',
                    '#d81b60',
                    '#8e24aa',
                    '#5e35b1',
                    '#3949ab',
                    '#1e88e5',
                    '#039be5'
                ]
            }]
        },
        options: {
            scales: {
                yAxes: [{
                    ticks: {
                        beginAtZero: true
                    }
                }]
            },
            legend: {
                display: false
            }
        }
    });
    var ordersProfitData = new Chart(document.getElementById('ordersProfitData'), {
        type: 'bar',
        data: {
            labels: @json($orders['chart']['profit']['label']),
            datasets: [{
                label: 'Total profit per day',
                data: @json($orders['chart']['profit']['data']),
                backgroundColor: [
                    '#f9fd50',
                    '#85ef47',
                    '#00bd56',
                    '#207dff',
                    '#dae1e7',
                    '#dd6b4d',
                    '#c54fa7'
                ]
            }]
        },
        options: {
            scales: {
                yAxes: [{
                    ticks: {
                        beginAtZero: true
                    }
                }]
            },
            legend: {
                display: false
            }
        }
    });
    var ordersQuantityData = new Chart(document.getElementById('ordersQuantityData'), {
        type: 'line',
        data: {
            labels: @json($orders['chart']['quantity']['label']),
            datasets: [{
                label: 'Total sold products per day',
                data: @json($orders['chart']['quantity']['data']),
                borderColor: "#0900c3"
            }]
        },
        options: {
            scales: {
                yAxes: [{
                    ticks: {
                        beginAtZero: true
                    }
                }]
            },
            legend: {
                display: false
            }
        }
    });
</script>
@endsection