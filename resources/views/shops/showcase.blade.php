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
                    <span>No Image</span>
                </div>
                <div class="product-body">
                    <div class="product-title">
                        {{ $product->name }}
                    </div>
                    <div class="product-actions">
                        <button class="btn btn-dark btn-sm">
                            Add to Cart
                        </button>
                        <button class="btn btn-outline-dark btn-sm">
                            Buy Now
                        </button>
                    </div>
                </div>
                <a href="{{ route('products.show', $product->id) }}"
                   class="stretched-link"></a>
            </div>
        @endforeach
    </div>
</div>
@endsection
