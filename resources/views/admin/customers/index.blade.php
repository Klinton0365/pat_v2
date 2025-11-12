@extends('admin.layout.app')
@section('content')
    {{--
    <div class="container mt-4">
        <div class="d-flex justify-content-between align-items-center mb-3">
            <h4>Customers List</h4>
            <a href="{{ route('admin.customers.create') }}" class="btn btn-primary">+ Add Customer</a>
        </div>

        @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
        @elseif(session('error'))
        <div class="alert alert-danger">{{ session('error') }}</div>
        @endif --}}
        {{-- @extends('admin.layout.navbar') --}}
        <div class="content">
            <div class="container-fluid pt-4 px-4">
                <div class="bg-secondary text-center rounded p-4">
                    <div class="d-flex justify-content-between align-items-center mb-3">
                        <h3 class="mb-0">Customers List</h3>
                        <a href="{{ route('admin.customers.create') }}" class="btn btn-primary">+ Add Customer</a>
                    </div>
                    @if(session('success'))
                        <div class="alert alert-success">{{ session('success') }}</div>
                    @elseif(session('error'))
                        <div class="alert alert-danger">{{ session('error') }}</div>
                    @endif
                    <div class="table-responsive">

                        <table class="table table-bordered table-striped">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Customer Code</th>
                                    <th>Name</th>
                                    <th>Mobile</th>
                                    <th>Email</th>
                                    <th>Type</th>
                                    <th>Status</th>
                                    <th>Company</th>
                                    <th>Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse ($customers as $customer)
                                    <tr>
                                        <td>{{ $loop->iteration }}</td>
                                        <td>{{ $customer->customer_code }}</td>
                                        <td>{{ $customer->user->first_name ?? '' }} {{ $customer->user->last_name ?? '' }}</td>
                                        <td>{{ $customer->user->email ?? '' }}</td>
                                        <td>{{ $customer->user->phone ?? '' }}</td>
                                        <td>{{ ucfirst($customer->customer_type) }}</td>
                                        <td>
                                            <span
                                                class="badge bg-{{ $customer->status == 'active' ? 'success' : 'secondary' }}">
                                                {{ ucfirst($customer->status) }}
                                            </span>
                                        </td>
                                        <td>{{ $customer->company_name ?? '-' }}</td>
                                        <td>
                                            <a href="{{ route('admin.customers.edit', $customer->id) }}"
                                                class="btn btn-sm btn-info">Edit</a>
                                            <form action="{{ route('admin.customers.destroy', $customer->id) }}" method="POST"
                                                class="d-inline">
                                                @csrf
                                                @method('DELETE')
                                                <button onclick="return confirm('Delete this customer?')"
                                                    class="btn btn-sm btn-danger">Delete</button>
                                            </form>
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="8" class="text-center text-muted">No customers found.</td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>

                        {{-- <div class="mt-3">
                            {{ $customers->links() }}
                        </div>
                    </div> --}}
                </div>
            </div>
        </div>
    </div>

@endsection