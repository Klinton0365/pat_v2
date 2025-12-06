@extends('admin.layout.app')

@section('content')
    {{-- <div class="container-fluid pt-4 px-4">
        <div class="bg-secondary rounded p-4">

            <div class="d-flex justify-content-between mb-3">
                <h4 class="text-light">Inventory</h4>
                <a href="{{ route('inventories.create') }}" class="btn btn-primary">Add Stock</a>
            </div> --}}
            <div class="content">
                <div class="container-fluid pt-4 px-4">
                    <div class="bg-secondary text-center rounded p-4">
                        <div class="d-flex align-items-center justify-content-between mb-4">
                            <h6 class="mb-0">Inventory</h6>
                            <a href="{{ route('inventories.create') }}" class="btn btn-sm btn-primary">+ Add Stock</a>
                        </div>
                        <div class="table-responsive">
                            <table class="table table-dark table-hover text-center">
                                <thead>
                                    <tr>
                                        <th>Product</th>
                                        <th>Total Stock</th>
                                        <th>Available</th>
                                        <th>Reserved</th>
                                        <th>Actions</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($stocks as $s)
                                        <tr>
                                            <td>{{ $s->product->name }}</td>
                                            <td>{{ $s->total_stock }}</td>
                                            <td>{{ $s->available_stock }}</td>
                                            <td>{{ $s->reserved_stock }}</td>
                                            <td>
                                                <a href="{{ route('inventories.logs', $s->product_id) }}"
                                                    class="btn btn-sm btn-info">
                                                    View Logs
                                                </a>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>

                            {{-- {{ $services->links() }} --}}
                        </div>
                    </div>
                </div>
            </div>
            {{--
        </div>
    </div> --}}
@endsection