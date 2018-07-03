@extends('layouts.dashboard')
@section('title', 'Order Manager')
@section('content')

<div class="row justify-content-center">
	<div class="col-md-12">
		@if (session('status'))
		<div class="alert alert-dismissible alert-success">
			<button type="button" class="close" data-dismiss="alert">&times;</button>
			{{ session('status') }}
		</div>
		@endif
		<h3 class="card-title my-4">Pending ({{ $ordersPending->count() }})</h3>
		<div class="card">
			<div class="card-body">
				<div class="table-responsive">
					<table id="table1" class="table table-hover table-bordered text-center">
						<thead>
							<tr>
								<th scope="col">ID</th>
								<th scope="col">User</th>
								<th scope="col">Quantity</th>
								<th scope="col">Total</th>
								<th scope="col">Created at</th>
								<th scope="col">Action</th>
							</tr>
						</thead>
						<tbody>
							@foreach ($ordersPending as $orderPending)
							<tr>
								<th scope="row">{{ $orderPending->id }}</th>
								<td>{{ $orderPending->user->name }}</td>
								<td>{{ $orderPending->quantity }}</td>
								<td>${{ $orderPending->total }}</td>
								<td>{{ $orderPending->created_at }}</td>
								<td>
									{{ Form::open(['method' => 'DELETE', 'route' => ['order.delete', $orderPending->id]]) }}
									@csrf
									<div class="btn-group btn-group-toggle">
										<a href="{{ route('order.detail.pending', $orderPending->id) }}" class="btn btn-dark btn-sm">Detail</a>
										{{ Form::submit('Delete', ['class' => 'btn btn-danger btn-sm']) }}
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

	<div class="col-md-12 my-4">
		<h3 class="card-title my-4">Verified ({{ $ordersVerified->count() }})</h3>
		<div class="card">
			<div class="card-body">
				<div class="table-responsive">
					<div class="table-responsive">
						<table id="table2" class="table table-hover table-bordered text-center">
							<thead>
								<tr>
									<th scope="col">ID</th>
									<th scope="col">User</th>
									<th scope="col">Quantity</th>
									<th scope="col">Total</th>
									<th scope="col">Created at</th>
									<th scope="col">Action</th>
								</tr>
							</thead>
							<tbody>
								@foreach ($ordersVerified as $orderVerified)
								<tr>
									<th scope="row">{{ $orderVerified->id }}</th>
									<td>{{ $orderVerified->user->name }}</td>
									<td>{{ $orderVerified->quantity }}</td>
									<td>${{ $orderVerified->total }}</td>
									<td>{{ $orderVerified->created_at }}</td>
									<td>
										{{ Form::open(['method' => 'DELETE', 'route' => ['order.delete', $orderVerified->id]]) }}
										@csrf
										<div class="btn-group btn-group-toggle">
											<a href="{{ route('order.detail.verified', $orderVerified->id) }}" class="btn btn-dark btn-sm">Detail</a>
											{{ Form::submit('Delete', ['class' => 'btn btn-danger btn-sm']) }}
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
</div>

<script>
	$(document).ready(function() {
		$('#table1').DataTable();
	} );
	$(document).ready(function() {
		$('#table2').DataTable();
	} );
</script>

@endsection