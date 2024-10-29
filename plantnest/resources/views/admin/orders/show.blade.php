@extends('admin.dashboard')
@section('title', 'Order Details')

@section('main_content')
<div class="container mt-4">
    <!-- Order Information Section -->
    <div class="card mb-4">
        <div class="card-header bg-success text-white">
            <h4 class="mb-0">Order Information</h4>
        </div>
        <div class="card-body">
            <p><strong>Order Number:</strong> {{ $order->order_number }}</p>
            <p><strong>User ID:</strong> {{ $order->customer->user_id }}</p>
            <p><strong>User Name:</strong> {{ $order->customer->user->name }}</p>
            <p><strong>User Email:</strong> {{ $order->customer->user->email }}</p>
            <p><strong>Customer Name:</strong> {{ $order->customer ? $order->customer->first_name . ' ' . $order->customer->last_name : 'N/A' }}</p>
            <p><strong>Amount:</strong> ${{ number_format($order->amount, 2) }}</p>
            <p><strong>Payment Method:</strong> {{ ucfirst($order->payment_method) }}</p>
            <p><strong>Payment Status:</strong> {{ ucfirst($order->payment_status) }}</p>
            <p><strong>Delivery Status:</strong> {{ ucfirst($order->delivery_status) }}</p>
            <p><strong>Order Date:</strong> {{ $order->created_at->format('d M Y, h:i A') }}</p>
        </div>
    </div>

    <!-- Delivery Address Section -->
    <div class="card mb-4">
        <div class="card-header bg-secondary text-white">
            <h4 class="mb-0">Delivery Address</h4>
        </div>
        <div class="card-body">
            <p><strong>Street Address:</strong> {{ $order->customer->street_address }}</p>
            <p><strong>City:</strong> {{ $order->customer->city }}</p>
            <p><strong>State:</strong> {{ $order->customer->state }}</p>
            <p><strong>Country:</strong> {{ $order->customer->country }}</p>
            <p><strong>Postal Code:</strong> {{ $order->customer->postal_code }}</p>
        </div>
    </div>

    <!-- Order Items Section -->
    <div class="card mb-4">
        <div class="card-header bg-success text-white">
            <h4 class="mb-0">Order Items</h4>
        </div>
        <div class="card-body">
            @if($order->orderItems->isNotEmpty())
                <table class="table table-striped table-bordered">
                    <thead>
                        <tr>
                            <th>Product Name</th>
                            <th>Quantity</th>
                            <th>Price</th>
                            <th>Total</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($order->orderItems as $item)
                            <tr>
                                <td>{{ $item->product_name }}</td>
                                <td>{{ $item->quantity }}</td>
                                <td>${{ number_format($item->price, 2) }}</td>
                                <td>${{ number_format($item->price * $item->quantity, 2) }}</td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            @else
                <p class="text-center">No items found for this order.</p>
            @endif
        </div>
    </div>

    <!-- Action Buttons -->
    <div class="d-flex justify-content-between mb-4">
        <a href="{{ route('admin.orders.edit', $order->order_number) }}" class="btn btn-warning">Edit Order</a>
        <form action="{{ route('admin.orders.destroy', $order->order_number) }}" method="POST" style="display:inline;">
            @csrf
            @method('DELETE')
            <button type="submit" class="btn btn-danger" onclick="return confirm('Are you sure you want to delete this order?')">Delete Order</button>
        </form>
    </div>
</div>
@endsection
