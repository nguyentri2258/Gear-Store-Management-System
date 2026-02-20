@extends('layouts.default')

@section('content')

<div class="container-fluid p-0">
    <section class="hero-section d-flex align-items-center text-white">
        <div class="container text-center">
            <h1 class="fw-bold display-5 mb-3">
                Build Your Dream PC
            </h1>
            <p class="lead mb-4">
                High-performance CPU, GPU, RAM and more – authentic products, best prices.
            </p>
            <a href="{{ route('products.shop') }}" class="btn btn-light btn-lg px-4">
                Shop Now
            </a>
        </div>
    </section>
</div>


<div class="container py-5">
    <h3 class="fw-bold mb-4 text-center">Popular Categories</h3>
    <div class="row g-4 mb-5">
        @foreach($categories ?? [] as $category)
            <div class="col-md-3 col-sm-6">
                <a href="{{ route('categories.show', $category->id) }}" class="text-decoration-none">
                    <div class="category-card text-center p-4">
                        <h5 class="fw-semibold">{{ $category->name }}</h5>
                    </div>
                </a>
            </div>
        @endforeach
    </div>

    <h3 class="fw-bold mb-4 text-center">Latest Products</h3>

    <div class="row g-4">
        @foreach($products ?? [] as $product)
            <div class="col-md-3 col-sm-6">
                <div class="home-product-card">
                    <div class="home-product-image">
                        <img
                            src="{{ $product->image
                                ? asset('uploads/'.$product->image)
                                : asset('images/default-thumbnail.jpg') }}">
                    </div>

                    <div class="p-3">
                        <div class="fw-semibold mb-2">
                            {{ $product->name }}
                        </div>

                        <div class="text-danger fw-bold mb-3">
                            {{ number_format($product->price) }} ₫
                        </div>

                        <a href="{{ route('products.show', $product->id) }}"
                           class="btn btn-dark btn-sm w-100">
                            View Detail
                        </a>
                    </div>
                </div>
            </div>
        @endforeach
    </div>
</div>

<style>
    .hero-section {
        background: linear-gradient(135deg, #111, #333);
        height: 420px;
    }

    .category-card {
        background: #f8f9fa;
        border-radius: 12px;
        transition: 0.2s ease;
    }

    .category-card:hover {
        background: #111;
        color: #fff;
    }

    .home-product-card {
        border: 1px solid #eee;
        border-radius: 12px;
        overflow: hidden;
        transition: 0.2s ease;
        background: #fff;
    }

    .home-product-card:hover {
        box-shadow: 0 8px 20px rgba(0,0,0,0.08);
    }

    .home-product-image {
        height: 200px;
        overflow: hidden;
        background: #f5f5f5;
    }

    .home-product-image img {
        width: 100%;
        height: 100%;
        object-fit: cover;
    }

    @media (max-width: 768px) {
        .hero-section {
            height: 300px;
        }
    }
</style>

@endsection
