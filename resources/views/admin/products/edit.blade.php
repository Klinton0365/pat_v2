@extends('admin.layout.app')

@section('content')
    {{-- @extends('admin.layout.navbar') --}}
    <div class="content">
        <div class="container-fluid pt-4 px-4">
            <div class="bg-secondary text-center rounded p-4">
                <h6 class="mb-4">Edit Product</h6>

                <form action="{{ route('products.update', $product) }}" method="POST" enctype="multipart/form-data">

                    @csrf
                    @method('PUT')

                    <div class="mb-3 text-start">
                        <label for="category_id" class="form-label">Category</label>
                        <select name="category_id" class="form-control" required>
                            @foreach ($categories as $category)
                                <option value="{{ $category->id }}"
                                    {{ $product->category_id == $category->id ? 'selected' : '' }}>
                                    {{ $category->name }}
                                </option>
                            @endforeach
                        </select>
                        @error('category_id')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>

                    <div class="mb-3 text-start">
                        <label for="name" class="form-label">Product Name</label>
                        <input type="text" name="name" class="form-control" value="{{ $product->name }}" required>
                        @error('name')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>

                    <div class="mb-3 text-start">
                        <label for="description" class="form-label">Description</label>
                        <textarea name="description" class="form-control">{{ $product->description }}</textarea>
                    </div>

                    <div class="mb-3 text-start">
                        <label for="price" class="form-label">Price</label>
                        <input type="number" step="0.01" name="price" class="form-control"
                            value="{{ $product->price }}" required>
                        @error('price')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>

                    <div class="mb-3 text-start">
                        <label for="warranty_months" class="form-label">Warranty (Months)</label>
                        <input type="number" name="warranty_months" class="form-control"
                            value="{{ $product->warranty_months }}">
                    </div>

                    <div class="mb-3">
                        <label for="slug" class="form-label">Slug</label>
                        <input type="text" name="slug" class="form-control"
                            value="{{ old('slug', $product->slug ?? '') }}">
                    </div>

                    <div class="mb-3">
                        <label for="discount" class="form-label">Discount (%)</label>
                        <input type="number" step="0.01" name="discount" class="form-control"
                            value="{{ old('discount', $product->discount ?? 0) }}">
                    </div>

                    <div class="mb-3">
                        <label for="stock" class="form-label">Stock</label>
                        <input type="number" name="stock" class="form-control"
                            value="{{ old('stock', $product->stock ?? 0) }}">
                    </div>

                    <div class="mb-3">
                        <label for="colors" class="form-label">Available Colors</label>
                        <select name="colors[]" class="form-control" multiple>
                            <option value="Red" {{ in_array('Red', $product->colors) ? 'selected' : '' }}>Red</option>

                        </select>
                    </div>

                    <div class="mb-3">
                        <label for="sku" class="form-label">SKU</label>
                        <input type="text" name="sku" class="form-control"
                            value="{{ old('sku', $product->sku ?? '') }}">
                    </div>

                    <div class="mb-3 form-check">
                        <input type="checkbox" name="is_published" class="form-check-input"
                            {{ old('is_published', $product->is_published ?? 1) ? 'checked' : '' }}>
                        <label class="form-check-label">Published</label>
                    </div>

                    <div class="mb-3 form-check">
                        <input type="checkbox" name="publish_home" class="form-check-input"
                            {{ old('publish_home', $product->publish_home ?? 0) ? 'checked' : '' }}>
                        <label class="form-check-label">Show on Homepage</label>
                    </div>

                    <div class="mb-3 form-check">
                        <input type="checkbox" name="featured" class="form-check-input"
                            {{ old('featured', $product->featured ?? 0) ? 'checked' : '' }}>
                        <label class="form-check-label">Featured</label>
                    </div>

                    <div class="form-group">
                        <label for="rating">Rating (0–5)</label>
                        <input type="number" name="rating" id="rating" class="form-control" step="0.1"
                            min="0" max="5" value="{{ old('rating', 0) }}">
                    </div>

                    <div class="mb-3 text-start">
                        <label for="main_image" class="form-label">Main Image</label>
                        <input type="file" name="main_image" class="form-control" accept="image/*">
                        @if ($product->main_image)
                            <div class="mt-2">
                                <img src="{{ asset('storage/' . $product->main_image) }}" alt="Main Image"
                                    width="100">
                            </div>
                        @endif
                        @error('main_image')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>

                    {{-- <div class="mb-3 text-start">
                        <label for="product_images" class="form-label">Product Images (Multiple)</label>
                        <input type="file" name="product_images[]" class="form-control" accept="image/*" multiple>
                        @foreach ($product->product_images as $img)
                            <img src="{{ asset('storage/' . $img) }}" alt="Gallery Image" width="100"
                                class="me-2 mb-2">
                        @endforeach

                        @error('product_images')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div> --}}
                   <div class="mb-3 text-start">
                        <label for="product_images" class="form-label">Product Images (Multiple)</label>

                        {{-- Upload input (always visible) --}}
                        <input type="file" name="product_images[]" class="form-control" accept="image/*" multiple>

                        {{-- Existing images block --}}
                        <div class="mt-2 d-flex flex-wrap">
                            @foreach ($product->product_images as $img)
                                <div class="image-box me-3 mb-3" style="position: relative;">
                                    
                                    <img src="{{ asset('storage/' . $img) }}" 
                                        width="90" height="90" 
                                        style="object-fit:cover;border:1px solid #666; border-radius:6px;">


                                    <button type="button"
                                            class="btn btn-sm btn-danger delete-image-btn"
                                            data-image="{{ $img }}"
                                            data-id="{{ $product->id }}"
                                            style="position:absolute; top:-6px; right:-6px; padding:2px 6px; font-size:11px;">
                                        X
                                    </button>

                                </div>
                            @endforeach
                        </div>

                        @error('product_images')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>



                    <button type="submit" class="btn btn-warning">Update</button>
                    <a href="{{ route('products.index') }}" class="btn btn-secondary">Cancel</a>
                </form>
            </div>
        </div>
    </div>
    <script>
document.addEventListener("DOMContentLoaded", function () {
    document.querySelectorAll(".delete-image-btn").forEach(btn => {
        btn.addEventListener("click", function () {
            if (!confirm("Delete this image?")) return;

            const img = this.dataset.image;
            const id = this.dataset.id;

            const form = document.createElement("form");
            form.method = "POST";
            form.action = `/admin/products/${id}/delete-image`;

            const csrf = document.createElement("input");
            csrf.type = "hidden";
            csrf.name = "_token";
            csrf.value = "{{ csrf_token() }}";

            const method = document.createElement("input");
            method.type = "hidden";
            method.name = "_method";
            method.value = "DELETE";

            const input = document.createElement("input");
            input.type = "hidden";
            input.name = "image";
            input.value = img;

            form.appendChild(csrf);
            form.appendChild(method);
            form.appendChild(input);

            document.body.appendChild(form);
            form.submit();
        });
    });
});
</script>

@endsection
