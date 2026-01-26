@extends('layouts.default')

@section('content')

@include('layouts.alert')

<div class='container'>
    <h2>Products</h2>
    <div class='mb-4'>
        <a href="{{ route('products.create') }}" class='btn btn-primary'>Create Product</a>
    </div>
    <div class='mb-4'>
        <form method="GET" action="{{ route('products.search') }}" class="mb-4">
            <input
                type="text"
                name="name"
                placeholder="Search products"
                class="form-control mb-2"
                value="{{ request('name') }}"
            >
            <button type="submit" class="btn btn-success">Search</button>
        </form>
    </div>
    <div class='mb-4'>
        <table class='table table-striped table-bordered'>
            <thead class='table-dark'>
                <tr class='text-center'>
                    <th>Name</th>
                    <th>Quantity</th>
                    <th>Category</th>
                    <th>Description</th>
                    <th>Edit</th>
                    <th>Delete</th>
                </tr>
            </thead>
            <tbody class='text-center'>
                @forelse($products as $product)
                    <tr>
                        <td>{{ $product->name }}</td>
                        <td>{{ $product->quantity }}</td>
                        <td>{{ $product->category->name }}</td>
                        <td>{{ $product->description }}</td>
                        <td>
                            <a href='{{ route('products.edit', $product) }}' class='btn btn-warning'>Edit</a>
                        </td>
                        <td>
                            <form method='POST' action="{{ route('products.destroy', $product) }}">
                                @csrf
                                @method('DELETE')
                                <button type='submit' class='btn btn-danger'>Delete</button>
                            </form>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan='6'>No products found.</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>
@endsection
