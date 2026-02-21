@extends('layouts.default')

@section('content')

<div class="container py-5">
    <h2 class="text-center fw-bold mb-5">
        {{ isset($category) ? $category->name : 'Our Products' }}
    </h2>
    <div class="product-grid">
        @foreach($products as $product)
            <div class="product-card">
                <a href="{{ route('products.show', $product->id) }}" class="product-image">
                    <img
                        src="{{ $product->image
                            ? asset('uploads/'.$product->image)
                            : asset('images/default-thumbnail.jpg') }}"
                        class="product-img">
                </a>
                <div class="product-body">
                    <a href="{{ route('products.show', $product->id) }}"
                       class="product-title text-decoration-none">
                        {{ $product->name }}
                    </a>
                    <div class="product-price">
                        {{ number_format($product->price) }} ₫
                    </div>
                    <div class="product-actions">
                        <form action="{{ route('cart.add', $product->id) }}" method="POST">
                            @csrf
                            <button type="submit" class="btn btn-dark btn-sm w-100">
                                Add to Cart
                            </button>
                        </form>
                        <a href="{{ route('products.show', $product->id) }}"
                           class="btn btn-outline-dark btn-sm w-100">
                            View Detail
                        </a>
                    </div>
                </div>
            </div>
        @endforeach
    </div>
</div>

<style>
    .product-grid {
        display: grid;
        grid-template-columns: repeat(auto-fill, minmax(240px, 1fr));
        gap: 28px;
    }

    .product-card {
        border: 1px solid #eee;
        border-radius: 14px;
        overflow: hidden;
        background: #fff;
        transition: all 0.25s ease;
    }

    .product-card:hover {
        box-shadow: 0 10px 25px rgba(0,0,0,0.08);
        transform: translateY(-4px);
    }

    .product-image {
        display: block;
        height: 220px;
        background: #f6f6f6;
        overflow: hidden;
    }

    .product-img {
        width: 100%;
        height: 100%;
        object-fit: contain;
        transition: 0.3s ease;
    }

    .product-card:hover .product-img {
        transform: scale(1.05);
    }

    .product-body {
        padding: 18px;
    }

    .product-title {
        display: block;
        font-weight: 600;
        color: #111;
        margin-bottom: 6px;
        min-height: 44px;
    }

    .product-title:hover {
        color: #000;
    }

    .product-price {
        font-weight: 700;
        color: #e60023;
        margin-bottom: 14px;
    }

    .product-actions {
        display: flex;
        flex-direction: column;
        gap: 8px;
    }

    @media (max-width: 768px) {
        .product-image {
            height: 180px;
        }
    }
</style>

@endsection
