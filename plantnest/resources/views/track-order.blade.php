@extends('frontend_partials.main_layout')
@section('front_title', 'Thank You!')

@section('main_content')

<div class="container-fluid">
    <div class="row d-flex shop flex-row justify-content-center align-items-center py-5 text-center">
        <h1 class="fw-bolder fs-1"><i class="fa-solid fa-check-circle"></i>Track Your Order</h1>
    </div>
</div>
<div class="container p-5">
<form action="{{ route('track.order') }}" method="POST" class="mt-4">
        @csrf
        <div class="mb-3 text-center">
            <label for="order_number" class="form-label  fw-bold fs-2">Order Number</label>
            <input type="text" name="order_number" id="order_number" class="form-control rounded-pill p-3" required>
            @error('order_number')
            <div class="text-danger">{{ $message }}</div>
            @enderror
        </div>
        <button type="submit" class="btn btn-success rounded-pill p-3 fs-4 w-100">Track Order</button>
    </div>
    </form>
</div>

@endsection
