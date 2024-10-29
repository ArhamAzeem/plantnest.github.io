@extends('admin.dashboard')
@section('title','Edit Order')

@section('main_content')
<div class="container">
    <h1>Edit Order</h1>

    <form action="{{ route('admin.orders.update', $order->order_number) }}" method="POST">
        @csrf
        @method('PUT')
        
        <!-- Amount Field -->
        <div class="form-group">
            <label for="amount">Amount</label>
            <input type="number" id="amount" name="amount" value="{{ old('amount', $order->amount) }}" class="form-control" step="0.01" min="0">
            @error('amount')
            <div class="text-danger">{{ $message }}</div>
            @enderror
        </div>

        <!-- Payment Status Field -->
        <div class="form-group">
            <label for="payment_status">Payment Status</label>
            <select id="payment_status" name="payment_status" class="form-control">
                <option value="paid" {{ old('payment_status', $order->payment_status) === 'paid' ? 'selected' : '' }}>Paid</option>
                <option value="unpaid" {{ old('payment_status', $order->payment_status) === 'unpaid' ? 'selected' : '' }}>Unpaid</option>
            </select>
            @error('payment_status')
            <div class="text-danger">{{ $message }}</div>
            @enderror
        </div>

        <!-- Delivery Status Field -->
        <div class="form-group">
            <label for="delivery_status">Delivery Status</label>
            <select id="delivery_status" name="delivery_status" class="form-control">
                <option value="pending" {{ old('delivery_status', $order->delivery_status) === 'pending' ? 'selected' : '' }}>Pending</option>
                <option value="shipped" {{ old('delivery_status', $order->delivery_status) === 'shipped' ? 'selected' : '' }}>Shipped</option>
                <option value="delivered" {{ old('delivery_status', $order->delivery_status) === 'delivered' ? 'selected' : '' }}>Delivered</option>
                <option value="cancelled" {{ old('delivery_status', $order->delivery_status) === 'cancelled' ? 'selected' : '' }}>Cancelled</option>
            </select>
            @error('delivery_status')
            <div class="text-danger">{{ $message }}</div>
            @enderror
        </div>
        
        <button type="submit" class="btn btn-success">Update Order</button>
    </form>
</div>
@endsection
