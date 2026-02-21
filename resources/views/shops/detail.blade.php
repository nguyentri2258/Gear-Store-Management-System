@extends('layouts.default')

@section('content')

<div class="container py-4">
    <div class="row g-4">
        <div class="col-lg-5">
            <div class="product-image-box">
                <img
                    src="{{ $product->image
                        ? asset('uploads/'.$product->image)
                        : asset('images/default-thumbnail.jpg') }}"
                    class="main-image">
            </div>
        </div>

        <div class="col-lg-7">

            <h4 class="fw-bold mb-2">
                {{ $product->name }}
            </h4>

            <div class="text-muted small mb-2">
                View: {{ $product->views ?? 0 }} |
                Status:
                <span class="text-success fw-semibold">
                    {{ $product->quantity ? 'In stock' : 'Out of stock' }}
                </span>
            </div>

            <div class="price-box mb-3">
                <div class="product-price">
                    {{ number_format($product->price) }} đ
                </div>
            </div>

            <div class="d-grid gap-2 mb-3">
                <form action="{{ route('cart.add', $product->id) }}" method="POST">
                    @csrf
                    <button type="submit" class="btn btn-primary btn-lg w-100">
                        🛒 Add to cart
                    </button>
                </form>

                <form action="{{ route('cart.add', $product->id) }}" method="POST">
                    @csrf
                    <button type="submit" class="btn btn-danger btn-lg w-100"
                            formaction="{{ route('cart.add', $product->id) }}"
                            onclick="this.form.action='{{ route('cart.add', $product->id) }}';">
                        Buy now
                    </button>
                </form>
            </div>

            <div class="product-specs mt-4">
                <h6 class="fw-bold mb-2">Info</h6>
                <ul class="list-unstyled small">
                    <li>Socket:</li>
                    <li>Operating Frequency:</li>
                    <li>Performance Cores:</li>
                    <li>Efficient Cores:</li>
                    <li>Warranty:</li>
                </ul>
            </div>

        </div>
    </div>

    <div class="mt-5">
        <h5 class="fw-bold mb-3">Description</h5>
        <div class="product-description">
            {!! nl2br(e($product->description)) !!}
        </div>
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

    .product-image-box:hover .main-image {
        transform: scale(1.05);
    }

    .price-box .product-price {
        color: red;
        font-size: 26px;
        font-weight: 700;
    }

    .product-specs ul li {
        padding: 4px 0;
        border-bottom: 1px dashed #ddd;
    }

    .product-description {
        background: #fafafa;
        padding: 20px;
        border-radius: 12px;
    }
</style>
@endsection
