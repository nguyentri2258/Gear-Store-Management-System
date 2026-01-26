@extends('layouts.default')

@section('content')

@include('layouts.alert')

<div class='container'>
    <div class='mb-4'>
        <h2>Category</h2>
        <div class='mb-4'>
            <a class='btn btn-success' href="{{ route('categories.create') }}">Create Category</a>
        </div>
        <table class='table table-stripped table-bordered'>
            <thead class='table-dark'>
                <tr class='text-center'>
                    <th>Name</th>
                    <th>Note</th>
                    <th>Edit</th>
                    <th>Delete</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($categories as $category)
                    <tr class="text-center">
                        <td>{{ $category->name }}</td>
                        <td>{{ $category->note }}</td>
                        <td>
                            <a href="{{ route('categories.edit', $category)}}" class='btn btn-warning'>Edit</a>
                        </td>
                        <td>
                            <form method="POST" action="{{ route('categories.destroy', $category) }}">
                                @csrf
                                @method('DELETE')
                                    <button type='submit' class='btn btn-danger'>Delete</button>
                            </form>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan='4'>No category found</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>
@endsection
