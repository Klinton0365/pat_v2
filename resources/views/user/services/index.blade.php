@extends('user.dashboard.layout.app')

@section('content')
<div class="container py-4">
    <h3 class="mb-4">My Services</h3>

    <table class="table table-bordered">
        <thead class="table-dark">
            <tr>
                <th>Service Code</th>
                <th>Product</th>
                <th>Status</th>
                <th>Scheduled</th>
                <th>Next Service</th>
                <th></th>
            </tr>
        </thead>

        <tbody>
        @foreach($services as $s)
            <tr>
                <td>{{ $s->service_code }}</td>
                <td>{{ $s->product->name ?? 'External' }}</td>
                <td><span class="badge bg-info">{{ $s->status }}</span></td>
                <td>{{ optional($s->scheduled_date)->format('d M Y') }}</td>
                <td>{{ optional($s->next_service_date)->format('d M Y') }}</td>
                <td><a href="{{ route('user.services.show', $s->id) }}" class="btn btn-sm btn-primary">View</a></td>
            </tr>
        @endforeach
        </tbody>
    </table>

    {{ $services->links() }}
</div>
@endsection
