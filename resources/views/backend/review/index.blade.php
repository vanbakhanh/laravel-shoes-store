@extends('layouts.dashboard')

@section('title', trans('review.list_title'))

@section('content')

<div class="row justify-content-center">
    <div class="col-md-12">
        <div class="card">
            <div class="card-body table-responsive">
                <h3 class="card-title">{{ trans('review.list_title') }}</h3>
                @if ($reviews->isEmpty())
                <div class="alert alert-dismissible alert-warning">
                    <button type="button" class="close" data-dismiss="alert">&times;</button>
                    <p class="mb-0">{{ trans('review.empty') }}</p>
                </div>
                @else
                <table id="table" class="table table-hover table-bordered">
                    <thead>
                        <tr>
                            <th scope="col">{{ trans('review.id') }}</th>
                            <th scope="col">{{ trans('review.rating') }}</th>
                            <th scope="col">{{ trans('review.product_id') }}</th>
                            <th scope="col">{{ trans('review.user_id') }}</th>
                            <th scope="col">{{ trans('review.title') }}</th>
                            <th scope="col">{{ trans('review.created_at') }}</th>
                            <th scope="col">{{ trans('review.action') }}</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($reviews as $review)
                        <tr>
                            <th scope="row">{{ $review->id }}</th>
                            <td>{{ $review->rating }}</td>
                            <td>{{ $review->product_id }}</td>
                            <td>{{ $review->user_id }}</td>
                            <td>{{ $review->title }}</td>
                            <td>{{ $review->created_at }}</td>
                            <td>
                                {{ Form::open(['method' => 'DELETE', 'route' => ['review.destroy', $review->id]]) }}
                                {{ Form::submit(trans('review.delete'), ['class' => 'btn btn-outline-danger btn-sm']) }}
                                {{ Form::close() }}
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
                @endif
            </div>
        </div>
    </div>
</div>

@endsection