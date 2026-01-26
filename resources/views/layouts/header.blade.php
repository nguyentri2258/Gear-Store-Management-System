<nav class="navbar navbar-expand-lg navbar-dark bg-dark shadow-sm mb-4 py-4">
    <div class="container d-flex align-items-center gap-5">
        <button class="btn btn-outline-light btn-sm"
                type="button"
                data-bs-toggle="offcanvas"
                data-bs-target="#sidebar"
                aria-controls="sidebar">
            ☰
        </button>
        <a class="navbar-brand fw-bold fs-3 me-2" href="/">
            My Shop
        </a>
        <form method="GET"
              action="{{ route('products.search') }}"
              class="d-flex flex-grow-1 mx-3">
            <input
                type="text"
                name="name"
                placeholder="Search products..."
                class="form-control rounded-start"
                value="{{ request('name') }}"
            >
            <button type="submit" class="btn btn-success rounded-end">
                🔍
            </button>
        </form>
        <div class="d-flex align-items-center gap-3">
            <a class="nav-link text-white" href="">
                🛒 Cart
            </a>
            <a class="btn btn-outline-light btn-sm" href="">
                Login
            </a>
        </div>
    </div>
</nav>

<div class="offcanvas offcanvas-start bg-light"
    tabindex="-1"
    id="sidebar"
    aria-labelledby="sidebarLabel">
    <div class="offcanvas-header bg-dark text-white">
        <h5 class="offcanvas-title fw-bold" id="sidebarLabel">
            Menu
        </h5>
        <button type="button" class="btn-close btn-close-white"
                data-bs-dismiss="offcanvas"></button>
    </div>
    <div class="offcanvas-body p-3 bg-dark">
        <ul class="nav flex-column gap-2 sidebar-menu">
            <li class="nav-item">
                <a class="nav-link
                    {{ request()->routeIs('products.*') ? 'active' : '' }}"
                href="{{ route('products.index') }}">
                    Products
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link
                    {{ request()->routeIs('categories.*') ? 'active' : '' }}"
                href="{{ route('categories.index') }}">
                    Categories
                </a>
            </li>
        </ul>
    </div>
</div>
<style>
    .sidebar-menu .nav-link {
        color: #f8f9fa;
        border-radius: 6px;
        padding: 10px 12px;
    }

    .sidebar-menu .nav-link:hover {
        background-color: #2c2c2c;
        color: #fff;
    }

    .sidebar-menu .nav-link.active {
        background-color: #f8f9fa;
        color: #000;
        font-weight: 600;
    }
</style>
