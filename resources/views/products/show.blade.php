@extends('layouts.dashboard')

@section('content')

<div class="container py-4">
    <h2 class="mb-4">Product #{{ $product->id }}</h2>
        <div class="card shadow-sm">
            <div class="card-header bg-dark text-white">
                Product Information
            </div>

            <div class="card-body">
                <div class="product-image-box">
                    <img
                        src="{{ $product->image
                            ? asset('storage/'.$product->image)
                            : asset('images/default-thumbnail.jpg') }}"
                        class="main-image">
                </div>
                <p><strong>Name:</strong> {{ $product->name }}</p>
                <p><strong>Stock:</strong> {{ $product->stock }}</p>
                <p><strong>Category:</strong> {{ $product->category->name }}</p>
                <p><strong>Information:</strong> {{ $product->information }}</p>
                <p><strong>Description:</strong> {{ $product->description }}</p>
                <p><strong>Note:</strong> {{ $product->note ?? '-' }}</p>
            </div>
        </div>
    </div>

    <div class="mt-4">
        <a href="{{ route('products.index') }}" class="btn btn-secondary">
            ← Back to Products
        </a>
    </div>

</div>
<style>
    .product-image-box {
        width: 100%;
        height: 400px;
        border-radius: 12px;
        overflow: hidden;
        background: #f5f5f5;
        display: flex;
        align-items: center;
        justify-content: center;
    }

    .main-image {
        width: 100%;
        height: 100%;
        object-fit: contain;
        transition: transform 0.3s ease;
    }
</style>

@endsection
