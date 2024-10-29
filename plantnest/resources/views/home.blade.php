@extends('frontend_partials.main_layout')
@section('front_title', 'Home')

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

                           <!-- Images -->


<!-- Main Container -->
<div class="container-fluid bg-light p-5" style="background-color: rgb(211, 225, 211);">
  <div class="container">
    <div class="row align-items-center mb-5">
      <!-- Images and Text Section -->
      <div class="col-md-3 d-flex justify-content-center mb-4 mb-md-0">
        <img src="{{ asset('frontend_assets')}}/images/leave 2.png" alt="Tree Plant" class="img-fluid" style="height: 300px; width: auto;">
      </div>

      <div class="col-md-6 text-center mb-4 mb-md-0">
        <pre class="fw-bolder fs-1">Trees Plants to Grow in</pre>
        <p class="display-4 text-muted">Your Living Room</p>
        <button class="btn btn-success mt-3 rounded-5 px-3"><a href="{{ route('shop.index') }}" class="text-decoration-none text-white fw-bold">Shop Now</a></button>
      </div>

      <div class="col-md-3 d-flex justify-content-center mb-4 mb-md-0">
        <img src="{{ asset('frontend_assets')}}/images/leave 1.png" alt="Tree Plant" class="img-fluid" style="height: 300px; width: auto;">
      </div>
    </div>

    <!-- Content Section -->
    <div class="row">
      <!-- Left Box -->
      <div class="col-md-5 mb-4">
        <div class="box p-4 bg-white rounded-5 shadow-sm">
          <p class="text-center small">Tree-planting is the process of transplanting tree seedlings, generally for forestry, land reclamation, or other purposes. It differs from the transplantation of larger trees in arboriculture.</p>
          <a href="#" class="d-block text-success text-center mt-3">Learn more <i class="fa-solid fa-arrow-right"></i></a>
          <div class="row mt-4 text-center">
            <div class="col">
              <p class="display-4 font-weight-bold">200+<blockquote class="font-size-small">Plant Species</blockquote></p>
            </div>
            <div class="col">
              <p class="display-4 font-weight-bold">1.2k<blockquote class="font-size-small">Members Joined</blockquote></p>
            </div>
          </div>
        </div>
      </div>

      <!-- Right Box with Image -->
      <div class="col-md-7">
        <div class="box2 rounded-5 overflow-hidden shadow-sm">
          <img src="https://www.shutterstock.com/image-photo/gardener-working-nursery-inside-flower-260nw-2323828933.jpg" alt="Gardener" class="img-fluid w-100" style="height: 300px; object-fit: cover; object-position: top;">
        </div>
      </div>
    </div>
  </div>
</div>



<!-- 4 images section -->
<div class="container mt-5">
  <div class="row text-center">
    <div class="col-md-3 col-sm-6 mb-4">
      <img src="{{ asset('frontend_assets')}}/images/plant_care-removebg-preview-removebg-preview.png" alt="Garden Care" class="img-fluid" style="max-height: 120px; width: auto;">
      <h4 class="mt-3">Garden Care</h4>
      <p class="small">Our Garden care section offers expert tips and advice to help you nurture a healthy, beautiful garden year-round.</p>
    </div>
    <div class="col-md-3 col-sm-6 mb-4">
      <img src="{{ asset('frontend_assets')}}/images/plant_renovation-removebg-preview.png" alt="Plant Renovation" class="img-fluid" style="max-height: 120px; width: auto;">
      <h4 class="mt-3">Plant Renovation</h4>
      <p class="small">Our plant renovation section provides expert guidance on revitalizing and transforming your plant for a fresher, healthy look.</p>
    </div>
    <div class="col-md-3 col-sm-6 mb-4">
      <img src="{{ asset('frontend_assets')}}/images/plant_seed-removebg-preview.png" alt="Seed Supply" class="img-fluid" style="max-height: 120px; width: auto;">
      <h4 class="mt-3">Seed Supply</h4>
      <p class="small">Our seed supply section offers a diverse range of premium seeds, providing everything you need to start and grow a vibrant garden.</p>
    </div>
    <div class="col-md-3 col-sm-6 mb-4">
      <img src="{{ asset('frontend_assets')}}/images/plant_watering-removebg-preview.png" alt="Watering Garden" class="img-fluid" style="max-height: 120px; width: auto;">
      <h4 class="mt-3">Watering Garden</h4>
      <p class="small">Our watering garden section offers essential tips and techniques for effectively watering your plants ensuring they thrive and flourish.</p>
    </div>
  </div>
