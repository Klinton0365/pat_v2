@extends('admin.layout.app')

@section('content')
@extends('admin.layout.navbar')
    <div class="content">
<div class="container-fluid pt-4 px-4">
    <div class="bg-secondary text-center rounded p-4">
        <h6 class="mb-4">Edit Category</h6>

        <form action="{{ route('categories.update', $category) }}" method="POST">
            @csrf
            @method('PUT')

            <div class="mb-3 text-start">
                <label for="name" class="form-label">Category Name</label>
                <input type="text" name="name" class="form-control" value="{{ $category->name }}" required>
                @error('name') <span class="text-danger">{{ $message }}</span> @enderror
            </div>

            <div class="mb-3 text-start">
                <label for="description" class="form-label">Description</label>
                <textarea name="description" class="form-control">{{ $category->description }}</textarea>
            </div>

            <button type="submit" class="btn btn-warning">Update</button>
            <a href="{{ route('categories.index') }}" class="btn btn-secondary">Cancel</a>
        </form>
    </div>
</div>
</div>
@endsection
