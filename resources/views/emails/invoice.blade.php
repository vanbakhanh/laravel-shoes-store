<!DOCTYPE html>
<html>
<head>
    <title>Order Shipped</title>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="stylesheet" type="text/css" href="{{ asset('css/bootstrap.min.css') }}">
    <script type="text/javascript" src="{{ asset('js/jquery.min.js') }}"></script>
    <script type="text/javascript" src="{{ asset('js/bootstrap.min.js') }}"></script>
</head>
<body>
    <div class="row justify-content-center my-4">
        <div class="col-md-8 table-responsive mt-4">
            <div class="row">
                <div class="col-md-12">
                    <h4 class="float-left">Order #{{ $orderDetail->id }}</h4>
                    <h4 class="float-right">Total ${{ $orderDetail->total }}</h4>
                </div>
            </div>
            <div class="row">
                <div class="col-md-12">
                    <p class="float-left">Created at {{ $orderDetail->created_at }}</p>
                </div>
            </div>
            <table class="table table-hover table-bordered text-center table-light">
                <thead>
                    <tr>
                        <th scope="col">Items</th>
                        <th scope="col">Quantity</th>
                        <th scope="col">Size</th>
                        <th scope="col">Color</th>
                        <th scope="col">Total</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($orderProducts as $orderProduct)
                    <tr>
                        <td><a href="{{ route('product.show', $orderProduct->pivot->product_id) }}">{{ $orderProduct->name }}</a></td>
                        <td>{{ $orderProduct->pivot->qty }}</td>
                        <td>{{ $orderProduct->pivot->size }}</td>
                        <td>{{ $orderProduct->pivot->color }}</td>
                        <td>${{ $orderProduct->pivot->total }}</td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
            <table class="table table-light">
                <tbody>
                    <tr>
                        <th scope="row">Name</th>
                        <td class="text-right">{{ $user->name }}</td>
                    </tr>
                    <tr>
                        <th scope="row">Email</th>
                        <td class="text-right">{{ $user->email }}</td>
                    </tr>
                    <tr>
                        <th scope="row">Phone</th>
                        <td class="text-right">{{ $user->phone }}</td>
                    </tr>
                    <tr>
                        <th scope="row">Address</th>
                        <td class="text-right">{{ $user->address }}</td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>
</body>
</html>