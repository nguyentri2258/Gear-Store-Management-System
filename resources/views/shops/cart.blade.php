@extends('layouts.default')

@section('content')

<div class="container py-5">
    <h2 class="fw-bold mb-4">Shopping Cart</h2>

    <div class="row g-4">
        <div class="col-lg-8">

            @forelse($cart as $id => $item)

            <div class="cart-item d-flex align-items-center p-3 mb-3">

                <div class="cart-image me-3">
                    <img src="{{ $item['image']
                        ? asset('uploads/'.$item['image'])
                        : asset('images/default-thumbnail.jpg') }}">
                </div>

                <div class="flex-grow-1">
                    <div class="fw-semibold">
                        {{ $item['name'] }}
                    </div>

                    <div class="text-muted small mb-2">
                        {{ number_format($item['price']) }} ₫
                    </div>

                    <form action="{{ route('cart.update', $id) }}" method="POST">
                        @csrf
                        <div class="quantity-box d-flex align-items-center">
                            <input type="number"
                                name="quantity"
                                value="{{ $item['quantity'] }}"
                                min="1"
                                class="form-control form-control-sm"
                                style="width:80px">

                            <button class="btn btn-sm btn-dark ms-2">
                                Update
                            </button>
                        </div>
                    </form>
                </div>

                <div class="text-end ms-3">
                    <div class="fw-bold mb-2">
                        {{ number_format($item['price'] * $item['quantity']) }} ₫
                    </div>

                    <form action="{{ route('cart.remove', $id) }}" method="POST">
                        @csrf
                        <button class="btn btn-sm btn-outline-danger">
                            Remove
                        </button>
                    </form>
                </div>

            </div>

            @empty
                <div class="text-center py-5">
                    <h5>Your cart is empty 🛒</h5>
                    <a href="{{ route('products.shop') }}" class="btn btn-dark mt-3">
                        Continue Shopping
                    </a>
                </div>
            @endforelse

        </div>

        <div class="col-lg-4">
            <div class="cart-summary p-4">

                <h5 class="fw-bold mb-3">Order Summary</h5>

                <div class="d-flex justify-content-between mb-2">
                    <span>Subtotal</span>
                    <span class="fw-semibold">
                        {{ number_format($total ?? 0) }} ₫
                    </span>
                </div>

                <div class="d-flex justify-content-between mb-2">
                    <span>Shipping</span>
                    <span>Free</span>
                </div>

                <hr>

                <div class="d-flex justify-content-between mb-3">
                    <span class="fw-bold">Total</span>
                    <span class="fw-bold text-danger">
                        {{ number_format($total ?? 0) }} ₫
                    </span>
                </div>

                <button class="btn btn-dark w-100 btn-lg">
                    Proceed to Checkout
                </button>

            </div>
        </div>

    </div>
</div>


<style>
    .cart-item {
        border: 1px solid #eee;
        border-radius: 12px;
        background: #fff;
    }

    .cart-image {
        width: 90px;
        height: 90px;
        overflow: hidden;
        border-radius: 8px;
        background: #f5f5f5;
    }

    .cart-image img {
        width: 100%;
        height: 100%;
        object-fit: cover;
    }

    .cart-summary {
        border: 1px solid #eee;
        border-radius: 12px;
        background: #fafafa;
    }
</style>

@endsection
