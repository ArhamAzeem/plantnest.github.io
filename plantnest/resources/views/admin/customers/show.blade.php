@extends('admin.dashboard')
@section('title', 'Customer Details')

@section('main_content')
<div class="container mt-5">
    <h1 class="mb-4">Customer Details</h1>

    <div class="card mb-4">
        <div class="card-body">
            <h5 class="card-title mb-4">Customer Information</h5>
            <dl class="row">
                <dt class="col-sm-3">ID:</dt>
                <dd class="col-sm-9">{{ $customer->id }}</dd>

                <dt class="col-sm-3">First Name:</dt>
                <dd class="col-sm-9">{{ $customer->first_name }}</dd>

                <dt class="col-sm-3">Last Name:</dt>
                <dd class="col-sm-9">{{ $customer->last_name }}</dd>

                <dt class="col-sm-3">Email:</dt>
                <dd class="col-sm-9">{{ $customer->email }}</dd>

                <dt class="col-sm-3">Phone:</dt>
                <dd class="col-sm-9">{{ $customer->phone }}</dd>

                <dt class="col-sm-3">Street Address:</dt>
                <dd class="col-sm-9">{{ $customer->street_address }}</dd>

                <dt class="col-sm-3">City:</dt>
                <dd class="col-sm-9">{{ $customer->city }}</dd>

                <dt class="col-sm-3">State:</dt>
                <dd class="col-sm-9">{{ $customer->state }}</dd>

                <dt class="col-sm-3">Country:</dt>
                <dd class="col-sm-9">{{ $customer->country }}</dd>

                <dt class="col-sm-3">Postal Code:</dt>
                <dd class="col-sm-9">{{ $customer->postal_code }}</dd>

                @if($customer->user)
                    <dt class="col-sm-3">Username:</dt>
                    <dd class="col-sm-9">{{ $customer->user->name }}</dd>

                    <dt class="col-sm-3">User Email:</dt>
                    <dd class="col-sm-9">{{ $customer->user->email }}</dd>
                @else
                    <dt class="col-sm-3">User Details:</dt>
                    <dd class="col-sm-9 text-muted">Not Available</dd>
                @endif
            </dl>

            <a href="{{ route('admin.customers.index') }}" class="btn btn-success">
                <i class="fas fa-arrow-left"></i> Back to List
            </a>
        </div>
    </div>
</div>
@endsection
