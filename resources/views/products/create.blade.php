@extends('layouts.dashboard')

@section('content')

@include('layouts.alert')

<div class='form-control'>
    <h2>Create Product</h2>
    <form method='POST' action='{{ route('products.store') }}' enctype="multipart/form-data">
        @csrf
        <div class='mb-3'>
            <label for='name' class='form-label'>Name</label>
            <input type='text' name='name' id='name' class='form-control' placeholder='Enter name' value='{{ old('name') }}' required>
        </div>
        <div class='mb-3'>
            <label for='quantity' class='form-label'>Quantity</label>
            <input type='text' name='quantity' id='quantity' class='form-control' placeholder='Enter quantity' value='{{ old('quantity') }}' required>
        </div>
        <div class='mb-3'>
            <label for='price' class='form-label'>Price</label>
            <input type='number' min="0" step="1" name='price' id='price' class='form-control' placeholder='Enter price' value='{{ old('price') }}' required>
        </div>
        <div class='mb-3'>
            <label class='form-label'>Category</label>
            <select name="category_id" class="form-control" required>
                <option value="" disabled selected hidden>Choose category</option>
                @foreach ($categories as $category)
                    <option value="{{ $category->id }}"
                        {{ old('category_id') == $category->id ? 'selected' : ''}}>
                        {{ $category->name }}
                    </option>
                @endforeach
            </select>
        </div>
        <div class='mb-3'>
            <label for='description' class='form-label'>Description</label>
            <input type='text' name='description' id='description' class='form-control' placeholder='Enter description' value='{{ old('description') }}'>
        </div>
        <div class="text-center mb-3">
            <img
                id="imagePreview"
                src="{{ asset('images/default-thumbnail.jpg') }}"
                style="width:130px;height:130px;border-radius:50%;object-fit:cover;cursor:pointer;">
            <input
                type="file"
                name="image"
                id="imageInput"
                class="d-none">
        </div>
        <button type='submit' class='btn btn-primary'>Create</button>
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
