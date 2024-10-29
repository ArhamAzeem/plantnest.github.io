@extends('frontend_partials.main_layout')
@section('front_title', $product->name)

@section('main_content')
@if(session('success'))
<div class="alert alert-success alert-dismissible fade show" role="alert">
    {{ session('success') }}
    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
</div>
@endif

@if(session('error'))
<div class="alert alert-danger alert-dismissible fade show" role="alert">
    {{ session('error') }}
    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
</div>
@endif

<script>
// Automatically hide the alert after 5 seconds
setTimeout(function() {
    let alert = document.querySelector('.alert');
    if (alert) {
        alert.classList.remove('show');
        alert.classList.add('fade');
        setTimeout(function() {
            alert.remove();
        }, 500); // 0.5 second delay before removing the alert completely
    }
}, 5000); // 5 seconds delay
</script>

<div class="container py-5">
    <div class="row">
        <div class="col col-12 col-md-6 p-5">
            <img src="{{ asset('storage/' . $product->image_path) }}" alt="{{ $product->name }}"
                class="w-100 rounded-5 border">
        </div>
        <div class="col col-12 col-md-6 mt-3 mt-md-0 px-5 pt-md-5 product-detail d-flex flex-column gap-2">
            <h1 class="fw-bold">{{ $product->name }}</h1>

            <!-- Conditionally display species if category type is 'plant' -->
            @if ($product->category->type === 'plant')
            <h6 class="fs-6 fw-semibold">{{ $product->species }}</h6>
            @endif

            <p class="text-black-50">{{ $product->description }}</p>
            <div class="d-flex flex-row gap-2">
                <h4>${{ number_format($product->price, 2) }} USD</h4>
                @if ($product->discount_percentage > 0)
                <span class="badge bg-danger rounded-5 mt-3">{{ $product->discount_percentage }}% Discount</span>
                @endif
            </div>
            <div class="row mt-1">
                <div class="col col-6">
                    <form action="{{ route('cart.add') }}" method="POST">
                        @csrf
                        <input type="hidden" name="product_id" value="{{ $product->id }}">
                        <div class="input-group py-1">
                            <button class="btn btn-outline-secondary rounded-0" type="button" id="decrement">-</button>
                            <input type="number" name="quantity" id="quantity" class="form-control text-center w-50"
                                min="1" max="100" value="1">
                            <button class="btn btn-outline-secondary rounded-0" type="button" id="increment">+</button>
                        </div>
                        <script>
                        document.getElementById('increment').addEventListener('click', function() {
                            let input = document.getElementById('quantity');
                            if (parseInt(input.value) < parseInt(input.max)) {
                                input.value = parseInt(input.value) + 1;
                            }
                        });

                        document.getElementById('decrement').addEventListener('click', function() {
                            let input = document.getElementById('quantity');
                            if (parseInt(input.value) > parseInt(input.min)) {
                                input.value = parseInt(input.value) - 1;
                            }
                        });
                        </script>
                </div>
                <div class="col col-6">
                    <button type="submit" class="btn btn-success btn-block rounded-3 p-2 px-3 fs-6 mt-2">
                        <i class="fa-solid fa-cart-shopping"></i> Add to Cart
                    </button>
                </div>
                </form>
            </div>
            <p class="mt-1">Discount mentioned is already applied on All Products</p>
            <p><i class="fas fa-shipping-fast"></i> $30 USD Shipping Cost Applied on all orders</p>
            <p><i class="fa-regular fa-clock"></i> Delivers in 3-7 Working Days. Shipping & Return</p>
            <h5 class="fs-6 fw-semibold">Category: {{ $product->category->name }}</h5>
        </div>
    </div>
</div>

