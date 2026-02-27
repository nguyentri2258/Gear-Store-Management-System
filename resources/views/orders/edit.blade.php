@extends('layouts.dashboard')

@section('content')

@include('layouts.alert')

<div class="container">
    <h2 class="mb-4">Edit Order #{{ $order->id }}</h2>

    <form method="POST" action="{{ route('orders.update', $order) }}">
        @csrf
        @method('PUT')
        <div class="card mb-4">
            <div class="card-header bg-dark text-white">
                Customer Information
            </div>
            <div class="card-body">
                <div class="row">
                    <div class="col-md-6 mb-3">
                        <label class="form-label">Name</label>
                        <input type="text"
                               name="name"
                               class="form-control"
                               value="{{ old('name', $order->name) }}"
                               required>
                    </div>

                    <div class="col-md-6 mb-3">
                        <label class="form-label">Phone</label>
                        <input type="text"
                               name="phone"
                               class="form-control"
                               value="{{ old('phone', $order->phone) }}"
                               required>
                    </div>

                    <div class="col-md-12 mb-3">
                        <label class="form-label">Address</label>
                        <input type="text"
                               name="address"
                               class="form-control"
                               value="{{ old('address', $order->address) }}"
                               required>
                    </div>

                    <div class="col-md-12 mb-3">
                        <label class="form-label">Note</label>
                        <textarea name="note"
                                  class="form-control"
                                  rows="3">{{ old('note', $order->note) }}</textarea>
                    </div>
                </div>
            </div>
        </div>

        <div class="card mb-4">
            <div class="card-header bg-primary text-white">
                Order Items
            </div>
            <div class="card-body p-0">
                <table class="table table-bordered mb-0">
                    <thead class="table-light text-center">
                        <tr>
                            <th>Product</th>
                            <th width="120">Price</th>
                            <th width="120">Quantity</th>
                            <th width="120">Subtotal</th>
                            <th width="80">Remove</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($order->items as $item)
                            <tr class="text-center align-middle">
                                <td>
                                    {{ $item->product->name }}
                                </td>

                                <td>
                                    {{ number_format($item->price) }} đ
                                </td>

                                <td>
                                    <input type="number"
                                           name="items[{{ $item->id }}][quantity]"
                                           value="{{ $item->quantity }}"
                                           min="0"
                                           class="form-control quantity-input">
                                </td>

                                <td class="subtotal">
                                    {{ number_format($item->price * $item->quantity) }} đ
                                </td>

                                <td>
                                    <input type="checkbox"
                                           name="items[{{ $item->id }}][remove]"
                                           value="1">
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>

        <div class="text-end mb-4">
            <h4>
                Total:
                <span id="orderTotal">
                    {{ number_format($order->total_price) }} đ
                </span>
            </h4>
        </div>

        <div class="text-end">
            <button type="submit" class="btn btn-success">
                Update Order
            </button>

            <a href="{{ route('orders.index') }}" class="btn btn-secondary">
                Cancel
            </a>
        </div>
    </form>
</div>

@push('scripts')
<script>
    function recalcTotal() {
        let total = 0;

        document.querySelectorAll('tbody tr').forEach(function(row) {
            const price = parseFloat(row.children[1].innerText.replace(/[^0-9]/g, ''));
            const quantityInput = row.querySelector('.quantity-input');
            const subtotalCell = row.querySelector('.subtotal');

            const quantity = parseInt(quantityInput.value) || 0;
            const subtotal = price * quantity;

            subtotalCell.innerText = subtotal.toLocaleString() + ' đ';
            total += subtotal;
        });

        document.getElementById('orderTotal').innerText =
            total.toLocaleString() + ' đ';
    }

    document.querySelectorAll('.quantity-input').forEach(function(input) {
        input.addEventListener('input', recalcTotal);
    });
</script>
@endpush

@endsection
