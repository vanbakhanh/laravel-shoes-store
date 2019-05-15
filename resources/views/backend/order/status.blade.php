@extends('backend.order.manager')

@section('manager-status')
<div class="row justify-content-center">
    <div class="col-md-12">
        <div class="card">
            <div class="card-body">
                <h3 class="card-title">{{ trans('order.' . $status) }}</h3>
                <div class="table-responsive">
                    <table id="table1" class="table table-hover table-bordered text-center">
                        <thead>
                            <tr>
                                <th scope="col">{{ trans('order.id') }}</th>
                                <th scope="col">{{ trans('order.user') }}</th>
                                <th scope="col">{{ trans('order.quantity') }}</th>
                                <th scope="col">{{ trans('order.total') }}</th>
                                <th scope="col">{{ trans('order.created') }}</th>
                                <th scope="col">{{ trans('order.action') }}</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($orders as $order)
                            <tr>
                                <th scope="row">{{ $order->id }}</th>
                                <td>{{ $order->user->email }}</td>
                                <td>{{ $order->quantity }}</td>
                                <td>${{ $order->total }}</td>
                                <td>{{ $order->created_at }}</td>
                                <td>
                                    {{ Form::open(['method' => 'DELETE', 'route' => ['order.delete', $order->id]]) }}
                                    <div class="btn-group btn-group-toggle">
                                        <a href="{{ route('order.detail.' . $status, $order->id) }}"
                                            class="btn btn-outline-info btn-sm">{{ trans('order.detail') }}</a>
                                        {{ Form::submit(trans('order.delete'), ['class' => 'btn btn-outline-danger btn-sm']) }}
                                    </div>
                                    {{ Form::close() }}
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection