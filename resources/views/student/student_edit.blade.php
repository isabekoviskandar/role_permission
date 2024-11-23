@extends('layouts.adminLayout')

@section('title', 'Edit Student')

@section('content')

<!-- Google Font: Source Sans Pro -->
<link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
<!-- Font Awesome -->
<link rel="stylesheet" href="{{ asset('plugins/fontawesome-free/css/all.min.css') }}">
<!-- Theme style -->
<link rel="stylesheet" href="{{ asset('dist/css/adminlte.min.css') }}">

<div class="content-wrapper">
    <section class="content">
        <a href="/students" class="btn btn-primary m-2">Students</a>
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
            
            <div class="row">
                <div class="col-md-12">
                    <div class="card card-primary">
                        <div class="card-header">
                            <h3 class="card-title">Edit Student</h3>
                        </div>
                        
                        <form action="{{ route('student.update', $student->id) }}" method="POST" enctype="multipart/form-data">
                            @csrf
                            @method('PUT')
                            <div class="card-body">

                                <!-- Name -->
                                <div class="form-group">
                                    <label for="nameInput">Name</label>
                                    <input type="text" class="form-control" name="name" id="nameInput" value="{{ $student->name }}">
                                    @error('name')
                                        <label style="color: red">{{ $message }}</label>
                                    @enderror
                                </div>

                                <!-- Phone Number -->
                                <div class="form-group">
                                    <label for="phoneNumberInput">Phone Number</label>
                                    <input type="text" class="form-control" name="phone_number" id="phoneNumberInput" value="{{ $student->phone_number }}">
                                    @error('phone_number')
                                        <label style="color: red">{{ $message }}</label>
                                    @enderror
                                </div>

                                <!-- Image -->
                                <div class="form-group">
                                    <label for="imageInput">Image</label>
                                    <input type="file" class="form-control" name="image_path" id="imageInput">
                                    @if ($student->image_path)
                                        <img src="{{ asset('storage/' . $student->image_path) }}" alt="Current Image" style="width: 100px; margin-top: 10px;">
                                    @endif
                                    @error('image_path')
                                        <label style="color: red">{{ $message }}</label>
                                    @enderror
                                </div>
                            </div>

                            <div class="card-footer">
                                <button type="submit" class="btn btn-primary">Update</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>

<!-- Scripts -->
<script src="{{ asset('plugins/jquery/jquery.min.js') }}"></script>
<script src="{{ asset('plugins/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
<script src="{{ asset('plugins/bs-custom-file-input/bs-custom-file-input.min.js') }}"></script>
<script src="{{ asset('dist/js/adminlte.min.js') }}"></script>
<script>
  $(function () {
    bsCustomFileInput.init();
  });
</script>

@endsection
