@extends('admin.layout.app')

@section('content')
    @extends('admin.layout.navbar')
    <div class="content">
        <div class="container-fluid pt-4 px-4">
            <div class="bg-secondary text-center rounded p-4">
                <div class="d-flex justify-content-between align-items-center mb-3">
                    <h3 class="mb-0">Festival Offers</h3>
                    <a href="{{ route('admin.festival-offers.create') }}" class="btn btn-primary">Add Festival
                        Offer</a>
                </div>
                @if(session('success'))
                    <div class="alert alert-success">{{ session('success') }}</div>
                @endif
                <div class="table-responsive">
                    <table class="table table-bordered">
                        <thead class="table-dark">
                            <tr>
                                <th>#</th>
                                <th>Product</th>
                                <th>Offer Title</th>
                                <th>Offer Price</th>
                                <th>Is Percentage</th>
                                <th>Offer Period</th>
                                <th>Status</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($offers as $offer)
                                <tr>
                                    <td>{{ $loop->iteration }}</td>
                                    <td>{{ $offer->product->name ?? '-' }}</td>
                                    <td>{{ $offer->title }}</td>
                                    <td>₹{{ $offer->offer_price }}</td>
                                    <td>
                                        @if($offer->is_percentage === 1)
                                            YES%
                                        @else
                                            ₹NO
                                        @endif
                                    </td>

                                    <td>{{ $offer->start_date }} - {{ $offer->end_date }}</td>
                                    <td>
                                        <span class="badge bg-{{ $offer->status ? 'success' : 'secondary' }}">
                                            {{ $offer->status ? 'Active' : 'Inactive' }}
                                        </span>
                                    </td>
                                    <td>
                                        <a href="{{ route('admin.festival-offers.edit', $offer->id) }}"
                                            class="btn btn-warning btn-sm">Edit</a>

                                        <form action="{{ route('admin.festival-offers.destroy', $offer->id) }}" method="POST"
                                            class="d-inline">
                                            @csrf @method('DELETE')
                                            <button class="btn btn-danger btn-sm"
                                                onclick="return confirm('Delete this offer?')">Delete</button>
                                        </form>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="7" class="text-center">No Offers Found</td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
@endsection