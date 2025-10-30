@extends('admin.layout.app')

@section('content')
<!-- Flatpickr CSS -->
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/flatpickr/dist/flatpickr.min.css">

    {{-- @extends('admin.layout.navbar') --}}

    <div class="content">
        <div class="container-fluid pt-4 px-4">
            <div class="bg-secondary text-center rounded p-4">
                <h6 class="mb-4">Add Festival Offer</h6>

                <form action="{{ route('admin.festival-offers.store') }}" method="POST">
                    @csrf

                    {{-- <div class="mb-3">
                        <label>Select Product</label>
                        <select name="product_id" class="form-control" required>
                            <option value="">Choose Product</option>
                            @foreach($products as $product)
                                <option value="{{ $product->id }}">{{ $product->name }}</option>
                            @endforeach
                        </select>
                    </div> --}}
                    <div class="mb-3">
                        <label>Select Product</label>
                        <select name="product_id" id="product_id" class="form-control" required>
                            <option value="">Choose Product</option>
                            @foreach($products as $product)
                                <option value="{{ $product->id }}">{{ $product->name }}</option>
                            @endforeach
                        </select>
                    </div>

                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label>Product Price</label>
                            <input type="text" id="product_price" class="form-control" readonly>
                        </div>

                        <div class="col-md-6 mb-3">
                            <label>Product Discount (%)</label>
                            <input type="text" id="product_discount" class="form-control" readonly>
                        </div>
                    </div>

                    <div class="mb-3">
                        <label>Offer Title</label>
                        <input type="text" name="title" class="form-control" required
                            placeholder="Eg: Diwali Special Discount">
                    </div>

                    <div class="mb-3">
                        <label>Slug</label>
                        <input type="text" name="slug" class="form-control" required placeholder="eg: diwali-special-offer">
                    </div>

                    <div class="mb-3">
                        <label>Offer Price</label>
                        <input type="number" step="0.01" name="offer_price" class="form-control" placeholder="Eg: 4999">
                    </div>
                    <div class="mb-3">
                        <label>Offer Type</label>
                        <select name="is_percentage" class="form-control" required>
                            <option value="0">Amount</option>
                            <option value="1">Percentage</option>
                        </select>
                    </div>

                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label>Start Date</label>
                            <div class="input-group">
                                <input type="text" id="start_date" name="start_date" class="form-control" placeholder="Select start date">
                                <span class="input-group-text"><i class="fa fa-calendar"></i></span>
                            </div>
                        </div>

                        <div class="col-md-6 mb-3">
                            <label>End Date</label>
                            <div class="input-group">
                                <input type="text" id="end_date" name="end_date" class="form-control" placeholder="Select end date">
                                <span class="input-group-text"><i class="fa fa-calendar"></i></span>
                            </div>
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
<script>
$(function () {
    $('#startDatePicker').datetimepicker({
        format: 'YYYY-MM-DD'
    });
    $('#endDatePicker').datetimepicker({
        format: 'YYYY-MM-DD',
        useCurrent: false
    });

    // Make End Date always after Start Date
    $("#startDatePicker").on("change.datetimepicker", function (e) {
        $('#endDatePicker').datetimepicker('minDate', e.date);
    });
});
</script>

<!-- jQuery (if not already loaded) -->
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

<!-- Flatpickr JS -->
<script src="https://cdn.jsdelivr.net/npm/flatpickr"></script>

<script>
$(document).ready(function() {
    // Flatpickr setup
    flatpickr("#start_date", {
        dateFormat: "Y-m-d"
    });
    flatpickr("#end_date", {
        dateFormat: "Y-m-d"
    });

    // Fetch product details on change
    $('#product_id').change(function() {
        var productId = $(this).val();

        if (productId) {
           $.ajax({
    url: "/admin/get-product-details/" + productId,
                type: "GET",
                success: function(data) {
                    $('#product_price').val(data.price);
                    $('#product_discount').val(data.discount);
                },
                error: function() {
                    $('#product_price').val('');
                    $('#product_discount').val('');
                }
            });
        } else {
            $('#product_price').val('');
            $('#product_discount').val('');
        }
    });
});
</script>


@endsection