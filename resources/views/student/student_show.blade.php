@extends('layouts.adminLayout')

@section('title', 'Item Details')

@section('content')
<link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
<link rel="stylesheet" href="{{ asset('plugins/fontawesome-free/css/all.min.css') }}">
<link rel="stylesheet" href="{{ asset('dist/css/adminlte.min.css') }}">

<div class="content-wrapper">
    <section class="content">
        <!-- Back to Items button -->
        <a href="{{ route('student.index') }}" class="btn btn-primary m-2">Back to Students</a>

        <div class="container-fluid">
            <div class="row justify-content-center">
                <div class="col-md-8">
                    <div class="card card-info">
                        <div class="card-header text-center">
                            <h3 class="card-title">Item Details</h3>
                        </div>
                        
                        <div class="card-body">
                            @if($student->image_path)
                                <div class="text-center mb-3">
                                    <img width="100px" src="{{ asset('storage/' . $student->image_path) }}" alt="image">
                                </div>
                            @else
                                <p class="text-center text-muted">No Image Available</p>
                            @endif
                            <div class="form-group">
                                <h5><i class="fas fa-tag"></i> Name</h5>
                                <p class="text-muted">{{ $student->name }}</p>
                            </div>

                            <div class="form-group">
                                <h5><i></i> Phone Number</h5>
                                <p class="text-muted">${{ $student->phone_number }}</p>
                            </div>

                        </div>

                        <!-- Card Footer with Edit and Delete Buttons -->
                        <div class="card-footer text-right">
                            <a href="{{ route('student.edit', $student->id) }}" class="btn btn-warning">
                                <i class="fas fa-edit"></i> Edit
                            </a>
                            <form action="{{ route('student.destroy', $student->id) }}" method="POST" style="display:inline;">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger">
                                    <i class="fas fa-trash-alt"></i> Delete
                                </button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>

<!-- Scripts -->
<script src="{{ asset('plugins/jquery/jquery.min.js') }}"></script>
<script src="{{ asset('plugins/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
<script src="{{ asset('dist/js/adminlte.min.js') }}"></script>

@endsection
