@extends('layouts.dashboard')
@section('title', 'Admin Manager')
@section('content')

<div class="row justify-content-center">
    <div class="col-md-12">
        <h3 class="card-title my-4">List of admins</h3>
        <div class="card">
            <div class="card-body table-responsive">
                @if (session('status'))
                <div class="alert alert-dismissible alert-success">
                    <button type="button" class="close" data-dismiss="alert">&times;</button>
                    {{ session('status') }}
                </div>
                @endif
                @if ($admins->isEmpty())
                <div class="alert alert-dismissible alert-warning">
                    <button type="button" class="close" data-dismiss="alert">&times;</button>
                    <p class="mb-0">There is no admin!</p>
                </div>
                @else
                <table id="table" class="table table-hover table-md table-bordered">
                    <thead>
                        <tr>
                            <th scope="col">ID</th>
                            <th scope="col">Name</th>
                            <th scope="col">Email</th>
                            <th scope="col">Joined</th>
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