<div class="container">
    <div class="row">
        <div class="col col-12">
            <h2>Customer Reviews</h2>
            @forelse ($product->reviews as $review)
            <div class="review border rounded p-3 mb-3 rounded-5 bg-success-subtle">
                <p><strong>{{ $review->user->name }}</strong> ({{ $review->user->email }}) - Rating: {{ $review->rating }}/5</p>
                <p>{{ $review->review }}</p>
            </div>
            @empty
            <p>No reviews yet.</p>
            @endforelse
        </div>
    </div>
</div>



<div class="container py-5">
    <div class="row">
        <div class="col col-12">
            <h2>Leave a Review</h2>
            <form action="{{ route('reviews.store', ['productId' => $product->id]) }}" method="POST">
                @csrf
                <input type="hidden" name="product_id" value="{{ $product->id }}"> <!-- Pass the product ID -->

                <div class="mb-3">
                    <label for="rating" class="form-label fw-semibold fs-5">Rating</label>
                    <select class="form-select rounded-pill" id="rating" name="rating" required>
                        <option value="">Select Rating</option>
                        <option value="1">1 - Poor</option>
                        <option value="2">2 - Fair</option>
                        <option value="3">3 - Good</option>
                        <option value="4">4 - Very Good</option>
                        <option value="5">5 - Excellent</option>
                    </select>
                </div>

                <div class="mb-3">
                    <label for="review" class="form-label fw-semibold fs-5">Review</label>
                    <textarea class="form-control rounded-4" id="review" name="review" rows="3" required></textarea>
                </div>

                <button type="submit" class="btn btn-success rounded-pill text-white">Submit Review</button>
            </form>
        </div>
    </div>
</div>



<div class="container">
    <div class="row text-center">
        <h1>Similar Products</h1>
    </div>
    <div class="row py-5" id="products">
        @forelse ($similarProducts as $similarProduct)
        <div class="col col-6 col-lg-3 col-xl-3">
            <div class="card h-100 border-0 text-center position-relative product-card overflow-hidden">
                <!-- Discount Tag -->
                @if ($similarProduct->discount_percentage)
                <span
                    class="badge bg-danger position-absolute top-0 start-0 m-3 rounded-5">{{ $similarProduct->discount_percentage }}%
                    OFF</span>
                @endif

                <!-- Image Container -->
                <div class="position-relative">
                    <img src="{{ asset('storage/' . $similarProduct->image_path) }}"
                        class="card-img-top rounded-5 transition" alt="{{ $similarProduct->name }}">

                    <!-- Icon Container -->
                    <div
                        class="icon-container d-flex flex-column gap-2 position-absolute top-50 end-0 translate-middle-y pe-3">
                        <form action="{{ route('cart.add') }}" method="POST">
                            @csrf
                            <input type="hidden" name="product_id" value="{{ $similarProduct->id }}">
                            <input type="hidden" name="quantity" value="1"> <!-- Default quantity for product card -->
                            <button type="submit" class="btn btn-dark btn-sm rounded-circle mb-1 icon">
                                <i class="fas fa-shopping-cart"></i>
                            </button>
                        </form>
                        <a href="{{ route('shop.show', [$similarProduct->category->name, $similarProduct->category->type, $similarProduct->name]) }}"
                            class="btn btn-dark btn-sm rounded-circle mb-1 icon"><i class="fas fa-search"></i></a>
                    </div>
                </div>

                <!-- Card Body -->
                <div class="card-body">
                    <h5 class="card-title fs-6 fw-bold"><a
                            href="{{ route('shop.show', [$similarProduct->category->name, $similarProduct->category->type, $similarProduct->name]) }}"
                            class='text-decoration-none text-dark fs-6 fw-bold'>{{ $similarProduct->name }}</a></h5>
                    <p class="card-text fw-bold">${{ number_format($similarProduct->price, 2) }}</p>
                </div>
            </div>
        </div>
        @empty
        <div class="col-12 text-center">
            <p class="fw-bold fs-4">No Similar Products Found</p>
        </div>
        @endforelse
    </div>
</div>
@endsection