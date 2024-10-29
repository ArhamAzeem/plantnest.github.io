<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('front_title', '| PlantNest')</title>
    <link rel="stylesheet" href="{{ asset('frontend_assets')}}/bootstrap.min.css">
    <link rel="stylesheet" href="{{ asset('frontend_assets')}}/style.css">
    <link rel="icon" href="{{ asset('favicon.png') }}" type="image/png"/>
    <script src="https://kit.fontawesome.com/8672e0d49a.js" crossorigin="anonymous"></script>

</head>

@yield('app_content')

<div class="container my-5 p-5 rounded-5" style="background-color: rgb(237, 235, 235);">
    <div class="row text-center text-center gx-4 gx-md-5" id="payment">
        <div class="col-md-4 mb-4">
            <div class="d-flex flex-column align-items-center">
                <i class="fa-solid fa-truck mb-3 fs-2 text-success"></i>
                <h5 class="mb-2">Free Delivery</h5>
                <p class="mb-0 text-muted">For all orders above $45</p>
            </div>
        </div>
        <div class="col-md-4 mb-4">
            <div class="d-flex flex-column align-items-center">
                <i class="fa-regular fa-credit-card mb-3 fs-2 text-success"></i>
                <h5 class="mb-2">Secure Payment</h5>
                <p class="mb-0 text-muted">Confidence on all your devices</p>
            </div>
        </div>
        <div class="col-md-4">
            <div class="d-flex flex-column align-items-center">
                <i class="fa-solid fa-rotate-left mb-3 fs-2 text-success"></i>
                <h5 class="mb-2">180 Days Easy Return</h5>
                <p class="mb-0 text-muted">180 days return</p>
            </div>
        </div>
    </div>
</div>

<footer class="bg-success text-white py-5">
    <div class="container">
        <div class="row gx-5 border-top border-bottom border-white py-5 ">
            <!-- Contact Information -->
            <div class="col-md-4 mb-4 mb-md-0 border-end">
                <h5>Garden Care</h5>
                <p class="mb-1">Aptech Metro Star Gate, Karachi, 7500, PK</p>
                <p class="mb-1">92-300-000-0000</p>
                <p class="mb-0"><a href="mailto:arhamazeem318@gmail.com" class="text-decoration-none text-white"></a>arhamazeem318@gmail.com</p>
            </div>

            <!-- Social Media Links -->
            <div class="col-md-4 mb-4 mb-md-0 text-center text-md-start">
                <h3 class="mb-3">
                    <i class="fa-solid fa-spa me-2 fs-3"></i>Plantt
                </h3>
                <p class="mb-4">
                    The seed of gardening is a love that never dies, but it never grows to enduring happiness that the love of gardening provides to nature.
                </p>
                <div class="d-flex justify-content-center justify-content-md-start gap-2">
                    <a href="#" class="btn p-2 text-white">
                        <i class="fa-brands fa-instagram fs-5"></i>
                    </a>
                    <a href="#" class="btn p-2  text-white">
                        <i class="fa-brands fa-facebook-f fs-5"></i>
                    </a>
                    <a href="#" class="btn p-2  text-white">
                        <i class="fa-brands fa-twitter fs-5"></i>
                    </a>
                </div>
            </div>

            <!-- Navigation Links -->
            <div class="col-md-4 mb-4 mb-md-0 border-start d-flexx flex-column justify-content-center align-items-center">
                <h5 class="mb-3">Pages</h5>
                <ul class="list-unstyled">
                    <li><a href="{{ route('home') }}" class="text-white text-decoration-none d-block mb-2">Home</a></li>
                    <li><a href="{{ route('shop.index') }}" class="text-white text-decoration-none d-block mb-2">Shop</a></li>
                    <li><a href="{{ route('cart.index') }}" class="text-white text-decoration-none d-block mb-2">Cart</a></li>
                    <li><a href="{{ route('about') }}" class="text-white text-decoration-none d-block mb-2">About</a></li>
                    <li><a href="{{ route('contact') }}" class="text-white text-decoration-none d-block mb-2">Contact Us</a></li>
                </ul>
            </div>
        </div>
    </div>
</footer>

    <script src="{{ asset('frontend_assets')}}/bootstrap.bundle.min.js">
    </script>
</body>

</html>