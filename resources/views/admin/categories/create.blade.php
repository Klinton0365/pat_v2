@extends('admin.layout.app')

@section('content')
@extends('admin.layout.navbar')
    <div class="content">
<div class="container-fluid pt-4 px-4">
    <div class="bg-secondary text-center rounded p-4">
        <h6 class="mb-4">Add Category</h6>

        <form action="{{ route('categories.store') }}" method="POST">
            @csrf
            <div class="mb-3 text-start">
                <label for="name" class="form-label">Category Name</label>
                <input type="text" name="name" class="form-control" required>
                @error('name') <span class="text-danger">{{ $message }}</span> @enderror
            </div>

            <div class="mb-3 text-start">
                <label for="description" class="form-label">Description</label>
                <textarea name="description" class="form-control"></textarea>
            </div>

            <button type="submit" class="btn btn-primary">Save</button>
            <a href="{{ route('categories.index') }}" class="btn btn-secondary">Cancel</a>
        </form>
    </div>
</div>
    </div>
@endsection
