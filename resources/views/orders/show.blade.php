@extends('layouts.dashboard')

@section('content')

<div class="container py-4">
    <h2 class="mb-4">Order #{{ $order->id }}</h2>
    <div class="row g-4">
        <div class="col-lg-5">
            <div class="card shadow-sm">
                <div class="card-header bg-dark text-white">
                    Customer Information
                </div>

                <div class="card-body">
                    <p><strong>Name:</strong> {{ $order->name }}</p>
                    <p><strong>Email:</strong> {{ $order->email }}</p>
                    <p><strong>Phone:</strong> {{ $order->phone }}</p>
                    <p><strong>Address:</strong> {{ $order->address }}</p>
                    <p><strong>Note:</strong> {{ $order->note ?? '-' }}</p>
                    <p>
                        <strong>Status:</strong>
                        <span class="badge bg-primary">
                            {{ ucfirst($order->status) }}
                        </span>
                    </p>
                    <p>
                        <strong>Ordered At:</strong>
                        {{ $order->created_at->format('d/m/Y H:i') }}
                    </p>
                </div>
            </div>
        </div>

        <div class="col-lg-7">
            <div class="card shadow-sm">
                <div class="card-header bg-secondary text-white">
                    Order Items
                </div>

                <div class="card-body p-0">
                    <table class="table mb-0 text-center align-middle">
                        <thead class="table-light">
                            <tr>
                                <th>Product</th>
                                <th>Price</th>
                                <th>Quantity</th>
                                <th>Total</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($order->items as $item)
                                <tr>
                                    <td class="text-start">
                                        {{ $item->product->name ?? 'Product deleted' }}
                                    </td>
                                    <td>
                                        {{ number_format($item->price) }} ₫
                                    </td>
                                    <td>
                                        {{ $item->quantity }}
                                    </td>
                                    <td>
                                        {{ number_format($item->price * $item->quantity) }} ₫
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>

                <div class="card-footer text-end">
                    <h5>
                        Total:
                        <span class="text-danger">
                            {{ number_format($order->total_price) }} ₫
                        </span>
                    </h5>
                </div>
            </div>
        </div>

    </div>

    <div class="mt-4">
        <a href="{{ route('orders.index') }}" class="btn btn-secondary">
            ← Back to Orders
        </a>
    </div>

</div>

@endsection
