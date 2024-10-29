@extends('frontend_partials.main_layout')
@section('front_title', 'Check Out')

@section('main_content')

<!-- @if ($errors->any())
    <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif -->

@if (session('error'))
<div class="alert alert-danger">
    {{ session('error') }}
</div>
@endif

@if (session('success'))
<div class="alert alert-success">
    {{ session('success') }}
</div>
@endif

<div class="container-fluid">
    <div class="row d-flex shop flex-row justify-content-center align-items-center py-5 text-center">
        <h1 class="fw-bolder fs-1"><i class="fa-solid fa-cart-shopping"></i> Check Out</h1>
    </div>
</div>

<div class="container my-5 p-5">
    <div class="row">
        <!-- Checkout Form -->
        <div class="col col-12 col-md-8 p-5 rounded-5" style="background-color: rgb(211, 225, 211);">
            <form action="{{ route('checkout.placeOrder') }}" method="POST" id="checkoutForm" novalidate>
                @csrf

                <!-- Details Section -->
                <fieldset class='d-flex flex-column mb-5'>
                    <legend class='fw-bold text-success fs-2 mb-4'>Billing Details</legend>

                    <!-- First Name -->
                    <div class="form-group">
                        <label for="first_name" class="fw-semibold fs-6 my-2">First Name:</label>
                        <input type="text" class="form-control rounded-pill" id="first_name" name="first_name"
                            placeholder="Enter your First Name ..." required>
                        <div class="invalid-feedback" id="first_name_error"></div>
                    </div>

                    <!-- Last Name -->
                    <div class="form-group">
                        <label for="last_name" class="fw-semibold fs-6 my-2">Last Name:</label>
                        <input type="text" class="form-control rounded-pill" id="last_name" name="last_name"
                            placeholder="Enter your Last Name ..." required>
                        <div class="invalid-feedback" id="last_name_error"></div>
                    </div>

                    <!-- Email -->
                    <div class="form-group">
                        <label for="email" class="fw-semibold fs-6 my-2">Email Address:</label>
                        <input type="email" class="form-control rounded-pill" id="email" name="email"
                            placeholder="Enter your Email Address ..." required>
                        <div class="invalid-feedback" id="email_error"></div>
                    </div>

                    <!-- Phone -->
                    <div class="form-group">
                        <label for="phone" class="fw-semibold fs-6 my-2">Phone Number (with country code):</label>
                        <input type="text" class="form-control rounded-pill" id="phone" name="phone"
                            placeholder="Enter your Phone Number ..." required>
                        <div class="invalid-feedback" id="phone_error"></div>
                    </div>

                    <!-- Other Fields -->
                    @foreach (['street_address' => 'Street Address', 'city' => 'City', 'state' => 'State', 'country' =>
                    'Country', 'postal_code' => 'Postal Code'] as $field => $label)
                    <div class="form-group">
                        <label for="{{ $field }}" class="fw-semibold fs-6 my-2">{{ $label }}:</label>
                        <input type="text" class="form-control rounded-pill" id="{{ $field }}" name="{{ $field }}"
                            placeholder="Enter your {{ $label }} ..." required>
                        <div class="invalid-feedback" id="{{ $field }}_error"></div>
                    </div>
                    @endforeach
                </fieldset>

                <!-- Payment Method Section -->
                <fieldset class='d-flex flex-column mb-5'>
                    <legend class='fw-bold text-success fs-2 mb-4'>Payment Method</legend>

                    <div class="form-check">
                        <input class="form-check-input" type="radio" name="payment_method" id="cod"
                            value="cash on delivery" required>
                        <label class="form-check-label" for="cod">Cash on Delivery</label>
                    </div>
                    <div class="form-check">
                        <input class="form-check-input" type="radio" name="payment_method" id="card_payment"
                            value="card payment" required>
                        <label class="form-check-label" for="card_payment">Card Payment</label>
                    </div>
                    <div class="invalid-feedback" id="payment_method_error"></div>

                    <!-- Card Payment Section (Hidden by Default) -->
                    <div id="card-info" class="mt-4" style="display:none;">
                        <!-- Card Number -->
                        <div class="form-group">
                            <label for="card_number" class="fw-semibold fs-6 my-2">Credit/Debit Card Number:</label>
                            <input type="text" class="form-control rounded-pill" id="card_number" name="card_number"
                                placeholder="Enter your card number ...">
                            <div class="invalid-feedback" id="card_number_error"></div>
                        </div>

                        <!-- CVV -->
                        <div class="form-group">
                            <label for="cvv" class="fw-semibold fs-6 my-2">CVV:</label>
                            <input type="text" class="form-control rounded-pill" id="cvv" name="cvv"
                                placeholder="Enter CVV ...">
                            <div class="invalid-feedback" id="cvv_error"></div>
                        </div>

                        <!-- Expiry Date -->
                        <div class="form-group">
                            <label for="expiry_date" class="fw-semibold fs-6 my-2">Expiry Date:</label>
                            <input type="month" class="form-control rounded-pill" id="expiry_date" name="expiry_date"
                                placeholder="YYYY-MM">
                            <div class="invalid-feedback" id="expiry_date_error"></div>
                        </div>
                    </div>
                </fieldset>

                <button type="submit" class="btn btn-success rounded-pill mt-3 fs-6 w-100">Place Order</button>
            </form>
        </div>

        <!-- Cart Summary -->
        <div class="col col-12 col-md-4">
            <div class="card rounded-5 border-0 shadow">
                <div class="card-body p-4">
                    <div class="card-title fs-4 fw-bolder border-bottom pb-2">
                        Order Summary
                    </div>
                    <ol class="list-group list-group-numbered d-flex flex-column gap-2 py-2">
                        @foreach ($cartItems as $item)
                        <li class="list-group-item d-flex justify-content-between border-0">
                            {{ $item['name'] }}
                            <span>${{ $item['price'] }}</span>
                        </li>
                        @endforeach
                    </ol>
                    <div class="card-text d-flex justify-content-between border-top fw-semibold py-2">Sub-Total
                        <span id="subtotal">${{ $subTotal }}</span>
                    </div>
                    <div class="card-text d-flex justify-content-between border-top fw-bold py-2">Total
                        <span id="total">${{ $total }}</span>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
