<nav class="navbar navbar-expand-lg bg-success" data-bs-theme="dark">
    <div class="container-fluid">
        <a class="navbar-brand ms-5" href="{{ route('home') }}"><i class="fa-solid fa-leaf"></i>PlantNest</a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav"
            aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav ms-auto me-auto">
                <li class="nav-item">
                    <a class="nav-link {{ request()->is('/') ? 'active' : '' }}" aria-current="page"
                        href="{{ route('home') }}">Home</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link {{ request()->is('shop') ? 'active' : '' }}"
                        href="{{ route('shop.index') }}">Shop</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link {{ request()->is('about') ? 'active' : '' }}"
                        href="{{ route('about') }}">About</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link {{ request()->is('contact') ? 'active' : '' }}"
                        href="{{ route('contact') }}">Contact Us</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link {{ request()->is('track') ? 'active' : '' }}"
                        href="{{ route('track.order.form') }}">Track Order</a>
                </li>
            </ul>
            <ul class="navbar-nav me-5 d-flex flex-row" data-bs-theme="light">
                <li class="nav-item">
                    <a href="{{ Auth::check() ? route('cart.index') : route('login') }}"
                        class="nav-link px-2 text-white">
                        <i class="fa-solid fa-cart-shopping"></i>
                    </a>
                </li>
                <li class="nav-item ms-3 dropdown-center">
                    @if(Auth::check())
                    <button class="nav-link px-2 text-white" type="button" data-bs-toggle="dropdown"
                        aria-expanded="false">
                        {{ Auth::user()->name }}
                    </button>
                    @else
                    <button class="nav-link px-2 text-white" type="button" data-bs-toggle="dropdown"
                        aria-expanded="false">
                        <i class="fa-regular fa-user"></i>
                    </button>
                    @endif
                    <ul class="dropdown-menu dropdown-menu-start dropdown-menu-lg-end" data-bs-theme="light">
                        @auth
                        {{-- Check if the user is authenticated and has an admin role --}}
                        @if(auth()->user()->role === 1)
                        <li><a class="dropdown-item fw-bold" href="{{ route('dashboard') }}">Dashboard</a></li>
                        @endif
                        <li>
                            <form method="POST" action="{{ route('logout') }}" onsubmit="return confirmLogout()">
                                @csrf
                                <button type="submit" class="dropdown-item fw-bold">Logout</button>
                            </form>
                        </li>
                        @else
                        {{-- If the user is not authenticated, show Login and Register --}}
                        <li><a class="dropdown-item fw-bold" href="{{ route('login') }}">Login</a></li>
                        <li><a class="dropdown-item fw-bold" href="{{ route('register') }}">Sign Up</a></li>
                        @endauth
                    </ul>
                </li>
            </ul>
        </div>
    </div>
</nav>

<script>
function confirmLogout() {
    return confirm('Are you sure you want to log out?');
}
</script>