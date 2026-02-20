<nav class="custom-navbar">
    <div class="container navbar-grid">
        <div class="nav-left">
            <button class="menu-btn"
                    type="button"
                    data-bs-toggle="offcanvas"
                    data-bs-target="#sidebar">☰</button>
            <a class="brand" href="{{ route('home') }}">MyShop</a>
        </div>
        <div class="nav-center desktop-only">
            <form method="GET"
                  action="{{ route('products.search') }}"
                  class="search-box">
                <input type="text"
                       name="name"
                       placeholder="Search products..."
                       value="{{ request('name') }}">
                <button type="submit" class="search-btn">
                    <i class="bi bi-search"></i>
                </button>
            </form>
        </div>
        <div class="nav-right">
            <button class="icon-btn mobile-only"
                    onclick="toggleSearch()">
                <i class="bi bi-search"></i>
            </button>

            <a href="#" class="cart-link">
                <i class="bi bi-cart3"></i>
                <span class="cart-badge">2</span>
            </a>

            <a href="{{ route('users.login') }}" class="login-btn">
                Login
            </a>
        </div>
    </div>
    <div class="mobile-search" id="mobileSearch">
        <form method="GET"
              action="{{ route('products.search') }}"
              class="search-box">
            <input type="text"
                   name="name"
                   placeholder="Search products..."
                   autofocus>
            <button type="submit" class="search-btn">
                <i class="bi bi-search"></i>
            </button>
            <button type="button"
                    class="close-btn"
                    onclick="toggleSearch()">✖</button>
        </form>
    </div>
</nav>

<div class="offcanvas offcanvas-start bg-dark"
     tabindex="-1"
     id="sidebar">
    <div class="offcanvas-header text-white">
        <h5 class="fw-bold m-0">Menu</h5>
        <button type="button"
                class="btn-close btn-close-white"
                data-bs-dismiss="offcanvas"></button>
    </div>
    <div class="offcanvas-body">
        <ul class="nav flex-column gap-2 sidebar-menu">
            <li>
                <a class="nav-link {{ request()->routeIs('products.shop') ? 'active' : '' }}"
                   href="{{ route('products.shop') }}">
                    All Products
                </a>
            </li>

            <hr class="text-secondary">

            @foreach($categories as $cat)
                <li>
                    <a class="nav-link {{ request()->is('categories/'.$cat->id) ? 'active' : '' }}"
                       href="{{ route('categories.show', $cat->id) }}">
                        {{ $cat->name }}
                    </a>
                </li>
            @endforeach
        </ul>
    </div>
</div>


<style>
    .custom-navbar {
        background: linear-gradient(90deg,#111,#1c1c1c);
        padding: 14px 0;
        position: sticky;
        top: 0;
        z-index: 1000;
    }

    .navbar-grid {
        display: grid;
        grid-template-columns: auto 1fr auto;
        align-items: center;
        gap: 24px;
    }

    .nav-left,
    .nav-right {
        display: flex;
        align-items: center;
        gap: 14px;
    }

    .nav-center {
        display: flex;
        justify-content: center;
    }

    .search-box {
        display: flex;
        background: #fff;
        border-radius: 40px;
        overflow: hidden;
        width: 100%;
        max-width: 700px;
    }

    .search-box input {
        flex: 1;
        border: none;
        padding: 10px 18px;
        outline: none;
    }

    .search-btn {
        background: #000;
        border: none;
        padding: 0 18px;
        color: #fff;
    }

    .menu-btn,
    .icon-btn {
        background: transparent;
        border: 1px solid #555;
        color: #fff;
        padding: 6px 10px;
        border-radius: 8px;
    }

    .brand {
        font-size: 22px;
        font-weight: 700;
        color: #fff;
        text-decoration: none;
    }

    .cart-link {
        position: relative;
        color: #fff;
        font-size: 22px;
    }

    .cart-badge {
        position: absolute;
        top: -6px;
        right: -8px;
        background: red;
        color: #fff;
        font-size: 11px;
        padding: 3px 6px;
        border-radius: 50%;
    }

    .login-btn {
        padding: 6px 18px;
        border-radius: 30px;
        border: 1px solid #fff;
        color: #fff;
        text-decoration: none;
    }

    .mobile-search {
        display: none;
        padding: 10px;
        background: #111;
    }

    .mobile-search.active {
        display: block;
    }

    .close-btn {
        background: transparent;
        border: none;
        color: #fff;
        padding: 0 14px;
    }

    .desktop-only { display: flex; }
    .mobile-only { display: none; }

    @media (max-width: 768px) {

        .navbar-grid {
            grid-template-columns: auto auto;
        }

        .nav-center {
            display: none;
        }

        .desktop-only {
            display: none;
        }

        .mobile-only {
            display: inline-flex;
        }
    }


    .sidebar-menu .nav-link {
        color: #f8f9fa;
        padding: 10px 12px;
        border-radius: 6px;
    }

    .sidebar-menu .nav-link:hover {
        background: #2c2c2c;
    }

    .sidebar-menu .nav-link.active {
        background: #f8f9fa;
        color: #000;
        font-weight: 600;
    }
</style>
@push('scripts')
<script>
    function toggleSearch() {
        document.getElementById('mobileSearch')
            .classList.toggle('active');
    }
</script>
@endpush
