@extends('layouts.dashboard')

@section('content')

@include('layouts.alert')

<div class="container py-4">
    <h2 class="mb-4">Orders Management</h2>
    <form method="GET" action="{{ route('orders.search') }}" class="row g-2 mb-4">
        <div class="col-md-4">
            <input type="text"
                   name="name"
                   placeholder="Search by name..."
                   class="form-control"
                   value="{{ request('name') }}">
        </div>
        <div class="col-md-2">
            <button type="submit" class="btn btn-success w-100">
                Search
            </button>
        </div>
    </form>
    <div class="table-responsive">
        <table class="table table-bordered table-hover align-middle">
            <thead class="table-dark text-center">
                <tr>
                    <th>ID</th>
                    <th>Name</th>
                    <th>Phone</th>
                    <th>Note</th>
                    <th>Ordered At</th>
                    <th>Status</th>
                    <th width="200">Actions</th>
                </tr>
            </thead>
            <tbody class="text-center">
                @forelse($orders as $order)
                    <tr>
                        <td>{{ $order->id }}</td>
                        <td>{{ $order->name }}</td>
                        <td>{{ $order->phone }}</td>
                        <td>
                            <small>{{ $order->note ?? '-' }}</small>
                        </td>
                        <td>
                            {{ $order->created_at->format('d/m/Y H:i') }}
                        </td>
                        <td>
                            <form action="{{ route('orders.update', $order) }}"
                                  method="POST">
                                @csrf
                                @method('PUT')

                                <select name="status"
                                        class="form-select form-select-sm"
                                        onchange="this.form.submit()">

                                    <option value="pending"
                                        {{ $order->status == 'pending' ? 'selected' : '' }}>
                                        Pending
                                    </option>

                                    <option value="processing"
                                        {{ $order->status == 'processing' ? 'selected' : '' }}>
                                        Processing
                                    </option>

                                    <option value="shipping"
                                        {{ $order->status == 'shipping' ? 'selected' : '' }}>
                                        Shipping
                                    </option>

                                    <option value="completed"
                                        {{ $order->status == 'completed' ? 'selected' : '' }}>
                                        Completed
                                    </option>

                                    <option value="cancelled"
                                        {{ $order->status == 'cancelled' ? 'selected' : '' }}>
                                        Cancelled
                                    </option>
                                </select>
                            </form>
                        </td>
                        <td>
                            <div class="d-flex justify-content-center gap-2">

                                <a href="{{ route('orders.show', $order) }}"
                                   class="btn btn-sm btn-info">
                                    Show
                                </a>

                                @if($order->status == 'pending')
                                    <a href="{{ route('orders.edit', $order) }}"
                                       class="btn btn-sm btn-warning">
                                        Edit
                                    </a>
                                @endif

                            </div>
                        </td>
                    </tr>

                @empty
                    <tr>
                        <td colspan="7">
                            No orders found.
                        </td>
                    </tr>
                @endforelse

            </tbody>
        </table>
    </div>
</div>

@endsection
