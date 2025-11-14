@extends('admin.layout.app')

@section('content')

{{-- <div class="container-fluid pt-4 px-4">
    <div class="bg-secondary rounded p-4">

        <div class="d-flex justify-content-between mb-3">
            <h4 class="text-light">Services</h4>
            <a href="{{ route('admin.services.create') }}" class="btn btn-primary">Add Service</a>
        </div> --}}
 <div class="content">
            <div class="container-fluid pt-4 px-4">
                <div class="bg-secondary text-center rounded p-4">
                    <div class="d-flex align-items-center justify-content-between mb-4">
                        <h6 class="mb-0">Products</h6>
                        <a href="{{ route('admin.services.create') }}" class="btn btn-sm btn-primary">+ Add Service</a>
                    </div>
                    <div class="table-responsive"></div>
        <table class="table text-light">
            <thead>
                <tr>
                    <th>Service Code</th>
                    <th>Customer</th>
                    <th>Product</th>
                    <th>Schedule</th>
                    <th>Status</th>
                    <th>Technician</th>
                    <th>Actions</th>
                </tr>
            </thead>

            <tbody>
                @foreach ($services as $service)
                <tr>
                    <td>{{ $service->service_code }}</td>
                    <td>{{ $service->customer->customer_code ?? '—' }}</td>
                    <td>{{ $service->product->name ?? $service->external_product_name }}</td>
                    <td>{{ $service->scheduled_date ? $service->scheduled_date->format('d M Y') : '—' }}</td>
                    <td><span class="badge bg-info">{{ ucfirst($service->status) }}</span></td>
                    <td>{{ $service->technician->name ?? 'Not Assigned' }}</td>
                    <td>
                        <a href="{{ route('admin.services.edit', $service->id) }}" class="btn btn-sm btn-warning">Edit</a>
                        <form action="{{ route('admin.services.destroy', $service->id) }}" method="POST" style="display:inline">
                            @csrf @method('DELETE')
                            <button class="btn btn-sm btn-danger" onclick="return confirm('Delete?')">Delete</button>
                        </form>
                    </td>
                </tr>
                @endforeach
            </tbody>

        </table>

        {{ $services->links() }}
    {{-- </div>
</div> --}}

{{-- {{ $technicians->links() }} --}}
                        {{--
                    </div> --}}
                </div>
            </div>
        </div>
    </div>
@endsection
