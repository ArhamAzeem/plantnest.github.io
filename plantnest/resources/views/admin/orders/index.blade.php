@extends('admin.dashboard')
@section('title', 'Orders')

@section('main_content')
<div class="container mt-5">
    <h1 class="mb-4">Orders List</h1>
    
    @if($orders->isNotEmpty())
        <div class="table-responsive">
            <table class="table table-striped table-bordered">
                <thead class="table-success">
                    <tr>
                        <th>Order Number</th>
                        <th>Customer Name</th>
                        <th>Amount</th>
                        <th>Payment Method</th>
                        <th>Payment Status</th>
                        <th>Delivery Status</th>
                        <th>Items</th>
                        <th>Order Date</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($orders as $order)
                        <tr>
                            <td>{{ $order->order_number }}</td>
                            <td>{{ $order->customer ? $order->customer->first_name . ' ' . $order->customer->last_name : 'N/A' }}</td>
                            <td>${{ number_format($order->amount, 2) }}</td>
                            <td>{{ ucfirst($order->payment_method) }}</td>
                            <td>{{ ucfirst($order->payment_status) }}</td>
                            <td>{{ ucfirst($order->delivery_status) }}</td>
                            <td>{{ $order->orderItems->count() }} items</td>
                            <td>{{ $order->created_at->format('d M Y, h:i A') }}</td>
                            <td class='d-flex'>
                                <a href="{{ route('admin.orders.show', $order->order_number) }}" class="btn btn-info btn-sm">
                                    <i class="fas fa-eye"></i>
                                </a>
                                <a href="{{ route('admin.orders.edit', $order->order_number) }}" class="btn btn-warning btn-sm">
                                    <i class="fas fa-edit"></i>
                                </a>
                                <form action="{{ route('admin.orders.destroy', $order->order_number) }}" method="POST" onsubmit="return confirmDelete()">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-danger btn-sm">
                                        <i class="fas fa-trash"></i>
                                    </button>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>

            <!-- Pagination -->
            <div class="d-flex justify-content-center mt-4">
                {{ $orders->links() }}
            </div>
        </div>
    @else
        <div class="alert alert-info">No orders found.</div>
    @endif
</div>

<script>
    function confirmDelete() {
        return confirm('Are you sure you want to delete this order?');
    }
</script>
@endsection
