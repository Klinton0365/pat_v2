@extends('admin.layout.app')

@section('content')
    {{-- <div class="container">
        <h2>Edit Technician</h2> --}}
        <div class="content">
            <div class="container-fluid pt-4 px-4">
                <div class="bg-secondary text-center rounded p-4">
                    <h6 class="mb-4">Edit Product</h6>

                    <form method="POST" action="{{ route('admin.technicians.update', $technician->id) }}">
                        @csrf
                        @method('PUT')

                        <div class="mb-3">
                            <label>User</label>
                            <select name="user_id" class="form-control">
                                @foreach($users as $user)
                                    <option value="{{ $user->id }}" {{ $technician->user_id == $user->id ? 'selected' : '' }}>
                                        {{ $user->first_name }} {{ $user->last_name }} ({{ $user->email }})
                                    </option>
                                @endforeach
                            </select>
                        </div>

                        <div class="mb-3">
                            <label>Employee Code</label>
                            <input type="text" name="employee_code" value="{{ $technician->employee_code }}"
                                class="form-control" required>
                        </div>

                        <div class="mb-3">
                            <label>Specialization</label>
                            <input type="text" name="specialization" value="{{ $technician->specialization }}"
                                class="form-control">
                        </div>

                        <div class="mb-3">
                            <label>Experience (Years)</label>
                            <input type="number" name="experience_years" value="{{ $technician->experience_years }}"
                                class="form-control">
                        </div>

                        <div class="mb-3">
                            <label>Certification No</label>
                            <input type="text" name="certification_no" value="{{ $technician->certification_no }}"
                                class="form-control">
                        </div>

                        <div class="mb-3">
                            <label>Service Area</label>
                            <input type="text" name="service_area" value="{{ $technician->service_area }}"
                                class="form-control">
                        </div>

                        <button class="btn btn-primary">Update</button>
                        <a href="{{ route('admin.technicians.index') }}" class="btn btn-secondary">Cancel</a>
                    </form>
                    {{--
                </div> --}}
            </div>
        </div>
    </div>
@endsection