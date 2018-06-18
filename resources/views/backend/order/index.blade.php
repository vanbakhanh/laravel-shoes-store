@extends('layouts.dashboard')
@section('title', 'Order Manager')
@section('content')

<div class="row justify-content-center">
	<div class="col-md-12">
		<div class="card">
			<div class="card-header">
				Pending ({{ $ordersPending->count() }})
			</div>
			<div class="card-body">
				<div class="table-responsive">
					<table id="table1" class="table table-hover table-md text-center table-bordered">
						<thead>
							<tr>
								<th scope="col">ID</th>
								<th scope="col">User</th>
								<th scope="col">Total</th>
								<th scope="col">Created at</th>
								<th scope="col">Updated at</th>
								<th scope="col">Action</th>
							</tr>
						</thead>
						<tbody>
							@foreach ($ordersPending as $orderPending)
							<tr>
								<th scope="row">{{ $orderPending->id }}</th>
								<td>{{ $orderPending->user->name }}</td>
								<td>${{ $orderPending->total }}</td>
								<td>{{ $orderPending->created_at }}</td>
								<td>{{ $orderPending->updated_at }}</td>
								<td><a href="{{ route('admin.order.detail.pending', $orderPending->id) }}" class="btn btn-primary btn-sm">Detail</a></td>
							</tr>
							@endforeach
						</tbody>
					</table>
				</div>
			</div>
		</div>
	</div>

	<div class="col-md-12 my-4">
		<div class="card">
			<div class="card-header">
				Verified ({{ $ordersVerified->count() }})
			</div>
			<div class="card-body">
				<div class="table-responsive">
					<div class="table-responsive">
						<table id="table2" class="table table-hover table-md text-center table-bordered">
							<thead>
								<tr>
									<th scope="col">ID</th>
									<th scope="col">User</th>
									<th scope="col">Total</th>
									<th scope="col">Created at</th>
									<th scope="col">Updated at</th>
									<th scope="col">Action</th>
								</tr>
							</thead>
							<tbody>
								@foreach ($ordersVerified as $orderVerified)
								<tr>
									<th scope="row">{{ $orderVerified->id }}</th>
									<td>{{ $orderVerified->user->name }}</td>
									<td>${{ $orderVerified->total }}</td>
									<td>{{ $orderVerified->created_at }}</td>
									<td>{{ $orderVerified->updated_at }}</td>
									<td><a href="{{ route('admin.order.detail.verified', $orderVerified->id) }}" class="btn btn-primary btn-sm">Detail</a></td>
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