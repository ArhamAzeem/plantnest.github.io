@extends('frontend_partials.main_layout')
@section('front_title', 'Your Cart')

@section('main_content')

<div class="container-fluid">
    <div class="row d-flex shop flex-row justify-content-center align-items-center py-5 text-center">
        <h1 class="fw-bolder fs-1"><i class="fa-solid fa-cart-shopping"></i> Shopping Cart</h1>
    </div>
</div>
<div class="container py-5">
    <div class="row">
        <div class="col col-12 col-md-9">
            @forelse ($cartItems as $id => $item)
            <div class="cart-wrapper">
                <!-- Cart-Card -->
                <div class="card mb-3 rounded-5 border-0 shadow">
                    <div class="row g-1">
                        <div class="col col-4">
                            <img src="{{ asset('storage/' . $item['image']) }}"
                                class="img-fluid h-100 rounded-top-5 rounded-bottom-5 border" alt="{{ $item['name'] }}">
                        </div>
                        <div class="col-8">
                            <div class="card-body">
                                <h5 class="card-title">{{ $item['name'] }}</h5>
                                <p class="card-text"><small class="text-body-secondary">{{ $item['specie'] }}</small></p>
                                <p class="card-text"><small class="text-body-secondary">{{ $item['description'] }}</small></p>
                                <form action="{{ route('cart.update', $id) }}" method="POST"
                                    class="d-flex align-items-center py-1 pb-3 w-50">
                                    @csrf
                                    <input type="hidden" name="_method" value="POST">
                                    <button class="btn btn-outline-secondary rounded-0" type="button"
                                        id="decrement-{{ $loop->index }}">-</button>
                                    <input type="number" name="quantity" id="quantity-{{ $loop->index }}"
                                        class="form-control text-center w-25" min="1" max="100"
                                        value="{{ $item['quantity'] }}">
                                    <button class="btn btn-outline-secondary rounded-0" type="button"
                                        id="increment-{{ $loop->index }}">+</button>
                                </form>
                                <div class="d-flex flex-row justify-content-between mt-3">
                                    <span class="fs-4 price-{{ $loop->index }}">${{ $item['price'] * $item['quantity'] }}</span>
                                    <form action="{{ route('cart.remove', $id) }}" method="POST">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-danger btn-sm"><i
                                                class="fa-solid fa-trash"></i></button>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            @empty
            <p>Your cart is empty.</p>
            @endforelse
            <div class="row">
                <div class="col d-flex justify-content-start align-items-center gap-1 my-3"
                    role="button">
                    <a href="{{ route('shop.index') }}" class='text-decoration-none fw-bold text-success'><i class="fa-solid fa-arrow-left"></i> Continue Shopping</a>
                </div>
            </div>
        </div>
        <div class="col col-12 col-md-3">
            <!-- Total -->
            <div class="card rounded-5 border-0 shadow">
                <div class="card-body p-4">
                    <div class="card-title fs-4 fw-bolder border-bottom pb-2">
                        Cart Summary
                    </div>
                    <ol class="list-group list-group-numbered d-flex flex-column gap-2 py-2">
                        @foreach ($cartItems as $item)
                        <li class="list-group-item d-flex justify-content-between border-0">{{ $item['name'] }}
                            <span class="price-{{ $loop->index }}">${{ $item['price'] * $item['quantity'] }}</span></li>
                        @endforeach
                    </ol>
                    <div class="card-text d-flex justify-content-between border-top fw-semibold py-2">Sub-Total
                        <span id="subtotal">${{ $subtotal }}</span></div>
                    <div class="card-text d-flex justify-content-between border-top fw-bold py-2">Total
                        <span id="total">${{ $total }}</span></div>
                    <a href="{{ route('checkout.form') }}" class="btn btn-success w-100 rounded-pill my-1">Proceed Checkout</a>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
document.querySelectorAll('[id^="increment-"]').forEach(button => {
    button.addEventListener('click', function() {
        let index = this.id.split('-')[1];
        let input = document.getElementById('quantity-' + index);
        if (parseInt(input.value) < parseInt(input.max)) {
            input.value = parseInt(input.value) + 1;
            input.form.submit();
        }
    });
});

document.querySelectorAll('[id^="decrement-"]').forEach(button => {
    button.addEventListener('click', function() {
        let index = this.id.split('-')[1];
        let input = document.getElementById('quantity-' + index);
        if (parseInt(input.value) > parseInt(input.min)) {
            input.value = parseInt(input.value) - 1;
            input.form.submit();
        }
    });
});

document.querySelectorAll('input[type="number"]').forEach(input => {
    input.addEventListener('change', function() {
        let index = this.id.split('-')[1];
        let price = parseFloat(document.querySelector('.price-' + index).dataset.price);
        let newQuantity = parseInt(this.value);
        let newPrice = price * newQuantity;
        document.querySelector('.price-' + index).textContent = `$${newPrice.toFixed(2)}`;
        updateTotals();
    });
});

function updateTotals() {
    let subtotal = 0;
    document.querySelectorAll('span[class^="price-"]').forEach(priceElement => {
        subtotal += parseFloat(priceElement.textContent.replace('$', ''));
    });
    let total = subtotal + 30; // Adding shipping fee or any additional fee
    document.getElementById('subtotal').textContent = `$${subtotal.toFixed(2)}`;
    document.getElementById('total').textContent = `$${total.toFixed(2)}`;
}
</script>

@endsection
