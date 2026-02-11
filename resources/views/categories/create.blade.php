@extends('layouts.dashboard')

@section('content')

@include('layouts.alert')

<div class='form-control'>
    <div class="px-4 py-4">
        <h2>Create Category</h2>
        <form method="POST" action="{{ route('categories.store') }}">
            @csrf
            <div class='mb-4'>
                <label for="name" class="form-label">Name</label>
                <input type="text" name="name" id="name" class="form-control" placeholder="Name" value="{{ old('name') }}" required>
            </div>
            <div class='mb-4'>
                <label for="note" class="form-label">Note</label>
                <input type="text" name="note" id="note" class="form-control" placeholder="Note" value="{{ old('note') }}">
            </div>
            <button type="submit" class="btn btn-primary">Create</button>
            <a href="{{ route('categories.index') }}" class="btn btn-secondary">Cancel</a>
        </form>
    </div>
</div>

@endsection
