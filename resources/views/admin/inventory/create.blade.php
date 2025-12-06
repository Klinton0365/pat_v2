@extends('admin.layout.app')

@section('content')
{{-- <div class="container-fluid pt-4 px-4">
    <div class="bg-secondary rounded p-4">

        <h4 class="text-light mb-4">Add New Stock</h4> --}}
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/flatpickr/dist/flatpickr.min.css">

    <div class="content">
        <div class="container-fluid pt-4 px-4">
            <div class="bg-secondary text-center rounded p-4">
                <h6 class="mb-4">Add New Stock</h6>

        <form action="{{ route('inventories.store') }}" method="POST">
            @csrf

            <div class="row">

                <div class="col-md-6 mb-3">
                    <label class="text-light">Product</label>
                    <select name="product_id" class="form-control">
                        @foreach($products as $p)
                        <option value="{{ $p->id }}">{{ $p->name }}</option>
                        @endforeach
                    </select>
                </div>

                <div class="col-md-6 mb-3">
                    <label class="text-light">Quantity</label>
                    <input type="number" name="quantity" class="form-control">
                </div>

                <div class="col-md-6 mb-3">
                    <label class="text-light">Purchase Price (Per Unit)</label>
                    <input type="number" step="0.01" name="purchase_price" class="form-control">
                </div>

                <div class="col-md-6 mb-3">
                    <label class="text-light">Supplier</label>
                    <input type="text" name="supplier_name" class="form-control">
                </div>

            </div>

            <button class="btn btn-primary mt-3">Save</button>

        </form>

</div>
        </div>
    </div>
@endsection
