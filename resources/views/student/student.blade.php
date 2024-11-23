@extends('layouts.adminLayout')

@section('title', 'Student Page')

@section('content')
<div class="content-wrapper">
    <!-- Main content -->
    <section class="content">
        <div class="container-fluid">
            
            @if (session('success'))
                <div class="alert alert-success alert-dismissible fade show" role="alert">
                    <strong>{{ session('success') }}</strong>
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
            @endif
            
            @if (session('error'))
                <div class="alert alert-warning alert-dismissible fade show" role="alert">
                    <strong>{{ session('error') }}</strong>
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
            @endif

            @if (auth()->check() && (auth()->user()->role == 'admin' || auth()->user()->role == 'create'))
                <button class="btn btn-primary m-2" data-toggle="modal" data-target="#studentModal">Create</button>
            @endif
            
            <table class="table table-striped table-bordered">
                <thead class="thead-dark">
                    <tr>
                        <th>ID</th>
                        <th>Name</th>
                        <th>Phone Number</th>
                        <th>Image</th>
                        <th>Created Time</th>
                        @if (auth()->check())
                            <th>Actions</th>
                        @endif
                    </tr>
                </thead>
                <tbody>
                    @foreach ($students as $item)
                        <tr>
                            <td>{{ $item->id }}</td>
                            <td>{{ $item->name }}</td>
                            <td>{{ $item->phone_number }}</td>
                            <td>
                                <img width="100px" src="{{ asset('storage/' . $item->image_path) }}" alt="image">
                            </td>
                            
                            <td>{{ $item->created_at }}</td>
                            <td>
                                <div class="d-inline-flex">

                                    @if (auth()->check() && (auth()->user()->role == 'admin' || auth()->user()->role == 'edit'))
                                        <a href="/student-edit/{{ $item->id }}" class="btn btn-sm btn-warning mr-1">Edit</a>

                                    @endif

                                    @if (auth()->check() && (auth()->user()->role == 'admin' || auth()->user()->role == 'delete'))
                                        <form action="/student-delete/{{ $item->id }}" method="POST" style="display:inline;">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-danger btn-sm">Delete</button>
                                        </form>
                                    @endif

                                    @if (auth()->check() && (auth()->user()->role == 'admin' || auth()->user()->role == 'show'))
                                        <a href="/student-show/{{ $item->id }}" class="btn btn-sm btn-warning ml-1">Show</a>
                                    @endif
                                </div>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
            
            <!-- Pagination -->
            {{ $students->links() }}
        </div>
    </section>
</div>

<!-- Modal for creating and editing student -->
<div class="modal fade" id="studentModal" tabindex="-1" aria-labelledby="studentModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="studentModalLabel">Create Student</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form action="{{ route('student.store') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="modal-body">
                    <div class="form-group">
                        <label for="name">Name</label>
                        <input type="text" class="form-control" id="name" name="name" required>
                    </div>
                    
                    <div class="form-group">
                        <label for="phone">Phone Number</label>
                        <input type="text" class="form-control" id="phone" name="phone_number" required>
                    </div>
                    
                    <div class="form-group">
                        <label for="image">Image</label>
                        <input type="file" class="form-control" id="image" name="image_path">
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary" id="submitBtn">Save</button>
                </div>
            </form>
            
        </div>
    </div>
</div>


@endsection
