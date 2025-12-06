@extends('admin.layout.app')

@section('content')
    {{-- <div class="container-fluid pt-4 px-4">
        <div class="bg-secondary rounded p-4"> --}}
            <div class="content">
                <div class="container-fluid pt-4 px-4">
                    <div class="bg-secondary text-center rounded p-4">
                        {{-- <div class="d-flex align-items-center justify-content-between mb-4">
                            <h6 class="mb-0">Inventory</h6>
                            <a href="{{ route('inventories.create') }}" class="btn btn-sm btn-primary">+ Add Stock</a>
                        </div> --}}
                        <div class="table-responsive">
                            <h4 class="text-light mb-4">Stock Movement Logs – {{ $product->name }}</h4>

                            <table class="table table-dark table-bordered text-center">
                                <thead>
                                    <tr>
                                        <th>Type</th>
                                        <th>Qty</th>
                                        <th>Batch No</th>
                                        <th>Cost Price</th>
                                        <th>Reference</th>
                                        <th>Date</th>
                                    </tr>
                                </thead>

                                <tbody>
                                    @foreach($logs as $log)
                                        <tr>
                                            <td class="text-info">{{ ucfirst($log->type) }}</td>
                                            <td>{{ $log->quantity }}</td>
                                            <td>{{ $log->batch->batch_no ?? '--' }}</td>
                                            <td>{{ $log->cost_price }}</td>
                                            <td>{{ $log->reference_type ?? '--' }}</td>
                                            <td>{{ $log->created_at->format('d M Y H:i') }}</td>
                                        </tr>
                                    @endforeach
                                </tbody>

                            </table>
                        </div>
                    </div>
                </div>
            </div>
            {{--
        </div>
    </div> --}}
@endsection