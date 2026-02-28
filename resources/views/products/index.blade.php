@extends('layouts.dashboard')

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
                    <th>Image</th>
                    <th>Stock</th>
                    <th>Note</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody class='text-center'>
                @forelse($products as $product)
                    <tr>
                        <td>{{ $product->name }}</td>
                        <td>
                            <img
                                src="{{ $product->image
                                    ? asset('storage/'.$product->image)
                                    : asset('images/default-thumbnail.jpg') }}"
                                width="80">
                        </td>
                        <td>{{ $product->stock }}</td>
                        <td>{{ $product->note }}</td>
                        <td>
                            <div class="d-flex justify-content-center gap-2">
                                <a href="{{ route('products.show', $product) }}"
                                   class="btn btn-sm btn-info">
                                    Show
                                </a>
                                <a href='{{ route('products.edit', $product) }}'
                                    class='btn btn-warning'>
                                    Edit
                                </a>
                                <form method='POST' action="{{ route('products.destroy', $product) }}">
                                    @csrf
                                    @method('DELETE')
                                    <button type='submit' class='btn btn-danger'>Delete</button>
                                </form>
                            </div>
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