</div>


<div class="container my-5">
    <div class="row text-center">
        <h1>Latest Plants</h1>
    </div>
    <div class="row py-5" id="products">
        @forelse ($plantProducts as $product)
        <div class="col col-6 col-lg-3 col-xl-3">
            <div class="card h-100 border-0 text-center position-relative product-card overflow-hidden">
                <!-- Discount Tag -->
                @if ($product->discount_percentage)
                <span
                    class="badge bg-danger position-absolute top-0 start-0 m-3 rounded-5">{{ $product->discount_percentage }}%
                    OFF</span>
                @endif

                <!-- Image Container -->
                <div class="position-relative">
                    <img src="{{ asset('storage/' . $product->image_path) }}"
                        class="card-img-top rounded-5 transition border" alt="{{ $product->name }}">

                    <!-- Icon Container -->
                    <div
                        class="icon-container d-flex flex-column gap-2 position-absolute top-50 end-0 translate-middle-y pe-3">
                        <form action="{{ route('cart.add') }}" method="POST">
                            @csrf
                            <input type="hidden" name="product_id" value="{{ $product->id }}">
                            <input type="hidden" name="quantity" value="1"> <!-- Default quantity for product card -->
                            <button type="submit" class="btn btn-dark btn-sm rounded-circle mb-1 icon">
                                <i class="fas fa-shopping-cart"></i>
                            </button>
                        </form>
                        <a href="{{ route('shop.show', [$product->category->name, $product->category->type, $product->name]) }}"
                            class="btn btn-dark btn-sm rounded-circle mb-1 icon"><i class="fas fa-search"></i></a>
                    </div>
                </div>

                <!-- Card Body -->
                <div class="card-body">
                    <h5 class="card-title fs-6 fw-bold"><a
                            href="{{ route('shop.show', [$product->category->name, $product->category->type, $product->name]) }}"
                            class='text-decoration-none text-dark fs-6 fw-bold'>{{ $product->name }}</a></h5>
                    <p class="card-text fw-bold">${{ number_format($product->price, 2) }}</p>
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


