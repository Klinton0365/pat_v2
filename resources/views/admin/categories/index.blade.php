@extends('admin.layout.app')

@section('content')
@extends('admin.layout.navbar')

    <div class="content">
        
        <div class="container-fluid pt-4 px-4">
            <div class="bg-secondary text-center rounded p-4">
                <div class="d-flex align-items-center justify-content-between mb-4">
                    <h6 class="mb-0">Categories</h6>
                    <a href="{{ route('categories.create') }}" class="btn btn-sm btn-primary">Add Category</a>
                </div>
                <div class="table-responsive">
                    <table class="table text-start align-middle table-bordered table-hover mb-0">
                        <thead>
                            <tr class="text-white">
                                <th>#</th>
                                <th>Name</th>
                                <th>Description</th>
                                <th>Created</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($categories as $category)
                                <tr>
                                    <td>{{ $loop->iteration }}</td>
                                    <td>{{ $category->name }}</td>
                                    <td>{{ $category->description }}</td>
                                    <td>{{ $category->created_at->format('d M Y') }}</td>
                                    <td>
                                        <a href="{{ route('categories.edit', $category) }}"
                                            class="btn btn-sm btn-warning">Edit</a>
                                        <form action="{{ route('categories.destroy', $category) }}" method="POST"
                                            style="display:inline-block;">
                                            @csrf @method('DELETE')
                                            <button class="btn btn-sm btn-danger"
                                                onclick="return confirm('Delete this category?')">Delete</button>
                                        </form>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="5">No Categories Found</td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
@endsection
