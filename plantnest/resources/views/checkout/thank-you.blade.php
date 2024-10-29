@extends('frontend_partials.main_layout')
@section('front_title', 'Thank You!')

@section('main_content')

<div class="container-fluid">
    <div class="row d-flex shop flex-row justify-content-center align-items-center py-5 text-center">
        <h1 class="fw-bolder fs-1"><i class="fa-solid fa-check-circle"></i> Thank You!</h1>
    </div>
</div>

<div class="container my-5 p-5 text-center">
    <div class="row">
        <div class="col-12">
            <div class="alert alert-success" role="alert">
                <h4 class="alert-heading">Your order has been placed successfully!</h4>
                <p class="mb-0">Thank you for shopping with us. Your order ID is:</p>
                <h2 class="fw-bold">{{ $orderNumber }}</h2>
            </div>
        </div>
    </div>
</div>

@endsection
