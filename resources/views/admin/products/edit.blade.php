@extends('admin.layout.app')

@section('content')
@extends('admin.layout.navbar')
    <div class="content">
<div class="container-fluid pt-4 px-4">
    <div class="bg-secondary text-center rounded p-4">
        <h6 class="mb-4">Edit Product</h6>

        <form action="{{ route('products.update', $product) }}" method="POST">
            @csrf
            @method('PUT')

            <div class="mb-3 text-start">
                <label for="category_id" class="form-label">Category</label>
                <select name="category_id" class="form-control" required>
                    @foreach($categories as $category)
                        <option value="{{ $category->id }}" {{ $product->category_id == $category->id ? 'selected':'' }}>
                            {{ $category->name }}
                        </option>
                    @endforeach
                </select>
                @error('category_id') <span class="text-danger">{{ $message }}</span> @enderror
            </div>

            <div class="mb-3 text-start">
                <label for="name" class="form-label">Product Name</label>
                <input type="text" name="name" class="form-control" value="{{ $product->name }}" required>
                @error('name') <span class="text-danger">{{ $message }}</span> @enderror
            </div>

            <div class="mb-3 text-start">
                <label for="description" class="form-label">Description</label>
                <textarea name="description" class="form-control">{{ $product->description }}</textarea>
            </div>

            <div class="mb-3 text-start">
                <label for="price" class="form-label">Price</label>
                <input type="number" step="0.01" name="price" class="form-control" value="{{ $product->price }}" required>
                @error('price') <span class="text-danger">{{ $message }}</span> @enderror
            </div>

            <div class="mb-3 text-start">
                <label for="warranty_months" class="form-label">Warranty (Months)</label>
                <input type="number" name="warranty_months" class="form-control" value="{{ $product->warranty_months }}">
            </div>

            <button type="submit" class="btn btn-warning">Update</button>
            <a href="{{ route('products.index') }}" class="btn btn-secondary">Cancel</a>
        </form>
    </div>
</div>
    </div>
@endsection
