@extends('layouts.default')

@section('content')

<div class="container py-5">
    <h2 class="text-center mb-5">
        {{ isset($category) ? $category->name : 'Our Products' }}
    </h2>
    <div class="product-grid">
        @foreach($products as $product)
            <div class="product-card">
                <div class="product-image">
                    <img
                        src="{{ $product->image
                            ? asset('uploads/'.$product->image)
                            : asset('images/default-thumbnail.jpg') }}"
                        class="product-img">
                </div>
                <div class="product-actions d-flex gap-2">

                    <form action="{{ route('cart.add', $product->id) }}" method="POST" class="w-50">
                        @csrf
                        <button type="submit" class="btn btn-dark btn-sm w-100">
                            Add to Cart
                        </button>
                    </form>

                    <form action="{{ route('cart.add', $product->id) }}" method="POST" class="w-50">
                        @csrf
                        <button type="submit" class="btn btn-outline-dark btn-sm w-100">
                            Buy Now
                        </button>
                    </form>

                </div>
                <a href="{{ route('products.show', $product->id) }}"
                   class="stretched-link"></a>
            </div>
        @endforeach
    </div>
</div>
<style>
    .product-grid {
        display: grid;
        grid-template-columns: repeat(auto-fill, minmax(250px, 1fr));
        gap: 24px;
    }

    .product-card {
        border: 1px solid #eee;
        border-radius: 10px;
        overflow: hidden;
        background: #fff;
        transition: 0.2s ease;
        position: relative;
    }

    .product-card:hover {
        box-shadow: 0 6px 20px rgba(0,0,0,0.08);
    }

    .product-image {
        width: 100%;
        height: 220px;
        overflow: hidden;
        background: #f8f8f8;
    }

    .product-img {
        width: 100%;
        height: 100%;
        object-fit: cover;
    }

    .product-body {
        padding: 15px;
    }

    .product-title {
        font-weight: 600;
        margin-bottom: 10px;
    }
</style>
@endsection
