@extends('admin.layout.app')

@section('content')
    @extends('admin.layout.navbar')
    {{-- <div class="content">
        <div class="container-fluid pt-4 px-4">
            <div class="bg-secondary text-center rounded p-4">
                <h6 class="mb-4">Add Product</h6>

                <form action="{{ route('products.store') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="mb-3 text-start">
                        <label for="category_id" class="form-label">Category</label>
                        <select name="category_id" class="form-control" required>
                            <option value="">-- Select Category --</option>
                            @foreach ($categories as $category)
                            <option value="{{ $category->id }}">{{ $category->name }}</option>
                            @endforeach
                        </select>
                        @error('category_id')
                        <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>

                    <div class="mb-3 text-start">
                        <label for="name" class="form-label">Product Name</label>
                        <input type="text" name="name" class="form-control" required>
                        @error('name')
                        <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>

                    <div class="mb-3 text-start">
                        <label for="description" class="form-label">Description</label>
                        <textarea name="description" class="form-control"></textarea>
                    </div>

                    <div class="mb-3 text-start">
                        <label for="price" class="form-label">Price</label>
                        <input type="number" step="0.01" name="price" class="form-control" required>
                        @error('price')
                        <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>

                    <div class="mb-3 text-start">
                        <label for="warranty_months" class="form-label">Warranty (Months)</label>
                        <input type="number" name="warranty_months" class="form-control">
                    </div>

                    <div class="mb-3">
                        <label for="slug" class="form-label">Slug</label>
                        <input type="text" name="slug" class="form-control" value="{{ old('slug', $product->slug ?? '') }}">
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
                            <option value="Red">Red</option>
                            <option value="Blue">Blue</option>
                            <option value="Black">Black</option>
                            <option value="White">White</option>
                            <option value="Green">Green</option>
                        </select>
                        <small class="text-muted">Hold CTRL (Windows) or CMD (Mac) to select multiple</small>
                    </div>


                    <div class="mb-3">
                        <label for="sku" class="form-label">SKU(Stock Keeping Unit) - Unique Identifier</label>
                        <input type="text" name="sku" class="form-control" value="{{ old('sku', $product->sku ?? '') }}">
                    </div>

                    <div class="mb-3 form-check">
                        <input type="checkbox" name="is_published" class="form-check-input" {{ old('is_published',
                            $product->is_published ?? 1) ? 'checked' : '' }}>
                        <label class="form-check-label">Published</label>
                    </div>

                    <div class="mb-3 form-check">
                        <input type="checkbox" name="publish_home" class="form-check-input" {{ old('publish_home',
                            $product->publish_home ?? 0) ? 'checked' : '' }}>
                        <label class="form-check-label">Show on Homepage</label>
                    </div>

                    <div class="mb-3 form-check">
                        <input type="checkbox" name="featured" class="form-check-input" {{ old('featured',
                            $product->featured ?? 0) ? 'checked' : '' }}>
                        <label class="form-check-label">Featured</label>
                    </div>

                    <div class="form-group">
                        <label for="rating">Rating (0–5)</label>
                        <input type="number" name="rating" id="rating" class="form-control" step="0.1" min="0" max="5"
                            value="{{ old('rating', 0) }}">
                    </div>


                    <div class="mb-3 text-start">
                        <label for="main_image" class="form-label">Main Image</label>
                        <input type="file" name="main_image" class="form-control" accept="image/*" required>
                        @error('main_image')
                        <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>

                    <div class="mb-3 text-start">
                        <label for="product_images" class="form-label">Product Images (Multiple)</label>
                        <input type="file" name="product_images[]" class="form-control" accept="image/*" multiple>
                        @error('product_images')
                        <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>

                    <button type="submit" class="btn btn-primary">Save</button>
                    <a href="{{ route('products.index') }}" class="btn btn-secondary">Cancel</a>
                </form>
            </div>
        </div>
    </div> --}}
    {{-- <div class="app-content">
        <div class="container-fluid">

            <h3 class="mb-3">Add Festival Offer</h3> --}}
            <div class="content">
                <div class="container-fluid pt-4 px-4">
                    <div class="bg-secondary text-center rounded p-4">
                        <h6 class="mb-4">Add Festival Offer</h6>

                        <form action="{{ route('admin.festival-offers.store') }}" method="POST">
                            @csrf

                            <div class="mb-3">
                                <label>Select Product</label>
                                <select name="product_id" class="form-control" required>
                                    <option value="">Choose Product</option>
                                    @foreach($products as $product)
                                        <option value="{{ $product->id }}">{{ $product->name }}</option>
                                    @endforeach
                                </select>
                            </div>

                            <div class="mb-3">
                                <label>Offer Title</label>
                                <input type="text" name="title" class="form-control" required
                                    placeholder="Eg: Diwali Special Discount">
                            </div>

                            <div class="mb-3">
                                <label>Slug</label>
                                <input type="text" name="slug" class="form-control" required
                                    placeholder="eg: diwali-special-offer">
                            </div>

                            <div class="mb-3">
                                <label>Offer Price</label>
                                <input type="number" step="0.01" name="offer_price" class="form-control"
                                    placeholder="Eg: 4999">
                            </div>

                            <div class="row">
                                <div class="col-md-6 mb-3">
                                    <label>Start Date</label>
                                    <input type="date" name="start_date" class="form-control">
                                </div>

                                <div class="col-md-6 mb-3">
                                    <label>End Date</label>
                                    <input type="date" name="end_date" class="form-control">
                                </div>
                            </div>

                            <div class="mb-3">
                                <label>Description</label>
                                <textarea name="description" rows="4" class="form-control"></textarea>
                            </div>

                            <button class="btn btn-success">Save Offer</button>
                            <a href="{{ route('admin.festival-offers.index') }}" class="btn btn-secondary">Cancel</a>
                        </form>
                    </div>
                </div>
            </div>
@endsection