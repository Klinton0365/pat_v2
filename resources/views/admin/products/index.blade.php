@extends('admin.layout.app')

@section('content')
@extends('admin.layout.navbar')
    <div class="content">
<div class="container-fluid pt-4 px-4">
    <div class="bg-secondary text-center rounded p-4">
        <div class="d-flex align-items-center justify-content-between mb-4">
            <h6 class="mb-0">Products</h6>
            <a href="{{ route('products.create') }}" class="btn btn-sm btn-primary">Add Product</a>
        </div>
        <div class="table-responsive">
            <table class="table text-start align-middle table-bordered table-hover mb-0">
                <thead>
                    <tr class="text-white">
                        <th>#</th>
                        <th>Name</th>
                        <th>Category</th>
                        <th>Price</th>
                        <th>Warranty (Months)</th>
                        <th>Created</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($products as $product)
                        <tr>
                            <td>{{ $loop->iteration }}</td>
                            <td>{{ $product->name }}</td>
                            <td>{{ $product->category->name }}</td>
                            <td>${{ number_format($product->price, 2) }}</td>
                            <td>{{ $product->warranty_months ?? 'N/A' }}</td>
                            <td>{{ $product->created_at->format('d M Y') }}</td>
                            <td>
                                <a href="{{ route('products.edit', $product) }}" class="btn btn-sm btn-warning">Edit</a>
                                <form action="{{ route('products.destroy', $product) }}" method="POST" style="display:inline-block;">
                                    @csrf @method('DELETE')
                                    <button class="btn btn-sm btn-danger" onclick="return confirm('Delete this product?')">Delete</button>
                                </form>
                            </td>
                        </tr>
                    @empty
                        <tr><td colspan="7">No Products Found</td></tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>
</div>
@endsection
