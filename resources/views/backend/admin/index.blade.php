@extends('layouts.dashboard')

@section('title', trans('admin.title'))

@section('content')

<div class="row justify-content-center">
    <div class="col-md-12">
        <div class="card">
            <div class="card-body table-responsive">
                <h3 class="card-title">{{ trans('admin.title') }}</h3>
                @if ($admins->isEmpty())
                <div class="alert alert-dismissible alert-warning">
                    <button type="button" class="close" data-dismiss="alert">&times;</button>
                    <p class="mb-0">{{ trans('admin.empty') }}</p>
                </div>
                @else
                <table id="table" class="table table-hover table-bordered text-center">
                    <thead>
                        <tr>
                            <th scope="col">{{ trans('admin.id') }}</th>
                            <th scope="col">{{ trans('admin.name') }}</th>
                            <th scope="col">{{ trans('admin.email') }}</th>
                            <th scope="col">{{ trans('admin.joined') }}</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($admins as $admin)
                        <tr>
                            <th scope="row">{{ $admin->id }}</th>
                            <td>{{ $admin->name }}</td>
                            <td>{{ $admin->email }}</td>
                            <td>{{ $admin->created_at }}</td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
                @endif
            </div>
        </div>
    </div>
</div>

<script>
    $(document).ready(function() {
        $('#table').DataTable();
    } );
</script>

@endsection
