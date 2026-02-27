@extends('layouts.default')

@section('content')

<div class="container py-5">
    <div class="row g-5">
        <div class="col-lg-7">
            <div class="checkout-card p-4">

                <h4 class="fw-bold mb-4">Checkout Information</h4>

                @if(session('error'))
                    <div class="alert alert-danger">
                        {{ session('error') }}
                    </div>
                @endif

                <form action="{{ route('checkout.process') }}" method="POST">
                    @csrf

                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label class="form-label">Full Name</label>
                            <input type="text"
                                   name="name"
                                   value="{{ old('name', Auth::user()->name ?? '') }}"
                                   class="form-control"
                                   required>
                        </div>

                        <div class="col-md-6 mb-3">
                            <label class="form-label">Phone</label>
                            <input type="text"
                                   name="phone"
                                   value="{{ old('phone', Auth::user()->phone ?? '') }}"
                                   class="form-control"
                                   required>
                        </div>
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Email</label>
                        <input type="email"
                               name="email"
                               value="{{ old('email', Auth::user()->email ?? '') }}"
                               class="form-control"
                               required>
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Address</label>
                        <textarea name="address"
                                  class="form-control"
                                  rows="3"
                                  required>{{ old('address') }}</textarea>
                    </div>

                    <div class="mb-4">
                        <label class="form-label">Note (optional)</label>
                        <textarea name="note"
                                  class="form-control"
                                  rows="2">{{ old('note') }}</textarea>
                    </div>

                    <button type="submit" class="btn btn-dark w-100 btn-lg">
                        Place Order
                    </button>
                </form>

            </div>
        </div>

        <div class="col-lg-5">
            <div class="checkout-summary p-4">

                <h5 class="fw-bold mb-4">Order Summary</h5>

                @php
                    $cartItems = Auth::check()
                        ? Auth::user()->cart?->items
                        : session('cart', []);

                    $total = 0;
                @endphp

                @if($cartItems)

                    @foreach($cartItems as $item)

                        @php
                            if(Auth::check()){
                                $product = $item->product;
                                $price = $product->price;
                                $quantity = $item->quantity;
                                $image = $product->image;
                                $name = $product->name;
                            } else {
                                $price = $item['price'];
                                $quantity = $item['quantity'];
                                $image = $item['image'];
                                $name = $item['name'];
                            }

                            $total += $price * $quantity;
                        @endphp

                        <div class="d-flex align-items-center mb-3">
                            <div class="summary-image me-3">
                                <img src="{{ $image
                                    ? asset('storage/'.$image)
                                    : asset('images/default-thumbnail.jpg') }}">
                            </div>

                            <div class="flex-grow-1">
                                <div class="fw-semibold">{{ $name }}</div>
                                <div class="small text-muted">
                                    {{ number_format($price) }} ₫ × {{ $quantity }}
                                </div>
                            </div>

                            <div class="fw-bold">
                                {{ number_format($price * $quantity) }} ₫
                            </div>
                        </div>

                    @endforeach

                    <hr>

                    <div class="d-flex justify-content-between mb-2">
                        <span>Subtotal</span>
                        <span>{{ number_format($total) }} ₫</span>
                    </div>

                    <div class="d-flex justify-content-between mb-2">
                        <span>Shipping</span>
                        <span>Free</span>
                    </div>

                    <hr>

                    <div class="d-flex justify-content-between">
                        <span class="fw-bold">Total</span>
                        <span class="fw-bold text-danger fs-5">
                            {{ number_format($total) }} ₫
                        </span>
                    </div>

                @else
                    <div class="text-center py-4">
                        <p>Your cart is empty.</p>
                    </div>
                @endif

            </div>
        </div>

    </div>
</div>


<style>
    .checkout-card,
    .checkout-summary {
        border: 1px solid #eee;
        border-radius: 12px;
        background: #fff;
    }

    .summary-image {
        width: 60px;
        height: 60px;
        border-radius: 8px;
        overflow: hidden;
        background: #f5f5f5;
    }

    .summary-image img {
        width: 100%;
        height: 100%;
        object-fit: cover;
    }

    .checkout-summary {
        background: #fafafa;
    }

    .form-control:focus {
        box-shadow: none;
        border-color: #000;
    }
</style>

@endsection
