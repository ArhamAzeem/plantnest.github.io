@extends('frontend_partials.main_layout')
@section('front_title', 'Shop')

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

<!-- Shop Header -->
<div class="container-fliud">
    <div class="row d-flex shop flex-row justify-content-center align-items-center py-5 fw-bolder fs-1">
        Shop
    </div>
</div>


<div class="container pt-5">
    <div class="row">
        <div class="col col-12 col-md-3">
            <div class="border p-3 rounded-4 d-flex flex-column gap-3 filter">
                <div class="border d-flex align-items-center rounded-pill px-2">
                    <h6 class="m-2 fs-5 fw-bold" data-bs-toggle="collapse" data-bs-target="#filterSection"
                        aria-expanded="false" aria-controls="filterSection">Filter</h6>
                </div>
                <div id="filterSection" class="collapse collapse-custom">
                    <div class="border d-flex align-items-center rounded-pill px-2 my-2 bg-body-secondary">
                        <form action="{{ route('shop.index') }}" method="GET"
                            class="d-flex flex-row align-items-center">
                            <i class="fa-solid fa-magnifying-glass fs-6"></i>
                            <input type="search" name="search" id="search"
                                class="rounded-pill border-0 w-100 p-1 bg-body-secondary fs-6" placeholder="Search..."
                                value="{{ request()->search }}" onchange="this.form.submit()">
                        </form>
                    </div>
                    <div class="border d-flex flex-column align-items-start rounded-4 p-3 mb-2 bg-body-secondary">
                        <p class="fw-bold fs-6">Prices</p>
                        <form action="{{ route('shop.index') }}" method="GET">
                            <div class="slider-container">
                                <div class="slider-labels">
                                    <div class="d-flex flex-column gap-1">
                                        <label for="minPrice" class="fw-semibold">Min Price</label>
                                        <input type="number" id="minPrice" name="min_price"
                                            class="bg-white text-dark rounded-pill px-2 w-75 border-0 text-center"
                                            value="{{ request()->get('min_price', '0') }}">
                                    </div>
                                    <div class="d-flex flex-column gap-1">
                                        <label for="maxPrice" class="fw-semibold">Max Price</label>
                                        <input type="number" id="maxPrice" name="max_price"
                                            class="bg-white text-dark rounded-pill px-2 w-75 border-0 text-center"
                                            value="{{ request()->get('max_price', '100') }}">
                                    </div>
                                </div>
                                <button type="submit"
                                    class="btn btn-success mt-2 w-100 fw-bold fs-6 rounded-pill">Filter</button>
                            </div>
                        </form>

                    </div>
                    <div class="border d-flex flex-column align-items-start rounded-4 p-3 mb-2 bg-body-secondary">
                        <p class="fw-bold fs-6">Category</p>
                        <form action="{{ route('shop.index') }}" method="GET" class="flex-column d-flex gap-1">
                            <div class="d-flex gap-1">
                                <input type="checkbox" name="category[]" value="all" id="all"
                                    onchange="this.form.submit()"
                                    {{ request()->has('category') && in_array('all', request()->category) ? 'checked' : '' }}>
                                <label for="all">All</label>
                            </div>
                            <div class="d-flex gap-1">
                                <input type="checkbox" name="category[]" value="plant" id="plant"
                                    onchange="this.form.submit()"
                                    {{ request()->has('category') && in_array('plant', request()->category) ? 'checked' : '' }}>
                                <label for="plant">Plant</label>
                            </div>
                            <div class="d-flex gap-1">
                                <input type="checkbox" name="category[]" value="accessory" id="accessory"
                                    onchange="this.form.submit()"
                                    {{ request()->has('category') && in_array('accessory', request()->category) ? 'checked' : '' }}>
                                <label for="accessory">Accessory</label>
                            </div>
                        </form>

                    </div>
                    <div class="border d-flex flex-column align-items-start rounded-4 p-3 mb-2 bg-body-secondary">
                        <p class="fw-bold fs-6">Sub-Category</p>
                        <form action="{{ route('shop.index') }}" method="GET" class="flex-column d-flex gap-1">
                            @foreach ($categories as $category)
                            <div class="d-flex gap-1">
                                <input type="checkbox" name="sub_category" value="{{ $category->id }}"
                                    id="{{ $category->id }}" onchange="this.form.submit()"
                                    {{ request()->sub_category == $category->id ? 'checked' : '' }}>
                                {{ $category->name }}
                            </div>
                            @endforeach
                        </form>
                    </div>
                </div>
            </div>
        </div>
        <div class="col col-12 col-md-9 flex flex-column my-3 my-md-0">
            <div class="form-group fs-6 w-50 ms-auto mb-3">
                <form action="{{ route('shop.index') }}" method="GET">
                    <select class="form-control rounded-pill" name="sort" onchange="this.form.submit()">
                        <option value="default fs-6">Sort by</option>
                        <option value="price_asc" {{ request()->sort == 'price_asc' ? 'selected' : '' }}>Price: Low to
                            High</option>
                        <option value="price_desc" {{ request()->sort == 'price_desc' ? 'selected' : '' }}>Price: High
                            to Low</option>
                        <option value="name_asc" {{ request()->sort == 'name_asc' ? 'selected' : '' }}>Name: A to Z
                        </option>
                        <option value="name_desc" {{ request()->sort == 'name_desc' ? 'selected' : '' }}>Name: Z to A
                        </option>
                    </select>
                </form>
            </div>
            <!-- Product Display -->
            <div>
                <div class="row" id="products">
                    @forelse ($products as $product)
                    <div class="col col-6 col-lg-4 col-xl-4">
                        <div class="card h-100 border-0 text-center position-relative product-card overflow-hidden">
                            <!-- Discount Tag -->
                            <span
                                class="badge bg-danger position-absolute top-0 start-0 m-3 rounded-5">{{ $product->discount_percentage }}%
                                OFF</span>

                            <!-- Image Container -->
                            <div class="position-relative">
                                <img src="{{ asset('storage/' . $product->image_path) }}"
                                    class="card-img-top img-fluid rounded-5 transition border" alt="Product Image"
                                    style="height: 250px; object-fit: cover;">

                                <!-- Icon Container -->
                                <div
                                    class="icon-container d-flex flex-column gap-2 position-absolute top-50 end-0 translate-middle-y pe-3">
                                    <form action="{{ route('cart.add') }}" method="POST">
                                        @csrf
                                        <input type="hidden" name="product_id" value="{{ $product->id }}">
                                        <input type="hidden" name="quantity" value="1">
                                        <!-- Default quantity for product card -->
                                        <button type="submit" class="btn btn-dark btn-sm rounded-circle mb-1 icon">
                                            <i class="fas fa-shopping-cart"></i>
                                        </button>
                                    </form>

                                    <a href="{{ route('shop.show', [$product->category->name, $product->category->type, $product->name]) }}"
                                        class="btn btn-dark btn-sm rounded-circle mb-1 icon"><i
                                            class="fas fa-search"></i></a>
                                </div>
                            </div>

                            <!-- Card Body -->
                            <div class="card-body">
                                <h5 class="card-title fs-6 fw-bold"><a
                                        href="{{ route('shop.show', [$product->category->name, $product->category->type, $product->name]) }}"
                                        class='text-decoration-none text-dark fs-6 fw-bold'>{{ $product->name }}</a>
                                </h5>
                                <p class="card-text fw-bold">${{ number_format($product->price, 2) }}</p>
                            </div>
                        </div>
                    </div>
                    @empty
                    <div class="d-flex flex-column align-items-center justify-content-center gap-1">
                        <i class="fas fa-frown fs-3"></i>
                        <p class="fw-bold fs-3">No Products Found</p>
                    </div>
                    @endforelse
                </div>
            </div>
            <!-- Pagination -->
            <div class="d-flex justify-content-center my-3">
                <nav aria-label="Page navigation">
                    <ul class="pagination">
                        <!-- Previous Page Link -->
                        @if ($products->onFirstPage())
                        <li class="page-item disabled">
                            <span class="page-link text-success bg-light border-success">Previous</span>
                        </li>
                        @else
                        <li class="page-item">
                            <a class="page-link text-success bg-light border-success"
                                href="{{ $products->previousPageUrl() }}" aria-label="Previous">
                                <span aria-hidden="true">&laquo;</span>
                            </a>
                        </li>
                        @endif

                        <!-- Page Number Links -->
                        @foreach ($products->getUrlRange(1, $products->lastPage()) as $page => $url)
                        <li class="page-item {{ $page == $products->currentPage() ? 'active' : '' }}">
                            <a class="page-link {{ $page == $products->currentPage() ? 'text-light bg-success' : 'text-success bg-light border-success' }}"
                                href="{{ $url }}">
                                {{ $page }}
                            </a>
                        </li>
                        @endforeach

                        <!-- Next Page Link -->
                        @if ($products->hasMorePages())
                        <li class="page-item">
                            <a class="page-link text-success bg-light border-success"
                                href="{{ $products->nextPageUrl() }}" aria-label="Next">
                                <span aria-hidden="true">&raquo;</span>
                            </a>
                        </li>
                        @else
                        <li class="page-item disabled">
                            <span class="page-link text-success bg-light border-success">Next</span>
                        </li>
                        @endif
                    </ul>
                </nav>
            </div>
        </div>
    </div>
</div>


@endsection