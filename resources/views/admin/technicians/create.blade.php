@extends('admin.layout.app')
@section('content')
    {{-- <div class="container">
        <h2>Add Technician</h2> --}}
        <div class="content">
            <div class="container-fluid pt-4 px-4">
                <div class="bg-secondary text-center rounded p-4">
                    <h6 class="mb-4">Add Technician</h6>

                    <form method="POST" action="{{ route('admin.technicians.store') }}">
                        @csrf

                        <div class="mb-3">
                            <label>User</label>
                            <select name="user_id" class="form-control" required>
                                <option value="">Select User</option>
                                @foreach($users as $user)
                                    <option value="{{ $user->id }}">{{ $user->first_name }} {{ $user->last_name }}
                                        ({{ $user->email }})</option>
                                @endforeach
                            </select>
                        </div>

                        <div class="mb-3">
                            <label>Employee Code</label>
                            <input type="text" name="employee_code" class="form-control" required>
                        </div>

                        <div class="mb-3">
                            <label>Specialization</label>
                            <input type="text" name="specialization" class="form-control">
                        </div>

                        <div class="mb-3">
                            <label>Experience (Years)</label>
                            <input type="number" name="experience_years" class="form-control">
                        </div>

                        <div class="mb-3">
                            <label>Certification No</label>
                            <input type="text" name="certification_no" class="form-control">
                        </div>

                        <div class="mb-3">
                            <label>Service Area</label>
                            <input type="text" name="service_area" class="form-control">
                        </div>

                        <button class="btn btn-success">Save</button>
                        <a href="{{ route('admin.technicians.index') }}" class="btn btn-secondary">Cancel</a>
                    </form>
                    {{--
                </div> --}}
            </div>
        </div>
    </div>
@endsection