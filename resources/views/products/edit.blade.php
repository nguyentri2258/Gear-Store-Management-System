@extends('layouts.dashboard')

@section('content')

@include('layouts.alert')

<div class='form-control'>
    <h2>Edit Product</h2>
    <form method='POST' action='{{ route('products.update', $product) }}' enctype="multipart/form-data">
        @csrf
        @method('PUT')
        <div class='mb-3'>
            <label for='name' class='form-label'>Name</label>
            <input type='text' name='name' id='name' class='form-control' placeholder='Enter name' value='{{ old('name', $product->name) }}' required>
        </div>
        <div class='mb-3'>
            <label for='stock' class='form-label'>Stock</label>
            <input type='text' name='stock' id='stock' class='form-control' placeholder='Enter stock' value='{{ old('stock', $product->stock) }}' required>
        </div>
        <div class='mb-3'>
            <label for='price' class='form-label'>Price</label>
            <input type='text' name='price' id='price' class='form-control' placeholder='Enter price' value='{{ old('price', $product->price) }}' required>
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
        <div class="mb-3">
            <label for="information" class="form-label">Information</label>
            <textarea
                name="information"
                id="information"
                class="form-control"
                rows="4"
                placeholder="Enter information"
                style="resize: vertical; overflow-y: auto;"
            >{{ old('information', $product->information) }}</textarea>
        </div>
        <div class="mb-3">
            <label for="description" class="form-label">Description</label>
            <textarea
                name="description"
                id="description"
                class="form-control"
                rows="5"
                placeholder="Enter description"
                style="resize: vertical; overflow-y: auto;"
            >{{ old('description', $product->description) }}</textarea>
        </div>
        <div class="mb-3">
            <label for="note" class="form-label">Note</label>
            <textarea
                name="note"
                id="note"
                class="form-control"
                rows="3"
                placeholder="Enter note"
                style="resize: vertical; overflow-y: auto;"
            >{{ old('note', $product->note) }}</textarea>
        </div>
        <div class="text-center mb-3">
            <img
                id="imagePreview"
                src="{{ $product->image
                    ? asset('storage/'.$product->image)
                    : asset('images/default-thumbnail.jpg') }}"
                style="width:130px;height:130px;border-radius:50%;object-fit:cover;cursor:pointer;">
            <input
                type="file"
                name="image"
                id="imageInput"
                class="d-none">
        </div>
        <button type='submit' class='btn btn-primary'>Update</button>
        <a href="{{ route('products.index') }}" class='btn btn-secondary'>Cancel</a>
    </form>
</div>
@push('scripts')
    <script>
        const imagePreview = document.getElementById('imagePreview');
        const imageInput = document.getElementById('imageInput');

        imagePreview.addEventListener('click', function () {
            imageInput.click();
        });

        imageInput.addEventListener('change', function (e) {
            if (e.target.files.length > 0) {
                const reader = new FileReader();
                reader.onload = function (event) {
                    imagePreview.src = event.target.result;
                };
                reader.readAsDataURL(e.target.files[0]);
            }
        });
    </script>
@endpush
@endsection
