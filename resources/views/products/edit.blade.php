@extends('layouts.dashboard')

@section('content')

@include('layouts.alert')

<div class='form-control'>
    <h2>Edit Product</h2>
    <form method='POST' action='{{ route('products.update', $product) }}'>
        @csrf
        @method('PUT')
        <div class='mb-3'>
            <label for='name' class='form-label'>Name</label>
            <input type='text' name='name' id='name' class='form-control' placeholder='Enter name' value='{{ old('name', $product->name) }}' required>
        </div>
        <div class='mb-3'>
            <label for='quantity' class='form-label'>Quantity</label>
            <input type='text' name='quantity' id='quantity' class='form-control' placeholder='Enter quantity' value='{{ old('quantity', $product->quantity) }}' required>
        </div>
        <div class='mb-3'>
            <label class='form-label'>Category</label>
            <select name="category_id" class="form-control" required>
                <option value="" disable selected hidden>Choose category</option>
                @foreach ($categories as $category)
                    <option value="{{ $category->id }}"
                        {{ old('category_id', $product->category_id) == $category->id ? 'selected' : ''}}>
                        {{ $category->name }}
                    </option>
                @endforeach
            </select>
        </div>
        <div class='mb-3'>
            <label for='description' class='form-label'>Description</label>
            <input type='text' name='description' id='description' class='form-control' placeholder='Enter description' value='{{ old('description', $product->description) }}'>
        </div>
        <button type='submit' class='btn btn-primary'>Update</button>
        <a href="{{ route('products.index') }}" class='btn btn-secondary'>Cancel</a>
    </form>
</div>
@endsection
