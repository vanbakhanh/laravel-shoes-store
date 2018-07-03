@extends('layouts.dashboard')
@section('title', 'User Manager')
@section('content')

<div class="row justify-content-center">
    <div class="col-md-12">
        <h3 class="card-title my-4">List of users</h3>
        <div class="card">
            <div class="card-body table-responsive">
                @if (session('status'))
                <div class="alert alert-dismissible alert-success">
                    <button type="button" class="close" data-dismiss="alert">&times;</button>
                    {{ session('status') }}
                </div>
                @endif
                @if ($users->isEmpty())
                <div class="alert alert-dismissible alert-warning">
                    <button type="button" class="close" data-dismiss="alert">&times;</button>
                    <h4 class="alert-heading">Warning!</h4>
                    <p class="mb-0">There is no user.</p>
                </div>
                @else
                <table id="table" class="table table-hover table-bordered text-center">
                    <thead>
                        <tr>
                            <th scope="col">ID</th>
                            <th scope="col">Name</th>
                            <th scope="col">Gender</th>
                            <th scope="col">Email</th>
                            <th scope="col">Phone</th>
                            <th scope="col">Birthday</th>
                            <th scope="col">Address</th>
                            <th scope="col">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($users as $user)
                        <tr>
                            <th scope="row">{{ $user->id }}</th>
                            <td>{{ $user->name }}</td>
                            <td>{{ $user->gender }}</td>
                            <td>{{ $user->email }}</td>
                            <td>{{ $user->phone }}</td>
                            <td>{{ $user->birthday }}</td>
                            <td>{{ $user->address }}</td>
                            <td>
                                <button type="button" class="close float-none" aria-label="Close" id="delete{{$user->id}}">
                                    <span aria-hidden="true">&times;</span>
                                </button>
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

<script>
    $(document).ready(function() {
        $('#table').DataTable();
    } );
</script>

<!-- Delete user using Ajax -->
<script type="text/javascript">
    jQuery(document).ready(function() {
        @foreach ($users as $user)
        jQuery('#delete{{$user->id}}').click(function(e) {
            e.preventDefault();
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
            jQuery.ajax({
                url: "{{ route('user.destroy', $user->id) }}",
                method: 'POST',
                data: { _method: 'DELETE' },
                success: function() {
                    location.reload();
                },
            });
        });
        @endforeach
    });
</script>

@endsection