<!-- Shop Category Section -->
<div class="container my-5 p-5 rounded-5" id="shopcat"  style="background-color: rgb(211, 225, 211);">
    <div class="text-center mb-4">
        <h1>Shop by Category</h1>
        <p class="lead">Shop by category to find the perfect plants, tools, and accessories for your garden. Discover a wide range of products tailored to your gardening needs.</p>
    </div>

    <div class="row text-center">
        <div class="col-md-6 col-lg-3 mb-4">
            <a href="{{ route('shop.index', ['sub_category' => 2]) }}" class="d-block text-decoration-none text-black">
                <div class="position-relative">
                    <div class="bg-secondary rounded-3 overflow-hidden" style="background-image: url('https://t4.ftcdn.net/jpg/05/96/24/45/360_F_596244540_dc3YeAon65yvAUVIQWWFni2sOE3f6OqK.jpg'); background-size: cover; background-position: center; height: 230px;"></div>
                    <h5 class="mt-2">Out Door</h5>
                </div>
            </a>
        </div>

        <div class="col-md-6 col-lg-3 mb-4">
            <a href="{{ route('shop.index', ['sub_category' => 1]) }}" class="d-block text-decoration-none text-black">
                <div class="position-relative">
                    <div class="bg-secondary rounded-3 overflow-hidden" style="background-image: url('https://cdn.shopify.com/s/files/1/0068/4215/5090/t/115/assets/b2df66a3fbdb--PDP-6in-Flamingo-Flower-White-Ceramic-01_360x.jpg?v=1708137039'); background-size: cover; background-position: center; height: 230px;"></div>
                    <h5 class="mt-2">In Door</h5>
                </div>
            </a>
        </div>

        <div class="col-md-6 col-lg-3 mb-4">
            <a href="{{ route('shop.index', ['sub_category' => 9]) }}" class="d-block text-decoration-none text-black">
                <div class="position-relative">
                    <div class="bg-secondary rounded-3 overflow-hidden" style="background-image: url('https://nurserylive.com/cdn/shop/products/nurserylive-combo-packs-plants-evergreen-plants-for-terrace-garden-16968851325068.jpg?v=1634219247'); background-size: cover; background-position: center; height: 230px;"></div>
                    <h5 class="mt-2">Terrace & Balcony</h5>
                </div>
            </a>
        </div>

        <div class="col-md-6 col-lg-3 mb-4">
            <a href="{{ route('shop.index', ['sub_category' => 3]) }}" class="d-block text-decoration-none text-black">
                <div class="position-relative">
                    <div class="bg-secondary rounded-3 overflow-hidden" style="background-image: url('https://nurserylive.com/cdn/shop/products/nurserylive-g-best-3-table-top-office-desk-plants-to-bring-prosperity-123727.jpg?v=1679749249'); background-size: cover; background-position: center; height: 230px;"></div>
                    <h5 class="mt-2">Office Desk</h5>
                </div>
            </a>
        </div>
    </div>
</div>

<div class="container my-5">
    <div class="row text-center">
        <h1>Accessories</h1>
    </div>
    <div class="row py-5" id="products">
        @forelse ($accessoryProducts as $product)
        <div class="col col-6 col-lg-3 col-xl-3">
            <div class="card h-100 border-0 text-center position-relative product-card overflow-hidden">
                <!-- Discount Tag -->
                @if ($product->discount_percentage)
                <span
                    class="badge bg-danger position-absolute top-0 start-0 m-3 rounded-5">{{ $product->discount_percentage }}%
                    OFF</span>
                @endif

                <!-- Image Container -->
                <div class="position-relative">
                    <img src="{{ asset('storage/' . $product->image_path) }}"
                        class="card-img-top rounded-5 transition border" alt="{{ $product->name }}" style="height: 250px;">

                    <!-- Icon Container -->
                    <div
                        class="icon-container d-flex flex-column gap-2 position-absolute top-50 end-0 translate-middle-y pe-3">
                        <form action="{{ route('cart.add') }}" method="POST">
                            @csrf
                            <input type="hidden" name="product_id" value="{{ $product->id }}">
                            <input type="hidden" name="quantity" value="1"> <!-- Default quantity for product card -->
                            <button type="submit" class="btn btn-dark btn-sm rounded-circle mb-1 icon">
                                <i class="fas fa-shopping-cart"></i>
                            </button>
                        </form>
                        <a href="{{ route('shop.show', [$product->category->name, $product->category->type, $product->name]) }}"
                            class="btn btn-dark btn-sm rounded-circle mb-1 icon"><i class="fas fa-search"></i></a>
                    </div>
                </div>

                <!-- Card Body -->
                <div class="card-body">
                    <h5 class="card-title fs-6 fw-bold"><a
                            href="{{ route('shop.show', [$product->category->name, $product->category->type, $product->name]) }}"
                            class='text-decoration-none text-dark fs-6 fw-bold'>{{ $product->name }}</a></h5>
                    <p class="card-text fw-bold">${{ number_format($product->price, 2) }}</p>
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