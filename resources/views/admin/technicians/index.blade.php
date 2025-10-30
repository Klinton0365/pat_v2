@extends('admin.layout.app')

@section('content')
    {{-- <div class="container">
        <h2 class="mb-3">Technicians</h2>
        <a href="{{ route('admin.technicians.create') }}" class="btn btn-primary mb-3">+ Add Technician</a>

        @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
        @endif --}}
        <div class="content">
            <div class="container-fluid pt-4 px-4">
                <div class="bg-secondary text-center rounded p-4">
                    <div class="d-flex align-items-center justify-content-between mb-4">
                        <h6 class="mb-0">Products</h6>
                        <a href="{{ route('admin.technicians.create') }}" class="btn btn-sm btn-primary">+ Add Technician</a>
                    </div>
                    <div class="table-responsive">
                        <table class="table table-bordered table-striped">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>User</th>
                                    <th>Employee Code</th>
                                    <th>Specialization</th>
                                    <th>Experience</th>
                                    <th>Service Area</th>
                                    <th>Rating</th>
                                    <th>Status</th>
                                    <th>On Duty</th>
                                    <th>Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($technicians as $tech)
                                    <tr>
                                        <td>{{ $loop->iteration }}</td>
                                        <td>{{ $tech->user->first_name }} {{ $tech->user->last_name }}</td>
                                        <td>{{ $tech->employee_code }}</td>
                                        <td>{{ $tech->specialization }}</td>
                                        <td>{{ $tech->experience_years }} yrs</td>
                                        <td>{{ $tech->service_area }}</td>
                                        <td>{{ $tech->rating }}</td>
                                        <td>{{ $tech->active ? 'Active' : 'Inactive' }}</td>
                                        <td>{{ $tech->on_duty ? 'Yes' : 'No' }}</td>
                                        <td>
                                            <a href="{{ route('admin.technicians.edit', $tech->id) }}"
                                                class="btn btn-sm btn-warning">Edit</a>
                                            <form action="{{ route('admin.technicians.destroy', $tech->id) }}" method="POST"
                                                style="display:inline;">
                                                @csrf @method('DELETE')
                                                <button type="submit" class="btn btn-sm btn-danger"
                                                    onclick="return confirm('Delete this technician?')">Delete</button>
                                            </form>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>

                        {{ $technicians->links() }}
                        {{--
                    </div> --}}
                </div>
            </div>
        </div>
    </div>
@endsection