@extends('frontend_partials.main_layout')
@section('front_title', 'Thank You!')

@section('main_content')
<div class="container-fluid">
    <div class="row d-flex justify-content-center align-items-center py-5 text-center">
        <h1 class="fw-bolder fs-1"><i class="fa-solid fa-check-circle"></i> Order Details</h1>
    </div>
</div>

<div class="container py-5">
    @if(session('success'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            {{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif

    <div class="card shadow-sm mb-4 rounded-5 overflow-hidden">
        <div class="card-header bg-success text-white d-flex justify-content-between align-items-center p-4">
            <h5 class="mb-0">Order Details</h5>
            <p class="mb-0"><strong>Order Number:</strong> {{ $order->order_number }}</p>
        </div>
        <div class="card-body p-4">
            <div class="row mb-4">
                <div class="col-md-6">
                    <h6 class="text-muted">Payment Status</h6>
                    <p class="mb-2"><strong class="text-success text-uppercase">{{ $order->payment_status }}</strong></p>
                </div>
                <div class="col-md-6">
                    <h6 class="text-muted">Delivery Status</h6>
                    <p class="mb-2"><strong class="text-success text-uppercase">{{ $order->delivery_status }}</strong></p>
                </div>
            </div>

            <hr>

            <div class="mb-4">
                <h5>Order Items</h5>
                <ul class="list-group list-group-flush">
                    @foreach ($order->orderItems as $item)
                        <li class="list-group-item">
                            <div class="row align-items-center">
                                <div class="col-md-8">
                                    <h6 class="mb-0">{{ $item->product_name }}</h6>
                                    <p class="text-muted mb-0">Quantity: {{ $item->quantity }}</p>
                                </div>
                                <div class="col-md-4 text-end">
                                    <span class="fw-bold">${{ number_format($item->price * $item->quantity, 2) }}</span>
                                </div>
                            </div>
                        </li>
                    @endforeach
                </ul>
            </div>
        </div>
    </div>

    <div class="text-end">
        <form action="{{ route('track.order.destroy', $order->order_number) }}" method="POST" onsubmit="return confirm('Are you sure you want to cancel this order?');">
            @csrf
            @method('DELETE')
            <button type="submit" class="btn btn-danger rounded-pill px-3">Cancel Order</button>
        </form>
    </div>
</div>
@endsection