document.addEventListener('DOMContentLoaded', function() {
    const form = document.getElementById('checkoutForm');

    form.addEventListener('submit', function(event) {
        let valid = true;

        // Validation patterns
        const patterns = {
            first_name: /^[a-zA-Z]+$/,
            last_name: /^[a-zA-Z]+$/,
            email: /^[^\s@]+@[^\s@]+\.[^\s@]+$/,
            phone: /^\+[1-9]{1}[0-9]{3,14}$/,
            street_address: /^[\d\w\s.,-]+$/, // Street Address
            city: /^[a-zA-Z\s-]+$/, // City
            state: /^[a-zA-Z\s-]+$/, // State
            country: /^[a-zA-Z\s-]+$/, // Country
            postal_code: /^[\w\s-]+$/ // Postal Code (can be customized based on country requirements)
        };

        // Validate fields
        const fields = ['first_name', 'last_name', 'email', 'phone', 'street_address', 'city', 'state',
            'country', 'postal_code'
        ];
        fields.forEach(field => {
            const input = document.getElementById(field);
            const errorDiv = document.getElementById(`${field}_error`);
            if (input && !patterns[field]?.test(input.value)) {
                valid = false;
                errorDiv.textContent = `Invalid ${field.replace('_', ' ')}.`;
                input.classList.add('is-invalid');
            } else {
                errorDiv.textContent = '';
                input.classList.remove('is-invalid');
            }
        });

        // Validate card details if card payment is selected
        if (document.querySelector('input[name="payment_method"]:checked')?.value === 'card payment') {
            const cardNumber = document.getElementById('card_number');
            const cvv = document.getElementById('cvv');
            const expiryDate = document.getElementById('expiry_date');

            if (cardNumber && !patterns.card_number.test(cardNumber.value)) {
                valid = false;
                document.getElementById('card_number_error').textContent = 'Invalid card number.';
                cardNumber.classList.add('is-invalid');
            } else {
                document.getElementById('card_number_error').textContent = '';
                cardNumber.classList.remove('is-invalid');
            }

            if (cvv && !patterns.cvv.test(cvv.value)) {
                valid = false;
                document.getElementById('cvv_error').textContent = 'Invalid CVV.';
                cvv.classList.add('is-invalid');
            } else {
                document.getElementById('cvv_error').textContent = '';
                cvv.classList.remove('is-invalid');
            }

            if (expiryDate && !expiryDate.value) {
                valid = false;
                document.getElementById('expiry_date_error').textContent = 'Expiry date is required.';
                expiryDate.classList.add('is-invalid');
            } else {
                document.getElementById('expiry_date_error').textContent = '';
                expiryDate.classList.remove('is-invalid');
            }
        }

        if (!valid) {
            event.preventDefault();
        }
    });

    // Toggle card info visibility based on payment method selection
    document.querySelectorAll('input[name="payment_method"]').forEach((radio) => {
        radio.addEventListener('change', function() {
            document.getElementById('card-info').style.display = this.value === 'card payment' ?
                'block' : 'none';
        });
    });
});
</script>


@endsection