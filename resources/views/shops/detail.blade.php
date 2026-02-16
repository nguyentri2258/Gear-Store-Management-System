@extends('layouts.default')

@section('content')
<div class="container py-4">
    <div class="row g-4">
        <div class="col-lg-5">
            <div class="product-image-box">
                <span>No Image</span>
            </div>

            <div class="d-flex gap-2 mt-3">
                @foreach($product->images ?? [] as $img)
                    <img src="{{ asset('storage/'.$img) }}"
                         class="thumb-img">
                @endforeach
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
                    {{ $product->in_stock ? 'In stock' : 'Out of stock' }}
                </span>
            </div>

            <div class="price-box mb-3">
                @if($product->old_price)
                    <div class="old-price">
                        {{ number_format($product->old_price) }} đ
                    </div>
                @endif

                <div class="new-price">
                    {{ number_format($product->price) }} đ
                </div>
            </div>

            <div class="d-grid gap-2 mb-3">
                <button class="btn btn-primary btn-lg">
                    🛒 Add to cart
                </button>

                <button class="btn btn-danger btn-lg">
                    Buy now
                </button>
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
        border-radius: 12px;
        overflow: hidden;
        background: #f5f5f5;
        padding: 10px;
    }

    .main-image {
        width: 100%;
        object-fit: contain;
    }

    .thumb-img {
        width: 70px;
        height: 70px;
        object-fit: cover;
        border-radius: 8px;
        border: 1px solid #ddd;
        cursor: pointer;
    }

    .thumb-img:hover {
        border-color: #000;
    }

    .price-box .old-price {
        text-decoration: line-through;
        color: #888;
        font-size: 16px;
    }

    .price-box .new-price {
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
