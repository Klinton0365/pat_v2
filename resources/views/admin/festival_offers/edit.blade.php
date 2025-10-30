@extends('admin.layout.app')

@section('content')
    @extends('admin.layout.navbar')
            <div class="content">
                <div class="container-fluid pt-4 px-4">
                    <div class="bg-secondary text-center rounded p-4">
                        <h6 class="mb-4">Edit Festival Offer</h6>

                        <form action="{{ route('admin.festival-offers.update', $festivalOffer->id) }}" method="POST">
                            @csrf @method('PUT')

                            <div class="mb-3">
                                <label>Select Product</label>
                                <select name="product_id" class="form-control" required>
                                    @foreach($products as $product)
                                        <option value="{{ $product->id }}" {{ $festivalOffer->product_id == $product->id ? 'selected' : '' }}>
                                            {{ $product->name }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>

                            <div class="mb-3">
                                <label>Offer Title</label>
                                <input type="text" name="title" class="form-control" value="{{ $festivalOffer->title }}"
                                    required>
                            </div>

                            <div class="mb-3">
                                <label>Slug</label>
                                <input type="text" name="slug" class="form-control" value="{{ $festivalOffer->slug }}"
                                    required>
                            </div>

                            <div class="mb-3">
                                <label>Offer Price</label>
                                <input type="number" step="0.01" name="offer_price"
                                    value="{{ $festivalOffer->offer_price }}" class="form-control">
                            </div>

                            <div class="mb-3">
                                <label>Offer Type</label>
                                <select name="is_percentage" class="form-control" required>
                                    <option value="0" {{ $festivalOffer->is_percentage == 0 ? 'selected' : '' }}>Amount</option>
                                    <option value="1" {{ $festivalOffer->is_percentage == 1 ? 'selected' : '' }}>Percentage</option>
                                </select>
                            </div>

                            <div class="row">
                                <div class="col-md-6 mb-3">
                                    <label>Start Date</label>
                                    <input type="date" name="start_date" class="form-control"
                                        value="{{ $festivalOffer->start_date }}">
                                </div>

                                <div class="col-md-6 mb-3">
                                    <label>End Date</label>
                                    <input type="date" name="end_date" class="form-control"
                                        value="{{ $festivalOffer->end_date }}">
                                </div>
                            </div>

                            <div class="mb-3">
                                <label>Description</label>
                                <textarea name="description" rows="4"
                                    class="form-control">{{ $festivalOffer->description }}</textarea>
                            </div>

                            <div class="mb-3">
                                <label>Status</label>
                                <select name="status" class="form-control">
                                    <option value="1" {{ $festivalOffer->status ? 'selected' : '' }}>Active</option>
                                    <option value="0" {{ !$festivalOffer->status ? 'selected' : '' }}>Inactive</option>
                                </select>
                            </div>

                            <button class="btn btn-success">Update Offer</button>
                            <a href="{{ route('admin.festival-offers.index') }}" class="btn btn-secondary">Cancel</a>
                        </form>

                    </div>
                </div>
            </div>
@endsection